# SIMINAT — Sistem Pemetaan Minat & Bakat Mahasiswa

**Sistem Pemetaan Potensi Minat, Bakat, dan Kepribadian Mahasiswa Kesehatan**
Politeknik Negeri Subang

---

## Deskripsi

SIMINAT adalah aplikasi web untuk mengidentifikasi dan mengarahkan potensi mahasiswa baru jurusan kesehatan melalui tiga instrumen penilaian:

1. **Kuesioner Minat & Bakat Akademik** — Skala Likert (30–40 soal)
2. **Kuesioner Minat & Bakat Non-Akademik** — Skala Likert (30–40 soal)
3. **Tes Kepribadian MBTI** — Forced-Choice A/B (24–36 soal)

Sistem menghasilkan profil potensi, grafik minat, dan rekomendasi personalisasi berupa UKM/organisasi, lomba, dan kegiatan yang sesuai.

---

## Stack Teknologi

| Layer | Teknologi | Versi |
|---|---|---|
| Backend | Laravel | v13 |
| Frontend | Livewire + Flux UI | v4 / v2 |
| Auth | Laravel Fortify | v1 |
| CSS | Tailwind CSS | v4 |
| Testing | Pest | v4 |
| PHP | PHP | ^8.3 |
| Database | MySQL / SQLite | — |

---

## Role Pengguna

| Role | Login | Akses Utama |
|---|---|---|
| **Mahasiswa** | NIM + Tanggal Lahir | Isi tes, lihat hasil, download PDF |
| **Dosen Wali** | NIDN + Tanggal Lahir | Monitor kelas, export Excel |
| **Admin** | Username + Password | CRUD master data, export global |

---

## Persyaratan Sistem

- PHP >= 8.3
- Composer >= 2.x
- Node.js >= 20.x
- MySQL >= 8.0 atau SQLite (untuk development)
- Git

---

## Instalasi

### 1. Clone & Install Dependencies

```bash
git clone <repository-url> siminat-project
cd siminat-project
composer install
npm install
```

### 2. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` sesuai konfigurasi lokal:

```dotenv
APP_NAME=SIMINAT
APP_URL=http://siminat-project.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siminat
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Migrasi & Seeding Database

```bash
php artisan migrate
php artisan db:seed
```

Seeder akan membuat:
- Akun admin default
- Contoh data kelas dan dosen
- Bank soal (akademik, non-akademik, MBTI)

### 4. Build Frontend

```bash
npm run build
```

### 5. Jalankan Aplikasi

```bash
composer run dev
```

Atau secara terpisah:

```bash
php artisan serve
npm run dev
```

Akses di: `http://localhost:8000`

---

## Akun Default (Setelah Seeding)

| Role | Identifier | Password |
|---|---|---|
| Admin | `admin` | `password` |
| Contoh Dosen | `0412345678` (NIDN) | `01011980` (tgl lahir ddmmyyyy) |
| Contoh Mahasiswa | `2401001` (NIM) | `15062006` (tgl lahir ddmmyyyy) |

---

## Menjalankan Tes

```bash
# Semua tes
php artisan test --compact

# Filter tes tertentu
php artisan test --compact --filter=ScoringServiceTest

# Hanya unit test
php artisan test --compact tests/Unit/
```

---

## Struktur Direktori

```
app/
├── Enums/               # PHP Enums: UserRole, TipeSoal, TipeKategori, DimensiMbti
├── Http/
│   ├── Middleware/      # EnsureRole (RBAC)
│   └── Responses/       # LoginResponse (redirect by role)
├── Livewire/
│   ├── Auth/            # Custom login form
│   ├── Mahasiswa/       # Dashboard, TesWizard, Onboarding
│   ├── Dosen/           # Dashboard, DaftarMahasiswa, DetailMahasiswa
│   └── Admin/           # Dashboard, Master CRUD
├── Models/              # Semua Eloquent models
└── Services/
    ├── ScoringService.php      # Algoritma scoring Likert & MBTI
    ├── RekomendasisService.php # Smart recommendation engine
    ├── PdfExportService.php    # Laporan PDF via DomPDF
    └── ExcelExportService.php  # Export Excel via Maatwebsite

resources/views/
├── livewire/            # Blade templates untuk Livewire components
│   ├── mahasiswa/
│   ├── dosen/
│   └── admin/
└── pdf/                 # Template PDF untuk DomPDF

routes/
├── web.php              # Route utama
├── mahasiswa.php        # Route khusus mahasiswa
├── dosen.php            # Route khusus dosen
└── admin.php            # Route khusus admin

tests/
├── Unit/
│   └── Services/        # Test ScoringService, RekomendasisService
└── Feature/
    ├── Auth/            # Test login multi-role
    ├── Mahasiswa/       # Test alur tes & hasil
    ├── Dosen/           # Test dashboard & export
    └── Admin/           # Test CRUD master data
```

---

## Alur Penggunaan

### Mahasiswa

```
Login (NIM + Tanggal Lahir)
  → Onboarding (instruksi tes)
  → Tes Akademik (Likert 1–5, ~35 soal)
  → Tes Non-Akademik (Likert 1–5, ~35 soal)
  → Tes MBTI (Pilih A/B, ~30 soal)
  → Halaman Hasil (Profil MBTI + Grafik + Rekomendasi)
  → Download PDF / Logout
```

### Dosen Wali

```
Login (NIDN + Tanggal Lahir)
  → Dashboard (statistik & partisipasi kelas)
  → Tabel Mahasiswa (filter by minat/MBTI/status)
  → Detail Mahasiswa (lihat hasil individual)
  → Export Excel
```

### Admin

```
Login (Username + Password)
  → Dashboard Global (statistik seluruh jurusan)
  → Master Data (CRUD Mahasiswa, Dosen, Kelas, Soal)
  → Kelola Akun (reset password, aktivasi)
  → Export Global Data
```

---

## Algoritma Scoring

### Likert (Akademik & Non-Akademik)

```
Skor (%) = (Σ Jawaban × Bobot) / (Jumlah Soal × 5) × 100
```

Contoh: 10 soal, total jawaban 42 → Skor = (42 / 50) × 100 = **84%**

### MBTI (Forced-Choice)

Untuk setiap dimensi (E/I, S/N, T/F, J/P):
- Hitung jumlah pilihan A vs B
- Tipe = huruf dengan pilihan terbanyak

Contoh: Dimensi E/I — 7 pilihan E, 2 pilihan I → **E**

### Threshold Rekomendasi

| Skor | Label |
|---|---|
| > 80% | Sangat Cocok |
| 60–79% | Cocok |
| 40–59% | Cukup Cocok |
| < 40% | Kurang Cocok |

---

## Code Quality

```bash
# Format kode (wajib sebelum commit)
vendor/bin/pint --dirty --format agent

# Cek format tanpa ubah file
vendor/bin/pint --test
```

---

## Dokumentasi

| Dokumen | Deskripsi |
|---|---|
| [docs/database.md](docs/database.md) | Skema database lengkap, ERD, urutan migration, query contoh |
| [docs/scoring.md](docs/scoring.md) | Algoritma scoring Likert & MBTI, smart recommendation engine |
| [docs/auth.md](docs/auth.md) | Authentication, RBAC, konfigurasi Fortify, multi-role login |
| [docs/development.md](docs/development.md) | Panduan development, konvensi kode, struktur direktori |
| [docs/adr.md](docs/adr.md) | Architecture Decision Records — keputusan arsitektur & trade-off |

---

## Kontribusi

1. Buat branch dari `main`: `git checkout -b feature/nama-fitur`
2. Ikuti konvensi kode yang ada (cek file sibling sebelum membuat file baru)
3. Tulis tes untuk setiap perubahan
4. Jalankan `vendor/bin/pint --dirty` sebelum commit
5. Pastikan semua tes lulus: `php artisan test --compact`
6. Buat Pull Request ke `main`

---

## Lisensi

Proyek ini dikembangkan untuk kebutuhan internal Politeknik Negeri Subang.
