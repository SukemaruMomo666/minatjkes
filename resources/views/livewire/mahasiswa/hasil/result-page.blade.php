<div class="flex h-screen bg-[#f4f6fa] w-full font-sans">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col hidden md:flex z-20 shrink-0">
        <div class="h-20 flex items-center px-8 border-b border-gray-100">
            <div class="w-8 h-8 bg-[#2a3c5a] rounded-lg flex items-center justify-center text-white font-bold text-xl mr-3 shadow-md">S</div>
            <div>
                <h1 class="text-lg font-black text-[#2a3c5a] leading-tight tracking-tight uppercase">Project<br>Siminat</h1>
                <p class="text-[10px] text-gray-400 font-medium tracking-wider uppercase mt-0.5">Student Portal</p>
            </div>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('mahasiswa.dashboard') }}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#2a3c5a] rounded-xl font-semibold transition-all">
                <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg> Dashboard
            </a>
            <a href="{{ route('mahasiswa.tes') }}" class="flex items-center px-4 py-3 text-gray-500 hover:bg-gray-50 hover:text-[#2a3c5a] rounded-xl font-semibold transition-all">
                <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg> Assessments
            </a>
            <a href="{{ route('mahasiswa.results') }}" class="flex items-center px-4 py-3 bg-[#eed9c4] text-[#D98324] rounded-xl font-bold transition-all border-l-4 border-[#D98324]">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg> Results
            </a>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        <header class="h-20 bg-[#162744] flex items-center justify-between px-8 shadow-sm shrink-0 z-10">
            <div class="flex-1 max-w-xl relative">
                <input type="text" class="w-full bg-white/10 border-0 text-white placeholder-gray-400 rounded-xl px-4 py-3 text-sm" placeholder="Cari laporan atau saran...">
            </div>
            <div class="flex items-center space-x-6 ml-6">
                <div class="flex items-center cursor-pointer group">
                    <div class="w-10 h-10 rounded-full bg-[#D98324] flex items-center justify-center text-white font-bold mr-3 border-2 border-white/20">{{ substr(Auth::user()->nama ?? 'AS', 0, 2) }}</div>
                    <div>
                        <p class="text-sm font-bold text-white leading-tight">{{ Auth::user()->nama ?? 'Student' }}</p>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-6 md:p-10">
            <div class="max-w-6xl mx-auto">
                
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                    <div>
                        <h2 class="text-3xl font-extrabold text-[#162744]">Rapor Potensi Diri</h2>
                        <p class="text-sm text-gray-500 mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Penyelesaian Terakhir: {{ date('d F Y') }}
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <button class="px-5 py-2.5 border-2 border-[#D98324] text-[#D98324] font-bold rounded-lg hover:bg-orange-50 transition text-sm flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg> Download PDF Report
                        </button>
                        <button class="px-5 py-2.5 bg-[#D98324] text-white font-bold rounded-lg hover:bg-[#c27520] transition shadow-md text-sm flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg> Consult with Counselor
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 lg:col-span-2 flex flex-col relative">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-bold text-[#162744] text-lg">Kompetensi Bidang Kesehatan</h3>
                            <button class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></button>
                        </div>
                        
                        <div class="flex-1 flex justify-center items-center w-full min-h-[300px]">
                            <canvas id="radarChart"></canvas>
                        </div>

                        <div class="flex flex-wrap justify-center gap-4 mt-4 pt-4 border-t border-gray-50">
                            @foreach($topKategori as $nama => $skor)
                                <div class="flex items-center text-xs font-semibold text-gray-600">
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#D98324] mr-2"></span> {{ $nama }}: {{ $skor }}%
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex flex-col gap-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex-1 relative overflow-hidden">
                            <svg class="absolute -right-6 -top-6 w-32 h-32 text-gray-50 opacity-50" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 100 20 10 10 0 000-20zm0 18a8 8 0 110-16 8 8 0 010 16zm-1-11a1 1 0 112 0v4a1 1 0 11-2 0V9zm1 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                            <h3 class="font-bold text-[#162744] text-lg mb-4">Tipe Karir Anda</h3>
                            <div class="mb-4">
                                <h1 class="text-2xl font-black text-[#D98324] tracking-tight">{{ $tipeKepribadian }}</h1>
                            </div>
                            <p class="text-sm text-gray-500 leading-relaxed">{{ $deskripsiKepribadian }}</p>
                            
                            <div class="mt-6 space-y-3">
                                @foreach($topKategori as $nama => $skor)
                                    <div>
                                        <div class="flex justify-between text-xs font-bold text-gray-600 mb-1"><span>{{ $nama }}</span></div>
                                        <div class="w-full bg-gray-100 rounded-full h-1.5"><div class="bg-[#D98324] h-1.5 rounded-full" style="width: {{ $skor }}%"></div></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="bg-[#162744] p-6 rounded-2xl shadow-sm relative overflow-hidden">
                            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/5 rounded-full"></div>
                            <h3 class="font-bold text-white text-md mb-4 flex items-center">
                                <svg class="w-5 h-5 text-[#D98324] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                                Kekuatan Utama
                            </h3>
                            <ul class="space-y-3">
                                @php $index = 0; @endphp
                                @foreach($topKategori as $nama => $skor)
                                    @if($index < 2)
                                        <li class="flex items-start text-sm text-gray-300">
                                            <svg class="w-5 h-5 text-green-400 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Sangat dominan di bidang {{ $nama }}.
                                        </li>
                                    @endif
                                    @php $index++; @endphp
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <h3 class="font-bold text-[#162744] text-lg mb-4 mt-8">Rekomendasi Program Studi</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    @php 
                        $warnaBadge = ['text-green-500 bg-green-50', 'text-orange-500 bg-orange-50', 'text-blue-500 bg-blue-50'];
                        $i = 0;
                    @endphp
                    @foreach($topKategori as $nama => $skor)
                        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 cursor-pointer hover:border-[#D98324] hover:shadow-md transition">
                            <div class="flex justify-between items-center mb-3">
                                <span class="px-2 py-1 {{ $warnaBadge[$i%3] }} font-bold text-[10px] rounded-md">{{ $skor }}% MATCH</span>
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                            <h4 class="font-bold text-[#162744] text-md mb-1">{{ $nama }} Terapan</h4>
                            <p class="text-xs text-gray-500 line-clamp-2 mb-3">Sangat cocok untuk memperdalam spesialisasi karir Anda.</p>
                            <div class="flex gap-2">
                                <span class="px-2 py-1 bg-gray-100 text-gray-600 text-[9px] font-semibold rounded-md">Prioritas {{ $i+1 }}</span>
                            </div>
                        </div>
                        @php $i++; @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        const ctx = document.getElementById('radarChart').getContext('2d');
        
        const labels = @json($radarLabels);
        const dataSkor = @json($radarData);

        new Chart(ctx, {
            type: 'radar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Skor Potensi (%)',
                    data: dataSkor,
                    backgroundColor: 'rgba(217, 131, 36, 0.2)',
                    borderColor: '#D98324',
                    pointBackgroundColor: '#162744',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: '#D98324',
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        angleLines: { color: 'rgba(0, 0, 0, 0.05)' },
                        grid: { color: 'rgba(0, 0, 0, 0.05)' },
                        pointLabels: {
                            color: '#162744',
                            font: { family: "'Inter', sans-serif", size: 11, weight: 'bold' }
                        },
                        ticks: { display: false, min: 0, max: 100 }
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#162744',
                        titleFont: { family: "'Inter', sans-serif", size: 13 },
                        bodyFont: { family: "'Inter', sans-serif", size: 12 },
                        padding: 10,
                        cornerRadius: 8,
                        displayColors: false,
                        callbacks: {
                            label: function(context) { return context.raw + '% Match'; }
                        }
                    }
                }
            }
        });
    });
</script>