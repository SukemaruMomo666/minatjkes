<div class="flex h-screen bg-[#f4f7f6] w-full font-sans">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <aside class="w-64 bg-[#1e293b] flex flex-col hidden md:flex z-20 shrink-0 text-gray-300">
        <div class="h-24 flex items-center px-6 border-b border-gray-700/50 mb-4">
            <div class="w-10 h-10 bg-[#D98324] rounded-lg flex items-center justify-center text-white font-bold text-xl mr-3 shadow-md">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z"></path></svg>
            </div>
            <div>
                <h1 class="text-sm font-black text-white leading-tight tracking-wider uppercase">Project<br>Siminat</h1>
                <p class="text-[10px] text-gray-400 font-medium mt-1">Healthcare Admin Console</p>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-6 overflow-y-auto pb-4">
            <div>
                <a href="#" class="flex items-center px-4 py-3 bg-[#D98324] text-white rounded-lg font-bold transition-all shadow-md">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
            </div>

            <div>
                <p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">User Management</p>
                <a href="#" class="flex items-center px-4 py-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all text-sm font-medium">
                    <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> Students
                </a>
                <a href="#" class="flex items-center px-4 py-2 mt-1 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all text-sm font-medium">
                    <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg> Lecturers
                </a>
            </div>

            <div>
                <p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">Institution Data</p>
                <a href="#" class="flex items-center px-4 py-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all text-sm font-medium">
                    <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg> Classes
                </a>
                <a href="#" class="flex items-center px-4 py-2 mt-1 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all text-sm font-medium">
                    <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg> Assessments
                </a>
                <a href="#" class="flex items-center px-4 py-2 mt-1 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all text-sm font-medium">
                    <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg> Reports
                </a>
                <a href="#" class="flex items-center px-4 py-2 mt-1 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all text-sm font-medium">
                    <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> Settings
                </a>
            </div>
        </nav>

        <div class="p-4 border-t border-gray-700/50">
            <div class="flex items-center justify-between">
                <div class="flex items-center cursor-pointer">
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=3b82f6&color=fff" class="w-10 h-10 rounded-full border-2 border-gray-600 mr-3">
                    <div>
                        <p class="text-sm font-bold text-white leading-tight">Admin User</p>
                        <p class="text-[10px] text-gray-400">System Admin</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <header class="h-20 bg-white flex items-center justify-between px-8 shrink-0 z-10">
            <div class="flex-1 max-w-2xl relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" class="w-full bg-gray-50 border border-gray-200 text-gray-700 placeholder-gray-400 rounded-lg pl-11 pr-4 py-2.5 focus:ring-2 focus:ring-[#D98324] focus:border-transparent transition text-sm" placeholder="Search...">
            </div>
            <div class="flex items-center space-x-4 ml-6 text-gray-400">
                <button class="hover:text-gray-600 transition"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg></button>
                <button class="hover:text-gray-600 transition"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></button>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-6 md:p-10">
            <div class="max-w-6xl mx-auto">
                
                <div class="mb-8">
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Dashboard Overview</h2>
                    <p class="text-sm text-gray-500 mt-1">Key metrics and recent system activity.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between h-36">
                        <div class="flex justify-between items-start">
                            <p class="text-sm font-semibold text-gray-500">Total Users</p>
                            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg></div>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-gray-900">{{ number_format($totalUsers) }}</h3>
                            <p class="text-xs text-gray-400 mt-1"><span class="text-green-500 font-bold">&#8599; 4.2%</span> vs last month</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between h-36">
                        <div class="flex justify-between items-start">
                            <p class="text-sm font-semibold text-gray-500">Active Assessments</p>
                            <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center text-[#D98324]"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg></div>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-gray-900">{{ number_format($activeAssessments) }}</h3>
                            <p class="text-xs text-gray-400 mt-1"><span class="text-green-500 font-bold">&#8599; 12%</span> vs last week</p>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between h-36">
                        <div class="flex justify-between items-start">
                            <p class="text-sm font-semibold text-gray-500">Completion Rate</p>
                            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-gray-900">{{ $completionRate }}%</h3>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                                <div class="bg-[#D98324] h-1.5 rounded-full" style="width: {{ $completionRate }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between h-36">
                        <div class="flex justify-between items-start">
                            <p class="text-sm font-semibold text-gray-500">System Health</p>
                            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center text-green-500"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
                        </div>
                        <div>
                            <h3 class="text-3xl font-bold text-green-500">{{ $systemHealth }}</h3>
                            <p class="text-xs text-gray-500 mt-1 flex items-center"><svg class="w-3 h-3 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> All systems operational</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-gray-900 text-lg">Participation Trends</h3>
                        <div class="flex bg-gray-100 rounded-lg p-1 text-xs font-semibold">
                            <button class="px-3 py-1 text-gray-500 hover:text-gray-900 rounded-md transition">7D</button>
                            <button class="px-3 py-1 bg-[#D98324] text-white rounded-md shadow-sm">30D</button>
                            <button class="px-3 py-1 text-gray-500 hover:text-gray-900 rounded-md transition">YTD</button>
                        </div>
                    </div>
                    <div class="w-full h-64 border border-gray-100 rounded-xl p-4 bg-gray-50/50">
                        <canvas id="participationChart"></canvas>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="font-bold text-gray-900 text-lg">System Activity Log</h3>
                        <a href="#" class="text-sm font-bold text-[#D98324] hover:underline">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100/50 text-gray-600 text-sm font-bold border-b border-gray-200">
                                    <th class="px-6 py-3">Recent Actions</th>
                                    <th class="px-6 py-3">User</th>
                                    <th class="px-6 py-3">Role</th>
                                    <th class="px-6 py-3">Timestamp</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700">
                                @foreach($activityLogs as $log)
                                <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 flex items-center font-medium">
                                        @if(str_contains(strtolower($log['action']), 'created'))
                                            <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        @elseif(str_contains(strtolower($log['action']), 'updated'))
                                            <svg class="w-5 h-5 text-orange-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        @elseif(str_contains(strtolower($log['action']), 'failed'))
                                            <svg class="w-5 h-5 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        @else
                                            <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                        @endif
                                        {{ $log['action'] }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-500">{{ $log['user'] }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 text-[10px] font-bold rounded-md {{ $log['color'] }}">{{ $log['role'] }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500 text-xs">{{ $log['time'] }}</td>
                                </tr>
                                @endforeach
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
        const chartData = @json($participationData);
        
        if(document.getElementById('participationChart')) {
            const ctx = document.getElementById('participationChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Assessments Taken',
                        data: chartData.data,
                        backgroundColor: function(context) {
                            const index = context.dataIndex;
                            return index === 2 ? '#D98324' : '#cbd5e1'; 
                        },
                        borderRadius: 4,
                        borderSkipped: false,
                        barPercentage: 0.8,
                        categoryPercentage: 0.9
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { display: false, beginAtZero: true },
                        x: { display: false } 
                    }
                }
            });
        }
    });
</script>