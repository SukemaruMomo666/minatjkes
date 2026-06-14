<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    {{-- SIDEBAR --}}
    <aside class="w-[220px] flex-col hidden md:flex shrink-0 relative" style="background-color:#1A2340;">
        <div class="absolute inset-0 siminat-batik" style="opacity:0.05;"></div>
        <div class="h-16 flex items-center px-5 relative" style="border-bottom:1px solid rgba(232,213,163,0.15);">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3 shrink-0" style="background-color:#C8922A;">
                <i class="ti ti-plus font-bold" style="color:#1A2340;font-size:15px;"></i>
            </div>
            <span class="font-bold tracking-widest text-sm" style="color:#FDF6E8;letter-spacing:0.15em;">SIMINAT</span>
        </div>
        <nav class="flex-1 px-3 py-5 space-y-1 relative">
            <a href="{{ route('mahasiswa.dashboard') }}"
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all hover:bg-white/10"
               style="color:rgba(253,246,232,0.65);">
                <i class="ti ti-home mr-3 text-base"></i> Beranda
            </a>
            <a href="{{ route('mahasiswa.asesmen') }}"
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold"
               style="background-color:rgba(200,146,42,0.15);color:#C8922A;border-left:3px solid #C8922A;">
                <i class="ti ti-clipboard-list mr-3 text-base"></i> Asesmen
            </a>
            <a href="{{ route('mahasiswa.results') }}"
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all hover:bg-white/10"
               style="color:rgba(253,246,232,0.65);">
                <i class="ti ti-report-analytics mr-3 text-base"></i> Hasil Saya
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
                    <p class="text-[10px]" style="color:rgba(253,246,232,0.4);">Mahasiswa</p>
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
    <main class="flex-1 flex flex-col overflow-hidden relative pb-16 md:pb-0">

        <header class="h-16 flex items-center justify-between px-5 md:px-8 shrink-0"
                style="background-color:#1A2340;border-bottom:1px solid rgba(232,213,163,0.15);">
            <div class="flex items-center gap-2 text-xs" style="color:rgba(253,246,232,0.45);">
                <i class="ti ti-clipboard-list text-sm"></i>
                <span class="hidden sm:inline">/</span>
                <span class="hidden sm:inline" style="color:rgba(253,246,232,0.7);">Asesmen</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold" style="color:#FDF6E8;">{{ Auth::user()->nama }}</p>
                    <p class="text-xs" style="color:rgba(253,246,232,0.5);">{{ Auth::user()->kelas?->nama_kelas ?? '-' }}</p>
                </div>
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold shrink-0"
                     style="background-color:#C8922A;color:#1A2340;">
                    {{ Auth::user()->initials() }}
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto px-5 py-6 md:px-8 md:py-8">
            <div class="max-w-3xl mx-auto space-y-6">

                <div>
                    <p class="text-xs font-bold uppercase tracking-widest mb-1" style="color:#C8922A;">SIMINAT • ASESMEN</p>
                    <h1 class="text-2xl font-display font-bold" style="color:#1A2340;">Pusat Asesmen</h1>
                    <p class="text-sm mt-1" style="color:#6B7494;">Selesaikan kedua tes berikut untuk mendapatkan pemetaan potensi lengkap kamu.</p>
                </div>

                {{-- Tab Switcher --}}
                <div class="flex gap-2 p-1 rounded-xl" style="background-color:rgba(26,35,64,0.06);">
                    <button wire:click="setTab('minat')"
                            class="flex-1 py-2 px-4 rounded-lg text-sm font-semibold transition-all"
                            style="{{ $activeTab === 'minat' ? 'background-color:#1A2340;color:#FDF6E8;' : 'color:#6B7494;' }}">
                        <i class="ti ti-map-pin mr-1.5"></i> Minat &amp; Bakat
                    </button>
                    <button wire:click="setTab('mbti')"
                            class="flex-1 py-2 px-4 rounded-lg text-sm font-semibold transition-all"
                            style="{{ $activeTab === 'mbti' ? 'background-color:#1A2340;color:#FDF6E8;' : 'color:#6B7494;' }}">
                        <i class="ti ti-brain mr-1.5"></i> Tes MBTI
                    </button>
                </div>

                {{-- Tab: Minat & Bakat --}}
                @if($activeTab === 'minat')
                    <div class="sim-card p-6 md:p-8">
                        <div class="flex items-start justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0"
                                     style="background-color:rgba(45,63,107,0.1);">
                                    <i class="ti ti-map-pin text-2xl" style="color:#2D3F6B;"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold" style="color:#1A2340;">Tes Minat &amp; Bakat</h2>
                                    <p class="text-xs mt-0.5" style="color:#6B7494;">{{ $totalSoalMinat }} soal penilaian skala 1–4</p>
                                </div>
                            </div>
                            @if($statusMinat === 'selesai')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold"
                                      style="background-color:rgba(46,125,85,0.1);color:#2E7D55;border:1px solid rgba(46,125,85,0.25);">
                                    <i class="ti ti-circle-check"></i> Selesai
                                </span>
                            @elseif($statusMinat === 'proses')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold"
                                      style="background-color:rgba(200,146,42,0.1);color:#C8922A;border:1px solid rgba(200,146,42,0.25);">
                                    <i class="ti ti-clock"></i> Sedang Proses
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold"
                                      style="background-color:rgba(26,35,64,0.07);color:#6B7494;border:1px solid rgba(26,35,64,0.1);">
                                    <i class="ti ti-alert-circle"></i> Belum Dimulai
                                </span>
                            @endif
                        </div>

                        <p class="text-sm mb-5" style="color:#6B7494;">
                            Tes ini mengukur minat dan bakat kamu di berbagai bidang keperawatan melalui pernyataan-pernyataan yang perlu kamu nilai dari Sangat Tidak Setuju hingga Sangat Setuju.
                        </p>

                        @if($statusMinat !== 'belum')
                            <div class="mb-5">
                                <div class="flex items-center justify-between mb-1.5">
                                    <span class="text-xs font-semibold" style="color:#6B7494;">Progress</span>
                                    <span class="text-xs font-bold" style="color:#2D3F6B;">{{ $totalDijawabMinat }}/{{ $totalSoalMinat }} soal</span>
                                </div>
                                <div class="h-2 rounded-full overflow-hidden" style="background-color:rgba(26,35,64,0.08);">
                                    <div class="h-full rounded-full transition-all"
                                         style="width:{{ $progressMinat }}%;background-color:{{ $statusMinat === 'selesai' ? '#2E7D55' : '#C8922A' }};"></div>
                                </div>
                                <p class="text-[10px] mt-1 font-semibold" style="color:{{ $statusMinat === 'selesai' ? '#2E7D55' : '#C8922A' }};">{{ $progressMinat }}% selesai</p>
                            </div>
                        @endif

                        <div class="grid grid-cols-3 gap-3 mb-6">
                            <div class="p-3 rounded-xl text-center" style="background-color:rgba(45,63,107,0.06);">
                                <p class="text-lg font-bold" style="color:#1A2340;">{{ $totalSoalMinat }}</p>
                                <p class="text-[10px] font-semibold" style="color:#6B7494;">Total Soal</p>
                            </div>
                            <div class="p-3 rounded-xl text-center" style="background-color:rgba(45,63,107,0.06);">
                                <p class="text-lg font-bold" style="color:#1A2340;">{{ $totalDijawabMinat }}</p>
                                <p class="text-[10px] font-semibold" style="color:#6B7494;">Terjawab</p>
                            </div>
                            <div class="p-3 rounded-xl text-center" style="background-color:rgba(45,63,107,0.06);">
                                <p class="text-lg font-bold" style="color:#1A2340;">{{ $totalSoalMinat - $totalDijawabMinat }}</p>
                                <p class="text-[10px] font-semibold" style="color:#6B7494;">Tersisa</p>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            @if($statusMinat === 'selesai')
                                <a href="{{ route('mahasiswa.results') }}"
                                   class="sim-btn-gold text-sm text-center justify-center">
                                    <i class="ti ti-report-analytics mr-1.5"></i> Lihat Hasil Tes
                                </a>
                                <a href="{{ route('mahasiswa.tes') }}?isReviewMode=true"
                                   class="sim-btn-ghost text-sm text-center justify-center">
                                    <i class="ti ti-file-description mr-1.5"></i> Detail Jawaban
                                </a>
                            @elseif($statusMinat === 'proses')
                                <a href="{{ route('mahasiswa.tes') }}"
                                   class="sim-btn-gold text-sm text-center justify-center">
                                    <i class="ti ti-player-play mr-1.5"></i> Lanjutkan Tes
                                </a>
                            @else
                                <a href="{{ route('mahasiswa.tes') }}"
                                   class="sim-btn-gold text-sm text-center justify-center">
                                    <i class="ti ti-player-play mr-1.5"></i> Mulai Tes Minat &amp; Bakat
                                </a>
                            @endif
                        </div>
                    </div>

                    {{-- Info box --}}
                    <div class="p-4 rounded-xl" style="background-color:rgba(45,63,107,0.06);border:1px solid rgba(45,63,107,0.1);">
                        <p class="text-xs font-bold mb-2" style="color:#2D3F6B;"><i class="ti ti-info-circle mr-1.5"></i>Catatan</p>
                        <p class="text-xs" style="color:#6B7494;">Selesaikan tes Minat &amp; Bakat terlebih dahulu sebelum mengerjakan Tes MBTI untuk mendapatkan hasil yang lebih akurat.</p>
                    </div>
                @endif

                {{-- Tab: MBTI --}}
                @if($activeTab === 'mbti')
                    <div class="sim-card p-6 md:p-8">
                        <div class="flex items-start justify-between mb-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center shrink-0"
                                     style="background-color:rgba(200,146,42,0.1);">
                                    <i class="ti ti-brain text-2xl" style="color:#C8922A;"></i>
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold" style="color:#1A2340;">Tes Kepribadian MBTI</h2>
                                    <p class="text-xs mt-0.5" style="color:#6B7494;">{{ $totalSoalMbti }} soal pilihan A atau B</p>
                                </div>
                            </div>
                            @if($statusMbti === 'selesai')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold"
                                      style="background-color:rgba(46,125,85,0.1);color:#2E7D55;border:1px solid rgba(46,125,85,0.25);">
                                    <i class="ti ti-circle-check"></i> Selesai
                                </span>
                            @elseif($statusMbti === 'proses')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold"
                                      style="background-color:rgba(200,146,42,0.1);color:#C8922A;border:1px solid rgba(200,146,42,0.25);">
                                    <i class="ti ti-clock"></i> Sedang Proses
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold"
                                      style="background-color:rgba(26,35,64,0.07);color:#6B7494;border:1px solid rgba(26,35,64,0.1);">
                                    <i class="ti ti-alert-circle"></i> Belum Dimulai
                                </span>
                            @endif
                        </div>

                        <p class="text-sm mb-5" style="color:#6B7494;">
                            Myers-Briggs Type Indicator (MBTI) mengidentifikasi 16 tipe kepribadian berdasarkan 4 dimensi: Extraversion/Introversion, Sensing/Intuition, Thinking/Feeling, dan Judging/Perceiving.
                        </p>

                        @if($statusMbti !== 'belum')
                            <div class="mb-5">
                                <div class="flex items-center justify-between mb-1.5">
                                    <span class="text-xs font-semibold" style="color:#6B7494;">Progress</span>
                                    <span class="text-xs font-bold" style="color:#C8922A;">{{ $totalDijawabMbti }}/{{ $totalSoalMbti }} soal</span>
                                </div>
                                <div class="h-2 rounded-full overflow-hidden" style="background-color:rgba(26,35,64,0.08);">
                                    <div class="h-full rounded-full transition-all"
                                         style="width:{{ $progressMbti }}%;background-color:{{ $statusMbti === 'selesai' ? '#2E7D55' : '#C8922A' }};"></div>
                                </div>
                                <p class="text-[10px] mt-1 font-semibold" style="color:{{ $statusMbti === 'selesai' ? '#2E7D55' : '#C8922A' }};">{{ $progressMbti }}% selesai</p>
                            </div>
                        @endif

                        <div class="grid grid-cols-4 gap-2 mb-6">
                            @foreach([['E/I', 'Energi'], ['S/N', 'Informasi'], ['T/F', 'Keputusan'], ['J/P', 'Gaya Hidup']] as [$dim, $label])
                                <div class="p-3 rounded-xl text-center" style="background-color:rgba(200,146,42,0.06);">
                                    <p class="text-base font-bold" style="color:#C8922A;">{{ $dim }}</p>
                                    <p class="text-[9px] font-semibold leading-tight" style="color:#6B7494;">{{ $label }}</p>
                                </div>
                            @endforeach
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3">
                            @if($statusMbti === 'selesai')
                                <a href="{{ route('mahasiswa.results') }}"
                                   class="sim-btn-gold text-sm text-center justify-center">
                                    <i class="ti ti-report-analytics mr-1.5"></i> Lihat Hasil MBTI
                                </a>
                                <a href="{{ route('mahasiswa.tes.mbti') }}?isReviewMode=true"
                                   class="sim-btn-ghost text-sm text-center justify-center">
                                    <i class="ti ti-file-description mr-1.5"></i> Detail Jawaban
                                </a>
                            @elseif($statusMbti === 'proses')
                                <a href="{{ route('mahasiswa.tes.mbti') }}"
                                   class="sim-btn-gold text-sm text-center justify-center">
                                    <i class="ti ti-player-play mr-1.5"></i> Lanjutkan Tes MBTI
                                </a>
                            @else
                                @if($statusMinat !== 'selesai')
                                    <div class="p-3 rounded-xl w-full text-center text-xs font-semibold"
                                         style="background-color:rgba(180,69,47,0.07);color:#B4452F;border:1px solid rgba(180,69,47,0.2);">
                                        <i class="ti ti-lock mr-1.5"></i> Selesaikan Tes Minat &amp; Bakat terlebih dahulu
                                    </div>
                                @else
                                    <a href="{{ route('mahasiswa.tes.mbti') }}"
                                       class="sim-btn-gold text-sm text-center justify-center">
                                        <i class="ti ti-player-play mr-1.5"></i> Mulai Tes MBTI
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </main>

    {{-- MOBILE BOTTOM NAV --}}
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-50 flex justify-around items-center h-16 pb-safe"
         style="background-color:rgba(255,255,255,0.9);backdrop-filter:blur(10px);border-top:1px solid rgba(26,35,64,0.08);box-shadow:0 -4px 20px rgba(0,0,0,0.03);">
        <a href="{{ route('mahasiswa.dashboard') }}" class="flex flex-col items-center justify-center w-full h-full transition-colors" style="color:#6B7494;">
            <i class="ti ti-home text-xl mb-1"></i>
            <span class="text-[10px] font-semibold">Beranda</span>
        </a>
        <a href="{{ route('mahasiswa.asesmen') }}" class="flex flex-col items-center justify-center w-full h-full" style="color:#C8922A;">
            <i class="ti ti-clipboard-list text-xl mb-1 drop-shadow-sm"></i>
            <span class="text-[10px] font-bold">Asesmen</span>
        </a>
        <a href="{{ route('mahasiswa.results') }}" class="flex flex-col items-center justify-center w-full h-full transition-colors" style="color:#6B7494;">
            <i class="ti ti-report-analytics text-xl mb-1"></i>
            <span class="text-[10px] font-semibold">Rapor Saya</span>
        </a>
    </nav>
</div>
