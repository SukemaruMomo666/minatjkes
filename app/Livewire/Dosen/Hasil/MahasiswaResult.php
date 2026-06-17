<?php

namespace App\Livewire\Dosen\Hasil;

use App\Models\DraftJawaban;
use App\Models\JawabanMbti;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Url;
use Livewire\Component;

class MahasiswaResult extends Component
{
    #[Url]
    public int $userId = 0;

    public string $namaLengkap = '';

    public string $nimNidn = '';

    public string $namaKelas = '';

    public string $jenisKelamin = '';

    public array $radarLabels = [];

    public array $radarData = [];

    /** @var array<string, int> */
    public array $persentaseKategori = [];

    /** @var array<string, int> */
    public array $topKategori = [];

    /** @var array<string, int> */
    public array $bottomKategori = [];

    public string $mbtiResult = '';

    public array $mbtiDetailData = [];

    /** @var array<string, array<string, mixed>> */
    public array $mbtiSkorDimensi = [];

    public array $rekomendasiKegiatanData = [];

    public string $kesimpulanGabungan = '';

    public bool $belumAda = false;

    public function mount(int $userId): void
    {
        $user = User::with('kelas')->find($userId);

        if (! $user) {
            $this->redirect(route('dosen.dashboard'));

            return;
        }

        $this->userId = $userId;
        $this->namaLengkap = $user->nama ?? '';
        $this->nimNidn = $user->nim_nidn ?? '';
        $this->namaKelas = $user->kelas?->nama_kelas ?? '-';
        $this->jenisKelamin = match ($user->jenis_kelamin) {
            'laki-laki' => 'Laki-laki',
            'perempuan' => 'Perempuan',
            default => '-',
        };

        $jawabansMinat = DraftJawaban::with('soal.kategori')->where('user_id', $userId)->get();

        if ($jawabansMinat->isEmpty()) {
            $this->belumAda = true;

            return;
        }

        $skorMentah = [];
        foreach ($jawabansMinat as $jawaban) {
            $soal = $jawaban->soal;
            $nilai = (int) $jawaban->jawaban;

            if ($soal->is_unfav) {
                $nilai = 6 - $nilai;
            }

            if ($soal->kategori) {
                $nama = $soal->kategori->nama_kategori;
                if (! isset($skorMentah[$nama])) {
                    $skorMentah[$nama] = ['total_nilai' => 0, 'jumlah_soal' => 0];
                }
                $skorMentah[$nama]['total_nilai'] += $nilai;
                $skorMentah[$nama]['jumlah_soal']++;
            }
        }

        $persentaseKategori = [];
        foreach ($skorMentah as $nama => $data) {
            $maxSkor = $data['jumlah_soal'] * 5;
            $persen = $maxSkor > 0 ? ($data['total_nilai'] / $maxSkor) * 100 : 0;
            $persentaseKategori[$nama] = round($persen);
        }

        arsort($persentaseKategori);
        $this->persentaseKategori = $persentaseKategori;
        $this->radarLabels = array_keys($persentaseKategori);
        $this->radarData = array_values($persentaseKategori);
        $this->topKategori = array_slice($persentaseKategori, 0, 3, true);
        $this->bottomKategori = array_slice(array_reverse($persentaseKategori, true), 0, 3, true);

        $jawabansMbti = JawabanMbti::with('soalMbti')->where('user_id', $userId)->get();
        $mbtiSkor = ['E' => 0, 'I' => 0, 'S' => 0, 'N' => 0, 'T' => 0, 'F' => 0, 'J' => 0, 'P' => 0];

        foreach ($jawabansMbti as $jwbMbti) {
            if ($jwbMbti->soalMbti) {
                $dimensi = $jwbMbti->soalMbti->dimensi;
                $pilihan = $jwbMbti->pilihan;
                if ($dimensi === 'EI') {
                    $pilihan === 'A' ? $mbtiSkor['E']++ : $mbtiSkor['I']++;
                }
                if ($dimensi === 'SN') {
                    $pilihan === 'A' ? $mbtiSkor['S']++ : $mbtiSkor['N']++;
                }
                if ($dimensi === 'TF') {
                    $pilihan === 'A' ? $mbtiSkor['T']++ : $mbtiSkor['F']++;
                }
                if ($dimensi === 'JP') {
                    $pilihan === 'A' ? $mbtiSkor['J']++ : $mbtiSkor['P']++;
                }
            }
        }

        $E_or_I = ($mbtiSkor['E'] >= $mbtiSkor['I']) ? 'E' : 'I';
        $S_or_N = ($mbtiSkor['S'] >= $mbtiSkor['N']) ? 'S' : 'N';
        $T_or_F = ($mbtiSkor['T'] >= $mbtiSkor['F']) ? 'T' : 'F';
        $J_or_P = ($mbtiSkor['J'] >= $mbtiSkor['P']) ? 'J' : 'P';

        $this->mbtiResult = $jawabansMbti->isEmpty() ? '' : $E_or_I.$S_or_N.$T_or_F.$J_or_P;

        foreach (['EI' => ['E', 'I'], 'SN' => ['S', 'N'], 'TF' => ['T', 'F'], 'JP' => ['J', 'P']] as $dim => [$a, $b]) {
            $total = $mbtiSkor[$a] + $mbtiSkor[$b];
            $aPersen = $total > 0 ? round(($mbtiSkor[$a] / $total) * 100) : 50;
            $this->mbtiSkorDimensi[$dim] = [
                $a => $mbtiSkor[$a],
                $b => $mbtiSkor[$b],
                $a.'_persen' => $aPersen,
                $b.'_persen' => 100 - $aPersen,
                'dominan' => ($mbtiSkor[$a] >= $mbtiSkor[$b]) ? $a : $b,
            ];
        }

        $kategoriUtama = array_key_first($this->topKategori) ?? '';
        $this->mbtiDetailData = $this->getKamusMbti($this->mbtiResult) ?? [];
        $this->rekomendasiKegiatanData = $kategoriUtama ? $this->getKamusKegiatan($kategoriUtama) : [];
        $this->kesimpulanGabungan = $this->generateKesimpulan($kategoriUtama, $this->mbtiResult, $this->topKategori, $this->bottomKategori);
    }

    private function generateKesimpulan(string $minatUtama, string $mbti, array $kuat, array $lemah): string
    {
        $mbtiData = $this->getKamusMbti($mbti);
        $julukan = $mbtiData ? $mbtiData['julukan'] : '';
        $kuatList = implode(', ', array_keys($kuat));
        $lemahList = implode(', ', array_keys($lemah));
        $mbtiLabel = $mbti ? "{$mbti} ({$julukan})" : 'belum diketahui';

        return "Berdasarkan hasil pemetaan lengkap, bidang minat terkuat mahasiswa ini adalah {$kuatList} — menunjukkan potensi unggulan yang dapat dikembangkan secara konsisten. "
            ."Dipadukan dengan tipe kepribadian {$mbtiLabel}, terdapat kecocokan tinggi untuk jalur karier yang memanfaatkan kekuatan tersebut. "
            ."Sementara itu, bidang {$lemahList} menunjukkan skor lebih rendah dan merupakan area pengembangan diri yang dapat ditingkatkan melalui bimbingan akademik yang terarah.";
    }

    private function getKamusMbti(string $mbti): ?array
    {
        $kamus = [
            'ISTJ' => ['julukan' => 'The Inspector', 'karakter' => 'Disiplin, terstruktur, teliti, dan bertanggung jawab. Menyukai aturan jelas dan sistematis.', 'potensi' => 'Administrasi, manajemen, keperawatan klinis, audit mutu.', 'pengembangan' => 'Kepemimpinan dan komunikasi interpersonal.'],
            'ISFJ' => ['julukan' => 'The Protector', 'karakter' => 'Peduli, sabar, dan memiliki kepedulian tinggi terhadap kebutuhan orang lain. Senang membantu.', 'potensi' => 'Keperawatan anak, maternitas, komunitas, pelayanan pasien.', 'pengembangan' => 'Percaya diri dalam mengambil keputusan.'],
            'INFJ' => ['julukan' => 'The Advocate', 'karakter' => 'Empati tinggi, visioner, dan mampu memahami perasaan orang lain. Berorientasi pada nilai hidup.', 'potensi' => 'Keperawatan jiwa, konseling, edukasi kesehatan.', 'pengembangan' => 'Mengelola perfeksionisme dan stres emosional.'],
            'INTJ' => ['julukan' => 'The Architect', 'karakter' => 'Berpikir strategis, logis, dan berorientasi pemecahan masalah. Merancang solusi jangka panjang.', 'potensi' => 'Penelitian, manajemen kesehatan, pengembangan kebijakan.', 'pengembangan' => 'Kerja sama tim dan komunikasi sosial.'],
            'ISTP' => ['julukan' => 'The Virtuoso', 'karakter' => 'Praktis, mandiri, dan cepat beradaptasi. Menyukai tantangan teknis dan keterampilan praktik.', 'potensi' => 'IGD, ICU, kamar operasi, keterampilan klinis.', 'pengembangan' => 'Konsistensi dalam perencanaan jangka panjang.'],
            'ISFP' => ['julukan' => 'The Adventurer', 'karakter' => 'Ramah, kreatif, dan sensitif terhadap lingkungan sekitar. Menyukai kebebasan berekspresi.', 'potensi' => 'Promosi kesehatan, terapi kreatif, kegiatan sosial.', 'pengembangan' => 'Kemampuan organisasi dan kepemimpinan.'],
            'INFP' => ['julukan' => 'The Mediator', 'karakter' => 'Idealis, reflektif, dengan nilai kemanusiaan kuat. Mencari makna dalam setiap aktivitas.', 'potensi' => 'Keperawatan jiwa, konseling, relawan kemanusiaan.', 'pengembangan' => 'Pengambilan keputusan yang lebih tegas.'],
            'INTP' => ['julukan' => 'The Thinker', 'karakter' => 'Rasa ingin tahu tinggi, analitis, mengeksplorasi ide baru. Memahami konsep kompleks.', 'potensi' => 'Penelitian, inovasi kesehatan, teknologi kesehatan.', 'pengembangan' => 'Keterampilan komunikasi dan implementasi ide.'],
            'ESTP' => ['julukan' => 'The Entrepreneur', 'karakter' => 'Energik, aktif, cepat mengambil tindakan darurat. Menyukai tantangan dan pengalaman baru.', 'potensi' => 'Keperawatan gawat darurat, ambulans, organisasi mahasiswa.', 'pengembangan' => 'Perencanaan dan konsistensi jangka panjang.'],
            'ESFP' => ['julukan' => 'The Entertainer', 'karakter' => 'Ramah, antusias, mudah bergaul. Menikmati interaksi sosial dengan banyak orang.', 'potensi' => 'Edukator kesehatan, promosi kesehatan, event organizer.', 'pengembangan' => 'Manajemen waktu dan fokus pada tujuan.'],
            'ENFP' => ['julukan' => 'The Campaigner', 'karakter' => 'Kreatif, inovatif, dan menginspirasi orang lain. Senang menjalin relasi dan peluang baru.', 'potensi' => 'Promosi kesehatan, organisasi, kewirausahaan.', 'pengembangan' => 'Konsistensi dalam menyelesaikan tugas.'],
            'ENTP' => ['julukan' => 'The Debater', 'karakter' => 'Berpikir kritis, argumentatif, inovatif. Senang berdiskusi mencari solusi kreatif.', 'potensi' => 'Penelitian, kewirausahaan, pengembangan program kesehatan.', 'pengembangan' => 'Kesabaran dan perhatian terhadap detail.'],
            'ESTJ' => ['julukan' => 'The Executive', 'karakter' => 'Tegas, terorganisir, pemimpin yang baik. Mengatur sumber daya secara efektif.', 'potensi' => 'Manajemen keperawatan, organisasi mahasiswa, kepemimpinan.', 'pengembangan' => 'Empati dan fleksibilitas dalam bekerja.'],
            'ESFJ' => ['julukan' => 'The Consul', 'karakter' => 'Hangat, kooperatif, membangun hubungan baik. Senang bekerja dalam tim dan membantu sesama.', 'potensi' => 'Keperawatan komunitas, anak, maternitas.', 'pengembangan' => 'Kemandirian dalam pengambilan keputusan.'],
            'ENFJ' => ['julukan' => 'The Protagonist', 'karakter' => 'Pemimpin, motivator, membimbing orang lain. Menciptakan hubungan positif menuju tujuan bersama.', 'potensi' => 'Pendidikan kesehatan, kepemimpinan organisasi, konseling.', 'pengembangan' => 'Menjaga keseimbangan kebutuhan diri dan orang lain.'],
            'ENTJ' => ['julukan' => 'The Commander', 'karakter' => 'Kepemimpinan kuat, percaya diri, berorientasi hasil. Merencanakan strategi dan keputusan cepat.', 'potensi' => 'Manajemen kesehatan, kepemimpinan organisasi, kewirausahaan.', 'pengembangan' => 'Sensitivitas terhadap perasaan anggota tim.'],
        ];

        return $kamus[$mbti] ?? null;
    }

    private function getKamusKegiatan(string $kategori): array
    {
        $kategoriLower = strtolower($kategori);

        if (str_contains($kategoriLower, 'klinis')) {
            return ['Kompetisi Keperawatan Klinis: Olimpiade OSCE.', 'Asisten Laboratorium Keperawatan / tutor sebaya.', 'Lomba Evakuasi & Gawat Darurat (ILMKI).'];
        } elseif (str_contains($kategoriLower, 'riset') || str_contains($kategoriLower, 'penalaran')) {
            return ['Program Kreativitas Mahasiswa (PKM-RE/RSH).', 'Lomba Karya Tulis Ilmiah Nasional (LKTIN).', 'National Nursing Scientific Essay.'];
        } elseif (str_contains($kategoriLower, 'pendidikan') || str_contains($kategoriLower, 'promosi')) {
            return ['Lomba Poster / Infografis Kesehatan.', 'Video Edukasi Kesehatan / Content Creator.', 'Duta Kesehatan Kampus atau Tim Pengmas.'];
        } elseif (str_contains($kategoriLower, 'organisasi') || str_contains($kategoriLower, 'kepemimpinan')) {
            return ['Pengurus Organisasi Kampus (HIMA, BEM, UKM).', 'Kepanitiaan (Ketua / koordinator program).', 'Pelatihan Leadership & Public Speaking.'];
        } elseif (str_contains($kategoriLower, 'seni') || str_contains($kategoriLower, 'kreativitas')) {
            return ['UKM Seni Budaya (Tari, musik, teater).', 'Tim Desainer / fotografer / videografer.', 'Kompetisi Seni Kreativitas.'];
        } elseif (str_contains($kategoriLower, 'olahraga') || str_contains($kategoriLower, 'bela diri')) {
            return ['UKM Olahraga (Futsal, Voli, Badminton).', 'UKM Bela Diri (Pencak silat, Taekwondo).', 'Pekan Olahraga Mahasiswa Nasional (POMNAS).'];
        } elseif (str_contains($kategoriLower, 'wirausaha') || str_contains($kategoriLower, 'entrepreneur')) {
            return ['PKM-K atau P2MW Kewirausahaan.', 'Kompetisi Bisnis Mahasiswa Indonesia (KBMI).', 'Inkubator bisnis / koperasi mahasiswa.'];
        } elseif (str_contains($kategoriLower, 'kemanusiaan') || str_contains($kategoriLower, 'relawan')) {
            return ['Korps Sukarela (KSR) PMI universitas.', 'Tim Disaster Medical Committee (DMC).', 'Fasilitator pengabdian masyarakat.'];
        } elseif (str_contains($kategoriLower, 'literasi') || str_contains($kategoriLower, 'bahasa')) {
            return ['Lomba Debat / pidato bahasa asing.', 'Tim Humas & Publikasi kampus.', 'Program Student Exchange / kelas internasional.'];
        }

        return [];
    }

    public function render(): View
    {
        return view('livewire.dosen.hasil.mahasiswa-result')->layout('layouts.blank');
    }
}
