<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    {{-- Panggil Sidebar Navigasi Mahasiswa --}}
    {{-- ===== SIDEBAR ===== --}}
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
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden relative pb-16 md:pb-0">
        
        {{-- Navbar Atas --}}
        <header class="h-16 flex items-center justify-between px-5 md:px-8 shrink-0 bg-white"
                style="border-bottom:1px solid rgba(26,35,64,0.08);">
            <div class="flex items-center gap-2" style="color:#6B7494;">
                <i class="ti ti-brain text-lg" style="color:#C8922A;"></i>
                <span class="text-sm font-bold">Tes Kepribadian (MBTI)</span>
            </div>
            
            <div class="hidden md:flex items-center gap-3">
                <span class="text-sm font-bold" style="color:#1A2340;">Tahap 2 dari 2</span>
            </div>
        </header>

        {{-- Konten Utama --}}
        <div class="flex-1 overflow-y-auto p-4 md:p-8">
            <div class="max-w-3xl mx-auto space-y-6 pb-20">

                {{-- Progress Bar --}}
                <div class="mb-8 pt-2">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-xs md:text-sm font-semibold" style="color:#1A2340;">Progress Tes MBTI</span>
                        <span class="text-xs md:text-sm font-bold" style="color:#C8922A;">{{ $progressPersen }}%</span>
                    </div>
                    <div class="sim-progress-bar">
                        <div class="sim-progress-fill" style="width:{{ $progressPersen }}%; transition: width 0.3s ease;"></div>
                    </div>
                </div>

                {{-- Daftar Soal MBTI --}}
                <div class="space-y-6 md:space-y-8">
                    @foreach($soals as $idx => $soal)
                        @php 
                            $jawabanUser = $jawaban[$soal->id] ?? null; 
                        @endphp
                        
                        <div class="sim-card p-5 md:p-8 transition-all {{ $jawabanUser ? 'border-l-4' : '' }}"
                             style="border-left-color: {{ $jawabanUser ? '#C8922A' : 'transparent' }};">
                            
                            {{-- Pertanyaan --}}
                            <div class="flex items-start gap-3 mb-5">
                                <span class="text-base md:text-lg font-display font-bold mt-0.5 shrink-0" style="color:#C8922A;">
                                    {{ $idx + 1 }}.
                                </span>
                                <h3 class="text-sm md:text-base font-semibold leading-relaxed" style="color:#1A2340;">
                                    {{ $soal->pertanyaan }}
                                </h3>
                            </div>

                            {{-- Pilihan A & B --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-4 ml-7 md:ml-9">
                                
                                {{-- Tombol A --}}
                                <button wire:click="pilihJawaban({{ $soal->id }}, 'A')"
                                        class="text-left p-4 rounded-xl border-2 transition-all flex items-start gap-3 group"
                                        style="
                                            border-color: {{ $jawabanUser === 'A' ? '#C8922A' : 'rgba(26,35,64,0.1)' }};
                                            background-color: {{ $jawabanUser === 'A' ? 'rgba(200,146,42,0.05)' : '#fff' }};
                                        ">
                                    <span class="w-6 h-6 rounded-full flex items-center justify-center shrink-0 text-xs font-bold transition-colors"
                                          style="
                                              background-color: {{ $jawabanUser === 'A' ? '#C8922A' : 'rgba(26,35,64,0.05)' }};
                                              color: {{ $jawabanUser === 'A' ? '#fff' : '#1A2340' }};
                                          ">A</span>
                                    <span class="text-xs md:text-sm leading-relaxed mt-0.5" style="color:#1A2340;">
                                        {{ $soal->opsi_a }}
                                    </span>
                                </button>

                                {{-- Tombol B --}}
                                <button wire:click="pilihJawaban({{ $soal->id }}, 'B')"
                                        class="text-left p-4 rounded-xl border-2 transition-all flex items-start gap-3 group"
                                        style="
                                            border-color: {{ $jawabanUser === 'B' ? '#C8922A' : 'rgba(26,35,64,0.1)' }};
                                            background-color: {{ $jawabanUser === 'B' ? 'rgba(200,146,42,0.05)' : '#fff' }};
                                        ">
                                    <span class="w-6 h-6 rounded-full flex items-center justify-center shrink-0 text-xs font-bold transition-colors"
                                          style="
                                              background-color: {{ $jawabanUser === 'B' ? '#C8922A' : 'rgba(26,35,64,0.05)' }};
                                              color: {{ $jawabanUser === 'B' ? '#fff' : '#1A2340' }};
                                          ">B</span>
                                    <span class="text-xs md:text-sm leading-relaxed mt-0.5" style="color:#1A2340;">
                                        {{ $soal->opsi_b }}
                                    </span>
                                </button>
                            </div>

                        </div>
                    @endforeach
                </div>

                {{-- Tombol Submit Akhir --}}
                <div class="mt-8 flex justify-center">
                    <button wire:click="submitFinal"
                            @if(!$isComplete) disabled @endif
                            class="sim-btn-gold px-8 py-3.5 w-full md:w-auto text-sm disabled:opacity-50 disabled:cursor-not-allowed">
                        Selesaikan Pemetaan & Lihat Rapor <i class="ti ti-check ml-2 text-lg"></i>
                    </button>
                </div>

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
            <span class="text-[10px] font-semibold">Hasil Saya</span>
        </a>
    </nav>
</div>