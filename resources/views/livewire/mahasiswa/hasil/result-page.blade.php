<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-[220px] flex-col hidden md:flex shrink-0 relative" style="background-color:#1A2340;">
        <div class="absolute inset-0 siminat-batik" style="opacity:0.05;"></div>
        <div class="h-16 flex items-center px-5 relative" style="border-bottom:1px solid rgba(232,213,163,0.15);">
            <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3 shrink-0" style="background-color:#C8922A;"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1A2340" stroke-width="3.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
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
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all hover:bg-white/10"
               style="color:rgba(253,246,232,0.65);">
                <i class="ti ti-clipboard-list mr-3 text-base"></i> Asesmen
            </a>
            <a href="{{ route('mahasiswa.results') }}"
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold"
               style="background-color:rgba(200,146,42,0.15);color:#C8922A;border-left:3px solid #C8922A;">
                <i class="ti ti-report-analytics mr-3 text-base"></i> Hasil Saya
            </a>
        </nav>
    </aside>

    {{-- ===== MAIN AREA ===== --}}
    <main class="flex-1 flex flex-col overflow-hidden relative pb-16 md:pb-0">

        {{-- Navbar --}}
        <header class="h-16 flex items-center justify-between px-5 md:px-8 shrink-0"
                style="background-color:#1A2340;border-bottom:1px solid rgba(232,213,163,0.15);">
            <div class="flex items-center gap-2 text-xs" style="color:rgba(253,246,232,0.45);">
                <i class="ti ti-report-analytics text-sm"></i>
                <span class="hidden sm:inline">/</span>
                <span class="hidden sm:inline" style="color:rgba(253,246,232,0.7);">Rapor Potensi Diri</span>
            </div>
            <div class="flex items-center gap-3">
                <button class="hidden md:flex text-xs items-center gap-2 px-3 py-1.5 rounded-lg font-bold transition-all"
                        style="background-color:rgba(200,146,42,0.15); color:#C8922A;" onclick="window.print()">
                    <i class="ti ti-printer"></i> Cetak Rapor
                </button>
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold" style="color:#FDF6E8;">{{ $namaLengkap }}</p>
                    <p class="text-[10px]" style="color:rgba(253,246,232,0.5);">{{ $nimNidn }}</p>
                </div>
                <div class="w-8 h-8 md:w-9 md:h-9 rounded-full flex items-center justify-center text-xs md:text-sm font-bold shrink-0"
                     style="background-color:#C8922A;color:#1A2340;">
                    {{ Auth::user()->initials() }}
                </div>
            </div>
        </header>

        {{-- Scrollable content --}}
        <div class="flex-1 overflow-y-auto">

            {{-- Hero --}}
            <section class="relative px-5 py-7 md:px-8 md:py-9 overflow-hidden" style="background-color:#1A2340;">
                <div class="absolute inset-0 siminat-batik" style="opacity:0.07;"></div>
                <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="text-center md:text-left">
                        <div class="inline-flex items-center justify-center w-12 h-12 rounded-full mb-3"
                             style="background-color:rgba(200,146,42,0.15);border:2px solid rgba(200,146,42,0.3);">
                            <i class="ti ti-rosette-discount-check text-2xl" style="color:#C8922A;"></i>
                        </div>
                        <h1 class="font-display text-2xl md:text-3xl font-bold mb-1" style="color:#FDF6E8;">
                            Rapor Potensi Diri
                        </h1>
                        <p class="text-xs md:text-sm" style="color:rgba(253,246,232,0.55);">Pemetaan Minat &amp; Bakat + Kepribadian MBTI â€” {{ now()->translatedFormat('d F Y') }}</p>
                    </div>
                    {{-- Identity Card --}}
                    <div class="flex-shrink-0 rounded-xl px-5 py-3.5 grid grid-cols-2 gap-x-6 gap-y-2"
                         style="background-color:rgba(255,255,255,0.06);border:1px solid rgba(232,213,163,0.15);">
                        <div>
                            <p class="text-[9px] font-bold uppercase tracking-widest mb-0.5" style="color:rgba(253,246,232,0.4);">Nama</p>
                            <p class="text-xs font-semibold" style="color:#FDF6E8;">{{ $namaLengkap ?: 'â€”' }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold uppercase tracking-widest mb-0.5" style="color:rgba(253,246,232,0.4);">NIM</p>
                            <p class="text-xs font-semibold font-mono" style="color:#FDF6E8;">{{ $nimNidn ?: 'â€”' }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold uppercase tracking-widest mb-0.5" style="color:rgba(253,246,232,0.4);">Kelas</p>
                            <p class="text-xs font-semibold" style="color:#FDF6E8;">{{ $namaKelas ?: 'â€”' }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-bold uppercase tracking-widest mb-0.5" style="color:rgba(253,246,232,0.4);">Jenis Kelamin</p>
                            <p class="text-xs font-semibold" style="color:#FDF6E8;">{{ $jenisKelamin ?: 'â€”' }}</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Content --}}
            <div class="px-5 py-6 md:px-8 md:py-8 max-w-5xl mx-auto space-y-6 md:space-y-7">

                {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
                {{-- SECTION 1: PEMETAAN MINAT & BAKAT                     --}}
                {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <div class="w-1 h-5 rounded-full" style="background-color:#C8922A;"></div>
                            <h2 class="font-display text-base md:text-lg font-bold" style="color:#1A2340;">Pemetaan Minat &amp; Bakat</h2>
                        </div>
                        <a href="{{ route('mahasiswa.tes') }}?isReviewMode=true"
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold transition-all hover:opacity-80"
                           style="background-color:rgba(26,35,64,0.06);color:#1A2340;border:1px solid rgba(26,35,64,0.12);">
                            <i class="ti ti-eye text-sm"></i> Tinjau Jawaban
                        </a>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 md:gap-5">

                        {{-- Radar Chart --}}
                        <div class="sim-card p-5 md:p-6 lg:col-span-3">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-sm font-bold" style="color:#1A2340;">Peta Kompetensi</h3>
                                <i class="ti ti-chart-radar text-lg" style="color:#C8922A;"></i>
                            </div>
                            <div class="flex justify-center w-full aspect-square md:aspect-auto md:h-[280px]">
                                <canvas id="radarChart"></canvas>
                            </div>
                        </div>

                        {{-- Semua Kategori (kelebihan + kelemahan) --}}
                        <div class="sim-card p-5 md:p-6 lg:col-span-2">
                            <h3 class="text-sm font-bold mb-4" style="color:#1A2340;">Rincian Per Bidang</h3>
                            <div class="space-y-3">
                                @php $total = count($persentaseKategori); $i = 0; @endphp
                                @foreach($persentaseKategori as $nama => $skor)
                                    @php
                                        $i++;
                                        if ($i <= 3) {
                                            $labelTag = 'Kelebihan';
                                            $barColor = '#2E7D55';
                                            $tagBg = 'rgba(46,125,85,0.1)';
                                            $tagColor = '#2E7D55';
                                        } elseif ($i > $total - 3) {
                                            $labelTag = 'Perlu Dikembangkan';
                                            $barColor = '#B4452F';
                                            $tagBg = 'rgba(180,69,47,0.1)';
                                            $tagColor = '#B4452F';
                                        } else {
                                            $labelTag = '';
                                            $barColor = '#C8922A';
                                            $tagBg = '';
                                            $tagColor = '';
                                        }
                                    @endphp
                                    <div>
                                        <div class="flex justify-between items-center mb-1">
                                            <div class="flex items-center gap-1.5 min-w-0">
                                                <span class="text-xs font-semibold truncate" style="color:#1A2340;" title="{{ $nama }}">{{ $nama }}</span>
                                                @if($labelTag)
                                                    <span class="text-[9px] font-bold px-1.5 py-0.5 rounded-full shrink-0"
                                                          style="background-color:{{ $tagBg }};color:{{ $tagColor }};">
                                                        {{ $labelTag }}
                                                    </span>
                                                @endif
                                            </div>
                                            <span class="text-xs font-bold ml-2 shrink-0" style="color:{{ $barColor }};">{{ $skor }}%</span>
                                        </div>
                                        <div class="w-full rounded-full h-1.5" style="background-color:rgba(26,35,64,0.08);">
                                            <div class="h-1.5 rounded-full transition-all" style="width:{{ $skor }}%;background-color:{{ $barColor }};"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
                {{-- SECTION 2: PROFIL KEPRIBADIAN MBTI                    --}}
                {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
                @if($mbtiResult)
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-1 h-5 rounded-full" style="background-color:#2D3F6B;"></div>
                        <h2 class="font-display text-base md:text-lg font-bold" style="color:#1A2340;">Profil Kepribadian MBTI</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-5">

                        {{-- Badge MBTI + Dimensi Bars --}}
                        <div class="sim-card p-5 md:p-6">
                            {{-- Badge --}}
                            <div class="text-center p-4 rounded-xl mb-5 relative overflow-hidden"
                                 style="background-color:#1A2340;">
                                <div class="absolute inset-0 siminat-batik" style="opacity:0.08;"></div>
                                <i class="ti ti-brain text-3xl mb-2 relative block" style="color:#C8922A;"></i>
                                <h3 class="font-display text-2xl font-bold relative" style="color:#C8922A;">{{ $mbtiResult }}</h3>
                                @if($mbtiDetailData)
                                    <span class="text-[10px] font-bold uppercase tracking-widest px-3 py-1 rounded-full mt-2 inline-block relative"
                                          style="background-color:rgba(200,146,42,0.2);color:#FDF6E8;">
                                        {{ $mbtiDetailData['julukan'] }}
                                    </span>
                                @endif
                            </div>

                            {{-- Dimensi Bars --}}
                            <div class="space-y-3">
                                @foreach($mbtiSkorDimensi as $dim => $data)
                                    @php
                                        [$a, $b] = match($dim) {
                                            'EI' => ['E', 'I'],
                                            'SN' => ['S', 'N'],
                                            'TF' => ['T', 'F'],
                                            'JP' => ['J', 'P'],
                                        };
                                        $aLabel = match($a) {
                                            'E' => 'Extrovert',
                                            'S' => 'Sensing',
                                            'T' => 'Thinking',
                                            'J' => 'Judging',
                                            default => $a,
                                        };
                                        $bLabel = match($b) {
                                            'I' => 'Introvert',
                                            'N' => 'Intuition',
                                            'F' => 'Feeling',
                                            'P' => 'Perceiving',
                                            default => $b,
                                        };
                                    @endphp
                                    <div>
                                        <div class="flex justify-between text-[10px] font-bold mb-1">
                                            <span style="color:{{ $data['dominan'] === $a ? '#1A2340' : '#9AA3BC' }};">
                                                {{ $a }} â€” {{ $aLabel }} <span class="font-mono">{{ $data[$a.'_persen'] }}%</span>
                                            </span>
                                            <span style="color:{{ $data['dominan'] === $b ? '#1A2340' : '#9AA3BC' }};">
                                                <span class="font-mono">{{ $data[$b.'_persen'] }}%</span> {{ $bLabel }} â€” {{ $b }}
                                            </span>
                                        </div>
                                        <div class="w-full h-2 rounded-full overflow-hidden flex" style="background-color:rgba(26,35,64,0.08);">
                                            <div class="h-full rounded-l-full" style="width:{{ $data[$a.'_persen'] }}%;background-color:{{ $data['dominan'] === $a ? '#1A2340' : 'rgba(26,35,64,0.2)' }};"></div>
                                            <div class="h-full rounded-r-full" style="width:{{ $data[$b.'_persen'] }}%;background-color:{{ $data['dominan'] === $b ? '#C8922A' : 'rgba(200,146,42,0.2)' }};"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Uraian Kepribadian --}}
                        @if($mbtiDetailData)
                        <div class="sim-card p-5 md:p-6 border-t-4" style="border-top-color:#1A2340;">
                            <h3 class="text-sm font-bold mb-4 flex items-center gap-2" style="color:#1A2340;">
                                <i class="ti ti-user-scan text-lg" style="color:#C8922A;"></i> Uraian Kepribadian
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <h4 class="text-[10px] font-bold uppercase tracking-wider mb-1" style="color:#6B7494;">Karakteristik</h4>
                                    <p class="text-sm font-medium leading-relaxed" style="color:#1A2340;">{{ $mbtiDetailData['karakter'] }}</p>
                                </div>
                                <hr style="border-color:rgba(26,35,64,0.06);">
                                <div>
                                    <h4 class="text-[10px] font-bold uppercase tracking-wider mb-1" style="color:#6B7494;">Potensi Karier</h4>
                                    <p class="text-sm font-bold" style="color:#2E7D55;">{{ $mbtiDetailData['potensi'] }}</p>
                                </div>
                                <hr style="border-color:rgba(26,35,64,0.06);">
                                <div>
                                    <h4 class="text-[10px] font-bold uppercase tracking-wider mb-1" style="color:#6B7494;">Area Pengembangan</h4>
                                    <p class="text-sm font-medium" style="color:#B4452F;">{{ $mbtiDetailData['pengembangan'] }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
                @endif

                {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
                {{-- SECTION 3: KESIMPULAN TERPADU                         --}}
                {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
                <div class="sim-card p-5 md:p-6 border-t-4" style="border-top-color:#C8922A;">
                    <h2 class="font-display text-base md:text-lg font-bold mb-2 flex items-center gap-2" style="color:#1A2340;">
                        <i class="ti ti-layout-list text-lg" style="color:#C8922A;"></i>
                        Kesimpulan Terpadu
                    </h2>
                    <p class="text-xs mb-5" style="color:#6B7494;">Sintesis hasil kuesioner Minat &amp; Bakat dan Tes MBTI</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                        {{-- Bidang Kelebihan --}}
                        <div class="rounded-xl p-4" style="background-color:rgba(46,125,85,0.05);border:1px solid rgba(46,125,85,0.15);">
                            <h4 class="text-xs font-bold uppercase tracking-wider mb-3 flex items-center gap-2" style="color:#2E7D55;">
                                <i class="ti ti-trending-up text-sm"></i> Bidang Menonjol (Kelebihan)
                            </h4>
                            <ul class="space-y-2">
                                @foreach($topKategori as $nama => $skor)
                                    <li class="flex items-center justify-between text-sm">
                                        <span class="font-medium" style="color:#1A2340;">{{ $nama }}</span>
                                        <span class="font-bold text-xs px-2 py-0.5 rounded-full" style="background-color:rgba(46,125,85,0.12);color:#2E7D55;">{{ $skor }}%</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Bidang Kelemahan --}}
                        <div class="rounded-xl p-4" style="background-color:rgba(180,69,47,0.05);border:1px solid rgba(180,69,47,0.15);">
                            <h4 class="text-xs font-bold uppercase tracking-wider mb-3 flex items-center gap-2" style="color:#B4452F;">
                                <i class="ti ti-trending-down text-sm"></i> Perlu Dikembangkan
                            </h4>
                            <ul class="space-y-2">
                                @foreach($bottomKategori as $nama => $skor)
                                    <li class="flex items-center justify-between text-sm">
                                        <span class="font-medium" style="color:#1A2340;">{{ $nama }}</span>
                                        <span class="font-bold text-xs px-2 py-0.5 rounded-full" style="background-color:rgba(180,69,47,0.12);color:#B4452F;">{{ $skor }}%</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="rounded-xl p-4" style="background-color:rgba(200,146,42,0.05);border:1px solid rgba(200,146,42,0.15);">
                        <p class="text-sm leading-relaxed" style="color:#1A2340;">{{ $kesimpulanGabungan }}</p>
                    </div>
                </div>

                {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
                {{-- SECTION 4: REKOMENDASI KEGIATAN                       --}}
                {{-- â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â•â• --}}
                @if(!empty($rekomendasiKegiatanData))
                <div class="sim-card p-5 md:p-6 border-t-4" style="border-top-color:#2D3F6B;">
                    <h2 class="font-display text-base md:text-lg font-bold mb-1 flex items-center gap-2" style="color:#1A2340;">
                        <i class="ti ti-bulb text-lg" style="color:#C8922A;"></i> Rekomendasi Kegiatan
                    </h2>
                    <p class="text-xs mb-4" style="color:#6B7494;">
                        Berdasarkan minat dominan Anda di bidang <strong>{{ array_key_first($topKategori) }}</strong>:
                    </p>
                    <ul class="space-y-3">
                        @foreach($rekomendasiKegiatanData as $kegiatan)
                            <li class="flex items-start gap-3 p-3 rounded-lg" style="background-color:rgba(200,146,42,0.05);">
                                <i class="ti ti-check text-sm mt-0.5 shrink-0" style="color:#C8922A;"></i>
                                <span class="text-sm font-medium leading-relaxed" style="color:#1A2340;">{{ $kegiatan }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif

            </div>
        </div>
    </main>

    {{-- ===== MOBILE BOTTOM NAVIGATION ===== --}}
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-50 flex justify-around items-center h-16 pb-safe"
         style="background-color:rgba(255,255,255,0.9);backdrop-filter:blur(10px);border-top:1px solid rgba(26,35,64,0.08);box-shadow:0 -4px 20px rgba(0,0,0,0.03);">
        <a href="{{ route('mahasiswa.dashboard') }}" class="flex flex-col items-center justify-center w-full h-full transition-colors" style="color:#6B7494;">
            <i class="ti ti-home text-xl mb-1"></i>
            <span class="text-[10px] font-semibold">Beranda</span>
        </a>
        <a href="{{ route('mahasiswa.asesmen') }}" class="flex flex-col items-center justify-center w-full h-full transition-colors" style="color:#6B7494;">
            <i class="ti ti-clipboard-list text-xl mb-1"></i>
            <span class="text-[10px] font-semibold">Asesmen</span>
        </a>
        <a href="{{ route('mahasiswa.results') }}" class="flex flex-col items-center justify-center w-full h-full" style="color:#C8922A;">
            <i class="ti ti-report-analytics text-xl mb-1 drop-shadow-sm"></i>
            <span class="text-[10px] font-bold">Rapor Saya</span>
        </a>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        const ctx = document.getElementById('radarChart');
        if (!ctx) return;

        const labels = @json($radarLabels);
        const data   = @json($radarData);

        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Skor (%)',
                    data: data,
                    backgroundColor: 'rgba(200, 146, 42, 0.35)',
                    borderColor: '#C8922A',
                    borderWidth: 3,
                    pointBackgroundColor: '#C8922A',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        ticks: { display: false },
                        suggestedMin: 0,
                        suggestedMax: 100,
                        pointLabels: {
                            display: true,
                            color: '#1A2340',
                            font: { size: 9, weight: '600' }
                        }
                    }
                },
                plugins: { legend: { display: false } }
            }
        });
    });
</script>

