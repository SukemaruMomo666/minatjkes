<?php

namespace App\Livewire\Dosen\Dashboard;

use App\Enums\UserRole;
use App\Models\DraftJawaban;
use App\Models\Kelas;
use App\Models\Soal;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $dosenNama = '';

    public int $totalMahasiswa = 0;

    public int $asesmenSelesai = 0;

    public int $belumMulai = 0;

    public int $sedangProses = 0;

    public int $rataKecocokan = 0;

    public array $hasilAsesmen = [];

    public array $distribusiMinat = [];

    public array $petaKompetensi = [];

    public function mount(): void
    {
        $this->dosenNama = Auth::user()->nama;
        $this->kalkulasiData();
    }

    private function kalkulasiData(): void
    {
        $totalSoal = Soal::where('is_active', true)->count();

        // Cari kelas yang diampu dosen ini
        $kelas = Kelas::where('dosen_wali_id', Auth::id())->first();

        if ($kelas) {
            $mahasiswas = User::where('role', UserRole::Mahasiswa)
                ->where('kelas_id', $kelas->id)
                ->get();
        } else {
            // Fallback: tampilkan semua mahasiswa
            $mahasiswas = User::where('role', UserRole::Mahasiswa)->get();
        }

        $this->totalMahasiswa = $mahasiswas->count();

        if ($totalSoal === 0 || $this->totalMahasiswa === 0) {
            return;
        }

        $totalKecocokan = 0;
        $rekapDistribusi = [];
        $rekapKompetensi = [];

        foreach ($mahasiswas as $mhs) {
            $jawabans = DraftJawaban::with('soal.kategori')
                ->where('user_id', $mhs->id)
                ->get();

            $jumlahDijawab = $jawabans->count();

            $status = 'Belum Mulai';
            $isSelesai = false;

            if ($jumlahDijawab > 0 && $jumlahDijawab < $totalSoal) {
                $status = 'Proses ('.round(($jumlahDijawab / $totalSoal) * 100).'%)';
                $this->sedangProses++;
            } elseif ($jumlahDijawab >= $totalSoal) {
                $status = 'Selesai';
                $isSelesai = true;
                $this->asesmenSelesai++;
            } else {
                $this->belumMulai++;
            }

            $skorMentah = [];
            foreach ($jawabans as $jawaban) {
                if ($jawaban->soal && $jawaban->soal->kategori) {
                    $namaKat = $jawaban->soal->kategori->nama_kategori;
                    if (! isset($skorMentah[$namaKat])) {
                        $skorMentah[$namaKat] = ['total' => 0, 'jumlah' => 0];
                    }
                    $skorMentah[$namaKat]['total'] += (int) $jawaban->jawaban;
                    $skorMentah[$namaKat]['jumlah']++;
                }
            }

            $kategoriTertinggi = '-';
            $skorTertinggi = 0;

            foreach ($skorMentah as $nama => $data) {
                $maxSkor = $data['jumlah'] * 5;
                $pct = $maxSkor > 0 ? round(($data['total'] / $maxSkor) * 100) : 0;

                if (! isset($rekapKompetensi[$nama])) {
                    $rekapKompetensi[$nama] = [];
                }
                $rekapKompetensi[$nama][] = $pct;

                if ($pct > $skorTertinggi) {
                    $skorTertinggi = $pct;
                    $kategoriTertinggi = $nama;
                }
            }

            if ($isSelesai) {
                $totalKecocokan += $skorTertinggi;
                $rekapDistribusi[$kategoriTertinggi] = ($rekapDistribusi[$kategoriTertinggi] ?? 0) + 1;
            }

            if ($jumlahDijawab > 0) {
                $this->hasilAsesmen[] = [
                    'nama' => $mhs->nama ?? 'Mahasiswa',
                    'nim' => $mhs->nim_nidn ?? '-',
                    'kelas' => $kelas?->nama_kelas ?? '-',
                    'kategori_utama' => $kategoriTertinggi,
                    'skor_utama' => $skorTertinggi,
                    'status' => $status,
                ];
            }
        }

        if ($this->asesmenSelesai > 0) {
            $this->rataKecocokan = round($totalKecocokan / $this->asesmenSelesai);
        }

        $this->distribusiMinat = [
            'labels' => array_keys($rekapDistribusi),
            'data' => array_values($rekapDistribusi),
        ];

        $radarLabels = [];
        $radarData = [];
        foreach ($rekapKompetensi as $kat => $vals) {
            $radarLabels[] = $kat;
            $radarData[] = round(array_sum($vals) / count($vals));
        }

        $this->petaKompetensi = [
            'labels' => $radarLabels,
            'data' => $radarData,
        ];
    }

    public function render(): View
    {
        return view('livewire.dosen.dashboard.index')->layout('layouts.blank');
    }
}
