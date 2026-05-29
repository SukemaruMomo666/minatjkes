<?php

namespace App\Livewire\Dosen\Dashboard;

use App\Models\User;
use App\Models\Soal;
use App\Models\DraftJawaban;
use Livewire\Component;

class Index extends Component
{
    public $totalMahasiswa = 0;
    public $asesmenSelesai = 0;
    public $rataKecocokan = 0;
    public $konsultasiTertunda = 12; 

    public $hasilAsesmen = [];
    public $distribusiMinat = [];
    public $petaKompetensi = [];

    public function mount()
    {
        $this->kalkulasiDataRiil();
    }

    private function kalkulasiDataRiil()
    {
        $mahasiswas = User::where('role', 'mahasiswa')
            ->orWhere('role', 'user') 
            ->get();
            
        $totalSoal = Soal::count();
        $this->totalMahasiswa = $mahasiswas->count();

        if ($totalSoal == 0 || $this->totalMahasiswa == 0) return;

        $totalKecocokanSemua = 0;
        $rekapDistribusi = [];
        $rekapKompetensi = [];

        foreach ($mahasiswas as $mhs) {
            $jawabans = DraftJawaban::with('soal.kategori')->where('user_id', $mhs->id)->get();
            $jumlahDijawab = $jawabans->count();

            $status = 'Belum Mulai';
            $isSelesai = false;
            if ($jumlahDijawab > 0 && $jumlahDijawab < $totalSoal) {
                $status = 'Proses (' . round(($jumlahDijawab / $totalSoal) * 100) . '%)';
            } elseif ($jumlahDijawab == $totalSoal && $totalSoal > 0) {
                $status = 'Terverifikasi';
                $isSelesai = true;
                $this->asesmenSelesai++;
            }

            $skorMentah = [];
            foreach ($jawabans as $jawaban) {
                if ($jawaban->soal && $jawaban->soal->kategori) {
                    $namaKategori = $jawaban->soal->kategori->nama_kategori;
                    if (!isset($skorMentah[$namaKategori])) {
                        $skorMentah[$namaKategori] = ['total_nilai' => 0, 'jumlah_soal' => 0];
                    }
                    $skorMentah[$namaKategori]['total_nilai'] += (int) $jawaban->jawaban;
                    $skorMentah[$namaKategori]['jumlah_soal']++;
                }
            }

            $kategoriTertinggi = '-';
            $skorTertinggi = 0;

            foreach ($skorMentah as $nama => $data) {
                $maxSkor = $data['jumlah_soal'] * 5;
                $persentase = round(($data['total_nilai'] / $maxSkor) * 100);
 
                if (!isset($rekapKompetensi[$nama])) {
                    $rekapKompetensi[$nama] = [];
                }
                $rekapKompetensi[$nama][] = $persentase;

                if ($persentase > $skorTertinggi) {
                    $skorTertinggi = $persentase;
                    $kategoriTertinggi = $nama;
                }
            }

            if ($isSelesai) {
                $totalKecocokanSemua += $skorTertinggi;

                if (!isset($rekapDistribusi[$kategoriTertinggi])) {
                    $rekapDistribusi[$kategoriTertinggi] = 0;
                }
                $rekapDistribusi[$kategoriTertinggi]++;
            }

            if ($jumlahDijawab > 0) {
                $this->hasilAsesmen[] = [
                    'nama' => $mhs->nama ?? 'Mahasiswa',
                    'nim' => $mhs->nim_nidn ?? 'N/A',
                    'kelas' => 'Keperawatan-A',
                    'kategori_utama' => $kategoriTertinggi,
                    'skor_utama' => $skorTertinggi,
                    'status' => $status
                ];
            }
        }

        if ($this->asesmenSelesai > 0) {
            $this->rataKecocokan = round($totalKecocokanSemua / $this->asesmenSelesai);
        }

        $this->distribusiMinat = [
            'labels' => array_keys($rekapDistribusi),
            'data' => array_values($rekapDistribusi)
        ];

        $radarLabels = [];
        $radarData = [];
        foreach ($rekapKompetensi as $kategori => $nilaiArray) {
            $radarLabels[] = $kategori;
            $radarData[] = round(array_sum($nilaiArray) / count($nilaiArray));
        }
        
        $this->petaKompetensi = [
            'labels' => $radarLabels,
            'data' => $radarData
        ];
    }

    public function render()
    {
        return view('livewire.dosen.dashboard.index')->layout('layouts.blank');
    }
}