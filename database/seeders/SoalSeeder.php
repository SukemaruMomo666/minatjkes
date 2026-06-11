<?php

namespace Database\Seeders;

use App\Models\Soal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('draft_jawabans')->truncate();
        DB::table('soals')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $soals = [
            // ================== KATEGORI MINAT (13 SOAL) ==================
            // ID 1: Keperawatan Klinis
            [1, 'akademik', null, 'Saya merasa antusias dan bersemangat setiap kali jadwal praktik klinik di rumah sakit (KDP/KMB/Anak/Maternitas) tiba.'],
            [1, 'akademik', null, 'Saya mampu melakukan tindakan keperawatan invasif (seperti memasang infus, kateter, atau menyuntik) dengan tangan yang stabil (tidak gemetar) dan sesuai prosedur.'],

            // ID 2: Riset & Penalaran
            [2, 'akademik', null, 'Saya lebih menikmati proses menyusun proposal penelitian, karya tulis ilmiah (KTI), atau skripsi dibandingkan melakukan praktik klinik.'],
            [2, 'akademik', null, 'Saya sering memikirkan ide-ide kreatif atau inovasi baru (seperti aplikasi kesehatan, modifikasi alat, atau model edukasi baru) untuk mempermudah asuhan keperawatan.'],

            // ID 3: Pendidikan Kesehatan
            [3, 'akademik', null, 'Saya secara sukarela mau meluangkan waktu untuk menjadi edukator kesehatan dalam kegiatan pengabdian masyarakat atau posyandu.'],
            [3, 'akademik', null, 'Saya mampu menjelaskan istilah medis/keperawatan yang rumit menjadi bahasa awam yang sederhana dan mudah dimengerti oleh masyarakat biasa.'],

            // ID 4: Organisasi & Kepemimpinan
            [4, 'non_akademik', null, 'Saya merasa percaya diri dan mampu mengarahkan, membagi tugas, serta menggerakkan anggota tim untuk mencapai tujuan bersama yang telah ditetapkan.'],
            [4, 'non_akademik', null, 'Ketika terjadi perbedaan pendapat atau konflik di dalam kelompok, saya mampu bertindak sebagai penengah dan membantu mencari jalan keluar yang adil.'],

            // ID 7: Kewirausahaan
            [7, 'non_akademik', null, 'Saya memiliki keinginan yang kuat untuk memiliki bisnis sendiri atau menjadi perawat pengusaha (nursepreneur) di masa depan daripada hanya bergantung pada gaji tetap.'],
            [7, 'non_akademik', null, 'Saya merasa percaya diri dan mampu menawarkan produk/jasa secara persuasif (meyakinkan) agar orang lain tertarik dan mau membelinya.'],

            // ID 8: Kemanusiaan (Relawan)
            [8, 'non_akademik', null, 'Saya merasa terpanggil dan sangat antusias jika ada kesempatan untuk menjadi relawan dalam aksi kemanusiaan, donor darah, atau bakti sosial.'],
            [8, 'non_akademik', null, 'Saya memiliki kepekaan yang tinggi terhadap kondisi kelompok rentan (seperti lansia telantar, anak yatim, atau masyarakat miskin) dan terdorong untuk membantu memperjuangkan kebutuhan mereka.'],

            // ID 9: Literasi & Bahasa
            [9, 'non_akademik', null, 'Saya merasa sangat senang meluangkan waktu luang untuk membaca buku non-kuliah (seperti novel, esai, biografi, atau artikel populer) secara konsisten.'],

            // ================== KATEGORI MBTI (12 SOAL) ==================
            [null, 'mbti', 'EI', 'Saya merasa mendapatkan lebih banyak energi dan bersemangat setelah menghabiskan waktu berkumpul dan berinteraksi dengan banyak orang.'],
            [null, 'mbti', 'EI', 'Saya sangat mudah memulai percakapan dengan orang yang baru saya kenal di lingkungan baru.'],
            [null, 'mbti', 'EI', 'Saya lebih suka berbicara langsung (telepon/tatap muka) daripada mengirim pesan teks saat harus menjelaskan sesuatu yang penting.'],
            [null, 'mbti', 'SN', 'Saya lebih suka fokus pada fakta, detail nyata, dan pengalaman masa lalu daripada berandai-andai tentang konsep masa depan.'],
            [null, 'mbti', 'SN', 'Saat menyelesaikan tugas, saya lebih suka mengikuti instruksi langkah demi langkah yang sudah terbukti daripada mencari cara baru.'],
            [null, 'mbti', 'SN', 'Saya lebih mudah mengingat detail spesifik dari sebuah kejadian (seperti warna baju atau angka) daripada makna tersembunyi dari kejadian tersebut.'],
            [null, 'mbti', 'TF', 'Saat mengambil keputusan penting, saya lebih mengutamakan logika dan objektivitas daripada mempertimbangkan perasaan orang yang terlibat.'],
            [null, 'mbti', 'TF', 'Saya cenderung lebih menghargai kebenaran dan keadilan meskipun terkadang hal itu bisa terdengar kasar atau menyakiti perasaan seseorang.'],
            [null, 'mbti', 'TF', 'Saat melihat teman kerja melakukan kesalahan, saya lebih fokus mengkritik hasil kerjanya untuk perbaikan daripada menjaga perasaannya.'],
            [null, 'mbti', 'JP', 'Saya merasa jauh lebih tenang dan nyaman jika semua jadwal kegiatan saya hari ini sudah terencana dan tertulis dengan rapi.'],
            [null, 'mbti', 'JP', 'Saya selalu berusaha menyelesaikan tugas jauh sebelum tenggat waktu (deadline) daripada menundanya sampai menit-menit terakhir.'],
            [null, 'mbti', 'JP', 'Saya merasa kurang nyaman jika ada perubahan rencana secara mendadak dan lebih menyukai rutinitas yang terprediksi.'],
        ];

        foreach ($soals as $item) {
            Soal::create([
                'kategori_id' => $item[0],
                'tipe' => $item[1],
                'dimensi_mbti' => $item[2],
                'teks_soal' => $item[3],
                'bobot' => 1,
                'is_active' => true,
            ]);
        }
    }
}
