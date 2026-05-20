# Architecture Decision Records — SIMINAT

Dokumen ini merangkum semua keputusan arsitektur penting beserta alasan dan trade-off-nya.

---

## ADR-001: Full-Stack Livewire Monolith (bukan REST API + JWT)

**Status:** Accepted | **Tanggal:** 2026-05-20

### Konteks

Dokumen teknis awal menyebut "RESTful API + JWT" sebagai pendekatan. Namun stack yang terpasang (Laravel 13 + Livewire 4 + Flux UI + Fortify) secara natural mengarah ke server-side rendering.

### Keputusan

Gunakan **Full-Stack Livewire Monolith** dengan session-based authentication. Hapus rencana JWT.

### Trade-off

| Aspek | Livewire Monolith | REST API + JWT |
|---|---|---|
| Kompleksitas | Rendah (1 codebase) | Tinggi (2 codebase) |
| Auth | Session cookie (aman) | JWT di localStorage (rentan XSS) |
| PDF/Excel export | Server-side, direct download | Perlu trigger dari frontend |
| Mobile app future | Perlu tambah Sanctum nanti | Siap dari awal |
| Timeline feasibility | Feasible (7–8 minggu) | Berisiko |

### Konsekuensi

- Jika di masa depan butuh mobile app, tambahkan `laravel/sanctum` tanpa ubah logic utama
- Semua "API endpoints" di dokumen awal digantikan Livewire component actions

---

## ADR-002: Satu Tabel `users` untuk Semua Role

**Status:** Accepted | **Tanggal:** 2026-05-20

### Konteks

Tiga role dengan credential berbeda: mahasiswa (NIM + tanggal lahir), dosen (NIDN + tanggal lahir), admin (username + password).

### Keputusan

Satu tabel `users` dengan kolom `role` ENUM dan `nim_nidn` sebagai login identifier. Fortify dikonfigurasi dengan `username => 'nim_nidn'`.

### Alternatif yang Ditolak

- **3 tabel terpisah + 3 guard:** Triple complexity, triple maintenance, tidak worth it untuk scope ini
- **Polymorphic profile:** Overhead JOIN tidak diperlukan, data mahasiswa/dosen tidak jauh berbeda

### Konsekuensi

- Password mahasiswa/dosen di-seed sebagai `bcrypt('ddmmyyyy')`
- Custom `LoginResponse` untuk redirect berdasarkan `$user->role`
- Custom middleware `EnsureRole` untuk RBAC

---

## ADR-003: Tabel `draft_jawaban` untuk Resume Tes

**Status:** Accepted | **Tanggal:** 2026-05-20

### Konteks

Tes terdiri dari 90–120 soal (~30–40 menit). Risiko data loss jika browser refresh atau session expire sebelum submit.

### Keputusan

Setiap jawaban yang dipilih langsung di-save ke tabel `draft_jawaban` via `updateOrCreate`. Saat submit final, draft dipindah ke `jawaban` lalu draft di-truncate.

### Trade-off

- **Pro:** Data aman dari browser crash, bisa resume dari mana saja
- **Con:** 1 DB write per soal yang dijawab (~100 write per sesi tes) — acceptable untuk volume internal kampus

### Konsekuensi

- Tambah tabel `draft_jawaban` (tidak ada di ERD dokumen asli)
- Unique constraint: `(user_id, soal_id)` di `draft_jawaban`
- `TesWizard` component cek draft saat mount untuk resume

---

## ADR-004: Server-Side PDF dengan DomPDF (bukan jsPDF)

**Status:** Accepted | **Tanggal:** 2026-05-20

### Konteks

Dokumen awal menyebut `jsPDF` (client-side). Karena arsitektur adalah Livewire monolith (server-rendered), lebih konsisten menggunakan server-side PDF.

### Keputusan

Gunakan `barryvdh/laravel-dompdf`. Template PDF adalah Blade view dengan CSS inline. Grafik di PDF menggunakan CSS bar chart (bukan Chart.js — DomPDF tidak support JS).

### Trade-off

- **Pro:** Konsisten dengan arsitektur, mudah di-maintain, CSS controllable
- **Con:** Grafik di PDF lebih sederhana dibanding versi web (tidak ada animasi/interaktivitas)
- **Grafik web** tetap menggunakan Chart.js via Alpine.js

---

## ADR-005: Maatwebsite Excel untuk Export (bukan SheetJS)

**Status:** Accepted | **Tanggal:** 2026-05-20

### Konteks

Dokumen awal menyebut `xlsx / SheetJS` (JavaScript). Karena monolith, export Excel lebih natural di server.

### Keputusan

Gunakan `maatwebsite/laravel-excel`. Support streaming untuk dataset besar dan integrasi natural dengan Eloquent collection.

### Konsekuensi

- Dua dependency baru perlu ditambahkan ke `composer.json`: `barryvdh/laravel-dompdf` dan `maatwebsite/excel`
- Untuk export >1000 baris, gunakan queue export

---

## ADR-006: `RekomendasisService` Berbasis PHP Array (bukan Database)

**Status:** Accepted | **Tanggal:** 2026-05-20

### Konteks

Mapping MBTI → rekomendasi adalah data statis yang jarang berubah. Bisa disimpan di database (CRUD admin) atau hard-code di PHP.

### Keputusan

Data mapping disimpan sebagai PHP array di `RekomendasisService`. Jika ada perubahan mapping, edit file PHP dan deploy ulang.

### Trade-off

- **Pro:** Tidak butuh tabel + CRUD admin tambahan, mudah di-version control, testable
- **Con:** Perubahan mapping butuh deploy (tidak bisa diubah admin via UI)
- **Alternatif jika perlu:** Buat tabel `recommendation_rules` dan CRUD admin — tapi tidak dalam scope awal

### Konsekuensi

- Aturan rekomendasi ada di `app/Services/RekomendasisService.php`
- Hasil rekomendasi disimpan sebagai JSON di `hasil_tes.rekomendasi_*` (snapshot saat tes)

---

## ADR-007: Circular FK `users ↔ kelas` — Strategi Migration

**Status:** Accepted | **Tanggal:** 2026-05-20

### Konteks

`users.kelas_id` FK ke `kelas`, dan `kelas.dosen_wali_id` FK ke `users`. Circular dependency di migration.

### Keputusan

Migration dibagi 3 langkah:
1. Buat `kelas` **tanpa** kolom `dosen_wali_id`
2. Buat `users` dengan `kelas_id` FK ke `kelas`
3. ALTER `kelas`: tambah kolom `dosen_wali_id` FK ke `users`

### Konsekuensi

- Urutan migration harus dijaga ketat (lihat `docs/database.md`)
- Seeder harus membuat kelas dulu, lalu assign dosen setelah user dosen dibuat

---

## Keputusan yang Belum Diambil (Open Questions)

| Pertanyaan | Opsi | Prioritas |
|---|---|---|
| Format password default mahasiswa | `ddmmyyyy` atau `dd-mm-yyyy` | Tinggi — tentukan sebelum seeding |
| Mahasiswa bisa tes ulang? | One-time atau multiple attempts | Medium — pengaruhi UI riwayat |
| Notifikasi dosen saat mahasiswa belum tes | Email reminder atau dashboard saja | Rendah |
| Apakah soal perlu dirandominasi urutan? | Fixed order atau shuffle | Medium |
