<aside class="w-[220px] flex-col hidden md:flex shrink-0 relative" style="background-color:#1A2340;">
    <div class="absolute inset-0 siminat-batik" style="opacity:0.05;"></div>

    {{-- Logo --}}
    <div class="h-16 flex items-center px-5 relative" style="border-bottom:1px solid rgba(232,213,163,0.15);">
        <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3 shrink-0" style="background-color:#C8922A;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1A2340" stroke-width="3.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
        </div>
        <div>
            <span class="font-bold tracking-widest text-xs block" style="color:#FDF6E8;letter-spacing:0.12em;">SIMINAT</span>
            <span class="text-[10px]" style="color:rgba(253,246,232,0.4);">Admin Console</span>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 py-5 space-y-1 overflow-y-auto relative">

        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all
           {{ request()->routeIs('admin.dashboard') ? '' : 'hover:bg-white/10' }}"
           style="{{ request()->routeIs('admin.dashboard')
               ? 'background-color:rgba(200,146,42,0.15);color:#C8922A;border-left:3px solid #C8922A;'
               : 'color:rgba(253,246,232,0.65);' }}">
            <i class="ti ti-layout-dashboard mr-3 text-base"></i> Dashboard
        </a>

        <p class="px-4 pt-4 pb-1 text-[10px] font-bold uppercase tracking-widest" style="color:rgba(253,246,232,0.3);">Manajemen Pengguna</p>

        <a href="{{ route('admin.students') }}"
           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all
           {{ request()->routeIs('admin.students') ? '' : 'hover:bg-white/10' }}"
           style="{{ request()->routeIs('admin.students')
               ? 'background-color:rgba(200,146,42,0.15);color:#C8922A;border-left:3px solid #C8922A;'
               : 'color:rgba(253,246,232,0.65);' }}">
            <i class="ti ti-users mr-3 text-base"></i> Mahasiswa
        </a>

        <a href="{{ route('admin.lecturers') }}"
           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all
           {{ request()->routeIs('admin.lecturers') ? '' : 'hover:bg-white/10' }}"
           style="{{ request()->routeIs('admin.lecturers')
               ? 'background-color:rgba(200,146,42,0.15);color:#C8922A;border-left:3px solid #C8922A;'
               : 'color:rgba(253,246,232,0.65);' }}">
            <i class="ti ti-school mr-3 text-base"></i> Dosen
        </a>

        <a href="{{ route('admin.kelas') }}"
           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all
           {{ request()->routeIs('admin.kelas') ? '' : 'hover:bg-white/10' }}"
           style="{{ request()->routeIs('admin.kelas')
               ? 'background-color:rgba(200,146,42,0.15);color:#C8922A;border-left:3px solid #C8922A;'
               : 'color:rgba(253,246,232,0.65);' }}">
            <i class="ti ti-building mr-3 text-base"></i> Kelas
        </a>

        <p class="px-4 pt-4 pb-1 text-[10px] font-bold uppercase tracking-widest" style="color:rgba(253,246,232,0.3);">Asesmen</p>

        <a href="{{ route('admin.soal') }}"
           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all
           {{ request()->routeIs('admin.soal') ? '' : 'hover:bg-white/10' }}"
           style="{{ request()->routeIs('admin.soal')
               ? 'background-color:rgba(200,146,42,0.15);color:#C8922A;border-left:3px solid #C8922A;'
               : 'color:rgba(253,246,232,0.65);' }}">
            <i class="ti ti-clipboard-list mr-3 text-base"></i> Bank Soal
        </a>

        <a href="{{ route('admin.minat.kelompok') }}"
           class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all
           {{ request()->routeIs('admin.minat.kelompok') ? '' : 'hover:bg-white/10' }}"
           style="{{ request()->routeIs('admin.minat.kelompok')
               ? 'background-color:rgba(200,146,42,0.15);color:#C8922A;border-left:3px solid #C8922A;'
               : 'color:rgba(253,246,232,0.65);' }}">
            <i class="ti ti-chart-pie mr-3 text-base"></i> Pengelompokan Minat
        </a>

    </nav>

    {{-- Footer --}}
    <div class="p-4 relative" style="border-top:1px solid rgba(232,213,163,0.1);">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold shrink-0"
                 style="background-color:#C8922A;color:#1A2340;">
                {{ Auth::user()->initials() }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-semibold truncate" style="color:#FDF6E8;">{{ Auth::user()->nama }}</p>
                <p class="text-[10px]" style="color:rgba(253,246,232,0.4);">Administrator</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="mt-3">
            @csrf
            <button type="submit" class="flex items-center gap-2 text-xs font-medium w-full px-3 py-2 rounded-lg transition-all hover:bg-white/10"
                    style="color:rgba(253,246,232,0.5);">
                <i class="ti ti-logout text-sm"></i> Keluar
            </button>
        </form>
    </div>
</aside>
