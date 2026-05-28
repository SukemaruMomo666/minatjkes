<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoris = [
            // Kategori Akademik
            ['id' => 1, 'nama_kategori' => 'Keperawatan Klinis', 'tipe' => 'akademik', 'deskripsi' => 'Menggali ketertarikan dan kesiapan dalam pelayanan langsung ke pasien.'],
            ['id' => 2, 'nama_kategori' => 'Riset & Penalaran', 'tipe' => 'akademik', 'deskripsi' => 'Menggali minat dalam dunia penelitian, analisis data, dan penulisan KTI.'],
            ['id' => 3, 'nama_kategori' => 'Pendidikan Kesehatan', 'tipe' => 'akademik', 'deskripsi' => 'Menggali bakat dalam mengajar, edukasi, dan promosi kesehatan.'],
            
            // Kategori Non-Akademik
            ['id' => 4, 'nama_kategori' => 'Organisasi & Kepemimpinan', 'tipe' => 'non_akademik', 'deskripsi' => 'Mengukur inisiatif, koordinasi tim, dan pengambilan keputusan.'],
            ['id' => 5, 'nama_kategori' => 'Seni & Kreativitas', 'tipe' => 'non_akademik', 'deskripsi' => 'Mengukur ekspresi diri, estetika, dan inovasi visual/audio.'],
            ['id' => 6, 'nama_kategori' => 'Olahraga & Bela Diri', 'tipe' => 'non_akademik', 'deskripsi' => 'Mengukur ketahanan fisik, koordinasi motorik, dan kompetisi.'],
            ['id' => 7, 'nama_kategori' => 'Kewirausahaan', 'tipe' => 'non_akademik', 'deskripsi' => 'Mengukur inovasi bisnis, orientasi keuntungan, dan keberanian.'],
            ['id' => 8, 'nama_kategori' => 'Kemanusiaan (Relawan)', 'tipe' => 'non_akademik', 'deskripsi' => 'Mengukur empati, altruisme, dan kepedulian sosial.'],
            ['id' => 9, 'nama_kategori' => 'Literasi & Bahasa', 'tipe' => 'non_akademik', 'deskripsi' => 'Mengukur kemampuan olah kata, pemahaman teks, dan bahasa asing.']
        ];

        foreach ($kategoris as $kategori) {
            Kategori::updateOrCreate(['id' => $kategori['id']], $kategori);
        }
    }
}
