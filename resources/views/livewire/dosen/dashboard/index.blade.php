<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    {{-- SIDEBAR --}}
    <aside class="w-[220px] flex-col hidden md:flex shrink-0 relative" style="background-color:#1A2340;">
        <div class="absolute inset-0 siminat-batik" style="opacity:0.05;"></div>
        <div class="h-16 flex items-center px-5 relative" style="border-bottom:1px solid rgba(232,213,163,0.15);">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3 shrink-0" style="background-color:#C8922A;">
                <i class="ti ti-plus font-bold" style="color:#1A2340;font-size:15px;"></i>
            </div>
            <div>
                <span class="font-bold tracking-widest text-xs block" style="color:#FDF6E8;letter-spacing:0.12em;">SIMINAT</span>
                <span class="text-[10px]" style="color:rgba(253,246,232,0.4);">Portal Dosen</span>
            </div>
        </div>
        <nav class="flex-1 px-3 py-5 space-y-1 relative">
            <a href="{{ route('dosen.dashboard') }}"
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold"
               style="background-color:rgba(200,146,42,0.15);color:#C8922A;border-left:3px solid #C8922A;">
                <i class="ti ti-layout-dashboard mr-3 text-base"></i> Dashboard
            </a>
        </nav>
        <div class="p-4 relative" style="border-top:1px solid rgba(232,213,163,0.1);">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold shrink-0"
                     style="background-color:#C8922A;color:#1A2340;">
                    {{ Auth::user()->initials() }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-semibold truncate" style="color:#FDF6E8;">{{ Auth::user()->nama }}</p>
                    <p class="text-[10px]" style="color:rgba(253,246,232,0.4);">Dosen</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="flex items-center gap-2 text-xs font-medium w-full px-3 py-2 rounded-lg hover:bg-white/10"
                        style="color:rgba(253,246,232,0.5);">
                    <i class="ti ti-logout text-sm"></i> Keluar
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN --}}
    <main class="flex-1 flex flex-col overflow-hidden">

        <header class="h-16 flex items-center justify-between px-8 shrink-0"
                style="background-color:#fff;border-bottom:1px solid rgba(26,35,64,0.08);">
            <div>
                <h1 class="text-base font-bold" style="color:#1A2340;">Dashboard Dosen</h1>
                <p class="text-xs" style="color:#6B7494;">Selamat datang, {{ $dosenNama }}. Pantau kemajuan mahasiswa bimbingan kamu.</p>
            </div>
            <button onclick="window.print()"
                    class="sim-btn-ghost text-sm">
                <i class="ti ti-download"></i> Ekspor Data
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-6xl mx-auto space-y-6">

                {{-- Stat Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                    <div class="sim-card p-5">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background-color:rgba(45,63,107,0.1);">
                            <i class="ti ti-users text-xl" style="color:#2D3F6B;"></i>
                        </div>
                        <h3 class="text-3xl font-bold" style="color:#1A2340;">{{ $totalMahasiswa }}</h3>
                        <p class="text-xs font-semibold mt-1" style="color:#6B7494;">Total Mahasiswa</p>
                    </div>
                    <div class="sim-card p-5">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background-color:rgba(46,125,85,0.1);">
                            <i class="ti ti-circle-check text-xl" style="color:#2E7D55;"></i>
                        </div>
                        <h3 class="text-3xl font-bold" style="color:#1A2340;">{{ $asesmenSelesai }}</h3>
                        <p class="text-xs font-semibold mt-1" style="color:#6B7494;">Asesmen Selesai</p>
                    </div>
                    <div class="sim-card p-5">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background-color:rgba(200,146,42,0.1);">
                            <i class="ti ti-clock text-xl" style="color:#C8922A;"></i>
                        </div>
                        <h3 class="text-3xl font-bold" style="color:#1A2340;">{{ $sedangProses }}</h3>
                        <p class="text-xs font-semibold mt-1" style="color:#6B7494;">Sedang Proses</p>
                    </div>
                    <div class="sim-card p-5">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center mb-3" style="background-color:rgba(180,69,47,0.1);">
                            <i class="ti ti-alert-circle text-xl" style="color:#B4452F;"></i>
                        </div>
                        <h3 class="text-3xl font-bold" style="color:#1A2340;">{{ $belumMulai }}</h3>
                        <p class="text-xs font-semibold mt-1" style="color:#6B7494;">Belum Mulai</p>
                    </div>
                </div>

                {{-- Charts --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                    <div class="sim-card p-6 lg:col-span-2">
                        <div class="flex items-center justify-between mb-5">
                            <h3 class="text-base font-bold" style="color:#1A2340;">Distribusi Minat per Kelas</h3>
                            <div class="flex items-center gap-1.5 text-xs font-semibold" style="color:#6B7494;">
                                <span class="w-3 h-3 rounded-full inline-block" style="background-color:#C8922A;"></span> Minat Utama
                            </div>
                        </div>
                        <div class="h-52">
                            <canvas id="barChart"></canvas>
                        </div>
                        @if(empty($distribusiMinat['labels']))
                            <p class="text-xs text-center mt-4" style="color:#6B7494;">Data tersedia setelah mahasiswa menyelesaikan tes.</p>
                        @endif
                    </div>

                    <div class="sim-card p-6">
                        <h3 class="text-base font-bold mb-5" style="color:#1A2340;">Peta Kompetensi Kelas</h3>
                        <div class="h-52 flex justify-center items-center">
                            <canvas id="radarChart"></canvas>
                        </div>
                        @if(empty($petaKompetensi['labels']))
                            <p class="text-xs text-center" style="color:#6B7494;">Belum ada data.</p>
                        @endif
                    </div>
                </div>

                {{-- Rata kecocokan banner --}}
                @if($rataKecocokan > 0)
                    <div class="rounded-2xl px-6 py-4 flex items-center gap-4 relative overflow-hidden" style="background-color:#1A2340;">
                        <div class="absolute inset-0 siminat-batik" style="opacity:0.06;"></div>
                        <i class="ti ti-star-filled text-3xl relative" style="color:#C8922A;"></i>
                        <div class="relative">
                            <p class="text-xs font-bold uppercase tracking-widest mb-0.5" style="color:rgba(253,246,232,0.5);">Rata-rata Kecocokan Minat</p>
                            <p class="text-2xl font-display font-bold" style="color:#C8922A;">{{ $rataKecocokan }}%</p>
                        </div>
                    </div>
                @endif

                {{-- Tabel Hasil --}}
                <div class="sim-card overflow-hidden">
                    <div class="px-6 py-4 flex items-center justify-between" style="border-bottom:1px solid rgba(26,35,64,0.07);">
                        <h3 class="text-base font-bold" style="color:#1A2340;">Hasil Asesmen Mahasiswa</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr style="background-color:rgba(253,246,232,0.6);border-bottom:1px solid rgba(26,35,64,0.07);">
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Mahasiswa</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Kelas</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Minat Utama</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Skor</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($hasilAsesmen as $mhs)
                                    <tr style="border-bottom:1px solid rgba(26,35,64,0.04);"
                                        onmouseover="this.style.backgroundColor='rgba(232,213,163,0.1)'" onmouseout="this.style.backgroundColor=''">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold shrink-0"
                                                     style="background-color:rgba(200,146,42,0.1);color:#C8922A;">
                                                    {{ substr($mhs['nama'], 0, 2) }}
                                                </div>
                                                <div>
                                                    <p class="text-sm font-semibold" style="color:#1A2340;">{{ $mhs['nama'] }}</p>
                                                    <p class="text-xs" style="color:#6B7494;">{{ $mhs['nim'] }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm" style="color:#2D3F6B;">{{ $mhs['kelas'] }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2.5 py-1 text-xs font-bold rounded-full"
                                                  style="background-color:rgba(45,63,107,0.1);color:#2D3F6B;">
                                                {{ $mhs['kategori_utama'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <div class="w-16 h-1.5 rounded-full overflow-hidden" style="background-color:rgba(26,35,64,0.08);">
                                                    <div class="h-full rounded-full" style="width:{{ $mhs['skor_utama'] }}%;background-color:#C8922A;"></div>
                                                </div>
                                                <span class="text-sm font-bold" style="color:#C8922A;">{{ $mhs['skor_utama'] }}%</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($mhs['status'] === 'Selesai')
                                                <span class="px-2.5 py-1 text-xs font-bold rounded-full"
                                                      style="background-color:rgba(46,125,85,0.1);color:#2E7D55;">Selesai</span>
                                            @else
                                                <span class="px-2.5 py-1 text-xs font-bold rounded-full"
                                                      style="background-color:rgba(200,146,42,0.1);color:#A6781F;">{{ $mhs['status'] }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-10 text-center text-sm" style="color:#6B7494;">
                                            Belum ada mahasiswa yang mengerjakan tes.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        const distribusi = @json($distribusiMinat);
        const kompetensi = @json($petaKompetensi);

        const barEl = document.getElementById('barChart');
        if (barEl && distribusi.labels && distribusi.labels.length > 0) {
            new Chart(barEl, {
                type: 'bar',
                data: {
                    labels: distribusi.labels,
                    datasets: [{
                        data: distribusi.data,
                        backgroundColor: '#C8922A',
                        borderRadius: 8,
                        barPercentage: 0.5,
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(26,35,64,0.05)' }, ticks: { color: '#6B7494', font: { size: 10 } } },
                        x: { grid: { display: false }, ticks: { color: '#6B7494', font: { size: 10 } } }
                    }
                }
            });
        }

        const radarEl = document.getElementById('radarChart');
        if (radarEl && kompetensi.labels && kompetensi.labels.length > 0) {
            new Chart(radarEl, {
                type: 'radar',
                data: {
                    labels: kompetensi.labels,
                    datasets: [{
                        data: kompetensi.data,
                        backgroundColor: 'rgba(200,146,42,0.18)',
                        borderColor: '#C8922A',
                        pointBackgroundColor: '#1A2340',
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    scales: {
                        r: {
                            angleLines: { color: 'rgba(26,35,64,0.07)' },
                            grid: { color: 'rgba(26,35,64,0.07)' },
                            pointLabels: { display: false },
                            ticks: { display: false },
                            suggestedMin: 0, suggestedMax: 100,
                        }
                    },
                    plugins: { legend: { display: false } }
                }
            });
        }
    });
</script>
