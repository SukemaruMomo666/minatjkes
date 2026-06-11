<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    {{-- ===== MAIN AREA (FULL WIDTH) ===== --}}
    <main class="w-full flex flex-col overflow-hidden relative">

        {{-- Navbar Minimalis --}}
        <header class="h-16 flex items-center justify-between px-5 md:px-8 shrink-0 relative"
                style="background-color:#1A2340;border-bottom:1px solid rgba(232,213,163,0.15);">
            <div class="flex items-center gap-2 text-xs" style="color:rgba(253,246,232,0.45);">
                <i class="ti ti-clipboard-list text-sm" style="color:#C8922A;"></i>
                <span class="font-bold tracking-widest text-xs" style="color:#FDF6E8;letter-spacing:0.15em;">SIMINAT ASESMEN</span>
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
</div>