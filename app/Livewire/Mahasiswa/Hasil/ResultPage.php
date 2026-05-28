<?php

namespace App\Livewire\Mahasiswa\Hasil;

use Livewire\Component;
use App\Models\DraftJawaban;
use Illuminate\Support\Facades\Auth;

class ResultPage extends Component
{
    public $radarLabels = [];
    public $radarData = [];
    public $topKategori = [];
    public $tipeKepribadian = '';
    public $deskripsiKepribadian = '';

    public function mount()
    {
        $userId = Auth::id();

        $jawabans = DraftJawaban::with('soal.kategori')->where('user_id', $userId)->get();

        if ($jawabans->isEmpty()) {
            return redirect()->route('mahasiswa.tes'); 
        }

        $skorMentah = [];
        foreach ($jawabans as $jawaban) {
            $namaKategori = $jawaban->soal->kategori->nama_kategori;
            
            if (!isset($skorMentah[$namaKategori])) {
                $skorMentah[$namaKategori] = ['total_nilai' => 0, 'jumlah_soal' => 0];
            }
            
            $skorMentah[$namaKategori]['total_nilai'] += (int) $jawaban->jawaban;
            $skorMentah[$namaKategori]['jumlah_soal']++;
        }

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
        $this->tentukanKepribadian($kategoriTertinggi);
    }

    private function tentukanKepribadian($kategoriUtama)
    {
        $personas = [
            'Keperawatan Klinis' => ['tipe' => 'The Caregiver (Klinisi)', 'desc' => 'Anda memiliki empati yang tinggi dan kemampuan teknis medis yang luar biasa. Sangat cocok di garis depan pelayanan pasien.'],
            'Riset & Penalaran' => ['tipe' => 'The Analyst (Peneliti)', 'desc' => 'Anda memiliki pikiran kritis dan berorientasi pada data. Dunia riset dan Evidence-Based Practice adalah panggung utama Anda.'],
            'Pendidikan Kesehatan' => ['tipe' => 'The Educator (Pendidik)', 'desc' => 'Anda memiliki bakat komunikasi publik yang hebat. Sangat cocok menjadi penyuluh, dosen, atau promotor kesehatan.'],
            'Organisasi & Kepemimpinan' => ['tipe' => 'The Commander (Manajerial)', 'desc' => 'Anda adalah pemimpin alami yang terstruktur. Manajemen rumah sakit dan kepemimpinan tim medis adalah keahlian Anda.'],
            'Kewirausahaan' => ['tipe' => 'The Innovator (Nursepreneur)', 'desc' => 'Anda berani mengambil risiko dan inovatif. Membangun klinik sendiri atau bisnis kesehatan sangat direkomendasikan.'],
        ];

        $hasil = $personas[$kategoriUtama] ?? ['tipe' => 'The Versatile (Multitalenta)', 'desc' => 'Anda memiliki kemampuan seimbang di berbagai aspek kesehatan. Anda sangat adaptif di berbagai situasi medis.'];
        
        $this->tipeKepribadian = $hasil['tipe'];
        $this->deskripsiKepribadian = $hasil['desc'];
    }

    public function render()
    {
        return view('livewire.mahasiswa.hasil.result-page')->layout('layouts.blank');
    }
}