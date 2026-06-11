<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    {{-- ===== MAIN AREA (FULL WIDTH) ===== --}}
    <main class="w-full flex flex-col overflow-hidden relative">

        {{-- Navbar --}}
        <header class="h-16 flex items-center justify-between px-5 md:px-8 shrink-0"
                style="background-color:#1A2340;border-bottom:1px solid rgba(232,213,163,0.15);">
            <div class="flex items-center gap-2 text-xs" style="color:rgba(253,246,232,0.45);">
                <span class="font-bold tracking-widest text-xs" style="color:#FDF6E8;letter-spacing:0.15em;">SIMINAT</span>
                <span>/</span>
                <span style="color:rgba(253,246,232,0.7);">Rapor Final</span>
            </div>
            <div class="flex items-center gap-3 md:gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold" style="color:#FDF6E8;">{{ Auth::user()->nama ?? '' }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-[10px] md:text-xs font-medium px-2.5 py-1.5 md:px-3 rounded-lg transition-all"
                            style="color:rgba(253,246,232,0.5);border:1px solid rgba(232,213,163,0.15);"
                            onmouseover="this.style.color='#FDF6E8'" onmouseout="this.style.color='rgba(253,246,232,0.5)'">
                        Selesai & Keluar
                    </button>
                </form>
            </div>
        </header>

        {{-- Scrollable content --}}
        <div class="flex-1 overflow-y-auto">

            {{-- Hero --}}
            <section class="relative px-5 py-8 md:px-8 md:py-10 overflow-hidden" style="background-color:#1A2340;">
                <div class="absolute inset-0 siminat-batik" style="opacity:0.07;"></div>
                <div class="relative text-center">
                    <div class="inline-flex items-center justify-center w-12 h-12 md:w-14 md:h-14 rounded-full mb-3 md:mb-4"
                         style="background-color:rgba(46,125,85,0.15);border:2px solid rgba(46,125,85,0.3);">
                        <i class="ti ti-circle-check text-2xl md:text-3xl" style="color:#4ade80;"></i>
                    </div>
                    <p class="text-[10px] md:text-xs font-bold uppercase tracking-widest mb-2" style="color:#C8922A;letter-spacing:0.15em;">Rapor Potensi Diri</p>
                    <h1 class="font-display text-2xl md:text-3xl font-bold mb-2" style="color:#FDF6E8;">
                        Pemetaan Telah Selesai!
                    </h1>
                    <p class="text-[10px] md:text-sm" style="color:rgba(253,246,232,0.55);">
                        {{ Auth::user()->nama }} &middot; {{ Auth::user()->nim_nidn }} &middot; {{ date('d F Y') }}
                    </p>
                </div>
            </section>

            {{-- Content --}}
            <div class="px-5 py-6 md:px-8 md:py-8 max-w-5xl mx-auto space-y-5 md:space-y-6">

                {{-- Section 1: Tipe Kepribadian & Top Kategori --}}
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 md:gap-5">

                    {{-- Tipe Kepribadian --}}
                    <div class="sim-card p-5 md:p-6 lg:col-span-2">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="font-display text-base md:text-lg font-bold" style="color:#1A2340;">Tipe Potensi Utama</h2>
                        </div>
                        <div class="text-center p-4 md:p-5 rounded-xl mb-4 relative overflow-hidden"
                             style="background-color:#1A2340;">
                            <div class="absolute inset-0 siminat-batik" style="opacity:0.08;"></div>
                            <i class="ti ti-brain text-3xl md:text-4xl mb-2 relative block" style="color:#C8922A;"></i>
                            <h3 class="font-display text-lg md:text-xl font-bold relative" style="color:#C8922A;">{{ $tipeKepribadian }}</h3>
                        </div>
                        <p class="text-xs md:text-sm leading-relaxed" style="color:#2D3F6B;">{{ $deskripsiKepribadian }}</p>

                        {{-- Top Kategori bars --}}
                        <div class="mt-5 space-y-3">
                            @foreach($topKategori as $nama => $skor)
                                <div>
                                    <div class="flex justify-between text-[10px] md:text-xs font-semibold mb-1">
                                        <span style="color:#1A2340;">{{ $nama }}</span>
                                        <span style="color:#C8922A;">{{ $skor }}%</span>
                                    </div>
                                    <div class="sim-progress-bar">
                                        <div class="sim-progress-fill" style="width:{{ $skor }}%;"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Radar Chart --}}
                    <div class="sim-card p-5 md:p-6 lg:col-span-3">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h2 class="font-display text-base md:text-lg font-bold" style="color:#1A2340;">Peta Kompetensi</h2>
                                <p class="text-[10px] md:text-xs mt-1 md:mt-1.5" style="color:#6B7494;">
                                    Arah Minat Utama: 
                                    <span class="font-extrabold text-[10px] md:text-sm uppercase tracking-wide" style="color:#C8922A;">
                                        {{ array_key_first($topKategori) }}
                                    </span>
                                </p>
                            </div>
                            <i class="ti ti-chart-radar text-lg md:text-xl" style="color:#C8922A;"></i>
                        </div>
                        <div class="flex justify-center relative w-full aspect-square md:aspect-auto md:h-[320px]">
                            <canvas id="radarChart"></canvas>
                        </div>
                        <div class="flex flex-wrap justify-center gap-2 md:gap-3 mt-4 pt-4" style="border-top:1px solid rgba(26,35,64,0.07);">
                            @foreach($topKategori as $nama => $skor)
                                <div class="flex items-center gap-1 md:gap-1.5 text-[10px] md:text-xs font-semibold" style="color:#2D3F6B;">
                                    <span class="w-2 h-2 md:w-2.5 md:h-2.5 rounded-full inline-block" style="background-color:#C8922A;"></span>
                                    {{ $nama }}: {{ $skor }}%
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Section 2: Rekomendasi --}}
                <div>
                    <div class="flex items-center justify-between mb-3 md:mb-4">
                        <h2 class="font-display text-lg md:text-xl font-bold" style="color:#1A2340;">Rekomendasi Untukmu</h2>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-5">
                        @php $i = 0; @endphp
                        @foreach($topKategori as $nama => $skor)
                            <div class="sim-card p-4 md:p-5">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] md:text-xs font-bold"
                                          style="background-color:rgba(200,146,42,0.1);color:#A6781F;">
                                        {{ $skor }}% Match
                                    </span>
                                    <span class="text-[10px] md:text-xs font-semibold" style="color:#6B7494;">Prioritas {{ $i+1 }}</span>
                                </div>
                                <h4 class="text-sm md:text-base font-bold mb-1.5" style="color:#1A2340;">{{ $nama }}</h4>
                                <p class="text-[10px] md:text-xs leading-relaxed" style="color:#6B7494;">
                                    Kamu memiliki potensi kuat di bidang ini. Kembangkan lebih jauh melalui kegiatan yang relevan.
                                </p>
                            </div>
                            @php $i++; @endphp
                        @endforeach
                    </div>
                </div>

                {{-- Actions (Hanya Download PDF) --}}
                <div class="flex flex-col sm:flex-row items-center justify-center pt-2 pb-6">
                    <button class="sim-btn-gold text-xs md:text-sm w-full sm:w-auto justify-center px-8 py-3">
                        <i class="ti ti-download"></i> Unduh Rapor PDF
                    </button>
                </div>

            </div>
        </div>
    </main>
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
                    backgroundColor: 'rgba(200, 146, 42, 0.45)', 
                    borderColor: '#C8922A', 
                    borderWidth: 3, 
                    pointBackgroundColor: '#C8922A', 
                    pointBorderColor: '#ffffff', 
                    pointBorderWidth: 2,
                    pointRadius: 5, 
                    pointHoverRadius: 7,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        angleLines: { color: 'rgba(26,35,64,0.1)' },
                        grid: { color: 'rgba(26,35,64,0.15)' },
                        pointLabels: {
                            color: '#1A2340', 
                            font: { family: "'Plus Jakarta Sans', sans-serif", size: 10, weight: '700' } 
                        },
                        ticks: { display: false },
                        suggestedMin: 0,
                        suggestedMax: 100,
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1A2340',
                        titleFont: { family: "'Plus Jakarta Sans', sans-serif", size: 12 },
                        bodyFont: { family: "'Plus Jakarta Sans', sans-serif", size: 11 },
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: { label: ctx => ctx.raw + '% Match' }
                    }
                }
            }
        });
    });
</script>