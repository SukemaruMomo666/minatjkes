<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    {{-- ===== SIDEBAR (HANYA MUNCUL DI LAPTOP/TABLET) ===== --}}
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

    {{-- ===== MAIN AREA ===== --}}
    <main class="flex-1 flex flex-col overflow-hidden relative pb-16 md:pb-0">

        {{-- Navbar --}}
        <header class="h-16 flex items-center justify-between px-5 md:px-8 shrink-0 relative"
                style="background-color:#1A2340;border-bottom:1px solid rgba(232,213,163,0.15);">
            <div class="flex items-center gap-2 text-xs" style="color:rgba(253,246,232,0.45);">
                <i class="ti ti-clipboard-list text-sm"></i>
                <span class="hidden sm:inline">/</span>
                <span class="hidden sm:inline" style="color:rgba(253,246,232,0.7);">Pemetaan Potensi</span>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold" style="color:#FDF6E8;">{{ Auth::user()->nama ?? '' }}</p>
                </div>
                <div class="w-8 h-8 md:w-9 md:h-9 rounded-full flex items-center justify-center text-xs md:text-sm font-bold shrink-0"
                     style="background-color:#C8922A;color:#1A2340;">
                    {{ substr(Auth::user()->nama ?? 'AS', 0, 2) }}
                </div>
            </div>
        </header>

        {{-- Content Area --}}
        <div class="flex-1 overflow-y-auto p-4 md:p-8">
            @if(!$hasStarted)
                @include('livewire.mahasiswa.tes.instruksi')
            @else
                @include('livewire.mahasiswa.tes.soal')
            @endif
        </div>

    </main>

    {{-- ===== MOBILE BOTTOM NAVIGATION ===== --}}
    <nav class="md:hidden fixed bottom-0 left-0 right-0 z-50 flex justify-around items-center h-16 pb-safe"
         style="background-color:rgba(255,255,255,0.9); backdrop-filter:blur(10px); border-top:1px solid rgba(26,35,64,0.08); box-shadow:0 -4px 20px rgba(0,0,0,0.03);">
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