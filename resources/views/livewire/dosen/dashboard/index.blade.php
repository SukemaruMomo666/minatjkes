<div>
<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    {{-- SIDEBAR --}}
    <aside class="w-[220px] flex-col hidden md:flex shrink-0 relative" style="background-color:#1A2340;">
        <div class="absolute inset-0 siminat-batik" style="opacity:0.05;"></div>
        <div class="h-16 flex items-center px-5 relative" style="border-bottom:1px solid rgba(232,213,163,0.15);">
            <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3 shrink-0" style="background-color:#C8922A;">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1A2340" stroke-width="3.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            </div>
            <div>
                <span class="font-bold tracking-widest text-xs block" style="color:#FDF6E8;letter-spacing:0.12em;">SIMINAT</span>
                <span class="text-[10px]" style="color:rgba(253,246,232,0.4);">Portal Dosen</span>
            </div>
        </div>
        <nav class="flex-1 px-3 py-5 space-y-1 relative">
            <a href="{{ route('dosen.dashboard') }}"
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold"
               style="background-color:rgba(200,146,42,0.15);color:#C8922A;border-left:3px solid #C8922A;">
                <i class="ti ti-layout-dashboard mr-3 text-base"></i> Dashboard
            </a>
            <a href="{{ route('dosen.minat.kelompok') }}"
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all hover:bg-white/10"
               style="color:rgba(253,246,232,0.65);">
                <i class="ti ti-chart-pie mr-3 text-base"></i> Pengelompokan Minat
            </a>
        </nav>
        <div class="p-4 relative" style="border-top:1px solid rgba(232,213,163,0.1);">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold shrink-0"
                     style="background-color:#C8922A;color:#1A2340;">
                    {{ Auth::user()->initials() }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold truncate" style="color:#FDF6E8;">{{ Auth::user()->nama }}</p>
                    <p class="text-[10px]" style="color:rgba(253,246,232,0.4);">Dosen</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="flex items-center gap-2 text-xs font-medium w-full px-3 py-2 rounded-lg hover:bg-white/10"
                        style="color:rgba(253,246,232,0.5);">
                    <i class="ti ti-logout text-sm"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <main class="flex-1 flex flex-col overflow-hidden">

        <header class="h-16 flex items-center justify-between px-8 shrink-0"
                style="background-color:#fff;border-bottom:1px solid rgba(26,35,64,0.08);">
            <div>
                <h1 class="text-base font-bold" style="color:#1A2340;">Dashboard Dosen</h1>
                <p class="text-xs" style="color:#6B7494;">
                    Selamat datang, {{ $dosenNama }}.
                    @if($namaKelas) Kelas: <strong>{{ $namaKelas }}</strong> @endif
                </p>
            </div>
            <button wire:click="exportCsv"
                    wire:loading.attr="disabled"
                    class="sim-btn-ghost text-sm">
                <span wire:loading.remove wire:target="exportCsv">
                    <i class="ti ti-file-spreadsheet"></i> Ekspor CSV
                </span>
                <span wire:loading wire:target="exportCsv">
                    <i class="ti ti-loader animate-spin"></i> Menyiapkan...
                </span>
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-6xl mx-auto space-y-6">

                {{-- Stat Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                    <div class="sim-card p-5">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background-color:rgba(45,63,107,0.1);">
                            <i class="ti ti-users text-xl" style="color:#2D3F6B;"></i>
                        </div>
                        <h3 class="text-3xl font-bold" style="color:#1A2340;">{{ $totalMahasiswa }}</h3>
                        <p class="text-xs font-semibold mt-1" style="color:#6B7494;">Total Mahasiswa</p>
                    </div>
                    <div class="sim-card p-5">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background-color:rgba(46,125,85,0.1);">
                            <i class="ti ti-circle-check text-xl" style="color:#2E7D55;"></i>
                        </div>
                        <h3 class="text-3xl font-bold" style="color:#1A2340;">{{ $asesmenSelesai }}</h3>
                        <p class="text-xs font-semibold mt-1" style="color:#6B7494;">Minat Selesai</p>
                    </div>
                    <div class="sim-card p-5">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background-color:rgba(200,146,42,0.1);">
                            <i class="ti ti-clock text-xl" style="color:#C8922A;"></i>
                        </div>
                        <h3 class="text-3xl font-bold" style="color:#1A2340;">{{ $sedangProses }}</h3>
                        <p class="text-xs font-semibold mt-1" style="color:#6B7494;">Sedang Proses</p>
                    </div>
                    <div class="sim-card p-5">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background-color:rgba(180,69,47,0.1);">
                            <i class="ti ti-alert-circle text-xl" style="color:#B4452F;"></i>
                        </div>
                        <h3 class="text-3xl font-bold" style="color:#1A2340;">{{ $belumMulai }}</h3>
                        <p class="text-xs font-semibold mt-1" style="color:#6B7494;">Belum Mulai</p>
                    </div>
                </div>

                {{-- Charts --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                    <div class="sim-card p-6 lg:col-span-2">
                        <div class="flex items-center justify-between mb-5">
                            <h3 class="text-base font-bold" style="color:#1A2340;">Distribusi Minat per Kelas</h3>
                            <div class="flex items-center gap-1.5 text-xs font-semibold" style="color:#6B7494;">
                                <span class="w-3 h-3 rounded-full inline-block" style="background-color:#C8922A;"></span> Minat Utama
                            </div>
                        </div>
                        <div class="h-52" wire:ignore>
                            <canvas id="barChart"></canvas>
                            @if(empty($distribusiMinat['labels']))
                                <p class="text-xs text-center mt-16" style="color:#6B7494;">Data tersedia setelah mahasiswa menyelesaikan tes.</p>
                            @endif
                        </div>
                    </div>

                    <div class="sim-card p-6">
                        <h3 class="text-base font-bold mb-5" style="color:#1A2340;">Peta Kompetensi Kelas</h3>
                        <div class="h-64 flex justify-center items-center" wire:ignore>
                            <canvas id="radarChart"></canvas>
                            @if(empty($petaKompetensi['labels']))
                                <p class="text-xs text-center" style="color:#6B7494;">Belum ada data.</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Rata kecocokan banner --}}
                @if($rataKecocokan > 0)
                    <div class="rounded-2xl px-6 py-4 flex items-center gap-4 relative overflow-hidden" style="background-color:#1A2340;">
                        <div class="absolute inset-0 siminat-batik" style="opacity:0.06;"></div>
                        <i class="ti ti-star-filled text-3xl relative" style="color:#C8922A;"></i>
                        <div class="relative">
                            <p class="text-xs font-bold uppercase tracking-widest mb-0.5" style="color:rgba(253,246,232,0.5);">Rata-rata Kecocokan Minat</p>
                            <p class="text-2xl font-display font-bold" style="color:#C8922A;">{{ $rataKecocokan }}%</p>
                        </div>
                    </div>
                @endif

                {{-- Tabel Mahasiswa --}}
                <div class="sim-card overflow-hidden">
                    <div class="px-6 py-4 flex items-center justify-between" style="border-bottom:1px solid rgba(26,35,64,0.07);">
                        <h3 class="text-base font-bold" style="color:#1A2340;">Daftar Mahasiswa</h3>
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full"
                              style="background-color:rgba(45,63,107,0.08);color:#2D3F6B;">
                            {{ count($hasilAsesmen) }} mahasiswa
                        </span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr style="background-color:rgba(253,246,232,0.6);border-bottom:1px solid rgba(26,35,64,0.07);">
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Mahasiswa</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Minat Bakat</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">MBTI</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Sertifikat</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($hasilAsesmen as $mhs)
                                    <tr style="border-bottom:1px solid rgba(26,35,64,0.04);"
                                        onmouseover="this.style.backgroundColor='rgba(232,213,163,0.1)'" onmouseout="this.style.backgroundColor=''">
                                        <td class="px-6 py-3">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold shrink-0"
                                                     style="background-color:rgba(200,146,42,0.1);color:#C8922A;">
                                                    {{ mb_substr($mhs['nama'], 0, 2) }}
                                                </div>
                                                <div>
                                                    <p class="text-sm font-semibold" style="color:#1A2340;">{{ $mhs['nama'] }}</p>
                                                    <p class="text-xs" style="color:#6B7494;">{{ $mhs['nim'] }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3">
                                            @if($mhs['status_minat'] === 'Selesai')
                                                <div>
                                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold"
                                                          style="background-color:rgba(46,125,85,0.1);color:#2E7D55;">
                                                        <i class="ti ti-circle-check text-xs"></i> Selesai
                                                    </span>
                                                    @if($mhs['kategori_utama'] !== '-')
                                                        <p class="text-[10px] mt-1" style="color:#6B7494;">{{ $mhs['kategori_utama'] }} ({{ $mhs['skor_utama'] }}%)</p>
                                                    @endif
                                                </div>
                                            @elseif(str_starts_with($mhs['status_minat'], 'Proses'))
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold"
                                                      style="background-color:rgba(200,146,42,0.1);color:#C8922A;">
                                                    <i class="ti ti-clock text-xs"></i> {{ $mhs['status_minat'] }}
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold"
                                                      style="background-color:rgba(180,69,47,0.07);color:#B4452F;">
                                                    <i class="ti ti-minus text-xs"></i> Belum
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-3">
                                            @if($mhs['status_mbti'] === 'Selesai')
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold"
                                                      style="background-color:rgba(45,63,107,0.1);color:#2D3F6B;">
                                                    <i class="ti ti-brain text-xs"></i> {{ $mhs['mbti_result'] }}
                                                </span>
                                            @elseif(str_starts_with($mhs['status_mbti'], 'Proses'))
                                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold"
                                                      style="background-color:rgba(200,146,42,0.1);color:#C8922A;">
                                                    <i class="ti ti-clock text-xs"></i> {{ $mhs['status_mbti'] }}
                                                </span>
                                            @else
                                                <span class="text-[10px] font-semibold" style="color:#6B7494;">—</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-3">
                                            <div class="flex items-center gap-2">
                                                <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[9px] font-bold"
                                                      style="background-color:{{ $mhs['file_akademik'] ? 'rgba(46,125,85,0.1)' : 'rgba(26,35,64,0.06)' }};color:{{ $mhs['file_akademik'] ? '#2E7D55' : '#6B7494' }};">
                                                    <i class="ti ti-school"></i> Akd
                                                </span>
                                                <span class="inline-flex items-center gap-1 px-1.5 py-0.5 rounded text-[9px] font-bold"
                                                      style="background-color:{{ $mhs['file_non_akademik'] ? 'rgba(200,146,42,0.1)' : 'rgba(26,35,64,0.06)' }};color:{{ $mhs['file_non_akademik'] ? '#C8922A' : '#6B7494' }};">
                                                    <i class="ti ti-trophy"></i> Non
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-3">
                                            <button wire:click="openDetail({{ $mhs['user_id'] }})"
                                                    class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all hover:scale-105"
                                                    style="background-color:rgba(45,63,107,0.1);color:#2D3F6B;">
                                                <i class="ti ti-eye mr-1"></i> Detail
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center text-sm" style="color:#6B7494;">
                                            Belum ada mahasiswa di kelas ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

{{-- DETAIL MODAL --}}
@if($selectedMhsId !== null && ! empty($detailData))
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4"
         style="background-color:rgba(26,35,64,0.6);backdrop-filter:blur(4px);">
        <div class="w-full max-w-xl rounded-2xl overflow-hidden shadow-2xl"
             style="background-color:#fff;max-height:90vh;overflow-y:auto;">

            {{-- Modal Header --}}
            <div class="px-6 py-5 flex items-start justify-between" style="background-color:#1A2340;">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-lg font-bold shrink-0"
                         style="background-color:#C8922A;color:#1A2340;">
                        {{ mb_substr($detailData['nama'], 0, 2) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold" style="color:#FDF6E8;">{{ $detailData['nama'] }}</p>
                        <p class="text-xs font-mono mt-0.5" style="color:rgba(253,246,232,0.6);">{{ $detailData['nim'] }}</p>
                        <p class="text-xs mt-0.5" style="color:rgba(253,246,232,0.5);">{{ $detailData['kelas'] }} • {{ $detailData['jenis_kelamin'] }}</p>
                    </div>
                </div>
                <button wire:click="closeDetail"
                        class="w-8 h-8 rounded-lg flex items-center justify-center transition-all hover:bg-white/10"
                        style="color:rgba(253,246,232,0.6);">
                    <i class="ti ti-x"></i>
                </button>
            </div>

            <div class="p-6 space-y-5">

                {{-- Status Bar --}}
                <div class="grid grid-cols-2 gap-3">
                    <div class="p-3 rounded-xl" style="background-color:rgba(26,35,64,0.04);border:1px solid rgba(26,35,64,0.08);">
                        <p class="text-[10px] font-bold uppercase tracking-wider mb-1" style="color:#6B7494;">Minat &amp; Bakat</p>
                        <p class="text-sm font-bold" style="color:{{ $detailData['status_minat'] === 'Selesai' ? '#2E7D55' : '#C8922A' }};">
                            {{ $detailData['status_minat'] }}
                        </p>
                    </div>
                    <div class="p-3 rounded-xl" style="background-color:rgba(26,35,64,0.04);border:1px solid rgba(26,35,64,0.08);">
                        <p class="text-[10px] font-bold uppercase tracking-wider mb-1" style="color:#6B7494;">MBTI</p>
                        <p class="text-sm font-bold" style="color:{{ $detailData['status_mbti'] === 'Selesai' ? '#2D3F6B' : '#C8922A' }};">
                            @if($detailData['status_mbti'] === 'Selesai')
                                {{ $detailData['mbti_result'] }}
                            @else
                                {{ $detailData['status_mbti'] }}
                            @endif
                        </p>
                    </div>
                </div>

                {{-- Skor Minat per Kategori --}}
                @if(! empty($detailData['skor_kategori']))
                    <div>
                        <p class="text-xs font-bold mb-3" style="color:#1A2340;"><i class="ti ti-map-pin mr-1.5 text-[#C8922A]"></i>Skor Minat per Kategori</p>
                        <div class="space-y-2.5">
                            @foreach($detailData['skor_kategori'] as $kategori => $skor)
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <span class="text-[11px] font-semibold" style="color:#1A2340;">{{ $kategori }}</span>
                                        <span class="text-[11px] font-bold" style="color:#C8922A;">{{ $skor }}%</span>
                                    </div>
                                    <div class="h-1.5 rounded-full overflow-hidden" style="background-color:rgba(26,35,64,0.07);">
                                        <div class="h-full rounded-full" style="width:{{ $skor }}%;background-color:{{ $skor >= 70 ? '#2E7D55' : ($skor >= 50 ? '#C8922A' : '#B4452F') }};"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="p-4 rounded-xl text-center text-xs" style="background-color:rgba(26,35,64,0.04);color:#6B7494;">
                        Belum ada data minat bakat.
                    </div>
                @endif

                {{-- Sertifikat --}}
                <div>
                    <p class="text-xs font-bold mb-3" style="color:#1A2340;"><i class="ti ti-certificate mr-1.5 text-[#C8922A]"></i>Portofolio Sertifikat</p>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="p-3 rounded-xl" style="background-color:rgba(45,63,107,0.05);border:1px solid rgba(45,63,107,0.12);">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="ti ti-school text-sm" style="color:#2D3F6B;"></i>
                                <span class="text-xs font-semibold" style="color:#1A2340;">Akademik</span>
                            </div>
                            @if($detailData['file_akademik'])
                                <div class="flex gap-2">
                                    <a href="{{ Storage::url($detailData['file_akademik']) }}" target="_blank" rel="noopener noreferrer"
                                       class="flex items-center gap-1 text-[10px] font-semibold px-2.5 py-1.5 rounded-lg transition-all hover:opacity-80"
                                       style="background-color:#2D3F6B;color:#FDF6E8;">
                                        <i class="ti ti-eye"></i> Lihat
                                    </a>
                                    <a href="{{ Storage::url($detailData['file_akademik']) }}" download
                                       class="flex items-center gap-1 text-[10px] font-semibold px-2.5 py-1.5 rounded-lg transition-all hover:opacity-80"
                                       style="background-color:rgba(45,63,107,0.1);color:#2D3F6B;">
                                        <i class="ti ti-download"></i> Unduh
                                    </a>
                                </div>
                            @else
                                <p class="text-[10px]" style="color:#B4452F;">Tidak ada data</p>
                            @endif
                        </div>
                        <div class="p-3 rounded-xl" style="background-color:rgba(200,146,42,0.05);border:1px solid rgba(200,146,42,0.15);">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="ti ti-trophy text-sm" style="color:#C8922A;"></i>
                                <span class="text-xs font-semibold" style="color:#1A2340;">Non-Akademik</span>
                            </div>
                            @if($detailData['file_non_akademik'])
                                <div class="flex gap-2">
                                    <a href="{{ Storage::url($detailData['file_non_akademik']) }}" target="_blank" rel="noopener noreferrer"
                                       class="flex items-center gap-1 text-[10px] font-semibold px-2.5 py-1.5 rounded-lg transition-all hover:opacity-80"
                                       style="background-color:#C8922A;color:#1A2340;">
                                        <i class="ti ti-eye"></i> Lihat
                                    </a>
                                    <a href="{{ Storage::url($detailData['file_non_akademik']) }}" download
                                       class="flex items-center gap-1 text-[10px] font-semibold px-2.5 py-1.5 rounded-lg transition-all hover:opacity-80"
                                       style="background-color:rgba(200,146,42,0.1);color:#C8922A;">
                                        <i class="ti ti-download"></i> Unduh
                                    </a>
                                </div>
                            @else
                                <p class="text-[10px]" style="color:#B4452F;">Tidak ada data</p>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <div class="px-6 pb-5 flex flex-col gap-2">
                <a href="{{ route('dosen.mahasiswa.hasil', ['userId' => $selectedMhsId]) }}"
                   class="w-full py-2.5 rounded-xl text-sm font-bold text-center transition-all flex items-center justify-center gap-2"
                   style="background-color:#1A2340;color:#FDF6E8;">
                    <i class="ti ti-report-analytics text-sm"></i> Lihat Hasil Lengkap
                </a>
                <button wire:click="closeDetail"
                        class="w-full py-2.5 rounded-xl text-sm font-semibold transition-all"
                        style="background-color:rgba(26,35,64,0.07);color:#6B7494;">
                    Tutup
                </button>
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener('livewire:initialized', () => {
        const distribusi = @json($distribusiMinat);
        const kompetensi = @json($petaKompetensi);

        const barEl = document.getElementById('barChart');
        if (barEl && distribusi.labels && distribusi.labels.length > 0) {
            new Chart(barEl, {
                type: 'bar',
                data: {
                    labels: distribusi.labels,
                    datasets: [{
                        data: distribusi.data,
                        backgroundColor: '#C8922A',
                        borderRadius: 8,
                        barPercentage: 0.5,
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(26,35,64,0.05)' }, ticks: { color: '#6B7494', font: { size: 10 } } },
                        x: { grid: { display: false }, ticks: { color: '#6B7494', font: { size: 10 } } }
                    }
                }
            });
        }

        const radarEl = document.getElementById('radarChart');
        if (radarEl && kompetensi.labels && kompetensi.labels.length > 0) {
            new Chart(radarEl, {
                type: 'radar',
                data: {
                    labels: kompetensi.labels,
                    datasets: [{
                        data: kompetensi.data,
                        backgroundColor: 'rgba(200,146,42,0.18)',
                        borderColor: '#C8922A',
                        pointBackgroundColor: '#1A2340',
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    scales: {
                        r: {
                            angleLines: { color: 'rgba(26,35,64,0.07)' },
                            grid: { color: 'rgba(26,35,64,0.07)' },
                            pointLabels: {
                                display: true,
                                color: '#1A2340',
                                font: { size: 9, weight: '600' },
                            },
                            ticks: { display: false },
                            suggestedMin: 0, suggestedMax: 100,
                        }
                    },
                    plugins: { legend: { display: false } }
                }
            });
        }
    });
</script>

</div>
