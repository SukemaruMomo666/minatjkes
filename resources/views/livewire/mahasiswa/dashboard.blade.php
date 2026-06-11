<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    {{-- ===== MAIN AREA (FULL WIDTH TANPA NAVIGASI) ===== --}}
    <main class="w-full flex flex-col overflow-hidden relative">

        {{-- Navbar --}}
        <header class="h-16 flex items-center justify-between px-5 md:px-8 shrink-0 relative"
                style="background-color:#1A2340;border-bottom:1px solid rgba(232,213,163,0.15);">
            <div class="flex items-center gap-2 text-xs" style="color:rgba(253,246,232,0.45);">
                <i class="ti ti-rosette-discount-check text-sm" style="color:#C8922A;"></i>
                <span class="font-bold tracking-widest text-xs" style="color:#FDF6E8;letter-spacing:0.15em;">SIMINAT</span>
            </div>
            <div class="flex items-center gap-3 md:gap-4">
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold" style="color:#FDF6E8;">{{ $namaLengkap }}</p>
                        <p class="text-xs" style="color:rgba(253,246,232,0.5);">{{ $namaKelas }}</p>
                    </div>
                    <div class="w-8 h-8 md:w-9 md:h-9 rounded-full flex items-center justify-center text-xs md:text-sm font-bold shrink-0 shadow-md"
                         style="background-color:#C8922A;color:#1A2340;">
                        {{ $inisial }}
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-[10px] md:text-xs font-medium px-2.5 py-1.5 md:px-3 rounded-lg transition-all"
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
            <section class="relative px-5 py-8 md:px-8 md:py-10 overflow-hidden" style="background-color:#1A2340;">
                <div class="absolute inset-0 siminat-batik" style="opacity:0.06;"></div>
                <div class="relative flex items-center justify-center text-center max-w-2xl mx-auto">
                    <div class="w-full">
                        {{-- Status pill --}}
                        @if($statusTes === 'selesai')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] md:text-xs font-semibold mb-4 shadow-sm"
                                  style="background-color:rgba(46,125,85,0.2);color:#4ade80;border:1px solid rgba(46,125,85,0.3);">
                                <i class="ti ti-circle-check text-sm"></i> Tes Selesai
                            </span>
                        @elseif($statusTes === 'proses')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] md:text-xs font-semibold mb-4 shadow-sm"
                                  style="background-color:rgba(200,146,42,0.2);color:#C8922A;border:1px solid rgba(200,146,42,0.3);">
                                <i class="ti ti-clock text-sm"></i> Sedang Berlangsung — {{ $progressPersen }}%
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] md:text-xs font-semibold mb-4 shadow-sm"
                                  style="background-color:rgba(200,146,42,0.15);color:#C8922A;border:1px solid rgba(200,146,42,0.25);">
                                <i class="ti ti-alert-circle text-sm"></i> Belum Mengisi Tes
                            </span>
                        @endif

                        <h1 class="font-display text-2xl md:text-4xl font-bold mb-2 md:mb-4 leading-snug" style="color:#FDF6E8;">
                            Halo, {{ $namaPanggil }}! <span>👋</span>
                        </h1>
                        <p class="text-xs md:text-base mb-8" style="color:rgba(253,246,232,0.6);">
                            Temukan potensi terbaik kamu dalam dunia keperawatan melalui asesmen terstruktur.
                        </p>

                        <div class="flex justify-center w-full">
                            @if($statusTes === 'selesai')
                                <a href="{{ route('mahasiswa.results') }}" class="sim-btn-gold text-sm w-full md:w-auto justify-center px-8 py-3">
                                    Lihat Rapor Potensi <i class="ti ti-arrow-right"></i>
                                </a>
                            @elseif($statusTes === 'proses')
                                <a href="{{ route('mahasiswa.tes') }}" class="sim-btn-gold text-sm w-full md:w-auto justify-center px-8 py-3">
                                    Lanjutkan Tes <i class="ti ti-arrow-right"></i>
                                </a>
                            @else
                                <a href="{{ route('mahasiswa.tes') }}" class="sim-btn-gold text-sm w-full md:w-auto justify-center px-8 py-3">
                                    Mulai Pemetaan <i class="ti ti-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </section>

            {{-- Content Info --}}
            <div class="px-5 py-6 md:px-8 md:py-10 max-w-4xl mx-auto">
                <div class="sim-card p-6 text-center">
                    <i class="ti ti-shield-check text-4xl mb-3 block" style="color:#C8922A;"></i>
                    <h2 class="font-display text-lg md:text-xl font-bold mb-2" style="color:#1A2340;">1 Akun, 1 Kesempatan</h2>
                    <p class="text-xs md:text-sm" style="color:#6B7494;">Asesmen ini hanya dapat dilakukan satu kali untuk menjamin keaslian profil psikologis Anda. Pastikan Anda berada di lingkungan yang tenang sebelum memulai.</p>
                </div>
            </div>
        </div>
    </main>
</div>