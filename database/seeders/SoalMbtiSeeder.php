<?php

namespace Database\Seeders;

use App\Models\SoalMbti;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoalMbtiSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('soal_mbtis')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $mbti = [
            ['EI', 'Di sebuah pesta yang ramai, Anda merasa:', 'Semakin bersemangat saat berbicara dengan banyak orang.', 'Cepat lelah dan ingin segera pulang untuk beristirahat.'],
            ['EI', 'Saat memiliki waktu luang di akhir pekan, Anda lebih suka:', 'Keluar bersama teman-teman atau mencoba tempat baru.', 'Menghabiskan waktu sendirian dengan hobi atau menonton film.'],
            ['EI', 'Di lingkungan kerja atau sekolah, Anda biasanya:', 'Mudah memulai percakapan dengan orang baru.', 'Menunggu orang lain menyapa Anda terlebih dahulu.'],
            ['EI', 'Mana yang lebih menggambarkan diri Anda?', '“Berpikir sambil berbicara” (sering mengungkapkan ide secara verbal).', '“Berpikir sebelum berbicara” (memproses ide dalam kepala dulu).'],
            ['EI', 'Setelah seharian penuh berinteraksi dengan orang lain, Anda merasa:', 'Terinspirasi dan penuh energi.', 'Butuh waktu tenang untuk mengisi ulang baterai mental.'],
            ['EI', 'Anda lebih menyukai:', 'Memiliki jaringan pertemanan yang luas meskipun tidak semuanya akrab.', 'Memiliki sedikit teman tetapi hubungan yang sangat mendalam.'],
            ['EI', 'Saat berada di pusat keramaian, Anda cenderung:', 'Ingin menjadi bagian dari pusat perhatian.', 'Mencari sudut yang lebih tenang untuk mengamati.'],
            ['EI', 'Dalam diskusi kelompok, Anda biasanya:', 'Menjadi orang pertama yang mengemukakan pendapat.', 'Mendengarkan semua pendapat dulu sebelum berbicara.'],

            ['SN', 'Saat mempelajari hal baru, Anda lebih suka:', 'Fakta, data konkret, dan aplikasi praktis yang jelas.', 'Teori, konsep abstrak, dan kemungkinan di masa depan.'],
            ['SN', 'Anda cenderung melihat sebuah pohon sebagai:', 'Sebuah objek fisik dengan batang, daun, dan jenis tertentu.', 'Bagian dari ekosistem yang melambangkan kehidupan dan pertumbuhan.'],
            ['SN', 'Dalam mengerjakan tugas, Anda lebih suka:', 'Mengikuti instruksi yang sudah terbukti berhasil.', 'Mencoba metode baru yang lebih kreatif meskipun belum tentu berhasil.'],
            ['SN', 'Orang lain sering menggambarkan Anda sebagai orang yang:', 'Pragmatis dan realistis.', 'Imajinatif dan visioner.'],
            ['SN', 'Anda lebih fokus pada:', 'Apa yang sedang terjadi saat ini (masa kini).', 'Apa yang mungkin terjadi di masa depan (potensi).'],
            ['SN', 'Saat menceritakan sebuah kejadian, Anda cenderung:', 'Detail dalam menyebutkan waktu, tempat, dan urutan kejadian.', 'Langsung pada inti cerita dan makna di baliknya.'],
            ['SN', 'Anda lebih menghargai:', 'Pengalaman nyata dan bukti sejarah.', 'Inovasi dan ide-ide baru yang belum pernah dicoba.'],

            ['TF', 'Saat seorang teman bercerita tentang masalahnya, hal pertama yang Anda lakukan adalah:', 'Memberikan solusi logis untuk menyelesaikan masalah tersebut.', 'Memberikan dukungan emosional dan menunjukkan empati.'],
            ['TF', 'Dalam mengambil keputusan penting, Anda lebih mengandalkan:', 'Analisis objektif tentang untung dan rugi.', 'Keyakinan pribadi dan dampaknya terhadap perasaan orang lain.'],
            ['TF', 'Anda lebih merasa dihargai jika dipuji karena:', 'Kemampuan berpikir kritis dan kompetensi Anda.', 'Kebaikan hati dan kepedulian Anda terhadap orang lain.'],
            ['TF', 'Jika terjadi konflik, Anda cenderung:', 'Menghadapinya dengan kepala dingin untuk mencari siapa yang benar.', 'Berusaha menjaga keharmonisan meskipun harus mengalah.'],
            ['TF', 'Menurut Anda, mana yang lebih buruk?', 'Bersikap tidak adil.', 'Bersikap tidak berperasaan.'],
            ['TF', 'Saat memberikan kritik, Anda biasanya:', 'Langsung pada poinnya (to the point) meskipun terasa tajam.', 'Membungkusnya dengan kata-kata halus agar tidak menyinggung.'],
            ['TF', 'Anda menganggap diri Anda sebagai orang yang:', 'Logis dan konsisten.', 'Penuh perasaan dan peka.'],

            ['JP', 'Sebelum pergi berlibur, Anda biasanya:', 'Membuat jadwal perjalanan yang mendetail (itinerary).', 'Memesan tiket saja dan melihat apa yang akan terjadi nanti.'],
            ['JP', 'Meja kerja atau kamar Anda biasanya:', 'Rapi dan tertata dengan barang-barang di tempatnya.', 'Berantakan namun Anda tahu di mana letak barang-barang tersebut.'],
            ['JP', 'Anda merasa lebih nyaman ketika:', 'Sudah ada keputusan pasti dan rencana yang tetap.', 'Semua pilihan masih terbuka dan bisa berubah sewaktu-waktu.'],
            ['JP', 'Dalam mengerjakan proyek dengan tenggat waktu, Anda cenderung:', 'Mencicil pekerjaan jauh-jauh hari agar selesai tepat waktu.', 'Menunggu hingga mendekati tenggat waktu agar mendapat tekanan kreatif.'],
            ['JP', 'Anda lebih suka hidup yang:', 'Terstruktur, terjadwal, dan dapat diprediksi.', 'Fleksibel, santai, dan penuh kejutan spontan.'],
            ['JP', 'Saat menghadapi tugas baru, langkah pertama Anda adalah:', 'Membuat daftar langkah-langkah yang harus dilakukan.', 'Langsung mengerjakannya dan belajar sambil jalan.'],
            ['JP', 'Jika seseorang datang berkunjung mendadak tanpa janji, Anda:', 'Merasa sedikit terganggu karena rencana hari itu jadi berantakan.', 'Menyambutnya dengan senang hati sebagai interupsi yang menyenangkan.'],
            ['JP', 'Mana yang lebih membuat Anda stres?', 'Ketidakpastian dan situasi yang menggantung.', 'Aturan yang terlalu ketat dan jadwal kaku.'],
        ];

        foreach ($mbti as $item) {
            SoalMbti::create([
                'dimensi' => $item[0],
                'pertanyaan' => $item[1],
                'opsi_a' => $item[2],
                'opsi_b' => $item[3],
                'is_active' => true,
            ]);
        }
    }
}
