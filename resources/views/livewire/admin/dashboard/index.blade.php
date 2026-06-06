<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    @include('partials.admin-sidebar')

    <main class="flex-1 flex flex-col overflow-hidden">

        {{-- Header --}}
        <header class="h-16 flex items-center justify-between px-8 shrink-0"
                style="background-color:#fff;border-bottom:1px solid rgba(26,35,64,0.08);">
            <div>
                <h1 class="text-base font-bold" style="color:#1A2340;">Dashboard Admin</h1>
                <p class="text-xs" style="color:#6B7494;">Ringkasan sistem SIMINAT</p>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">
            <div class="max-w-6xl mx-auto space-y-6">

                {{-- Stat Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">

                    <div class="sim-card p-5">
                        <div class="flex items-start justify-between mb-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color:rgba(45,63,107,0.1);">
                                <i class="ti ti-users text-xl" style="color:#2D3F6B;"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold" style="color:#1A2340;">{{ number_format($totalUsers) }}</h3>
                        <p class="text-xs font-semibold mt-1" style="color:#6B7494;">Total Pengguna</p>
                    </div>

                    <div class="sim-card p-5">
                        <div class="flex items-start justify-between mb-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color:rgba(200,146,42,0.1);">
                                <i class="ti ti-clipboard-check text-xl" style="color:#C8922A;"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold" style="color:#1A2340;">{{ number_format($activeAssessments) }}</h3>
                        <p class="text-xs font-semibold mt-1" style="color:#6B7494;">Mengerjakan Tes</p>
                    </div>

                    <div class="sim-card p-5">
                        <div class="flex items-start justify-between mb-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color:rgba(46,125,85,0.1);">
                                <i class="ti ti-circle-check text-xl" style="color:#2E7D55;"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold" style="color:#1A2340;">{{ $completionRate }}%</h3>
                        <p class="text-xs font-semibold mt-1" style="color:#6B7494;">Tingkat Penyelesaian</p>
                        <div class="mt-2 sim-progress-bar">
                            <div class="sim-progress-fill" style="width:{{ $completionRate }}%;background-color:#2E7D55;"></div>
                        </div>
                    </div>

                    <div class="sim-card p-5">
                        <div class="flex items-start justify-between mb-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color:rgba(200,146,42,0.1);">
                                <i class="ti ti-activity text-xl" style="color:#C8922A;"></i>
                            </div>
                        </div>
                        <h3 class="text-3xl font-bold" style="color:#2E7D55;">{{ $systemHealth }}</h3>
                        <p class="text-xs font-semibold mt-1" style="color:#6B7494;">System Health</p>
                        <p class="text-[10px] mt-0.5 flex items-center gap-1" style="color:#2E7D55;">
                            <i class="ti ti-check text-xs"></i> Semua sistem berjalan normal
                        </p>
                    </div>
                </div>

                {{-- Charts --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                    <div class="sim-card p-6 lg:col-span-2">
                        <div class="flex items-center justify-between mb-5">
                            <h3 class="text-base font-bold" style="color:#1A2340;">Tren Partisipasi</h3>
                            <span class="text-xs px-2.5 py-1 rounded-full font-semibold"
                                  style="background-color:rgba(200,146,42,0.1);color:#A6781F;">7 Hari Terakhir</span>
                        </div>
                        <div class="h-52">
                            <canvas id="participationChart"></canvas>
                        </div>
                    </div>

                    <div class="sim-card p-6">
                        <h3 class="text-base font-bold mb-5" style="color:#1A2340;">Navigasi Cepat</h3>
                        <div class="space-y-2">
                            <a href="{{ route('admin.students') }}"
                               class="flex items-center gap-3 p-3 rounded-xl transition-all hover:bg-cream"
                               style="border:1px solid rgba(26,35,64,0.07);" onmouseover="this.style.backgroundColor='rgba(232,213,163,0.2)'" onmouseout="this.style.backgroundColor=''">
                                <i class="ti ti-users text-xl" style="color:#C8922A;"></i>
                                <span class="text-sm font-semibold" style="color:#1A2340;">Kelola Mahasiswa</span>
                                <i class="ti ti-chevron-right ml-auto text-sm" style="color:#6B7494;"></i>
                            </a>
                            <a href="{{ route('admin.lecturers') }}"
                               class="flex items-center gap-3 p-3 rounded-xl transition-all"
                               style="border:1px solid rgba(26,35,64,0.07);" onmouseover="this.style.backgroundColor='rgba(232,213,163,0.2)'" onmouseout="this.style.backgroundColor=''">
                                <i class="ti ti-school text-xl" style="color:#C8922A;"></i>
                                <span class="text-sm font-semibold" style="color:#1A2340;">Kelola Dosen</span>
                                <i class="ti ti-chevron-right ml-auto text-sm" style="color:#6B7494;"></i>
                            </a>
                            <a href="{{ route('admin.kelas') }}"
                               class="flex items-center gap-3 p-3 rounded-xl transition-all"
                               style="border:1px solid rgba(26,35,64,0.07);" onmouseover="this.style.backgroundColor='rgba(232,213,163,0.2)'" onmouseout="this.style.backgroundColor=''">
                                <i class="ti ti-building text-xl" style="color:#C8922A;"></i>
                                <span class="text-sm font-semibold" style="color:#1A2340;">Kelola Kelas</span>
                                <i class="ti ti-chevron-right ml-auto text-sm" style="color:#6B7494;"></i>
                            </a>
                            <a href="{{ route('admin.soal') }}"
                               class="flex items-center gap-3 p-3 rounded-xl transition-all"
                               style="border:1px solid rgba(26,35,64,0.07);" onmouseover="this.style.backgroundColor='rgba(232,213,163,0.2)'" onmouseout="this.style.backgroundColor=''">
                                <i class="ti ti-clipboard-list text-xl" style="color:#C8922A;"></i>
                                <span class="text-sm font-semibold" style="color:#1A2340;">Bank Soal</span>
                                <i class="ti ti-chevron-right ml-auto text-sm" style="color:#6B7494;"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Activity Log --}}
                <div class="sim-card overflow-hidden">
                    <div class="px-6 py-4 flex items-center justify-between" style="border-bottom:1px solid rgba(26,35,64,0.07);">
                        <h3 class="text-base font-bold" style="color:#1A2340;">Registrasi Terbaru</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr style="background-color:rgba(253,246,232,0.5);border-bottom:1px solid rgba(26,35,64,0.07);">
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Aksi</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">NIM/NIDN</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Role</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($activityLogs as $log)
                                    <tr class="transition-all" style="border-bottom:1px solid rgba(26,35,64,0.04);"
                                        onmouseover="this.style.backgroundColor='rgba(232,213,163,0.15)'" onmouseout="this.style.backgroundColor=''">
                                        <td class="px-6 py-4 text-sm font-medium" style="color:#1A2340;">{{ $log['action'] }}</td>
                                        <td class="px-6 py-4 text-sm" style="color:#6B7494;">{{ $log['user'] }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2.5 py-1 text-xs font-bold rounded-full"
                                                  style="background-color:rgba(200,146,42,0.1);color:#A6781F;">
                                                {{ $log['role'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-xs" style="color:#6B7494;">{{ $log['time'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-sm" style="color:#6B7494;">
                                            Belum ada aktivitas.
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
        const data = @json($participationData);
        const ctx = document.getElementById('participationChart');
        if (!ctx) return;
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.labels,
                datasets: [{
                    data: data.data,
                    backgroundColor: data.data.map((_, i) => i === 2 ? '#C8922A' : 'rgba(200,146,42,0.2)'),
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { display: false, beginAtZero: true },
                    x: { grid: { display: false }, ticks: { color: '#6B7494', font: { size: 11 } } }
                }
            }
        });
    });
</script>
