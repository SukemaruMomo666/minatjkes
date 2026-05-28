<?php

namespace Database\Seeders;

use App\Models\Soal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $soals = [
            // =================================================================
            // KATEGORI 1: KEPERAWATAN KLINIS (ID: 1 | Akademik)
            // =================================================================
            [1, 'akademik', 'Saya merasa antusias dan bersemangat setiap kali jadwal praktik klinik di rumah sakit (KDP/KMB/Anak/Maternitas) tiba.'],
            [1, 'akademik', 'Saya lebih menikmati proses belajar saat melakukan demonstrasi tindakan keperawatan di laboratorium atau bed pasien daripada duduk mendengarkan kuliah teori di kelas.'],
            [1, 'akademik', 'Saya tertarik untuk mempelajari berbagai jenis penyakit, prosedur medis baru, dan penanganannya secara langsung di rumah sakit.'],
            [1, 'akademik', 'Saya merasa nyaman dan tidak terganggu berada di lingkungan rumah sakit dalam waktu yang lama (misalnya saat dinas pagi, sore, atau malam).'],
            [1, 'akademik', 'Saya memiliki keinginan yang kuat untuk meniti karier sebagai perawat klinis profesional (praktisi di RS) setelah lulus nanti, bukan sebagai dosen atau peneliti.'],
            [1, 'akademik', 'Saya mampu melakukan tindakan keperawatan invasif (seperti memasang infus, kateter, atau menyuntik) dengan tangan yang stabil (tidak gemetar) dan sesuai prosedur.'],
            [1, 'akademik', 'Saya dapat dengan mudah mengingat langkah-langkah standard operating procedure (SOP) tindakan keperawatan setelah beberapa kali latihan.'],
            [1, 'akademik', 'Saya merasa cekatan dan terampil dalam mengoperasikan alat-alat kesehatan di ruang perawatan (seperti infusion pump, monitor TTV, atau tabung oksigen).'],
            [1, 'akademik', 'Saya mampu mempertahankan teknik steril dengan baik saat melakukan perawatan luka atau tindakan aseptik lainnya.'],
            [1, 'akademik', 'Saya mampu menghubungkan teori patofisiologi penyakit dengan gejala nyata yang ditunjukkan oleh pasien saat pengkajian.'],
            [1, 'akademik', 'Ketika melihat hasil laboratorium pasien yang tidak normal, saya secara refleks mencari tahu apa maknanya terhadap kondisi klinis pasien.'],
            [1, 'akademik', 'Saya dapat tetap berpikir jernih, tenang, dan mengambil keputusan tindakan yang tepat ketika menghadapi situasi pasien yang memburuk secara mendadak (kritis).'],
            [1, 'akademik', 'Saya merasa mampu berkomunikasi dengan jelas dan terapeutik kepada pasien yang sedang cemas, marah, atau mengalami penurunan kesadaran.'],
            [1, 'akademik', 'Saya dapat bekerja sama dalam tim secara efektif saat melakukan tindakan keperawatan berkelompok (seperti resusitasi atau memindahkan pasien).'],
            [1, 'akademik', 'Saya mampu mengendalikan emosi dan tetap bersikap empati serta profesional meskipun menghadapi komplain atau perilaku pasien/keluarga yang tidak menyenangkan.'],

            // =================================================================
            // KATEGORI 2: RISET & PENALARAN (ID: 2 | Akademik)
            // =================================================================
            [2, 'akademik', 'Saya merasa tertantang dan bersemangat ketika dosen memberikan tugas untuk membedah (critical appraisal) sebuah jurnal ilmiah nasional maupun internasional.'],
            [2, 'akademik', 'Saya lebih menikmati proses menyusun proposal penelitian, karya tulis ilmiah (KTI), atau skripsi dibandingkan melakukan praktik klinik di ruangan.'],
            [2, 'akademik', 'Saya tertarik untuk mempelajari metodologi penelitian, metodologi keperawatan, dan biostatistik secara lebih mendalam.'],
            [2, 'akademik', 'Saya memiliki keinginan kuat untuk mempublikasikan artikel ilmiah hasil pemikiran atau penelitian saya ke dalam jurnal terakreditasi.'],
            [2, 'akademik', 'Saya bercita-cita untuk meniti karier akademik sebagai peneliti keperawatan, dosen, atau konsultan kesehatan di masa depan.'],
            [2, 'akademik', 'Ketika melihat sebuah fenomena atau masalah kesehatan di masyarakat/RS, saya secara refleks memikirkan apa latar belakang penyebab dan solusi ilmiahnya.'],
            [2, 'akademik', 'Saya mampu menemukan benang merah atau kesenjangan (research gap) dari membaca beberapa artikel jurnal yang memiliki topik sejenis.'],
            [2, 'akademik', 'Saya terbiasa bersikap skeptis dan kritis (tidak langsung percaya) terhadap informasi kesehatan baru sebelum mengecek validitas sumber datanya.'],
            [2, 'akademik', 'Saya mudah memahami logika berpikir deduktif (dari teori umum ke kasus khusus) dan induktif yang dituangkan dalam latar belakang penelitian.'],
            [2, 'akademik', 'Saya merasa mampu dan percaya diri dalam mencari artikel ilmiah yang relevan menggunakan database jurnal medis (seperti PubMed, ScienceDirect, atau Google Scholar).'],
            [2, 'akademik', 'Saya memiliki ketertarikan dan kemampuan yang baik dalam mengoperasikan perangkat lunak analisis data statistik (seperti SPSS) atau pengolah referensi (seperti Mendeley/Zotero).'],
            [2, 'akademik', 'Saya mampu menyarikan (synthesize) berbagai teori dari sumber bacaan yang berbeda menjadi satu narasi pembahasan yang runtut dan mudah dipahami.'],
            [2, 'akademik', 'Saya sering memikirkan ide-ide kreatif atau inovasi baru (seperti aplikasi kesehatan, modifikasi alat, atau model edukasi baru) untuk mempermudah asuhan keperawatan.'],
            [2, 'akademik', 'Saya merasa tertarik untuk ikut serta dalam ajang kompetisi ilmiah, seperti Program Kreativitas Mahasiswa (PKM) atau lomba karya tulis ilmiah tingkat nasional.'],
            [2, 'akademik', 'Saya mampu menyusun rencana program atau intervensi keperawatan yang berbasis bukti ilmiah terkini (evidence-based practice) untuk menyelesaikan masalah kesehatan yang kompleks.'],
            
            // =================================================================
            // KATEGORI 7: KEWIRAUSAHAAN (ID: 7 | Non-Akademik)
            // =================================================================
            [7, 'non_akademik', 'Saya merasa sangat tertarik dan bersemangat ketika mempelajari cara membangun sebuah usaha, strategi pemasaran, atau melihat kesuksesan para wirausahawan.'],
            [7, 'non_akademik', 'Saya memiliki keinginan yang kuat untuk memiliki bisnis sendiri atau menjadi perawat pengusaha (nursepreneur) di masa depan daripada hanya bergantung pada gaji tetap.'],
            [7, 'non_akademik', 'Ketika melihat tren atau masalah kesehatan di sekitar, saya secara refleks memikirkan produk atau jasa apa yang bisa saya jual sebagai solusi (misalnya: katering diet, masker herbal, jasa home care).'],
            [7, 'non_akademik', 'Saya mampu mengemas ide atau barang biasa menjadi sesuatu yang terlihat unik, memiliki nilai tambah, dan menarik minat orang untuk membeli.'],
            [7, 'non_akademik', 'Saya tidak takut menghadapi kegagalan finansial dan berani mengambil risiko kerugian demi mencoba ide bisnis baru yang menurut saya potensial.'],
            [7, 'non_akademik', 'Ketika rencana atau target usaha saya mengalami kegagalan, saya tidak mudah menyerah dan segera mencari strategi alternatif untuk bangkit kembali.'],
            [7, 'non_akademik', 'Saya merasa percaya diri dan mampu menawarkan produk/jasa secara persuasif (meyakinkan) agar orang lain tertarik dan mau membelinya.'],
            [7, 'non_akademik', 'Saya terbiasa dan disiplin dalam mencatat, mengelola, serta memperhitungkan perputaran uang (modal, pemasukan, dan keuntungan) dengan rapi.'],

        ];

        foreach ($soals as $item) {
            Soal::create([
                'kategori_id' => $item[0],
                'tipe' => $item[1],
                'teks_soal' => $item[2],
                'bobot' => 1,
                'is_active' => true,
            ]);
        }
    }
}
