<div class="flex h-screen bg-[#f4f6fa] w-full font-sans">
    
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col hidden md:flex z-20 shrink-0">
        <div class="h-20 flex items-center px-8 border-b border-gray-100">
            <div class="w-8 h-8 bg-[#2a3c5a] rounded-lg flex items-center justify-center text-white font-bold text-xl mr-3 shadow-md">S</div>
            <div>
                <h1 class="text-lg font-black text-[#2a3c5a] leading-tight tracking-tight uppercase">Project<br>Siminat</h1>
                <p class="text-[10px] text-gray-400 font-medium tracking-wider uppercase mt-0.5">Student Portal</p>
            </div>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('mahasiswa.dashboard') }}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#2a3c5a] rounded-xl font-semibold transition-all duration-200">
                <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            
            <a href="{{ route('mahasiswa.tes') }}" class="flex items-center px-4 py-3 bg-[#D98324] text-white rounded-xl font-semibold transition-all shadow-md shadow-orange-500/20">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                Assessments
            </a>
            <a href="{{ route('mahasiswa.results') }}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#2a3c5a] rounded-xl font-semibold transition-all duration-200">
                <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Results
            </a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <header class="h-20 bg-[#354765] flex items-center justify-between px-8 shadow-sm shrink-0 z-10">
            <div class="flex-1 max-w-xl relative">
                <input type="text" class="w-full bg-white/10 border-0 text-white placeholder-gray-400 rounded-xl px-4 py-3 text-sm" placeholder="Search assessments...">
            </div>

            <div class="flex items-center space-x-6 ml-6">
                <div class="flex items-center cursor-pointer group">
                    <div class="w-10 h-10 rounded-full bg-[#D98324] flex items-center justify-center text-white font-bold mr-3 border-2 border-white/20">
                        {{ substr(Auth::user()->nama ?? 'AS', 0, 2) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white leading-tight">{{ Auth::user()->nama ?? 'Andi Saputra' }}</p>
                        <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="text-xs text-red-300 hover:text-red-100 flex items-center">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-6 md:p-10">
            
            @if(!$hasStarted)
                @include('livewire.mahasiswa.tes.instruksi')
            @else
                @include('livewire.mahasiswa.tes.soal')
            @endif
            
        </div>
    </main>
</div>