<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    {{-- Sidebar --}}
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
            <a href="{{ route('mahasiswa.tes') }}"
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all hover:bg-white/10"
               style="color:rgba(253,246,232,0.65);">
                <i class="ti ti-clipboard-list mr-3 text-base"></i> Mulai Tes
            </a>
            <a href="{{ route('mahasiswa.results') }}"
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold"
               style="background-color:rgba(200,146,42,0.15);color:#C8922A;border-left:3px solid #C8922A;">
                <i class="ti ti-report-analytics mr-3 text-base"></i> Hasil Saya
            </a>
        </nav>
        <div class="mx-3 mb-4 p-4 rounded-xl" style="background-color:rgba(46,125,85,0.1);border:1px solid rgba(46,125,85,0.2);">
            <i class="ti ti-circle-check text-xl mb-1 block" style="color:#4ade80;"></i>
            <p class="text-xs leading-relaxed" style="color:rgba(253,246,232,0.65);">Rapor Potensi Dirimu telah selesai! 🎉</p>
        </div>
    </aside>

    {{-- Main --}}
    <main class="flex-1 flex flex-col overflow-hidden">

        {{-- Navbar --}}
        <header class="h-16 flex items-center justify-between px-8 shrink-0"
                style="background-color:#1A2340;border-bottom:1px solid rgba(232,213,163,0.15);">
            <div class="flex items-center gap-2 text-xs" style="color:rgba(253,246,232,0.45);">
                <i class="ti ti-report-analytics text-sm"></i>
                <span>/</span>
                <span style="color:rgba(253,246,232,0.7);">Rapor Potensi Diri</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold shrink-0"
                     style="background-color:#C8922A;color:#1A2340;">
                    {{ substr(Auth::user()->nama ?? 'AS', 0, 2) }}
                </div>
                <p class="text-sm font-semibold" style="color:#FDF6E8;">{{ Auth::user()->nama ?? '' }}</p>
            </div>
        </header>

        {{-- Scrollable content --}}
        <div class="flex-1 overflow-y-auto">

            {{-- Hero --}}
            <section class="relative px-8 py-10 overflow-hidden" style="background-color:#1A2340;">
                <div class="absolute inset-0 siminat-batik" style="opacity:0.07;"></div>
                <div class="relative text-center">
                    <div class="inline-flex items-center justify-center w-14 h-14 rounded-full mb-4"
                         style="background-color:rgba(200,146,42,0.15);border:2px solid rgba(200,146,42,0.3);">
                        <i class="ti ti-rosette-discount-check text-3xl" style="color:#C8922A;"></i>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#C8922A;letter-spacing:0.15em;">Rapor Potensi Diri</p>
                    <h1 class="font-display text-3xl font-bold mb-2" style="color:#FDF6E8;">
                        Pemetaan Potensimu Telah Selesai! <span>🎉</span>
                    </h1>
                    <p class="text-sm" style="color:rgba(253,246,232,0.55);">
                        {{ Auth::user()->nama }} &middot; {{ Auth::user()->nim_nidn }} &middot; Dibuat {{ date('d F Y') }}
                    </p>
                </div>
            </section>

            {{-- Content --}}
            <div class="px-8 py-8 max-w-5xl mx-auto space-y-6">

                {{-- Section 1: Tipe Kepribadian & Top Kategori --}}
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-5">

                    {{-- Tipe Kepribadian --}}
                    <div class="sim-card p-6 lg:col-span-2">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="font-display text-lg font-bold" style="color:#1A2340;">Tipe Potensi Utama</h2>
                        </div>
                        <div class="text-center p-5 rounded-xl mb-4 relative overflow-hidden"
                             style="background-color:#1A2340;">
                            <div class="absolute inset-0 siminat-batik" style="opacity:0.08;"></div>
                            <i class="ti ti-brain text-4xl mb-2 relative block" style="color:#C8922A;"></i>
                            <h3 class="font-display text-xl font-bold relative" style="color:#C8922A;">{{ $tipeKepribadian }}</h3>
                        </div>
                        <p class="text-sm leading-relaxed" style="color:#2D3F6B;">{{ $deskripsiKepribadian }}</p>

                        {{-- Top Kategori bars --}}
                        <div class="mt-5 space-y-3">
                            @foreach($topKategori as $nama => $skor)
                                <div>
                                    <div class="flex justify-between text-xs font-semibold mb-1">
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
                    <div class="sim-card p-6 lg:col-span-3">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="font-display text-lg font-bold" style="color:#1A2340;">Peta Kompetensi</h2>
                            <i class="ti ti-chart-radar text-xl" style="color:#C8922A;"></i>
                        </div>
                        <div class="flex justify-center">
                            <canvas id="radarChart" style="max-width:320px;max-height:320px;"></canvas>
                        </div>
                        <div class="flex flex-wrap justify-center gap-3 mt-4 pt-4" style="border-top:1px solid rgba(26,35,64,0.07);">
                            @foreach($topKategori as $nama => $skor)
                                <div class="flex items-center gap-1.5 text-xs font-semibold" style="color:#2D3F6B;">
                                    <span class="w-2.5 h-2.5 rounded-full inline-block" style="background-color:#C8922A;"></span>
                                    {{ $nama }}: {{ $skor }}%
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Section 2: Rekomendasi --}}
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-display text-xl font-bold" style="color:#1A2340;">Rekomendasi Untukmu</h2>
                        <span class="text-xs" style="color:#6B7494;">Berdasarkan profil potensimu</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        @php
                            $i = 0;
                            $warnaIkon = ['#C8922A', '#2D3F6B', '#2E7D55'];
                        @endphp
                        @foreach($topKategori as $nama => $skor)
                            <div class="sim-card p-5">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold"
                                          style="background-color:rgba(200,146,42,0.1);color:#A6781F;">
                                        {{ $skor }}% Match
                                    </span>
                                    <span class="text-xs font-semibold" style="color:#6B7494;">Prioritas {{ $i+1 }}</span>
                                </div>
                                <h4 class="text-base font-bold mb-1" style="color:#1A2340;">{{ $nama }}</h4>
                                <p class="text-xs leading-relaxed" style="color:#6B7494;">
                                    Kamu memiliki potensi kuat di bidang ini. Kembangkan lebih jauh melalui kegiatan dan organisasi yang relevan.
                                </p>
                            </div>
                            @php $i++; @endphp
                        @endforeach
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <button class="sim-btn-gold text-sm">
                        <i class="ti ti-download"></i> Unduh Rapor PDF
                    </button>
                    <a href="{{ route('mahasiswa.tes') }}" class="sim-btn-ghost text-sm">
                        <i class="ti ti-refresh"></i> Isi Ulang Tes
                    </a>
                    <a href="{{ route('mahasiswa.dashboard') }}" class="inline-flex items-center gap-1.5 text-sm font-medium"
                       style="color:#2D3F6B;">
                        <i class="ti ti-arrow-left text-sm"></i> Kembali ke Dashboard
                    </a>
                </div>

                {{-- Disclaimer --}}
                <p class="text-xs pb-4" style="color:#6B7494;font-style:italic;">
                    Hasil ini merupakan panduan pengembangan diri, bukan penilaian mutlak kemampuan kamu.
                </p>

            </div>
        </div>
    </main>
</div>

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
                    backgroundColor: 'rgba(200,146,42,0.18)',
                    borderColor: '#C8922A',
                    pointBackgroundColor: '#1A2340',
                    pointBorderColor: '#fff',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        angleLines: { color: 'rgba(26,35,64,0.08)' },
                        grid: { color: 'rgba(26,35,64,0.08)' },
                        pointLabels: {
                            color: '#2D3F6B',
                            font: { family: "'Plus Jakarta Sans', sans-serif", size: 10, weight: '600' }
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
