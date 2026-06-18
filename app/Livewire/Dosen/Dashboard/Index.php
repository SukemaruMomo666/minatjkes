<?php

namespace App\Livewire\Dosen\Dashboard;

use App\Enums\UserRole;
use App\Models\DraftJawaban;
use App\Models\JawabanMbti;
use App\Models\Kelas;
use App\Models\Soal;
use App\Models\SoalMbti;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Index extends Component
{
    public string $dosenNama = '';

    public string $namaKelas = '';

    public int $totalMahasiswa = 0;

    public int $asesmenSelesai = 0;

    public int $belumMulai = 0;

    public int $sedangProses = 0;

    public int $rataKecocokan = 0;

    public array $hasilAsesmen = [];

    public array $distribusiMinat = [];

    public array $petaKompetensi = [];

    public ?int $selectedMhsId = null;

    public array $detailData = [];

    public function mount(): void
    {
        $this->dosenNama = Auth::user()->nama;
        $this->kalkulasiData();
    }

    private function kalkulasiData(): void
    {
        $totalSoalMinat = Soal::where('is_active', true)->count();
        $totalSoalMbti = SoalMbti::where('is_active', true)->count();

        $kelas = Kelas::where('dosen_wali_id', Auth::id())->first();
        $this->namaKelas = $kelas?->nama_kelas ?? '';

        if ($kelas) {
            $mahasiswas = User::where('role', UserRole::Mahasiswa)
                ->where('kelas_id', $kelas->id)
                ->orderBy('nama')
                ->get();
        } else {
            $mahasiswas = User::where('role', UserRole::Mahasiswa)->orderBy('nama')->get();
        }

        $this->totalMahasiswa = $mahasiswas->count();

        if ($totalSoalMinat === 0 || $this->totalMahasiswa === 0) {
            return;
        }

        $mhsIds = $mahasiswas->pluck('id');

        // Batch load semua jawaban minat bakat
        $allJawabansMinat = DraftJawaban::with('soal.kategori')
            ->whereIn('user_id', $mhsIds)
            ->get()
            ->groupBy('user_id');

        // Batch load semua jawaban MBTI
        $allJawabsMbti = JawabanMbti::with('soalMbti')
            ->whereIn('user_id', $mhsIds)
            ->get()
            ->groupBy('user_id');

        $totalKecocokan = 0;
        $rekapDistribusi = [];
        $rekapKompetensi = [];

        foreach ($mahasiswas as $mhs) {
            $jawabansMinat = $allJawabansMinat[$mhs->id] ?? collect();
            $jawabansMbti = $allJawabsMbti[$mhs->id] ?? collect();

            $jumlahDijawabMinat = $jawabansMinat->count();
            $jumlahDijawabMbti = $jawabansMbti->count();

            // Status minat bakat
            if ($jumlahDijawabMinat === 0) {
                $statusMinat = 'Belum Mulai';
                $this->belumMulai++;
            } elseif ($jumlahDijawabMinat < $totalSoalMinat) {
                $statusMinat = 'Proses ('.round(($jumlahDijawabMinat / $totalSoalMinat) * 100).'%)';
                $this->sedangProses++;
            } else {
                $statusMinat = 'Selesai';
                $this->asesmenSelesai++;
            }

            // Status MBTI
            if ($totalSoalMbti === 0 || $jumlahDijawabMbti === 0) {
                $statusMbti = 'Belum Mulai';
            } elseif ($jumlahDijawabMbti < $totalSoalMbti) {
                $statusMbti = 'Proses ('.round(($jumlahDijawabMbti / $totalSoalMbti) * 100).'%)';
            } else {
                $statusMbti = 'Selesai';
            }

            // Hitung MBTI result
            $mbtiResult = '-';
            if ($jawabansMbti->isNotEmpty()) {
                $mbtiSkor = ['E' => 0, 'I' => 0, 'S' => 0, 'N' => 0, 'T' => 0, 'F' => 0, 'J' => 0, 'P' => 0];
                foreach ($jawabansMbti as $jwb) {
                    if ($jwb->soalMbti) {
                        $dimensi = $jwb->soalMbti->dimensi;
                        $pilihan = $jwb->pilihan;
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
                if ($jumlahDijawabMbti >= $totalSoalMbti && $totalSoalMbti > 0) {
                    $mbtiResult = ($mbtiSkor['E'] >= $mbtiSkor['I'] ? 'E' : 'I')
                        .($mbtiSkor['S'] >= $mbtiSkor['N'] ? 'S' : 'N')
                        .($mbtiSkor['T'] >= $mbtiSkor['F'] ? 'T' : 'F')
                        .($mbtiSkor['J'] >= $mbtiSkor['P'] ? 'J' : 'P');
                } else {
                    $mbtiResult = 'Proses';
                }
            }

            // Hitung skor per kategori minat bakat
            $skorMentah = [];
            foreach ($jawabansMinat as $jawaban) {
                if ($jawaban->soal && $jawaban->soal->kategori) {
                    $namaKat = $jawaban->soal->kategori->nama_kategori;
                    if (! isset($skorMentah[$namaKat])) {
                        $skorMentah[$namaKat] = ['total' => 0, 'jumlah' => 0];
                    }
                    $nilai = (int) $jawaban->jawaban;
                    if ($jawaban->soal->is_unfav) {
                        $nilai = 6 - $nilai;
                    }
                    $skorMentah[$namaKat]['total'] += $nilai;
                    $skorMentah[$namaKat]['jumlah']++;
                }
            }

            $kategoriTertinggi = '-';
            $skorTertinggi = 0;

            foreach ($skorMentah as $nama => $data) {
                $maxSkor = $data['jumlah'] * 5;
                $pct = $maxSkor > 0 ? round(($data['total'] / $maxSkor) * 100) : 0;

                if (! isset($rekapKompetensi[$nama])) {
                    $rekapKompetensi[$nama] = [];
                }
                $rekapKompetensi[$nama][] = $pct;

                if ($pct > $skorTertinggi) {
                    $skorTertinggi = $pct;
                    $kategoriTertinggi = $nama;
                }
            }

            if ($statusMinat === 'Selesai') {
                $totalKecocokan += $skorTertinggi;
                $rekapDistribusi[$kategoriTertinggi] = ($rekapDistribusi[$kategoriTertinggi] ?? 0) + 1;
            }

            $this->hasilAsesmen[] = [
                'user_id' => $mhs->id,
                'nama' => $mhs->nama ?? 'Mahasiswa',
                'nim' => $mhs->nim_nidn ?? '-',
                'kelas' => $kelas?->nama_kelas ?? '-',
                'kategori_utama' => $kategoriTertinggi,
                'skor_utama' => $skorTertinggi,
                'status_minat' => $statusMinat,
                'status_mbti' => $statusMbti,
                'mbti_result' => $mbtiResult,
                'file_akademik' => $mhs->file_bakat_akademik,
                'file_non_akademik' => $mhs->file_bakat_non_akademik,
            ];
        }

        if ($this->asesmenSelesai > 0) {
            $this->rataKecocokan = round($totalKecocokan / $this->asesmenSelesai);
        }

        $this->distribusiMinat = [
            'labels' => array_keys($rekapDistribusi),
            'data' => array_values($rekapDistribusi),
        ];

        $radarLabels = [];
        $radarData = [];
        foreach ($rekapKompetensi as $kat => $vals) {
            $radarLabels[] = $kat;
            $radarData[] = round(array_sum($vals) / count($vals));
        }

        $this->petaKompetensi = [
            'labels' => $radarLabels,
            'data' => $radarData,
        ];
    }

    public function openDetail(int $mhsId): void
    {
        $mhs = User::with('kelas')->find($mhsId);
        if (! $mhs) {
            return;
        }

        $totalSoalMinat = Soal::where('is_active', true)->count();
        $totalSoalMbti = SoalMbti::where('is_active', true)->count();

        $jawabansMinat = DraftJawaban::with('soal.kategori')->where('user_id', $mhsId)->get();
        $jawabansMbti = JawabanMbti::with('soalMbti')->where('user_id', $mhsId)->get();

        $jumlahDijawabMinat = $jawabansMinat->count();
        $jumlahDijawabMbti = $jawabansMbti->count();

        // Status minat
        if ($jumlahDijawabMinat === 0) {
            $statusMinat = 'Belum Mulai';
        } elseif ($jumlahDijawabMinat < $totalSoalMinat) {
            $statusMinat = 'Proses ('.round(($jumlahDijawabMinat / $totalSoalMinat) * 100).'%)';
        } else {
            $statusMinat = 'Selesai';
        }

        // Status MBTI + result
        $mbtiResult = '-';
        if ($jumlahDijawabMbti === 0) {
            $statusMbti = 'Belum Mulai';
        } elseif ($jumlahDijawabMbti < $totalSoalMbti) {
            $statusMbti = 'Proses ('.round(($jumlahDijawabMbti / $totalSoalMbti) * 100).'%)';
            $mbtiResult = 'Proses';
        } else {
            $statusMbti = 'Selesai';
            $mbtiSkor = ['E' => 0, 'I' => 0, 'S' => 0, 'N' => 0, 'T' => 0, 'F' => 0, 'J' => 0, 'P' => 0];
            foreach ($jawabansMbti as $jwb) {
                if ($jwb->soalMbti) {
                    $d = $jwb->soalMbti->dimensi;
                    $p = $jwb->pilihan;
                    if ($d === 'EI') {
                        $p === 'A' ? $mbtiSkor['E']++ : $mbtiSkor['I']++;
                    }
                    if ($d === 'SN') {
                        $p === 'A' ? $mbtiSkor['S']++ : $mbtiSkor['N']++;
                    }
                    if ($d === 'TF') {
                        $p === 'A' ? $mbtiSkor['T']++ : $mbtiSkor['F']++;
                    }
                    if ($d === 'JP') {
                        $p === 'A' ? $mbtiSkor['J']++ : $mbtiSkor['P']++;
                    }
                }
            }
            $mbtiResult = ($mbtiSkor['E'] >= $mbtiSkor['I'] ? 'E' : 'I')
                .($mbtiSkor['S'] >= $mbtiSkor['N'] ? 'S' : 'N')
                .($mbtiSkor['T'] >= $mbtiSkor['F'] ? 'T' : 'F')
                .($mbtiSkor['J'] >= $mbtiSkor['P'] ? 'J' : 'P');
        }

        // Hitung skor per kategori
        $skorKategori = [];
        foreach ($jawabansMinat as $jawaban) {
            if ($jawaban->soal && $jawaban->soal->kategori) {
                $namaKat = $jawaban->soal->kategori->nama_kategori;
                if (! isset($skorKategori[$namaKat])) {
                    $skorKategori[$namaKat] = ['total' => 0, 'jumlah' => 0];
                }
                $nilai = (int) $jawaban->jawaban;
                if ($jawaban->soal->is_unfav) {
                    $nilai = 6 - $nilai;
                }
                $skorKategori[$namaKat]['total'] += $nilai;
                $skorKategori[$namaKat]['jumlah']++;
            }
        }

        $skorPersen = [];
        foreach ($skorKategori as $nama => $data) {
            $maxSkor = $data['jumlah'] * 5;
            $skorPersen[$nama] = $maxSkor > 0 ? round(($data['total'] / $maxSkor) * 100) : 0;
        }
        arsort($skorPersen);

        $this->detailData = [
            'nama' => $mhs->nama ?? '-',
            'nim' => $mhs->nim_nidn ?? '-',
            'kelas' => $mhs->kelas?->nama_kelas ?? '-',
            'jenis_kelamin' => match ($mhs->jenis_kelamin) {
                'laki-laki' => 'Laki-laki',
                'perempuan' => 'Perempuan',
                default => '-',
            },
            'status_minat' => $statusMinat,
            'status_mbti' => $statusMbti,
            'mbti_result' => $mbtiResult,
            'skor_kategori' => $skorPersen,
            'file_akademik' => $mhs->file_bakat_akademik,
            'file_non_akademik' => $mhs->file_bakat_non_akademik,
        ];

        $this->selectedMhsId = $mhsId;
    }

    public function closeDetail(): void
    {
        $this->selectedMhsId = null;
        $this->detailData = [];
    }

    public function exportCsv(): StreamedResponse
    {
        $rows = $this->hasilAsesmen;
        $kelas = $this->namaKelas;

        return response()->streamDownload(function () use ($rows, $kelas) {
            $headers = ['No', 'Nama', 'NIM', 'Kelas', 'Minat Utama', 'Skor (%)', 'Status Minat Bakat', 'Status MBTI', 'Hasil MBTI', 'Sertifikat Akademik', 'Sertifikat Non-Akademik'];

            echo "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\">\n";
            echo "<head><meta charset=\"UTF-8\"><style>\n";
            echo "body { font-family: Arial, sans-serif; font-size: 11pt; }\n";
            echo "table { border-collapse: collapse; width: 100%; }\n";
            echo "th { background-color: #1A2340; color: #ffffff; font-weight: bold; padding: 8px 10px; border: 1px solid #cccccc; text-align: center; }\n";
            echo "td { padding: 6px 10px; border: 1px solid #dddddd; vertical-align: middle; }\n";
            echo "tr:nth-child(even) td { background-color: #f5f5f5; }\n";
            echo ".badge-selesai { color: #2E7D55; font-weight: bold; }\n";
            echo ".badge-proses { color: #C8922A; font-weight: bold; }\n";
            echo ".badge-belum { color: #999999; }\n";
            echo ".badge-ada { color: #2E7D55; font-weight: bold; }\n";
            echo "caption { font-size: 14pt; font-weight: bold; padding: 10px 0; text-align: left; color: #1A2340; }\n";
            echo "</style></head><body>\n";
            echo '<table><caption>Rekap Asesmen Mahasiswa — '.htmlspecialchars($kelas).'</caption>';
            echo '<thead><tr>';
            foreach ($headers as $h) {
                echo '<th>'.htmlspecialchars($h).'</th>';
            }
            echo '</tr></thead><tbody>';

            foreach ($rows as $i => $mhs) {
                $statusMinat = $mhs['status_minat'];
                $statusMbti = $mhs['status_mbti'];
                $classMinat = match ($statusMinat) {
                    'Selesai' => 'badge-selesai', 'Dalam Proses' => 'badge-proses', default => 'badge-belum'
                };
                $classMbti = match ($statusMbti) {
                    'Selesai' => 'badge-selesai', 'Dalam Proses' => 'badge-proses', default => 'badge-belum'
                };

                echo '<tr>';
                echo '<td style="text-align:center;">'.($i + 1).'</td>';
                echo '<td>'.htmlspecialchars($mhs['nama']).'</td>';
                echo '<td style="text-align:center;">'.htmlspecialchars($mhs['nim']).'</td>';
                echo '<td style="text-align:center;">'.htmlspecialchars($mhs['kelas']).'</td>';
                echo '<td>'.htmlspecialchars($mhs['kategori_utama'] ?: '-').'</td>';
                echo '<td style="text-align:center;">'.($mhs['skor_utama'] ? $mhs['skor_utama'].'%' : '-').'</td>';
                echo '<td style="text-align:center;" class="'.$classMinat.'">'.htmlspecialchars($statusMinat).'</td>';
                echo '<td style="text-align:center;" class="'.$classMbti.'">'.htmlspecialchars($statusMbti).'</td>';
                echo '<td style="text-align:center; font-weight:bold;">'.htmlspecialchars($mhs['mbti_result'] ?: '-').'</td>';
                echo '<td style="text-align:center;" class="'.($mhs['file_akademik'] ? 'badge-ada' : 'badge-belum').'">'.($mhs['file_akademik'] ? 'Ada' : 'Belum').'</td>';
                echo '<td style="text-align:center;" class="'.($mhs['file_non_akademik'] ? 'badge-ada' : 'badge-belum').'">'.($mhs['file_non_akademik'] ? 'Ada' : 'Belum').'</td>';
                echo '</tr>';
            }

            echo '</tbody></table></body></html>';
        }, 'rekap-mahasiswa-'.$this->namaKelas.'.xls', [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
        ]);
    }

    public function render(): View
    {
        return view('livewire.dosen.dashboard.index')->layout('layouts.blank');
    }
}
