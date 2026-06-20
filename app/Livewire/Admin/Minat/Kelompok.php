<?php

namespace App\Livewire\Admin\Minat;

use App\Enums\UserRole;
use App\Models\DraftJawaban;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Kelompok extends Component
{
    public ?int $filterKelas = null;

    public ?string $selectedKategori = null;

    /** @var array<string, array<int, array<string, mixed>>> */
    public array $kelompokData = [];

    public int $belumTes = 0;

    /** @var array<int, array<string, mixed>> */
    public array $mahasiswaBelumTes = [];

    public function updatingFilterKelas(): void
    {
        $this->selectedKategori = null;
        $this->hitungKelompok();
    }

    public function mount(): void
    {
        $this->hitungKelompok();
    }

    private function hitungKelompok(): void
    {
        $this->kelompokData = [];
        $this->belumTes = 0;
        $this->mahasiswaBelumTes = [];

        $query = User::with('kelas')->where('role', UserRole::Mahasiswa);

        if ($this->filterKelas) {
            $query->where('kelas_id', $this->filterKelas);
        }

        $mahasiswas = $query->orderBy('nama')->get();

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
        return view('livewire.admin.minat.kelompok', [
            'kelasList' => Kelas::where('is_active', true)->orderBy('nama_kelas')->get(),
        ])->layout('layouts.blank');
    }
}
