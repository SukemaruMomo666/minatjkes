# Database Schema — SIMINAT

Dokumen ini menjelaskan skema database lengkap beserta relasi dan catatan implementasi.

---

## Diagram Relasi (ERD)

```
users ──────────────────────────────────────────────────┐
  │ id, nim_nidn, password, role, nama,                  │
  │ tanggal_lahir, email, kelas_id, is_active             │
  │                                                       │
  ├──< kelas (kelas_id FK)                               │
  │      id, nama_kelas, angkatan,                        │
  │      dosen_wali_id FK → users                        ─┘
  │
  ├──< hasil_tes (mahasiswa_id FK)
  │      id, mahasiswa_id, tanggal_tes,
  │      skor_klinis, skor_riset, skor_edukasi,
  │      skor_organisasi, skor_seni, skor_olahraga,
  │      skor_kewirausahaan, skor_kemanusiaan, skor_literasi,
  │      mbti_result, mbti_e_count … mbti_p_count,
  │      rekomendasi_organisasi (JSON),
  │      rekomendasi_lomba (JSON),
  │      rekomendasi_kegiatan (JSON)
  │         │
  │         └──< jawaban (hasil_tes_id FK)
  │                id, hasil_tes_id, soal_id, jawaban
  │
  ├──< draft_jawaban (user_id FK)          ← resume tes
  │      id, user_id, soal_id, jawaban, updated_at
  │
  └──< log_aktivitas (user_id FK)
         id, user_id, aktivitas, ip_address, user_agent

soal ──────────────────────────────────────────────────
  id, kategori_id (FK → kategori), tipe,
  teks_soal, dimensi_mbti, opsi_a, opsi_b,
  bobot, is_active
     │
     └── kategori
           id, nama_kategori, tipe, deskripsi
```

---

## Tabel Detail

### `users`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | Auto increment |
| `nim_nidn` | VARCHAR(50) UNIQUE | Login identifier (NIM atau NIDN atau username admin) |
| `password` | VARCHAR(255) | bcrypt hash. Mahasiswa/dosen: hash dari tanggal lahir format `ddmmyyyy` |
| `role` | ENUM | `mahasiswa` \| `dosen` \| `admin` |
| `nama` | VARCHAR(100) | Nama lengkap |
| `tanggal_lahir` | DATE | Tanggal lahir (digunakan untuk generate password awal) |
| `email` | VARCHAR(100) NULL | Email (wajib untuk dosen, opsional mahasiswa) |
| `kelas_id` | BIGINT FK NULL | FK ke `kelas`. NULL untuk admin |
| `is_active` | BOOLEAN | Default `true`. Set `false` untuk nonaktifkan akun |
| `last_login_at` | TIMESTAMP NULL | Update setiap login berhasil |
| `created_at` | TIMESTAMP | — |
| `updated_at` | TIMESTAMP | — |

**Catatan:**
- `nim_nidn` digunakan sebagai `username` di config Fortify
- Kolom `name` dan `email` dari boilerplate Fortify tetap ada tapi `email` tidak wajib untuk mahasiswa

---

### `kelas`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | — |
| `nama_kelas` | VARCHAR(50) | Contoh: `1A Keperawatan` |
| `angkatan` | SMALLINT | Tahun angkatan, contoh: `2024` |
| `dosen_wali_id` | BIGINT FK NULL | FK ke `users` (role dosen) |
| `is_active` | BOOLEAN | Filter kelas lama/aktif |
| `created_at` | TIMESTAMP | — |
| `updated_at` | TIMESTAMP | — |

**Catatan circular FK:** `users.kelas_id → kelas` dan `kelas.dosen_wali_id → users`.
Migration harus dibuat terpisah: buat tabel `kelas` dulu tanpa `dosen_wali_id`, buat `users`, lalu ALTER `kelas` untuk tambah FK.
Atau: gunakan nullable FK dan seed dengan urutan benar.

---

### `kategori`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | — |
| `nama_kategori` | VARCHAR(100) | Contoh: `Keperawatan Klinis` |
| `tipe` | ENUM | `akademik` \| `non_akademik` |
| `deskripsi` | TEXT NULL | Penjelasan kategori |
| `created_at` | TIMESTAMP | — |
| `updated_at` | TIMESTAMP | — |

**Kategori yang di-seed:**

| Nama | Tipe |
|---|---|
| Keperawatan Klinis | akademik |
| Riset & Penalaran Ilmiah | akademik |
| Pendidikan Kesehatan | akademik |
| Organisasi & Kepemimpinan | non_akademik |
| Seni & Kreativitas | non_akademik |
| Olahraga & Bela Diri | non_akademik |
| Kewirausahaan | non_akademik |
| Kemanusiaan (Relawan) | non_akademik |
| Literasi & Bahasa | non_akademik |

---

### `soal`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | — |
| `kategori_id` | BIGINT FK NULL | NULL untuk soal MBTI |
| `tipe` | ENUM | `akademik` \| `non_akademik` \| `mbti` |
| `teks_soal` | TEXT | Teks pertanyaan |
| `dimensi_mbti` | ENUM NULL | `EI` \| `SN` \| `TF` \| `JP` |
| `opsi_a` | TEXT NULL | Pilihan A (hanya MBTI) |
| `opsi_b` | TEXT NULL | Pilihan B (hanya MBTI) |
| `bobot` | TINYINT | Default `1`. Bobot soal untuk scoring |
| `is_active` | BOOLEAN | Soal nonaktif tidak muncul di tes |
| `created_at` | TIMESTAMP | — |
| `updated_at` | TIMESTAMP | — |

---

### `hasil_tes`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | — |
| `mahasiswa_id` | BIGINT FK | FK ke `users` |
| `tanggal_tes` | TIMESTAMP | Waktu submit tes |
| `skor_klinis` | DECIMAL(5,2) | Skor Keperawatan Klinis dalam % |
| `skor_riset` | DECIMAL(5,2) | Skor Riset & Penalaran dalam % |
| `skor_edukasi` | DECIMAL(5,2) | Skor Pendidikan Kesehatan dalam % |
| `skor_organisasi` | DECIMAL(5,2) | Skor Organisasi & Kepemimpinan dalam % |
| `skor_seni` | DECIMAL(5,2) | Skor Seni & Kreativitas dalam % |
| `skor_olahraga` | DECIMAL(5,2) | Skor Olahraga & Bela Diri dalam % |
| `skor_kewirausahaan` | DECIMAL(5,2) | Skor Kewirausahaan dalam % |
| `skor_kemanusiaan` | DECIMAL(5,2) | Skor Kemanusiaan (Relawan) dalam % |
| `skor_literasi` | DECIMAL(5,2) | Skor Literasi & Bahasa dalam % |
| `mbti_result` | VARCHAR(4) | Hasil MBTI, contoh: `ENFJ` |
| `mbti_e_count` | TINYINT | Jumlah pilihan E |
| `mbti_i_count` | TINYINT | Jumlah pilihan I |
| `mbti_s_count` | TINYINT | Jumlah pilihan S |
| `mbti_n_count` | TINYINT | Jumlah pilihan N |
| `mbti_t_count` | TINYINT | Jumlah pilihan T |
| `mbti_f_count` | TINYINT | Jumlah pilihan F |
| `mbti_j_count` | TINYINT | Jumlah pilihan J |
| `mbti_p_count` | TINYINT | Jumlah pilihan P |
| `rekomendasi_organisasi` | JSON | Array nama organisasi/UKM |
| `rekomendasi_lomba` | JSON | Array nama lomba |
| `rekomendasi_kegiatan` | JSON | Array nama kegiatan |
| `created_at` | TIMESTAMP | — |
| `updated_at` | TIMESTAMP | — |

---

### `jawaban`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | — |
| `hasil_tes_id` | BIGINT FK | FK ke `hasil_tes` |
| `soal_id` | BIGINT FK | FK ke `soal` |
| `jawaban` | VARCHAR(10) | `1`–`5` untuk Likert, `A`/`B` untuk MBTI |
| `created_at` | TIMESTAMP | — |

---

### `draft_jawaban`

Tabel ini tidak ada di ERD dokumen asli — ditambahkan untuk mendukung fitur **resume tes** (jika browser refresh atau session expire sebelum submit).

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | — |
| `user_id` | BIGINT FK | FK ke `users` |
| `soal_id` | BIGINT FK | FK ke `soal` |
| `jawaban` | VARCHAR(10) | Jawaban sementara |
| `created_at` | TIMESTAMP | — |
| `updated_at` | TIMESTAMP | — |

**Unique constraint:** `(user_id, soal_id)` — satu draft per soal per user.
Draft di-truncate setelah submit final berhasil.

---

### `log_aktivitas`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | BIGINT PK | — |
| `user_id` | BIGINT FK | FK ke `users` |
| `aktivitas` | VARCHAR(255) | Deskripsi: `login`, `logout`, `submit_tes`, `export_excel` |
| `ip_address` | VARCHAR(45) | IPv4 atau IPv6 |
| `user_agent` | TEXT NULL | Info browser/device |
| `created_at` | TIMESTAMP | — |

---

## Urutan Migration

```
1. create_kelas_table (tanpa FK dosen_wali_id dulu)
2. create_users_table (dengan kelas_id FK ke kelas)
3. add_dosen_wali_to_kelas_table (ALTER: tambah FK ke users)
4. create_kategori_table
5. create_soal_table
6. create_hasil_tes_table
7. create_jawaban_table
8. create_draft_jawaban_table
9. create_log_aktivitas_table
```

---

## Query Contoh

### Statistik partisipasi kelas

```php
$kelas = Kelas::withCount([
    'mahasiswas as total',
    'mahasiswas as sudah_tes' => fn($q) => $q->whereHas('hasilTes'),
])->find($kelasId);

$persentase = $kelas->total > 0
    ? round(($kelas->sudah_tes / $kelas->total) * 100, 1)
    : 0;
```

### Top minat per mahasiswa

```php
$hasil = HasilTes::where('mahasiswa_id', $userId)->latest()->first();

$skorAkademik = [
    'Keperawatan Klinis'     => $hasil->skor_klinis,
    'Riset & Penalaran'      => $hasil->skor_riset,
    'Pendidikan Kesehatan'   => $hasil->skor_edukasi,
];

arsort($skorAkademik);
$topAkademik = array_key_first($skorAkademik);
```

### Distribusi MBTI per kelas

```php
HasilTes::whereHas('mahasiswa', fn($q) => $q->where('kelas_id', $kelasId))
    ->select('mbti_result', DB::raw('count(*) as total'))
    ->groupBy('mbti_result')
    ->orderByDesc('total')
    ->get();
```
