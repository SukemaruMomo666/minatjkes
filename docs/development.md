# Panduan Development — SIMINAT

---

## Setup Development Environment

### Prasyarat

- PHP 8.3+
- Composer 2.x
- Node.js 20+
- MySQL 8.0+ (atau gunakan SQLite untuk lokal)
- Git

### Langkah Setup Awal

```bash
# 1. Clone repo
git clone <repo-url> siminat-project && cd siminat-project

# 2. Install PHP dependencies
composer install

# 3. Install JS dependencies
npm install

# 4. Setup environment
cp .env.example .env
php artisan key:generate

# 5. Migrasi + seed
php artisan migrate
php artisan db:seed

# 6. Build frontend
npm run build

# 7. Jalankan dev server
composer run dev
```

### Konfigurasi `.env` Minimal

```dotenv
APP_NAME=SIMINAT
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_DATABASE=siminat
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=log          # Untuk development, email di-log bukan dikirim
```

---

## Konvensi Kode

### PHP

- Gunakan PHP 8 constructor property promotion
- Return type declarations wajib untuk semua method
- Gunakan PHP Enums untuk nilai tetap (role, tipe soal, dimensi MBTI)
- Curly braces wajib meski single-line body

```php
// Benar
if ($user->isActive()) {
    return $user;
}

// Salah
if ($user->isActive()) return $user;
```

### Livewire Components

- Simpan state di server (bukan localStorage)
- Gunakan `wire:model` untuk binding form
- Gunakan `wire:loading` untuk feedback loading
- Validasi di method action, bukan hanya di frontend

```php
class TesWizard extends Component
{
    #[Validate('required|integer|between:1,5')]
    public array $jawaban = [];

    public function jawab(int $soalId, int $nilai): void
    {
        $this->jawaban[$soalId] = $nilai;
        // Simpan draft ke DB
    }
}
```

### Blade / Flux UI

- Gunakan komponen Flux UI (`<flux:button>`, `<flux:input>`, dll.) untuk konsistensi UI
- Hindari inline style kecuali untuk chart data binding
- Responsif: mobile-first dengan Tailwind breakpoints (`sm:`, `md:`, `lg:`)

---

## Membuat Fitur Baru

### 1. Buat Model + Migration

```bash
php artisan make:model NamaModel -mfs --no-interaction
# -m: migration, -f: factory, -s: seeder
```

### 2. Buat Livewire Component

```bash
php artisan make:livewire NamaDomain/NamaComponent --no-interaction
```

### 3. Buat Test

```bash
php artisan make:test --pest NamaFeatureTest --no-interaction
```

### 4. Daftarkan Route

```php
// routes/mahasiswa.php (atau dosen.php / admin.php)
Route::livewire('path', 'domain.component-name')->name('route.name');
```

---

## Struktur Direktori Lengkap

```
app/
├── Concerns/
│   ├── PasswordValidationRules.php
│   └── ProfileValidationRules.php
├── Enums/
│   ├── UserRole.php           # mahasiswa, dosen, admin
│   ├── TipeSoal.php           # akademik, non_akademik, mbti
│   ├── TipeKategori.php       # akademik, non_akademik
│   └── DimensiMbti.php        # EI, SN, TF, JP
├── Http/
│   ├── Middleware/
│   │   └── EnsureRole.php
│   └── Responses/
│       └── LoginResponse.php
├── Livewire/
│   ├── Auth/
│   │   └── Login.php
│   ├── Mahasiswa/
│   │   ├── Dashboard.php
│   │   ├── Onboarding.php
│   │   └── Tes/
│   │       └── TesWizard.php
│   ├── Dosen/
│   │   ├── Dashboard.php
│   │   ├── DaftarMahasiswa.php
│   │   └── DetailMahasiswa.php
│   └── Admin/
│       ├── Dashboard.php
│       ├── MasterMahasiswa/
│       │   ├── Index.php
│       │   ├── Create.php
│       │   └── Edit.php
│       ├── MasterDosen/
│       ├── MasterKelas/
│       └── MasterSoal/
├── Models/
│   ├── User.php
│   ├── Kelas.php
│   ├── Kategori.php
│   ├── Soal.php
│   ├── HasilTes.php
│   ├── Jawaban.php
│   ├── DraftJawaban.php
│   └── LogAktivitas.php
├── Providers/
│   ├── AppServiceProvider.php
│   └── FortifyServiceProvider.php
└── Services/
    ├── ScoringService.php
    ├── RekomendasisService.php
    ├── PdfExportService.php
    └── ExcelExportService.php

resources/views/
├── livewire/
│   ├── auth/
│   │   └── login.blade.php
│   ├── mahasiswa/
│   │   ├── dashboard.blade.php
│   │   ├── onboarding.blade.php
│   │   └── tes/
│   │       └── tes-wizard.blade.php
│   ├── dosen/
│   │   ├── dashboard.blade.php
│   │   ├── daftar-mahasiswa.blade.php
│   │   └── detail-mahasiswa.blade.php
│   └── admin/
│       ├── dashboard.blade.php
│       └── master-*/
└── pdf/
    └── rapor-potensi.blade.php    # Template DomPDF

routes/
├── web.php
├── mahasiswa.php
├── dosen.php
├── admin.php
├── settings.php
└── console.php

database/
├── migrations/          # Urutan lihat docs/database.md
├── factories/
└── seeders/
    ├── DatabaseSeeder.php
    ├── UserSeeder.php
    ├── KelasSeeder.php
    ├── KategoriSeeder.php
    └── SoalSeeder.php   # Bank soal lengkap

tests/
├── Unit/
│   └── Services/
│       ├── ScoringServiceTest.php
│       └── RekomendasisServiceTest.php
└── Feature/
    ├── Auth/
    │   ├── LoginTest.php
    │   └── RedirectByRoleTest.php
    ├── Mahasiswa/
    │   ├── TesWizardTest.php
    │   └── HasilTesTest.php
    ├── Dosen/
    │   ├── DashboardTest.php
    │   └── ExportExcelTest.php
    └── Admin/
        ├── MasterMahasiswaTest.php
        ├── MasterDosenTest.php
        ├── MasterKelasTest.php
        └── MasterSoalTest.php
```

---

## Testing

### Jalankan Tes

```bash
# Semua tes
php artisan test --compact

# Satu file
php artisan test --compact tests/Unit/Services/ScoringServiceTest.php

# Filter by nama
php artisan test --compact --filter=login

# Parallel (lebih cepat)
php artisan test --compact --parallel
```

### Menulis Test

```php
// tests/Feature/Auth/LoginTest.php

use App\Models\User;

it('mahasiswa bisa login dengan nim dan tanggal lahir', function () {
    $user = User::factory()->mahasiswa()->create([
        'nim_nidn' => '2401001',
        'password' => bcrypt('15062006'),
    ]);

    $response = $this->post('/login', [
        'nim_nidn' => '2401001',
        'password' => '15062006',
    ]);

    $response->assertRedirect(route('mahasiswa.dashboard'));
    $this->assertAuthenticatedAs($user);
});

it('akun nonaktif tidak bisa login', function () {
    User::factory()->mahasiswa()->create([
        'nim_nidn'  => '2401002',
        'password'  => bcrypt('15062006'),
        'is_active' => false,
    ]);

    $this->post('/login', [
        'nim_nidn' => '2401002',
        'password' => '15062006',
    ])->assertSessionHasErrors();
});
```

### Factory States

```php
// database/factories/UserFactory.php

public function mahasiswa(): static
{
    return $this->state(['role' => UserRole::Mahasiswa]);
}

public function dosen(): static
{
    return $this->state(['role' => UserRole::Dosen]);
}

public function admin(): static
{
    return $this->state(['role' => UserRole::Admin]);
}
```

---

## Code Formatting

Wajib dijalankan sebelum commit:

```bash
vendor/bin/pint --dirty --format agent
```

Cek tanpa mengubah file:

```bash
vendor/bin/pint --test
```

---

## Import Data via Excel

### Format Excel Mahasiswa

| Kolom | Wajib | Contoh |
|---|---|---|
| `nim` | Ya | `2401001` |
| `nama` | Ya | `Andi Saputra` |
| `tanggal_lahir` | Ya | `15/06/2006` |
| `kelas` | Ya | `1A Keperawatan` |
| `email` | Tidak | `andi@example.com` |

### Format Excel Soal

| Kolom | Wajib | Contoh |
|---|---|---|
| `kategori` | Ya (kecuali MBTI) | `Keperawatan Klinis` |
| `tipe` | Ya | `akademik` / `non_akademik` / `mbti` |
| `teks_soal` | Ya | `Saya merasa nyaman berinteraksi...` |
| `dimensi_mbti` | Hanya MBTI | `EI` |
| `opsi_a` | Hanya MBTI | `Saya aktif berdiskusi` |
| `opsi_b` | Hanya MBTI | `Saya merenung sendiri` |
| `bobot` | Tidak | `1` (default) |

---

## Troubleshooting Umum

### "Vite manifest not found"

```bash
npm run build
# atau jalankan: composer run dev
```

### Migration error: foreign key constraint

Pastikan urutan migration sesuai `docs/database.md`. Circular FK antara `users` dan `kelas` memerlukan migration terpisah (lihat bagian urutan migration).

### Livewire component tidak re-render

Pastikan property yang diubah menggunakan `$this->property = value`, bukan mutasi array langsung. Gunakan:

```php
$arr = $this->jawaban;
$arr[$soalId] = $nilai;
$this->jawaban = $arr;
```

### PDF tidak render grafik

DomPDF tidak support JavaScript. Grafik di template PDF harus menggunakan CSS-only (inline `width: X%` untuk bar chart). Grafik interaktif hanya di halaman web (Chart.js).

### Export Excel timeout

Untuk dataset besar (>1000 mahasiswa), gunakan Maatwebsite Excel queue export:

```php
(new DataGlobalExport)->queue('exports/data-global.xlsx');
```
