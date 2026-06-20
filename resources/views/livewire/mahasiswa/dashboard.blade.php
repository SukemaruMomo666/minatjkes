<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    {{-- ===== SIDEBAR (HANYA MUNCUL DI LAPTOP/TABLET) ===== --}}
    <aside class="w-[220px] flex-col hidden md:flex shrink-0 relative" style="background-color:#1A2340;">
        <div class="absolute inset-0 siminat-batik" style="opacity:0.05;"></div>
        <div class="h-16 flex items-center px-5 relative" style="border-bottom:1px solid rgba(232,213,163,0.15);">
            <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3 shrink-0" style="background-color:#C8922A;"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1A2340" stroke-width="3.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
            </div>
            <span class="font-bold tracking-widest text-sm" style="color:#FDF6E8;letter-spacing:0.15em;">SIMINAT</span>
        </div>
        <nav class="flex-1 px-3 py-5 space-y-1 relative">
            <a href="{{ route('mahasiswa.dashboard') }}"
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold"
               style="background-color:rgba(200,146,42,0.15);color:#C8922A;border-left:3px solid #C8922A;">
                <i class="ti ti-home mr-3 text-base"></i> Beranda
            </a>
            <a href="{{ route('mahasiswa.asesmen') }}"
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all hover:bg-white/10"
               style="color:rgba(253,246,232,0.65);">
                <i class="ti ti-clipboard-list mr-3 text-base"></i> Asesmen
            </a>
            <a href="{{ route('mahasiswa.results') }}"
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all hover:bg-white/10"
               style="color:rgba(253,246,232,0.65);">
                <i class="ti ti-report-analytics mr-3 text-base"></i> Hasil Saya
            </a>
        </nav>
        <div class="mx-3 mb-4 p-4 rounded-xl relative" style="background-color:rgba(200,146,42,0.08);border:1px solid rgba(200,146,42,0.18);">
            <p class="text-xs leading-relaxed" style="color:rgba(253,246,232,0.6);">Lengkapi pemetaan potensimu untuk membuka Rapor Potensi Diri.</p>
        </div>
    </aside>

    {{-- ===== MAIN AREA ===== --}}
    <main class="flex-1 flex flex-col overflow-hidden relative pb-16 md:pb-0">

        {{-- Navbar --}}
        <header class="h-16 flex items-center justify-between px-5 md:px-8 shrink-0 relative"
                style="background-color:#1A2340;border-bottom:1px solid rgba(232,213,163,0.15);">
            <div class="flex items-center gap-2 text-xs" style="color:rgba(253,246,232,0.45);">
                <i class="ti ti-home text-sm"></i>
                <span class="hidden sm:inline">/</span>
                <span class="hidden sm:inline" style="color:rgba(253,246,232,0.7);">Beranda</span>
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
                <div class="relative flex items-center justify-between">
                    <div class="w-full md:w-auto">
                        @if($statusTes === 'selesai')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] md:text-xs font-semibold mb-4 shadow-sm"
                                  style="background-color:rgba(46,125,85,0.2);color:#4ade80;border:1px solid rgba(46,125,85,0.3);">
                                <i class="ti ti-circle-check text-sm"></i> Tes Selesai
                            </span>
                        @elseif($statusTes === 'proses')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] md:text-xs font-semibold mb-4 shadow-sm"
                                  style="background-color:rgba(200,146,42,0.2);color:#C8922A;border:1px solid rgba(200,146,42,0.3);">
                                <i class="ti ti-clock text-sm"></i> Sedang Berlangsung â€” {{ $progressPersen }}%
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] md:text-xs font-semibold mb-4 shadow-sm"
                                  style="background-color:rgba(200,146,42,0.15);color:#C8922A;border:1px solid rgba(200,146,42,0.25);">
                                <i class="ti ti-alert-circle text-sm"></i> Belum Mengisi Tes
                            </span>
                        @endif

                        <h1 class="font-display text-2xl md:text-3xl font-bold mb-1.5 md:mb-2 leading-snug" style="color:#FDF6E8;">
                            Halo, {{ $namaPanggil }}! <span>ðŸ‘‹</span>
                        </h1>
                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mb-5">
                            @if($nimNidn)
                                <span class="text-xs font-mono" style="color:rgba(253,246,232,0.6);"><i class="ti ti-id mr-1"></i>{{ $nimNidn }}</span>
                            @endif
                            @if($namaKelas && $namaKelas !== '-')
                                <span class="text-xs" style="color:rgba(253,246,232,0.6);"><i class="ti ti-school mr-1"></i>{{ $namaKelas }}</span>
                            @endif
                            @if($jenisKelamin && $jenisKelamin !== '-')
                                <span class="text-xs" style="color:rgba(253,246,232,0.6);"><i class="ti ti-gender-androgyne mr-1"></i>{{ $jenisKelamin }}</span>
                            @endif
                        </div>

                        <div class="w-full md:w-auto">
                            @if($statusTes === 'selesai')
                                <a href="{{ route('mahasiswa.results') }}" class="sim-btn-gold text-sm w-full md:w-auto justify-center">
                                    Lihat Rapor Potensi <i class="ti ti-arrow-right"></i>
                                </a>
                            @elseif($statusTes === 'proses')
                                <a href="{{ route('mahasiswa.tes') }}" class="sim-btn-gold text-sm w-full md:w-auto justify-center">
                                    Lanjutkan Tes <i class="ti ti-arrow-right"></i>
                                </a>
                            @else
                                <a href="{{ route('mahasiswa.tes') }}" class="sim-btn-gold text-sm w-full md:w-auto justify-center">
                                    Mulai Pemetaan <i class="ti ti-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="hidden lg:block">
                        <i class="ti ti-rosette-discount-check" style="font-size:110px;color:rgba(232,213,163,0.12);"></i>
                    </div>
                </div>
            </section>

            {{-- Content --}}
            <div class="px-5 py-6 md:px-8 md:py-8 space-y-6 md:space-y-8 max-w-6xl">

                {{-- === STAT CARDS === --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-5">
                    {{-- Card: Minat & Bakat --}}
                    <div class="sim-card p-4 md:p-5">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 md:w-11 md:h-11 rounded-xl flex items-center justify-center shrink-0"
                                 style="{{ $statusTes === 'selesai' ? 'background-color:rgba(46,125,85,0.1);' : 'background-color:rgba(200,146,42,0.1);' }}">
                                <i class="ti ti-{{ $statusTes === 'selesai' ? 'circle-check' : 'clipboard-list' }} text-lg md:text-xl"
                                   style="{{ $statusTes === 'selesai' ? 'color:#2E7D55;' : 'color:#C8922A;' }}"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-[10px] md:text-xs font-semibold mb-1 uppercase tracking-wider" style="color:#6B7494;">Minat &amp; Bakat</p>
                                <p class="text-sm md:text-base font-bold" style="color:#1A2340;">
                                    @if($statusTes === 'selesai') Selesai
                                    @elseif($statusTes === 'proses') {{ $progressPersen }}%
                                    @else Belum Dimulai
                                    @endif
                                </p>
                                <p class="text-[10px] md:text-xs mt-0.5" style="color:#6B7494;">
                                    @if($statusTes === 'selesai') 100% selesai âœ“
                                    @elseif($statusTes === 'proses') sedang berlangsung
                                    @else yuk mulai sekarang
                                    @endif
                                </p>
                            </div>
                        </div>
                        @if($statusTes === 'proses')
                            <div class="mt-4 sim-progress-bar">
                                <div class="sim-progress-fill" style="width:{{ $progressPersen }}%;"></div>
                            </div>
                        @endif
                    </div>

                    {{-- Card: MBTI --}}
                    <div class="sim-card p-4 md:p-5">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 md:w-11 md:h-11 rounded-xl flex items-center justify-center shrink-0"
                                 style="{{ $statusMbti === 'selesai' ? 'background-color:rgba(46,125,85,0.1);' : 'background-color:rgba(200,146,42,0.1);' }}">
                                <i class="ti ti-brain text-lg md:text-xl"
                                   style="{{ $statusMbti === 'selesai' ? 'color:#2E7D55;' : 'color:#C8922A;' }}"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-[10px] md:text-xs font-semibold mb-1 uppercase tracking-wider" style="color:#6B7494;">Tes MBTI</p>
                                <p class="text-sm md:text-base font-bold" style="color:#1A2340;">
                                    @if($statusMbti === 'selesai') Selesai
                                    @elseif($statusMbti === 'proses') {{ $progressMbtiPersen }}%
                                    @else Belum Dimulai
                                    @endif
                                </p>
                                <p class="text-[10px] md:text-xs mt-0.5" style="color:#6B7494;">
                                    @if($statusMbti === 'selesai') 100% selesai âœ“
                                    @elseif($statusMbti === 'proses') sedang berlangsung
                                    @elseif($statusTes !== 'selesai') selesaikan minat dulu
                                    @else yuk mulai sekarang
                                    @endif
                                </p>
                            </div>
                        </div>
                        @if($statusMbti === 'proses')
                            <div class="mt-4 sim-progress-bar">
                                <div class="sim-progress-fill" style="width:{{ $progressMbtiPersen }}%;"></div>
                            </div>
                        @endif
                    </div>

                    <div class="sim-card p-4 md:p-5">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 md:w-11 md:h-11 rounded-xl flex items-center justify-center shrink-0"
                                 style="background-color:rgba(45,63,107,0.08);">
                                <i class="ti ti-id-badge text-lg md:text-xl" style="color:#2D3F6B;"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[10px] md:text-xs font-semibold mb-1.5 uppercase tracking-wider" style="color:#6B7494;">Profil Saya</p>
                                <p class="text-sm md:text-base font-bold truncate" style="color:#1A2340;">{{ $namaLengkap }}</p>
                                <p class="text-[10px] md:text-xs font-mono mt-0.5" style="color:#2D3F6B;">{{ $nimNidn }}</p>
                            </div>
                        </div>
                        <div class="mt-3 pt-3 grid grid-cols-2 gap-2" style="border-top:1px solid rgba(26,35,64,0.06);">
                            <div>
                                <p class="text-[9px] md:text-[10px] font-semibold uppercase tracking-wider mb-0.5" style="color:#6B7494;">Kelas</p>
                                <p class="text-xs md:text-sm font-semibold" style="color:#1A2340;">{{ $namaKelas ?: 'â€”' }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] md:text-[10px] font-semibold uppercase tracking-wider mb-0.5" style="color:#6B7494;">Jenis Kelamin</p>
                                <p class="text-xs md:text-sm font-semibold" style="color:#1A2340;">{{ $jenisKelamin }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- === KARTU PORTOFOLIO === --}}
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0"
                             style="background-color:rgba(200,146,42,0.1);">
                            <i class="ti ti-certificate text-lg" style="color:#C8922A;"></i>
                        </div>
                        <div>
                            <h2 class="text-sm md:text-base font-bold" style="color:#1A2340;">Portofolio Sertifikat</h2>
                            <p class="text-[10px] md:text-xs" style="color:#6B7494;">Unggah sertifikat prestasi atau bukti bakat kamu (PDF/JPG/PNG, maks. 2MB)</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        {{-- Akademik --}}
                        @php $labelA = 'fileBakatAkademik'; @endphp
                        <div class="sim-card p-4 md:p-5 border-2" style="border-color:rgba(45,63,107,0.2);">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2">
                                    <i class="ti ti-school text-base" style="color:#2D3F6B;"></i>
                                    <span class="text-xs font-bold" style="color:#1A2340;">Sertifikat Akademik</span>
                                </div>
                                @if($fileBakatAkademikPath)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold"
                                          style="background-color:rgba(46,125,85,0.1);color:#2E7D55;border:1px solid rgba(46,125,85,0.2);">
                                        <i class="ti ti-circle-check text-xs"></i> Ada
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold"
                                          style="background-color:rgba(180,69,47,0.08);color:#B4452F;border:1px solid rgba(180,69,47,0.2);">
                                        <i class="ti ti-x text-xs"></i> Belum Ada
                                    </span>
                                @endif
                            </div>

                            @if(session('sertifikat_message_akademik'))
                                <div class="mb-3 px-3 py-2 rounded-lg text-[10px] font-semibold flex items-center gap-1.5"
                                     style="background-color:rgba(46,125,85,0.1);color:#2E7D55;">
                                    <i class="ti ti-circle-check"></i> {{ session('sertifikat_message_akademik') }}
                                </div>
                            @endif

                            @if($fileBakatAkademikPath)
                                <div class="flex items-center gap-2 mb-3 p-2.5 rounded-lg"
                                     style="background-color:rgba(46,125,85,0.05);border:1px solid rgba(46,125,85,0.15);">
                                    <i class="ti ti-file-check shrink-0" style="color:#2E7D55;"></i>
                                    <p class="text-[10px] font-semibold flex-1 truncate" style="color:#1A2340;">
                                        {{ basename($fileBakatAkademikPath) }}
                                    </p>
                                    <a href="{{ Storage::url($fileBakatAkademikPath) }}" target="_blank" rel="noopener noreferrer"
                                       class="shrink-0 px-2 py-1 rounded-lg text-[10px] font-semibold"
                                       style="background-color:rgba(45,63,107,0.08);color:#2D3F6B;">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                    <a href="{{ Storage::url($fileBakatAkademikPath) }}" download
                                       class="shrink-0 px-2 py-1 rounded-lg text-[10px] font-semibold"
                                       style="background-color:rgba(46,125,85,0.08);color:#2E7D55;">
                                        <i class="ti ti-download"></i>
                                    </a>
                                    <button wire:click="hapusSertifikat('akademik')"
                                            wire:confirm="Hapus sertifikat akademik?"
                                            class="shrink-0 px-2 py-1 rounded-lg text-[10px] font-semibold"
                                            style="background-color:rgba(180,69,47,0.08);color:#B4452F;">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            @endif

                            <input type="file" wire:model="fileBakatAkademik"
                                   accept=".pdf,.jpg,.jpeg,.png"
                                   class="block w-full text-xs text-gray-500 mb-2
                                          file:mr-3 file:py-1.5 file:px-3
                                          file:rounded-lg file:border-0
                                          file:text-xs file:font-semibold
                                          file:bg-[#1A2340] file:text-[#FDF6E8]
                                          hover:file:bg-[#2D3F6B] file:transition-all cursor-pointer">
                            @error('fileBakatAkademik') <p class="text-[10px] mb-2 font-semibold" style="color:#B4452F;">{{ $message }}</p> @enderror
                            <button wire:click="uploadSertifikat('akademik')"
                                    wire:loading.attr="disabled"
                                    class="w-full py-2 rounded-xl text-xs font-bold transition-all"
                                    style="background-color:#1A2340;color:#FDF6E8;">
                                <span wire:loading.remove wire:target="uploadSertifikat('akademik')">
                                    <i class="ti ti-upload mr-1"></i>{{ $fileBakatAkademikPath ? 'Perbarui' : 'Unggah' }}
                                </span>
                                <span wire:loading wire:target="uploadSertifikat('akademik')">
                                    <i class="ti ti-loader animate-spin mr-1"></i>Mengunggah...
                                </span>
                            </button>
                        </div>

                        {{-- Non-Akademik --}}
                        <div class="sim-card p-4 md:p-5 border-2" style="border-color:rgba(200,146,42,0.25);">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center gap-2">
                                    <i class="ti ti-trophy text-base" style="color:#C8922A;"></i>
                                    <span class="text-xs font-bold" style="color:#1A2340;">Sertifikat Non-Akademik</span>
                                </div>
                                @if($fileBakatNonAkademikPath)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold"
                                          style="background-color:rgba(46,125,85,0.1);color:#2E7D55;border:1px solid rgba(46,125,85,0.2);">
                                        <i class="ti ti-circle-check text-xs"></i> Ada
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-semibold"
                                          style="background-color:rgba(180,69,47,0.08);color:#B4452F;border:1px solid rgba(180,69,47,0.2);">
                                        <i class="ti ti-x text-xs"></i> Belum Ada
                                    </span>
                                @endif
                            </div>

                            @if(session('sertifikat_message_non_akademik'))
                                <div class="mb-3 px-3 py-2 rounded-lg text-[10px] font-semibold flex items-center gap-1.5"
                                     style="background-color:rgba(46,125,85,0.1);color:#2E7D55;">
                                    <i class="ti ti-circle-check"></i> {{ session('sertifikat_message_non_akademik') }}
                                </div>
                            @endif

                            @if($fileBakatNonAkademikPath)
                                <div class="flex items-center gap-2 mb-3 p-2.5 rounded-lg"
                                     style="background-color:rgba(46,125,85,0.05);border:1px solid rgba(46,125,85,0.15);">
                                    <i class="ti ti-file-check shrink-0" style="color:#2E7D55;"></i>
                                    <p class="text-[10px] font-semibold flex-1 truncate" style="color:#1A2340;">
                                        {{ basename($fileBakatNonAkademikPath) }}
                                    </p>
                                    <a href="{{ Storage::url($fileBakatNonAkademikPath) }}" target="_blank" rel="noopener noreferrer"
                                       class="shrink-0 px-2 py-1 rounded-lg text-[10px] font-semibold"
                                       style="background-color:rgba(45,63,107,0.08);color:#2D3F6B;">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                    <a href="{{ Storage::url($fileBakatNonAkademikPath) }}" download
                                       class="shrink-0 px-2 py-1 rounded-lg text-[10px] font-semibold"
                                       style="background-color:rgba(46,125,85,0.08);color:#2E7D55;">
                                        <i class="ti ti-download"></i>
                                    </a>
                                    <button wire:click="hapusSertifikat('non_akademik')"
                                            wire:confirm="Hapus sertifikat non-akademik?"
                                            class="shrink-0 px-2 py-1 rounded-lg text-[10px] font-semibold"
                                            style="background-color:rgba(180,69,47,0.08);color:#B4452F;">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>
                            @endif

                            <input type="file" wire:model="fileBakatNonAkademik"
                                   accept=".pdf,.jpg,.jpeg,.png"
                                   class="block w-full text-xs text-gray-500 mb-2
                                          file:mr-3 file:py-1.5 file:px-3
                                          file:rounded-lg file:border-0
                                          file:text-xs file:font-semibold
                                          file:bg-[#C8922A] file:text-[#1A2340]
                                          hover:file:bg-[#1A2340] hover:file:text-[#FDF6E8] file:transition-all cursor-pointer">
                            @error('fileBakatNonAkademik') <p class="text-[10px] mb-2 font-semibold" style="color:#B4452F;">{{ $message }}</p> @enderror
                            <button wire:click="uploadSertifikat('non_akademik')"
                                    wire:loading.attr="disabled"
                                    class="w-full py-2 rounded-xl text-xs font-bold transition-all"
                                    style="background-color:#C8922A;color:#1A2340;">
                                <span wire:loading.remove wire:target="uploadSertifikat('non_akademik')">
                                    <i class="ti ti-upload mr-1"></i>{{ $fileBakatNonAkademikPath ? 'Perbarui' : 'Unggah' }}
                                </span>
                                <span wire:loading wire:target="uploadSertifikat('non_akademik')">
                                    <i class="ti ti-loader animate-spin mr-1"></i>Mengunggah...
                                </span>
                            </button>
                        </div>

                    </div>
                </div>

                {{-- === ABOUT + INFO === --}}
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-4 md:gap-5">
                    <div class="sim-card p-5 md:p-6 lg:col-span-3">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="font-display text-lg md:text-xl font-bold" style="color:#1A2340;">Tentang SIMINAT</h2>
                            <i class="ti ti-info-circle text-lg" style="color:#C8922A;"></i>
                        </div>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                                     style="background-color:rgba(200,146,42,0.1);">
                                    <i class="ti ti-map-pin" style="color:#C8922A;"></i>
                                </div>
                                <div>
                                    <p class="text-xs md:text-sm font-bold" style="color:#1A2340;">Petakan minat & bakat</p>
                                    <p class="text-[10px] md:text-xs mt-0.5" style="color:#6B7494;">Isi kuesioner akademik dan non-akademik.</p>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                                     style="background-color:rgba(200,146,42,0.1);">
                                    <i class="ti ti-brain" style="color:#C8922A;"></i>
                                </div>
                                <div>
                                    <p class="text-xs md:text-sm font-bold" style="color:#1A2340;">Kenali kepribadianmu</p>
                                    <p class="text-[10px] md:text-xs mt-0.5" style="color:#6B7494;">Pahami cara kerja dan belajar terbaikmu.</p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="lg:col-span-2 flex flex-col gap-4">
                        <div class="sim-card p-4 md:p-5">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-sm md:text-base font-bold" style="color:#1A2340;">Panduan Singkat</h3>
                                <i class="ti ti-info-circle" style="color:#C8922A;font-size:18px;"></i>
                            </div>
                            <ul class="space-y-2">
                                <li class="flex items-start gap-2 text-[10px] md:text-xs" style="color:#6B7494;">
                                    <i class="ti ti-circle-check shrink-0 mt-0.5" style="color:#2E7D55;"></i>
                                    Isi tes dengan jujur sesuai dirimu
                                </li>
                                <li class="flex items-start gap-2 text-[10px] md:text-xs" style="color:#6B7494;">
                                    <i class="ti ti-circle-check shrink-0 mt-0.5" style="color:#2E7D55;"></i>
                                    Tidak ada batas waktu pengerjaan
                                </li>
                                <li class="flex items-start gap-2 text-[10px] md:text-xs" style="color:#6B7494;">
                                    <i class="ti ti-circle-check shrink-0 mt-0.5" style="color:#2E7D55;"></i>
                                    Jawabanmu tersimpan otomatis
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- === FAQ === --}}
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0"
                             style="background-color:rgba(200,146,42,0.1);">
                            <i class="ti ti-help-circle text-lg" style="color:#C8922A;"></i>
                        </div>
                        <div>
                            <h2 class="text-sm md:text-base font-bold" style="color:#1A2340;">Pertanyaan yang Sering Diajukan (FAQ)</h2>
                            <p class="text-[10px] md:text-xs" style="color:#6B7494;">Klik pertanyaan untuk melihat jawaban</p>
                        </div>
                    </div>

                    <div class="space-y-2">

                        @php
                        $faqs = [
                            [
                                'q' => 'Apa itu SIMINAT?',
                                'a' => 'SIMINAT (Sistem Informasi Pemetaan Minat & Bakat) adalah platform digital yang dirancang khusus untuk mahasiswa Keperawatan Politeknik Negeri Subang. Sistem ini membantu kamu mengenali minat, bakat, dan tipe kepribadian agar bisa merencanakan jalur karier keperawatan yang paling sesuai dengan dirimu.',
                            ],
                            [
                                'q' => 'Ada berapa tes yang harus saya kerjakan?',
                                'a' => 'Ada 2 tes yang perlu dikerjakan secara berurutan: (1) Kuesioner Minat & Bakat â€” berisi ' . \App\Models\Soal::where('is_active', true)->count() . ' soal pilihan skala 1â€“4, dan (2) Tes Kepribadian MBTI â€” berisi ' . \App\Models\SoalMbti::where('is_active', true)->count() . ' soal pilihan A atau B. Tes MBTI baru bisa dimulai setelah Kuesioner Minat & Bakat selesai.',
                            ],
                            [
                                'q' => 'Apakah ada batas waktu untuk mengerjakan tes?',
                                'a' => 'Tidak ada batas waktu. Kamu bisa mengerjakan tes dengan santai sesuai kecepatan masing-masing. Jawaban juga tersimpan otomatis, sehingga kamu bisa berhenti dan melanjutkan kapan saja tanpa khawatir kehilangan jawaban.',
                            ],
                            [
                                'q' => 'Apakah jawaban saya bisa diubah setelah selesai tes?',
                                'a' => 'Tes ini dirancang untuk dikerjakan satu kali saja agar hasil yang diperoleh benar-benar mencerminkan kondisi dirimu saat ini. Selama proses pengerjaan, jawaban masih bisa diubah dengan klik pilihan lain. Namun setelah menekan tombol Selesai, jawaban tidak dapat diubah kembali.',
                            ],
                            [
                                'q' => 'Apa perbedaan Kuesioner Minat & Bakat dengan Tes MBTI?',
                                'a' => 'Kuesioner Minat & Bakat mengukur seberapa kuat ketertarikanmu di 9 bidang (seperti Keperawatan Klinis, Riset, Organisasi, Seni, dll) menggunakan skala penilaian 1â€“4. Sedangkan Tes MBTI mengukur tipe kepribadianmu melalui 4 dimensi (Extraversion/Introversion, Sensing/Intuition, Thinking/Feeling, Judging/Perceiving) yang menghasilkan kombinasi 4 huruf seperti INFJ atau ESTP.',
                            ],
                            [
                                'q' => 'Bagaimana cara membaca hasil rapor saya?',
                                'a' => 'Rapor Potensi Diri terdiri dari 4 bagian: (1) Peta Kompetensi â€” radar chart yang menampilkan skor semua bidang minatmu; (2) Rincian Per Bidang â€” daftar lengkap persentase tiap bidang dengan label "Kelebihan" (hijau) untuk 3 tertinggi dan "Perlu Dikembangkan" (merah) untuk 3 terendah; (3) Profil Kepribadian MBTI â€” tipe kepribadianmu beserta uraian karakteristik dan potensi karier; (4) Kesimpulan Terpadu â€” gabungan analisis dari kedua tes beserta rekomendasi kegiatan yang cocok untukmu.',
                            ],
                            [
                                'q' => 'Siapa saja yang bisa melihat hasil tes saya?',
                                'a' => 'Hasil tesmu dapat dilihat oleh kamu sendiri (melalui halaman Rapor) dan oleh Dosen Wali kelasmu. Dosen Wali dapat melihat rekap hasil seluruh mahasiswa di kelasnya untuk keperluan bimbingan akademik. Data kamu tidak dibagikan kepada pihak lain.',
                            ],
                            [
                                'q' => 'Untuk apa saya harus upload sertifikat?',
                                'a' => 'Fitur upload sertifikat di Portofolio Sertifikat digunakan untuk melampirkan bukti prestasi atau bakat kamu di luar akademik, seperti sertifikat lomba, penghargaan, atau kegiatan ekstrakurikuler. Ini membantu Dosen Wali mengetahui potensi nyata yang sudah kamu capai sebagai pelengkap hasil tes.',
                            ],
                            [
                                'q' => 'Apa yang harus saya lakukan jika mengalami kendala teknis?',
                                'a' => 'Jika kamu mengalami kendala seperti halaman tidak muncul, jawaban tidak tersimpan, atau tidak bisa login, coba langkah berikut: (1) Refresh halaman browser; (2) Pastikan koneksi internet stabil; (3) Coba gunakan browser lain (Chrome atau Firefox direkomendasikan); (4) Hubungi Dosen Wali atau penanggung jawab sistem jika masalah berlanjut.',
                            ],
                        ];
                        @endphp

                        @foreach($faqs as $idx => $faq)
                            <div class="sim-card overflow-hidden" x-data="{ isOpen: false }">
                                <button
                                    class="w-full flex items-center justify-between px-4 md:px-5 py-3.5 text-left transition-all"
                                    @click="isOpen = !isOpen"
                                    style="background:transparent;">
                                    <span class="text-xs md:text-sm font-semibold pr-4 leading-snug" style="color:#1A2340;">
                                        {{ $faq['q'] }}
                                    </span>
                                    <i class="ti shrink-0 text-base transition-transform duration-200"
                                       :class="isOpen ? 'ti-chevron-up' : 'ti-chevron-down'"
                                       style="color:#C8922A;"></i>
                                </button>
                                <div x-show="isOpen"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0"
                                     x-transition:enter-end="opacity-100"
                                     class="px-4 md:px-5 pb-4"
                                     style="border-top:1px solid rgba(26,35,64,0.06);">
                                    <p class="text-xs md:text-sm leading-relaxed pt-3" style="color:#6B7494;">
                                        {{ $faq['a'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </main>

    {{-- ===== MOBILE BOTTOM NAVIGATION ===== --}}
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-50 flex justify-around items-center h-16 pb-safe"
         style="background-color:rgba(255,255,255,0.9); backdrop-filter:blur(10px); border-top:1px solid rgba(26,35,64,0.08); box-shadow:0 -4px 20px rgba(0,0,0,0.03);">
        <a href="{{ route('mahasiswa.dashboard') }}" class="flex flex-col items-center justify-center w-full h-full" style="color:#C8922A;">
            <i class="ti ti-home text-xl mb-1 drop-shadow-sm"></i>
            <span class="text-[10px] font-bold">Beranda</span>
        </a>
        <a href="{{ route('mahasiswa.asesmen') }}" class="flex flex-col items-center justify-center w-full h-full transition-colors" style="color:#6B7494;">
            <i class="ti ti-clipboard-list text-xl mb-1"></i>
            <span class="text-[10px] font-semibold">Asesmen</span>
        </a>
        <a href="{{ route('mahasiswa.results') }}" class="flex flex-col items-center justify-center w-full h-full transition-colors" style="color:#6B7494;">
            <i class="ti ti-report-analytics text-xl mb-1"></i>
            <span class="text-[10px] font-semibold">Rapor Saya</span>
        </a>
    </nav>
</div>
