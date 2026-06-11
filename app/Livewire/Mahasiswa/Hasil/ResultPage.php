<?php

namespace App\Livewire\Mahasiswa\Hasil;

use App\Models\DraftJawaban;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ResultPage extends Component
{
    public $radarLabels = [];

    public $radarData = [];

    public $topKategori = [];

    public $tipeKepribadian = '';

    public $deskripsiKepribadian = '';

    public $mbtiResult = '';

    public function mount()
    {
        $userId = Auth::id();
        $jawabans = DraftJawaban::with('soal.kategori')->where('user_id', $userId)->get();

        if ($jawabans->isEmpty()) {
            return redirect()->route('mahasiswa.tes');
        }

        $skorMentah = [];
        $mbtiSkor = ['E' => 0, 'I' => 0, 'S' => 0, 'N' => 0, 'T' => 0, 'F' => 0, 'J' => 0, 'P' => 0];

        foreach ($jawabans as $jawaban) {
            $soal = $jawaban->soal;
            $nilai = (int) $jawaban->jawaban; // Skala 1-5

            // 1. HITUNG MINAT (Kategori Akademik/Non-Akademik)
            if ($soal->kategori) {
                $namaKategori = $soal->kategori->nama_kategori;
                if (! isset($skorMentah[$namaKategori])) {
                    $skorMentah[$namaKategori] = ['total_nilai' => 0, 'jumlah_soal' => 0];
                }
                $skorMentah[$namaKategori]['total_nilai'] += $nilai;
                $skorMentah[$namaKategori]['jumlah_soal']++;
            }

            // 2. HITUNG MBTI
            if ($soal->tipe === 'mbti' && $soal->dimensi_mbti) {
                // Misal: dimensi 'EI'. Pilihan 4 & 5 (Setuju) = E, Pilihan 1 & 2 (Tidak Setuju) = I
                $hurufKiri = substr($soal->dimensi_mbti, 0, 1);
                $hurufKanan = substr($soal->dimensi_mbti, 1, 1);

                if ($nilai > 3) {
                    $mbtiSkor[$hurufKiri]++;
                } elseif ($nilai < 3) {
                    $mbtiSkor[$hurufKanan]++;
                }
            }
        }

        // Tentukan MBTI Akhir
        $E_or_I = ($mbtiSkor['E'] >= $mbtiSkor['I']) ? 'E' : 'I';
        $S_or_N = ($mbtiSkor['S'] >= $mbtiSkor['N']) ? 'S' : 'N';
        $T_or_F = ($mbtiSkor['T'] >= $mbtiSkor['F']) ? 'T' : 'F';
        $J_or_P = ($mbtiSkor['J'] >= $mbtiSkor['P']) ? 'J' : 'P';
        $this->mbtiResult = $E_or_I.$S_or_N.$T_or_F.$J_or_P;

        // Proses Persentase Minat untuk Radar Chart
        $persentaseKategori = [];
        foreach ($skorMentah as $nama => $data) {
            $maxSkor = $data['jumlah_soal'] * 5;
            $persentase = ($data['total_nilai'] / $maxSkor) * 100;
            $persentaseKategori[$nama] = round($persentase);
            $this->radarLabels[] = $nama;
            $this->radarData[] = round($persentase);
        }

        arsort($persentaseKategori);
        $this->topKategori = array_slice($persentaseKategori, 0, 3, true);
        $kategoriTertinggi = array_key_first($this->topKategori);

        // Gabungkan MBTI dan Minat
        $this->tentukanKepribadian($kategoriTertinggi, $this->mbtiResult);
    }

    private function tentukanKepribadian($kategoriUtama, $mbti)
    {
        $kombinasi = $mbti.' - '.($kategoriUtama ?? 'Umum');

        $this->tipeKepribadian = 'Profil: '.$mbti;
        $this->deskripsiKepribadian = "Berdasarkan kepribadian {$mbti} Anda dan minat tertinggi di bidang {$kategoriUtama}, Anda disarankan mengambil jalur karir yang memanfaatkan kemampuan analisis dan empati Anda secara seimbang.";
    }

    public function render()
    {
        return view('livewire.mahasiswa.hasil.result-page')->layout('layouts.blank');
    }
}
