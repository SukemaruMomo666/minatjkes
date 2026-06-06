<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-[220px] flex-col hidden md:flex shrink-0 relative" style="background-color:#1A2340;">
        <div class="absolute inset-0 siminat-batik" style="opacity:0.05;"></div>

        {{-- Logo --}}
        <div class="h-16 flex items-center px-5 relative" style="border-bottom:1px solid rgba(232,213,163,0.15);">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3 shrink-0" style="background-color:#C8922A;">
                <i class="ti ti-plus font-bold" style="color:#1A2340;font-size:15px;"></i>
            </div>
            <span class="font-bold tracking-widest text-sm" style="color:#FDF6E8;letter-spacing:0.15em;">SIMINAT</span>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto relative">
            <a href="{{ route('mahasiswa.dashboard') }}"
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold"
               style="background-color:rgba(200,146,42,0.15);color:#C8922A;border-left:3px solid #C8922A;">
                <i class="ti ti-home mr-3 text-base"></i> Beranda
            </a>
            <a href="{{ route('mahasiswa.tes') }}"
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all hover:bg-white/10"
               style="color:rgba(253,246,232,0.65);">
                <i class="ti ti-clipboard-list mr-3 text-base"></i> Mulai Tes
            </a>
            <a href="{{ route('mahasiswa.results') }}"
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all hover:bg-white/10"
               style="color:rgba(253,246,232,0.65);">
                <i class="ti ti-report-analytics mr-3 text-base"></i> Hasil Saya
            </a>
        </nav>

        {{-- Sidebar footer tip --}}
        <div class="mx-3 mb-4 p-4 rounded-xl relative overflow-hidden" style="background-color:rgba(200,146,42,0.08);border:1px solid rgba(200,146,42,0.18);">
            <i class="ti ti-award text-xl mb-2 block" style="color:#C8922A;"></i>
            <p class="text-xs leading-relaxed" style="color:rgba(253,246,232,0.6);">Lengkapi pemetaan potensimu untuk membuka Rapor Potensi Diri.</p>
        </div>
    </aside>

    {{-- ===== MAIN AREA ===== --}}
    <main class="flex-1 flex flex-col overflow-hidden">

        {{-- Navbar --}}
        <header class="h-16 flex items-center justify-between px-8 shrink-0 relative"
                style="background-color:#1A2340;border-bottom:1px solid rgba(232,213,163,0.15);">
            <div class="flex items-center gap-2 text-xs" style="color:rgba(253,246,232,0.45);">
                <i class="ti ti-home text-sm"></i>
                <span>/</span>
                <span style="color:rgba(253,246,232,0.7);">Beranda</span>
            </div>
            <div class="flex items-center gap-4">
                <button class="relative" style="color:rgba(253,246,232,0.65);">
                    <i class="ti ti-bell" style="font-size:20px;"></i>
                </button>
                <div class="flex items-center gap-3">
                    <div class="text-right">
                        <p class="text-sm font-semibold" style="color:#FDF6E8;">{{ $namaLengkap }}</p>
                        <p class="text-xs" style="color:rgba(253,246,232,0.5);">{{ $namaKelas }}</p>
                    </div>
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold shrink-0"
                         style="background-color:#C8922A;color:#1A2340;">
                        {{ $inisial }}
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-xs font-medium px-3 py-1.5 rounded-lg transition-all"
                            style="color:rgba(253,246,232,0.5);border:1px solid rgba(232,213,163,0.15);"
                            onmouseover="this.style.color='#FDF6E8'" onmouseout="this.style.color='rgba(253,246,232,0.5)'">
                        Keluar
                    </button>
                </form>
            </div>
        </header>

        {{-- Scrollable Content --}}
        <div class="flex-1 overflow-y-auto">

            {{-- === HERO SECTION === --}}
            <section class="relative px-8 py-10 overflow-hidden" style="background-color:#1A2340;">
                <div class="absolute inset-0 siminat-batik" style="opacity:0.06;"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        {{-- Status pill --}}
                        @if($statusTes === 'selesai')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold mb-4"
                                  style="background-color:rgba(46,125,85,0.2);color:#4ade80;border:1px solid rgba(46,125,85,0.3);">
                                <i class="ti ti-circle-check text-sm"></i> Tes Selesai
                            </span>
                        @elseif($statusTes === 'proses')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold mb-4"
                                  style="background-color:rgba(200,146,42,0.2);color:#C8922A;border:1px solid rgba(200,146,42,0.3);">
                                <i class="ti ti-clock text-sm"></i> Sedang Berlangsung — {{ $progressPersen }}%
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold mb-4"
                                  style="background-color:rgba(200,146,42,0.15);color:#C8922A;border:1px solid rgba(200,146,42,0.25);">
                                <i class="ti ti-alert-circle text-sm"></i> Belum Mengisi Tes
                            </span>
                        @endif

                        <h1 class="font-display text-3xl font-bold mb-3 leading-snug" style="color:#FDF6E8;">
                            Selamat Datang, {{ $namaPanggil }}! <span>👋</span>
                        </h1>
                        <p class="text-base mb-6" style="color:rgba(253,246,232,0.6);">
                            Temukan potensi terbaik kamu dalam dunia keperawatan.
                        </p>

                        @if($statusTes === 'selesai')
                            <a href="{{ route('mahasiswa.results') }}" class="sim-btn-gold text-sm">
                                Lihat Rapor Potensi Diri <i class="ti ti-arrow-right"></i>
                            </a>
                        @elseif($statusTes === 'proses')
                            <a href="{{ route('mahasiswa.tes') }}" class="sim-btn-gold text-sm">
                                Lanjutkan Tes <i class="ti ti-arrow-right"></i>
                            </a>
                        @else
                            <a href="{{ route('mahasiswa.tes') }}" class="sim-btn-gold text-sm">
                                Mulai Pemetaan Potensi <i class="ti ti-arrow-right"></i>
                            </a>
                        @endif
                    </div>
                    <div class="hidden lg:block">
                        <i class="ti ti-rosette-discount-check" style="font-size:110px;color:rgba(232,213,163,0.12);"></i>
                    </div>
                </div>
            </section>

            {{-- Content --}}
            <div class="px-8 py-8 space-y-8 max-w-6xl">

                {{-- === STAT CARDS === --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    {{-- Status Tes --}}
                    <div class="sim-card p-5">
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0"
                                 style="{{ $statusTes === 'selesai' ? 'background-color:rgba(46,125,85,0.1);' : 'background-color:rgba(200,146,42,0.1);' }}">
                                <i class="ti ti-{{ $statusTes === 'selesai' ? 'circle-check' : 'clipboard-list' }} text-xl"
                                   style="{{ $statusTes === 'selesai' ? 'color:#2E7D55;' : 'color:#C8922A;' }}"></i>
                            </div>
                            <div>
                                <p class="text-xs font-semibold mb-1" style="color:#6B7494;">Status Tes</p>
                                <p class="text-base font-bold" style="color:#1A2340;">
                                    @if($statusTes === 'selesai') Tes Selesai
                                    @elseif($statusTes === 'proses') Sedang Proses
                                    @else Belum Dikerjakan
                                    @endif
                                </p>
                                <p class="text-xs mt-0.5" style="color:#6B7494;">
                                    @if($statusTes === 'proses') {{ $totalDijawab }}/{{ $totalSoal }} soal terjawab
                                    @elseif($statusTes === 'selesai') Semua soal selesai ✓
                                    @else Yuk mulai sekarang
                                    @endif
                                </p>
                            </div>
                        </div>
                        @if($statusTes === 'proses')
                            <div class="mt-4 sim-progress-bar">
                                <div class="sim-progress-fill" style="width:{{ $progressPersen }}%;"></div>
                            </div>
                            <p class="text-xs mt-1 text-right font-semibold" style="color:#C8922A;">{{ $progressPersen }}%</p>
                        @endif
                    </div>

                    {{-- Tipe Kepribadian --}}
                    <div class="sim-card p-5">
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0"
                                 style="background-color:rgba(200,146,42,0.1);">
                                <i class="ti ti-brain text-xl" style="color:#C8922A;"></i>
                            </div>
                            <div>
                                <p class="text-xs font-semibold mb-1" style="color:#6B7494;">Tipe Kepribadian</p>
                                <p class="text-base font-bold" style="color:#1A2340;">
                                    {{ $statusTes === 'selesai' ? 'Tersedia' : 'Belum tersedia' }}
                                </p>
                                <p class="text-xs mt-0.5" style="color:#6B7494;">
                                    {{ $statusTes === 'selesai' ? 'Lihat di halaman Hasil Saya' : 'Selesaikan tes untuk melihat' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- NIM & Kelas --}}
                    <div class="sim-card p-5">
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0"
                                 style="background-color:rgba(45,63,107,0.08);">
                                <i class="ti ti-id-badge text-xl" style="color:#2D3F6B;"></i>
                            </div>
                            <div>
                                <p class="text-xs font-semibold mb-1" style="color:#6B7494;">Profil Kamu</p>
                                <p class="text-base font-bold" style="color:#1A2340;">{{ $nimNidn }}</p>
                                <p class="text-xs mt-0.5" style="color:#6B7494;">{{ $namaKelas ?: 'Kelas belum ditetapkan' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- === ABOUT + INFO === --}}
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-5">

                    {{-- Tentang Program --}}
                    <div class="sim-card p-6 lg:col-span-3">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="font-display text-xl font-bold" style="color:#1A2340;">Tentang Program</h2>
                            <span class="text-xs font-bold tracking-widest uppercase" style="color:#A6781F;letter-spacing:0.1em;">SIMINAT</span>
                        </div>
                        <p class="text-sm mb-5" style="color:#2D3F6B;">
                            SIMINAT membantumu mengenali minat dan bakat agar perjalanan kuliahmu lebih terarah.
                        </p>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0"
                                     style="background-color:rgba(200,146,42,0.1);">
                                    <i class="ti ti-map-pin" style="color:#C8922A;"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold" style="color:#1A2340;">Petakan minat & bakat</p>
                                    <p class="text-xs" style="color:#6B7494;">Isi kuesioner di berbagai kategori akademik dan non-akademik.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0"
                                     style="background-color:rgba(200,146,42,0.1);">
                                    <i class="ti ti-brain" style="color:#C8922A;"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold" style="color:#1A2340;">Kenali kepribadianmu</p>
                                    <p class="text-xs" style="color:#6B7494;">Memahami cara kerja dan belajar terbaikmu.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-9 h-9 rounded-lg flex items-center justify-center shrink-0"
                                     style="background-color:rgba(200,146,42,0.1);">
                                    <i class="ti ti-route" style="color:#C8922A;"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold" style="color:#1A2340;">Dapatkan rekomendasi</p>
                                    <p class="text-xs" style="color:#6B7494;">Saran kegiatan dan jalur karier yang cocok dengan profilmu.</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    {{-- Info Card --}}
                    <div class="lg:col-span-2 flex flex-col gap-4">
                        <div class="sim-card p-5">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-base font-bold" style="color:#1A2340;">Jadwal & Info</h3>
                                <i class="ti ti-calendar-event" style="color:#C8922A;font-size:18px;"></i>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="text-4xl font-display font-bold" style="color:#C8922A;">15</div>
                                <div>
                                    <p class="text-sm font-semibold" style="color:#1A2340;">Juni 2026</p>
                                    <p class="text-xs" style="color:#6B7494;">Batas akhir pengisian pemetaan potensi semester ini.</p>
                                </div>
                            </div>
                        </div>
                        <div class="sim-card p-5">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold mb-3"
                                  style="background-color:rgba(232,213,163,0.3);color:#A6781F;">
                                <i class="ti ti-speakerphone text-xs"></i> Info Kampus
                            </span>
                            <p class="text-sm leading-relaxed" style="color:#2D3F6B;">
                                Workshop "Pengembangan Diri Mahasiswa Keperawatan" diadakan pekan depan di Aula Utama.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- === KATEGORI TES === --}}
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-display text-xl font-bold" style="color:#1A2340;">Kategori Tes</h2>
                        <span class="text-xs" style="color:#6B7494;">
                            @if($statusTes === 'selesai') Semua kategori selesai
                            @elseif($statusTes === 'proses') Sedang berjalan
                            @else 3 kategori · belum dimulai
                            @endif
                        </span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                        @php
                            $kategoriTes = [
                                ['icon' => 'ti-school',    'nama' => 'Akademik',     'desc' => 'Klinis, riset, dan pendidikan kesehatan.'],
                                ['icon' => 'ti-sparkles',  'nama' => 'Non-Akademik', 'desc' => 'Organisasi, seni, olahraga, dan lainnya.'],
                                ['icon' => 'ti-brain',     'nama' => 'Kepribadian',  'desc' => 'Tipe kepribadian multi-dimensi.'],
                            ];
                        @endphp

                        @foreach($kategoriTes as $kat)
                            <div class="sim-card p-5 flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0"
                                     style="{{ $statusTes === 'selesai' ? 'background-color:rgba(46,125,85,0.1);' : 'background-color:rgba(200,146,42,0.1);' }}">
                                    <i class="ti {{ $kat['icon'] }} text-xl"
                                       style="{{ $statusTes === 'selesai' ? 'color:#2E7D55;' : 'color:#C8922A;' }}"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-bold" style="color:#1A2340;">{{ $kat['nama'] }}</p>
                                    <p class="text-xs mt-0.5" style="color:#6B7494;">{{ $kat['desc'] }}</p>
                                </div>
                                @if($statusTes === 'selesai')
                                    <i class="ti ti-circle-check ml-auto text-xl" style="color:#2E7D55;"></i>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>
