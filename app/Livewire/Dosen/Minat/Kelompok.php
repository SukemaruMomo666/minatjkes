<?php

namespace App\Livewire\Dosen\Minat;

use App\Enums\UserRole;
use App\Models\DraftJawaban;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Kelompok extends Component
{
    public string $namaKelas = '';

    public ?string $selectedKategori = null;

    /** @var array<string, array<int, array<string, mixed>>> */
    public array $kelompokData = [];

    /** @var array<string, int> */
    public array $jumlahPerKategori = [];

    public int $belumTes = 0;

    /** @var array<int, array<string, mixed>> */
    public array $mahasiswaBelumTes = [];

    public function mount(): void
    {
        $kelas = Kelas::where('dosen_wali_id', Auth::id())->first();
        $this->namaKelas = $kelas?->nama_kelas ?? '';

        $mahasiswas = $kelas
            ? User::where('role', UserRole::Mahasiswa)->where('kelas_id', $kelas->id)->orderBy('nama')->get()
            : User::where('role', UserRole::Mahasiswa)->orderBy('nama')->get();

        if ($mahasiswas->isEmpty()) {
            return;
        }

        $mhsIds = $mahasiswas->pluck('id');

        $allJawabans = DraftJawaban::with('soal.kategori')
            ->whereIn('user_id', $mhsIds)
            ->get()
            ->groupBy('user_id');

        $kelompok = [];

        foreach ($mahasiswas as $mhs) {
            $jawabans = $allJawabans[$mhs->id] ?? collect();

            if ($jawabans->isEmpty()) {
                $this->belumTes++;
                $this->mahasiswaBelumTes[] = [
                    'id' => $mhs->id,
                    'nama' => $mhs->nama,
                    'nim_nidn' => $mhs->nim_nidn ?? '-',
                    'nama_kelas' => $mhs->kelas?->nama_kelas ?? '-',
                ];

                continue;
            }

            $skorMentah = [];
            foreach ($jawabans as $jawaban) {
                $soal = $jawaban->soal;
                $nilai = (int) $jawaban->jawaban;

                if ($soal->is_unfav) {
                    $nilai = 6 - $nilai;
                }

                if ($soal->kategori) {
                    $nama = $soal->kategori->nama_kategori;
                    if (! isset($skorMentah[$nama])) {
                        $skorMentah[$nama] = ['total_nilai' => 0, 'jumlah_soal' => 0];
                    }
                    $skorMentah[$nama]['total_nilai'] += $nilai;
                    $skorMentah[$nama]['jumlah_soal']++;
                }
            }

            if (empty($skorMentah)) {
                continue;
            }

            $persentase = [];
            foreach ($skorMentah as $nama => $data) {
                $maxSkor = $data['jumlah_soal'] * 5;
                $persentase[$nama] = $maxSkor > 0 ? round(($data['total_nilai'] / $maxSkor) * 100) : 0;
            }

            arsort($persentase);
            $topKategori = array_key_first($persentase);
            $topSkor = $persentase[$topKategori];

            $kelompok[$topKategori][] = [
                'id' => $mhs->id,
                'nama' => $mhs->nama,
                'nim_nidn' => $mhs->nim_nidn ?? '-',
                'nama_kelas' => $mhs->kelas?->nama_kelas ?? '-',
                'skor' => $topSkor,
            ];
        }

        arsort($kelompok);
        $this->kelompokData = $kelompok;

        foreach ($kelompok as $kat => $list) {
            $this->jumlahPerKategori[$kat] = count($list);
        }
    }

    public function pilihKategori(string $kategori): void
    {
        $this->selectedKategori = $kategori;
    }

    public function kembali(): void
    {
        $this->selectedKategori = null;
    }

    public function render(): View
    {
        return view('livewire.dosen.minat.kelompok')->layout('layouts.blank');
    }
}
