# Scoring Engine — SIMINAT

Dokumen ini menjelaskan algoritma penilaian dan logika rekomendasi secara lengkap.

---

## 1. Scoring Kuesioner Likert

Digunakan untuk tes Akademik dan Non-Akademik.

### Formula

```
Skor Kategori (%) = (Σ (Jawaban × Bobot)) / (Jumlah Soal × 5) × 100
```

- Jawaban valid: integer 1–5
- Bobot default: 1 (dapat dikonfigurasi per soal oleh admin)
- Hasil dibulatkan 2 desimal

### Contoh

Kategori **Keperawatan Klinis** (10 soal, semua bobot = 1):

| Soal | Jawaban | × Bobot |
|---|---|---|
| 1 | 5 | 5 |
| 2 | 4 | 4 |
| 3 | 5 | 5 |
| 4 | 3 | 3 |
| 5 | 4 | 4 |
| 6 | 5 | 5 |
| 7 | 4 | 4 |
| 8 | 5 | 5 |
| 9 | 3 | 3 |
| 10 | 4 | 4 |
| **Total** | | **42** |

```
Skor = (42 / (10 × 5)) × 100 = (42 / 50) × 100 = 84%
```

### Implementasi

```php
// app/Services/ScoringService.php

public function hitungLikert(array $jawaban, Collection $soal): float
{
    $total = 0;
    $maksimal = 0;

    foreach ($soal as $s) {
        $nilai = (int) ($jawaban[$s->id] ?? 0);
        $total    += $nilai * $s->bobot;
        $maksimal += 5 * $s->bobot;
    }

    if ($maksimal === 0) {
        return 0.0;
    }

    return round(($total / $maksimal) * 100, 2);
}
```

---

## 2. Scoring MBTI

### Dimensi yang Diukur

| Dimensi | Pilihan A | Pilihan B | Deskripsi |
|---|---|---|---|
| `EI` | E — Extraversion | I — Introversion | Sumber energi sosial |
| `SN` | S — Sensing | N — Intuition | Cara memproses informasi |
| `TF` | T — Thinking | F — Feeling | Cara mengambil keputusan |
| `JP` | J — Judging | P — Perceiving | Gaya hidup & organisasi |

### Algoritma

Untuk setiap soal MBTI:
- Pilihan `A` → tambah count huruf pertama dimensi (E, S, T, atau J)
- Pilihan `B` → tambah count huruf kedua dimensi (I, N, F, atau P)

Tipe akhir = huruf dengan count terbanyak per dimensi. Jika sama rata, default ke huruf pertama.

### Contoh

```
Dimensi EI: 7 soal → E: 5 pilihan, I: 2 pilihan → E
Dimensi SN: 6 soal → S: 3 pilihan, N: 3 pilihan → S (default huruf pertama)
Dimensi TF: 6 soal → T: 4 pilihan, F: 2 pilihan → T
Dimensi JP: 6 soal → J: 1 pilihan, P: 5 pilihan → P

Hasil MBTI: ESTP
```

### Implementasi

```php
// app/Services/ScoringService.php

public function hitungMbti(array $jawaban, Collection $soalMbti): array
{
    $counts = ['E' => 0, 'I' => 0, 'S' => 0, 'N' => 0, 'T' => 0, 'F' => 0, 'J' => 0, 'P' => 0];

    foreach ($soalMbti as $soal) {
        $pilihan = $jawaban[$soal->id] ?? null;
        if (! $pilihan) {
            continue;
        }

        [$hurufA, $hurufB] = match ($soal->dimensi_mbti) {
            DimensiMbti::EI => ['E', 'I'],
            DimensiMbti::SN => ['S', 'N'],
            DimensiMbti::TF => ['T', 'F'],
            DimensiMbti::JP => ['J', 'P'],
        };

        $pilihan === 'A' ? $counts[$hurufA]++ : $counts[$hurufB]++;
    }

    return [
        'EI'      => $counts['E'] >= $counts['I'] ? 'E' : 'I',
        'SN'      => $counts['S'] >= $counts['N'] ? 'S' : 'N',
        'TF'      => $counts['T'] >= $counts['F'] ? 'T' : 'F',
        'JP'      => $counts['J'] >= $counts['P'] ? 'J' : 'P',
        'counts'  => $counts,
        'result'  => '', // diisi oleh buildMbtiString()
    ];
}

public function buildMbtiString(array $dimensi): string
{
    return $dimensi['EI'] . $dimensi['SN'] . $dimensi['TF'] . $dimensi['JP'];
}
```

---

## 3. Threshold & Label

| Skor | Label | Warna UI |
|---|---|---|
| > 80% | Sangat Cocok | Hijau |
| 60–79% | Cocok | Biru |
| 40–59% | Cukup Cocok | Kuning |
| < 40% | Kurang Cocok | Abu-abu |

---

## 4. Smart Recommendation Engine

### Logika Utama

Rekomendasi dihasilkan dengan menggabungkan:
1. **Skor tertinggi** kategori akademik
2. **Skor tertinggi** kategori non-akademik
3. **Tipe MBTI** hasil tes

### Mapping MBTI → Bidang Kesehatan

| Tipe MBTI | Bidang Cocok | Karakteristik |
|---|---|---|
| ENFJ, ESFJ | Keperawatan Klinis, Edukasi Kesehatan | Empati tinggi, komunikatif |
| INTJ, INTP, ENTJ | Riset & Penalaran Ilmiah | Analitis, sistematis |
| ISTJ, ESTJ | Manajemen Klinis | Terstruktur, detail-oriented |
| INFP, ENFP | Seni & Kreativitas, Edukasi Kreatif | Imajinatif, ekspresif |
| ISFJ, ESFJ | Keperawatan Klinis, Kemanusiaan | Caring, service-oriented |

### Aturan Rekomendasi

```
IF skor_klinis > 70% AND mbti IN (ENFJ, ESFJ, ISFJ) THEN
  organisasi : KSR PMI, Tim Bantuan Medis (TBM), BEM Divisi Kesos
  lomba      : Olimpiade Keperawatan, Lomba Poster Edukasi Kesehatan
  kegiatan   : Volunteer Puskesmas, Bakti Sosial, Tanggap Bencana

IF skor_riset > 70% AND mbti IN (INTJ, INTP, ENTJ) THEN
  organisasi : Forum Kajian Ilmiah, Pers Mahasiswa
  lomba      : LKTI, Esai Nasional, Olimpiade Sains
  kegiatan   : Asisten Peneliti Dosen, Publikasi Jurnal

IF skor_edukasi > 70% THEN
  organisasi : UKM Pers, Divisi Humas BEM
  lomba      : Lomba Debat Kesehatan, Kompetisi Konten Edukatif
  kegiatan   : Penyuluhan Puskesmas, Health Influencer Kampus

IF skor_kemanusiaan > 80% AND skor_organisasi > 70% THEN
  organisasi : BEM, Relawan Kampus, KSR PMI
  lomba      : Social Business Plan
  kegiatan   : Manajemen Event Sosial, Tim Tanggap Bencana

IF skor_seni > 70% THEN
  organisasi : UKM Seni, UKM Fotografi
  lomba      : Festival Seni Mahasiswa, Kompetisi Desain
  kegiatan   : Dokumentasi Kegiatan Kampus, Mading Kreatif

IF skor_olahraga > 70% THEN
  organisasi : UKM Olahraga sesuai cabang
  lomba      : POMDA, Turnamen antar kampus
  kegiatan   : Delegasi kompetisi regional

IF skor_kewirausahaan > 70% THEN
  organisasi : UKM Kewirausahaan, Inkubator Bisnis
  lomba      : Business Plan Competition, PKM-K
  kegiatan   : Startup kesehatan, produk herbal

IF skor_literasi > 70% THEN
  organisasi : UKM Bahasa, English Club
  lomba      : Lomba Debat Bahasa Inggris, TOEFL Preparation
  kegiatan   : Program Nurse ke Luar Negeri, Pertukaran Pelajar
```

### Implementasi

```php
// app/Services/RekomendasisService.php

public function generate(HasilTes $hasil): array
{
    $rekomendasi = [
        'organisasi' => [],
        'lomba'      => [],
        'kegiatan'   => [],
    ];

    // Aturan berbasis skor + MBTI
    foreach ($this->rules() as $rule) {
        if ($rule['condition']($hasil)) {
            $rekomendasi['organisasi'] = array_unique(array_merge(
                $rekomendasi['organisasi'],
                $rule['organisasi']
            ));
            $rekomendasi['lomba'] = array_unique(array_merge(
                $rekomendasi['lomba'],
                $rule['lomba']
            ));
            $rekomendasi['kegiatan'] = array_unique(array_merge(
                $rekomendasi['kegiatan'],
                $rule['kegiatan']
            ));
        }
    }

    return $rekomendasi;
}

private function rules(): array
{
    return [
        [
            'condition'  => fn(HasilTes $h) => $h->skor_klinis > 70 && in_array($h->mbti_result, ['ENFJ', 'ESFJ', 'ISFJ']),
            'organisasi' => ['KSR PMI', 'Tim Bantuan Medis (TBM)', 'BEM Divisi Kesejahteraan Mahasiswa'],
            'lomba'      => ['Olimpiade Keperawatan', 'Lomba Poster Edukasi Kesehatan'],
            'kegiatan'   => ['Volunteer Puskesmas', 'Bakti Sosial', 'Tanggap Bencana Daerah'],
        ],
        // ... aturan lainnya
    ];
}
```

---

## 5. Contoh Hasil Lengkap

**Profil Mahasiswa:**
- Skor Klinis: 84%, Riset: 45%, Edukasi: 68%
- Skor Kemanusiaan: 88%, Organisasi: 78%, Literasi: 60%
- MBTI: ENFJ

**Output Rekomendasi:**

```json
{
  "organisasi": ["KSR PMI", "Tim Bantuan Medis (TBM)", "BEM Divisi Kesejahteraan Mahasiswa"],
  "lomba": ["Olimpiade Keperawatan", "Lomba Poster Edukasi Kesehatan"],
  "kegiatan": ["Volunteer Puskesmas", "Bakti Sosial", "Tanggap Bencana Daerah"]
}
```

---

## 6. Unit Testing

Scoring engine harus di-test secara independen dari database:

```php
// tests/Unit/Services/ScoringServiceTest.php

it('menghitung skor likert dengan benar', function () {
    $service = new ScoringService();
    $soal = Soal::factory()->count(10)->make(['bobot' => 1]);
    $jawaban = $soal->mapWithKeys(fn($s, $i) => [$s->id => [5,4,5,3,4,5,4,5,3,4][$i]])->all();

    expect($service->hitungLikert($jawaban, $soal))->toBe(84.0);
});

it('menentukan tipe mbti berdasarkan dominasi pilihan', function () {
    $service = new ScoringService();
    // setup soal dan jawaban MBTI...
    $result = $service->buildMbtiString($service->hitungMbti($jawaban, $soal));

    expect($result)->toBe('ENFJ');
});

it('mengembalikan 0 jika tidak ada soal', function () {
    $service = new ScoringService();
    expect($service->hitungLikert([], collect()))->toBe(0.0);
});
```
