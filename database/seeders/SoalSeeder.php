<?php

namespace Database\Seeders;

use App\Models\Soal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoalSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan data lama agar tidak menumpuk
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('draft_jawabans')->truncate();
        DB::table('soals')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Format Array: [kategori_id, tipe, teks_soal, is_unfav]
        $soals = [
            // ====================================================================
            // KATEGORI 1: KEPERAWATAN KLINIS (Akademik)
            // ====================================================================
            [1, 'akademik', 'Saya merasa antusias dan bersemangat setiap kali jadwal praktik klinik di rumah sakit (KDP/KMB/Anak/Maternitas) tiba.', false],
            [1, 'akademik', 'Saya lebih menikmati proses belajar kuliah teori di kelas daripada melakukan demonstrasi tindakan keperawatan di laboratorium.', true], // UNFAV
            [1, 'akademik', 'Saya tertarik untuk mempelajari berbagai jenis penyakit, prosedur medis baru, dan penanganannya secara langsung di rumah sakit.', false],
            [1, 'akademik', 'Saya memiliki keinginan yang kuat untuk meniti karier sebagai perawat klinis profesional (praktisi di RS) setelah lulus nanti, bukan sebagai dosen atau peneliti.', false],
            [1, 'akademik', 'Saya mampu melakukan tindakan keperawatan invasif (seperti memasang infus, kateter, atau menyuntik) dengan tangan yang stabil (tidak gemetar) dan sesuai prosedur.', false],
            [1, 'akademik', 'Saya merasa kesulitan mengingat langkah-langkah standard operating procedure (SOP) tindakan keperawatan setelah beberapa kali latihan.', true], // UNFAV
            [1, 'akademik', 'Saya merasa cekatan dan terampil dalam mengoperasikan alat-alat kesehatan di ruang perawatan.', false],
            [1, 'akademik', 'Saya mampu mempertahankan teknik steril dengan baik saat melakukan perawatan luka atau tindakan aseptik lainnya.', false],
            [1, 'akademik', 'Saya mampu menghubungkan teori patofisiologi penyakit dengan gejala nyata yang ditunjukkan oleh pasien saat pengkajian.', false],
            [1, 'akademik', 'Saya merasa kurang dalam berkomunikasi dengan jelas dan terapeutik kepada pasien yang sedang cemas, marah, atau bingung.', true], // UNFAV

            // ====================================================================
            // KATEGORI 2: RISET & PENALARAN (Akademik)
            // ====================================================================
            [2, 'akademik', 'Saya merasa tertantang dan bersemangat ketika dosen memberikan tugas untuk membedah sebuah jurnal ilmiah nasional maupun internasional.', false],
            [2, 'akademik', 'Saya lebih menikmati proses menyusun proposal penelitian, karya tulis ilmiah (KTI), atau skripsi dibandingkan melakukan praktik klinik.', false],
            [2, 'akademik', 'Saya tertarik untuk mempelajari metodologi penelitian, metodologi keperawatan, dan biostatistik secara lebih mendalam.', false],
            [2, 'akademik', 'Saya bercita-cita untuk meniti karier akademik sebagai peneliti keperawatan, dosen, atau konsultan kesehatan di masa depan.', false],
            [2, 'akademik', 'Ketika melihat sebuah fenomena atau masalah kesehatan di masyarakat/RS, saya secara refleks memikirkan apa latar belakang penyebab dan solusi ilmiahnya.', false],
            [2, 'akademik', 'Saya merasa kesulitan memahami logika berpikir deduktif (dari teori umum ke kasus khusus) dan induktif yang dituangkan dalam latar belakang penelitian.', true], // UNFAV
            [2, 'akademik', 'Saya merasa kurang percaya diri dalam mencari artikel ilmiah yang relevan dari jurnal medis (seperti PubMed, ScienceDirect, atau Google Scholar).', true], // UNFAV
            [2, 'akademik', 'Saya belum memiliki kemampuan untuk meringkas teori dari sumber bacaan yang berbeda menjadi satu narasi pembahasan yang runtut dan mudah dipahami.', true], // UNFAV
            [2, 'akademik', 'Saya sering memikirkan ide-ide kreatif atau inovasi baru (seperti aplikasi kesehatan, modifikasi alat, atau model edukasi baru) untuk mempermudah asuhan keperawatan.', false],
            [2, 'akademik', 'Saya merasa tertarik untuk ikut serta dalam ajang kompetisi ilmiah, seperti Program Kreativitas Mahasiswa (PKM) atau lomba karya tulis ilmiah tingkat nasional.', false],

            // ====================================================================
            // KATEGORI 3: PENDIDIKAN & PROMOSI KESEHATAN (Akademik)
            // ====================================================================
            [3, 'akademik', 'Saya lebih menikmati tugas menyusun program penyuluhan dan melakukan edukasi kepada masyarakat daripada melakukan tindakan medis invasif di RS.', false],
            [3, 'akademik', 'Saya secara sukarela mau meluangkan waktu untuk menjadi edukator kesehatan dalam kegiatan pengabdian masyarakat atau posyandu.', false],
            [3, 'akademik', 'Saya memiliki cita-cita untuk berkarier di bidang yang berfokus pada edukasi, seperti perawat komunitas, penyuluh kesehatan, atau fasilitator promosi kesehatan.', false],
            [3, 'akademik', 'Saya merasa kurang percaya diri, gelisah, dan demam panggung saat harus berbicara atau presentasi di depan orang banyak.', true], // UNFAV
            [3, 'akademik', 'Saya mampu menjelaskan istilah medis/keperawatan yang rumit menjadi bahasa awam yang sederhana dan mudah dimengerti oleh masyarakat biasa.', false],
            [3, 'akademik', 'Saya merasa kurang dalam menggunakan intonasi suara, mimik wajah, dan bahasa tubuh secara tepat agar audiens tetap fokus mendengarkan penjelasan saya.', true], // UNFAV
            [3, 'akademik', 'Saya memiliki kemampuan dan ketertarikan dalam merancang media edukasi visual yang menarik (seperti leaflet, poster, atau lembar balik).', false],
            [3, 'akademik', 'Saya senang dan terampil memanfaatkan teknologi digital/media sosial (seperti membuat video TikTok/Instagram Reels atau infografis) untuk menyebarkan konten edukasi kesehatan.', false],
            [3, 'akademik', 'Sebelum melakukan edukasi, saya terbiasa mencari tahu terlebih dahulu apa latar belakang budaya, tingkat pendidikan, dan mitos kesehatan yang dipercayai oleh calon audiens.', false],
            [3, 'akademik', 'Saya merasa kurang mudah membaur, beradaptasi, dan membangun hubungan saling percaya dengan kelompok masyarakat dari berbagai latar belakang sosial-ekonomi.', true], // UNFAV

            // ====================================================================
            // KATEGORI 4: ORGANISASI & KEPEMIMPINAN (Non-Akademik)
            // ====================================================================
            [4, 'non_akademik', 'Saya merasa senang dan menikmati dinamika terlibat aktif dalam organisasi mahasiswa (seperti BEM, Hima, atau UKM) serta kepanitiaan acara di kampus.', false],
            [4, 'non_akademik', 'Saya merasa percaya diri dan mampu mengarahkan, membagi tugas, serta menggerakkan anggota tim untuk mencapai tujuan bersama yang telah ditetapkan.', false],
            [4, 'non_akademik', 'Ketika terjadi perbedaan pendapat atau konflik di dalam kelompok, saya mampu bertindak sebagai penengah dan membantu mencari jalan keluar yang adil.', false],
            [4, 'non_akademik', 'Saya mampu menyusun skala prioritas dan mengelola waktu dengan baik antara tuntutan tugas akademik keperawatan yang padat dan tanggung jawab organisasi.', false],
            [4, 'non_akademik', 'Saya terbiasa membuat target atau rencana kerja jangka panjang yang terstruktur dan optimis demi kemajuan tim atau organisasi yang saya ikuti.', false],

            // ====================================================================
            // KATEGORI 5: SENI & KREATIVITAS (Non-Akademik)
            // ====================================================================
            [5, 'non_akademik', 'Saya merasa sangat antusias dan bersemangat jika dilibatkan dalam kegiatan yang membutuhkan sentuhan estetika, dekorasi, atau pertunjukan seni di kampus.', false],
            [5, 'non_akademik', 'Saya sering meluangkan waktu luang secara konsisten untuk menikmati atau menyalurkan hobi di bidang seni (seperti musik, tari, sastra, teater, seni rupa, atau fotografi).', false],
            [5, 'non_akademik', 'Saya sering memiliki ide-ide unik dan tidak biasa (kreatif) ketika diminta merancang konsep sebuah acara, kostum, poster, atau dekorasi panggung.', false],
            [5, 'non_akademik', 'Saya memiliki keterampilan teknis yang baik dalam salah satu cabang seni (misalnya: mahir bermain alat musik/menyanyi, menari, menggambar/melukis, atau berakting).', false],
            [5, 'non_akademik', 'Saya mampu mengoperasikan perangkat lunak atau aplikasi digital penunjang kreativitas (seperti Canva, Photoshop, Premiere Pro, CapCut, atau aplikasi pengolah audio/visual lainnya).', false],

            // ====================================================================
            // KATEGORI 6: OLAHRAGA & BELA DIRI (Non-Akademik)
            // ====================================================================
            [6, 'non_akademik', 'Saya merasa sangat antusias, bugar, dan bersemangat setiap kali mengikuti atau menonton kegiatan olahraga dan bela diri.', false],
            [6, 'non_akademik', 'Saya secara konsisten meluangkan waktu di luar jam kuliah untuk berlatih olahraga (seperti futsal, voli, badminton, renang, basket) atau seni bela diri.', false],
            [6, 'non_akademik', 'Saya memiliki stamina dan ketahanan fisik yang baik, sehingga tidak mudah merasa lelah atau lemas setelah melakukan aktivitas fisik yang berat dalam waktu lama.', false],
            [6, 'non_akademik', 'Saya mampu bekerja sama, berkomunikasi secara taktis, dan menekan ego pribadi saat bermain dalam sebuah tim olahraga demi mencapai kemenangan bersama.', false],
            [6, 'non_akademik', 'Saya terbiasa menerapkan kedisiplinan tingkat tinggi, ketegasan, dan mental pantang menyerah yang saya pelajari dari olahraga/bela diri ke dalam kehidupan sehari-hari.', false],

            // ====================================================================
            // KATEGORI 7: KEWIRAUSAHAAN (Non-Akademik)
            // ====================================================================
            [7, 'non_akademik', 'Saya merasa sangat tertarik dan bersemangat ketika mempelajari cara membangun sebuah usaha, strategi pemasaran, atau melihat kesuksesan para wirausahawan.', false],
            [7, 'non_akademik', 'Saya memiliki keinginan yang kuat untuk memiliki bisnis sendiri atau menjadi perawat pengusaha (nursepreneur) di masa depan daripada hanya bergantung pada gaji tetap.', false],
            [7, 'non_akademik', 'Ketika melihat tren atau masalah kesehatan di sekitar, saya secara refleks memikirkan produk atau jasa apa yang bisa saya jual sebagai solusi.', false],
            [7, 'non_akademik', 'Saya tidak takut menghadapi kegagalan finansial dan berani mengambil risiko kerugian demi mencoba ide bisnis baru yang menurut saya potensial.', false],
            [7, 'non_akademik', 'Saya merasa percaya diri dan mampu menawarkan produk/jasa secara persuasif (meyakinkan) agar orang lain tertarik dan mau membelinya.', false],

            // ====================================================================
            // KATEGORI 8: KEMANUSIAAN & KERELAWANAN (Non-Akademik)
            // ====================================================================
            [8, 'non_akademik', 'Saya merasa terpanggil dan sangat antusias jika ada kesempatan untuk menjadi relawan dalam aksi kemanusiaan, donor darah, atau bakti sosial.', false],
            [8, 'non_akademik', 'Saya percaya diri bahwa keterampilan keperawatan dasar yang saya miliki (seperti balut bidai, P3K, atau dukungan psikologis awal) dapat memberikan manfaat nyata di lapangan.', false],
            [8, 'non_akademik', 'Saya mudah beradaptasi dan mampu bekerja sama secara solid dengan relawan dari berbagai latar belakang profesi maupun usia yang berbeda.', false],
            [8, 'non_akademik', 'Saya memiliki kepekaan yang tinggi terhadap kondisi kelompok rentan (seperti lansia telantar, anak yatim, atau miskin) dan terdorong untuk membantu memperjuangkan kebutuhan mereka.', false],
            [8, 'non_akademik', 'Saya tertarik dan aktif terlibat dalam menggalang bantuan (dana, pakaian, atau logistik) ketika melihat atau mendengar adanya bencana alam di suatu daerah.', false],

            // ====================================================================
            // KATEGORI 9: LITERASI & BAHASA (Non-Akademik)
            // ====================================================================
            [9, 'non_akademik', 'Saya merasa sangat senang meluangkan waktu luang untuk membaca buku non-kuliah (seperti novel, esai, biografi, atau artikel populer) secara konsisten.', false],
            [9, 'non_akademik', 'Saya merasa percaya diri dan mampu memahami serta berkomunikasi (berbicara/menulis) menggunakan bahasa asing (seperti Inggris, Jepang, Arab, Jerman, dll).', false],
            [9, 'non_akademik', 'Saya mampu menyusun argumen lisan dengan runtut, logis, dan meyakinkan saat harus berdiskusi, berdebat, atau menyampaikan pendapat dalam forum resmi.', false],
            [9, 'non_akademik', 'Saya tertarik untuk menjadi penulis atau editor konten kesehatan populer (seperti mengelola majalah dinding kampus, caption edukasi media sosial, atau buku populer).', false],
            [9, 'non_akademik', 'Saya memiliki motivasi tinggi untuk mengikuti kompetisi non-akademik yang berbasis bahasa, seperti lomba debat, pidato, storytelling, atau menulis esai populer.', false],
        ];

        // Looping untuk memasukkannya ke database
        foreach ($soals as $item) {
            Soal::create([
                'kategori_id' => $item[0],
                'tipe' => $item[1],
                'teks_soal' => $item[2],
                'is_unfav' => $item[3],
                'bobot' => 1,
                'is_active' => true,
            ]);
        }
    }
}
