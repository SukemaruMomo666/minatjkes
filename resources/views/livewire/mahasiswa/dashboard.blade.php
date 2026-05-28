<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal - SIMINAT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#f4f6f8] text-gray-800 h-screen overflow-hidden flex">

    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between hidden md:flex z-20 shadow-sm">
        <div>
            <div class="px-6 py-6">
                <h1 class="text-lg font-bold text-gray-900 tracking-tight">PROJECT SIMINAT</h1>
                <p class="text-sm text-gray-500 font-medium mt-1">Student Portal</p>
            </div>

            <nav class="px-4 mt-2 space-y-1">
                <a href="{{ route('mahasiswa.dashboard') }}" class="flex items-center px-4 py-3 bg-[#D98324] text-white rounded-xl font-medium transition shadow-sm shadow-orange-500/20">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>
                
                <a href="{{ route('mahasiswa.tes') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition">
                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Assessments
                </a>
                
                <a href="{{ route('mahasiswa.results') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition">
                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    Results
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition">
                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4"></path></svg>
                    Personality Map
                </a>
                <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 rounded-xl font-medium transition">
                    <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Settings
                </a>
            </nav>
        </div>

        <div class="p-6 border-t border-gray-100 flex items-center">
            <div class="w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center text-white mr-3 shadow-inner">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path></svg>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-900 leading-tight">Univ. Kebangsaan</p>
                <p class="text-xs text-gray-500">Official Partner</p>
            </div>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <header class="h-20 bg-[#657694] px-8 flex items-center justify-between shrink-0">
            <div class="relative w-96">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" class="block w-full pl-10 pr-3 py-2.5 border-none rounded-xl bg-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-white/50 text-sm" placeholder="Cari asesmen atau materi...">
            </div>

            <div class="flex items-center space-x-6">
                <button class="relative p-1 text-white hover:text-gray-200 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-1 right-1 block h-2.5 w-2.5 rounded-full ring-2 ring-[#657694] bg-red-500"></span>
                </button>
                <div class="flex items-center cursor-pointer">
                    <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-[#657694] font-bold mr-3 border-2 border-white/30">
                        AF
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white leading-tight">Ahmad Faisal</p>
                        <p class="text-xs text-gray-300">Mahasiswa Kedokteran</p>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 space-y-6">
            
            <div class="bg-white rounded-2xl p-6 flex justify-between items-center shadow-sm border border-gray-100">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">Selamat Datang Kembali, Ahmad Faisal!</h2>
                    <p class="text-sm text-gray-500 mt-1 flex items-center">
                        <svg class="w-4 h-4 text-green-500 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Anda telah menyelesaikan 85% dari kurikulum asesmen tahun ini.
                    </p>
                </div>
                <button class="bg-[#D98324] hover:bg-[#c27520] text-white px-6 py-3 rounded-xl font-semibold shadow-sm transition flex items-center text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Lanjut Asesmen
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-green-600 bg-green-50 px-2.5 py-1 rounded-full">+2 New</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Asesmen Selesai</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">12</h3>
                    </div>
                </div>
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-lg bg-red-50 text-red-500 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-red-600 bg-red-50 px-2.5 py-1 rounded-full">2 Deadline</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Asesmen Tertunda</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">3</h3>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-lg bg-orange-50 text-orange-500 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-orange-700 bg-orange-50 px-2.5 py-1 rounded-full">Top 10%</span>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Skor Kepribadian Rata-rata</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">88.4</h3>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div class="flex justify-between items-start mb-4">
                        <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                        </div>
                        <span class="text-xs font-bold text-blue-600">On Track</span>
                    </div>
                    <div class="w-full">
                        <div class="flex justify-between mb-1">
                            <span class="text-sm font-medium text-gray-500">Progress Studi</span>
                            <span class="text-sm font-bold text-gray-900">85%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-[#D98324] h-2 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 lg:col-span-2">
                    <div class="flex justify-between items-center mb-6 border-b border-gray-100 pb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Pemetaan Kepribadian & Potensi</h3>
                            <p class="text-sm text-gray-500 mt-1">Visualisasi kompetensi berdasarkan hasil asesmen komprehensif</p>
                        </div>
                        <button class="text-[#D98324] text-sm font-bold flex items-center hover:text-orange-700 transition">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Unduh PDF
                        </button>
                    </div>
                    
                    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                        <div class="relative w-64 h-64 flex items-center justify-center">
                            <svg class="absolute w-full h-full text-gray-200" viewBox="0 0 100 100">
                                <polygon points="50,5 95,35 75,90 25,90 5,35" fill="none" stroke="currentColor" stroke-width="1"/>
                                <polygon points="50,20 80,42 67,80 33,80 20,42" fill="none" stroke="currentColor" stroke-width="1"/>
                                <polygon points="50,35 65,49 58,70 42,70 35,49" fill="none" stroke="currentColor" stroke-width="1"/>
                                <line x1="50" y1="50" x2="50" y2="5" stroke="currentColor" stroke-width="1"/>
                                <line x1="50" y1="50" x2="95" y2="35" stroke="currentColor" stroke-width="1"/>
                                <line x1="50" y1="50" x2="75" y2="90" stroke="currentColor" stroke-width="1"/>
                                <line x1="50" y1="50" x2="25" y2="90" stroke="currentColor" stroke-width="1"/>
                                <line x1="50" y1="50" x2="5" y2="35" stroke="currentColor" stroke-width="1"/>
                            </svg>
                            <svg class="absolute w-full h-full text-[#D98324]/20" viewBox="0 0 100 100">
                                <polygon points="50,15 85,38 60,85 30,75 15,40" fill="currentColor" stroke="#D98324" stroke-width="2" stroke-linejoin="round"/>
                            </svg>
                            <span class="absolute top-0 text-[10px] font-bold text-gray-600">EMPATHY</span>
                            <span class="absolute right-0 top-1/3 text-[10px] font-bold text-gray-600">ANALYTICAL</span>
                            <span class="absolute right-4 bottom-2 text-[10px] font-bold text-gray-600">LEADERSHIP</span>
                            <span class="absolute left-4 bottom-2 text-[10px] font-bold text-gray-600">TECHNICAL</span>
                            <span class="absolute left-0 top-1/3 text-[10px] font-bold text-gray-600">COMM.</span>
                        </div>

                        <div class="flex-1 space-y-4 w-full">
                            <div class="bg-blue-50/50 p-4 rounded-xl border border-blue-100">
                                <h4 class="text-sm font-bold text-[#657694] mb-2">Kekuatan Utama: Empathy (92%)</h4>
                                <p class="text-sm text-gray-600 leading-relaxed">Anda memiliki kecenderungan tinggi untuk memahami kebutuhan pasien secara emosional, sangat cocok untuk peran klinis.</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                <h4 class="text-sm font-bold text-[#657694] mb-2">Area Pengembangan: Technical</h4>
                                <p class="text-sm text-gray-600 leading-relaxed">Tingkatkan efisiensi penggunaan perangkat lunak medis melalui modul simulasi SIMINAT.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-[#657694] mb-6">Rekomendasi Jalur Karir</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-center">
                            <div class="relative w-14 h-14 flex items-center justify-center shrink-0">
                                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                                    <path class="text-gray-100" stroke-width="3" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="text-green-500" stroke-dasharray="98, 100" stroke-width="3" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                </svg>
                                <span class="absolute text-xs font-bold text-gray-800">98%</span>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-bold text-gray-900">Clinical Specialist</h4>
                                <p class="text-xs text-gray-500 mt-0.5">High match based on personality</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <div class="relative w-14 h-14 flex items-center justify-center shrink-0">
                                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                                    <path class="text-gray-100" stroke-width="3" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="text-[#D98324]" stroke-dasharray="85, 100" stroke-width="3" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                </svg>
                                <span class="absolute text-xs font-bold text-gray-800">85%</span>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-bold text-gray-900">Hospital Admin</h4>
                                <p class="text-xs text-gray-500 mt-0.5">Strong organizational skills</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="relative w-14 h-14 flex items-center justify-center shrink-0">
                                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 36 36">
                                    <path class="text-gray-100" stroke-width="3" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                    <path class="text-blue-500" stroke-dasharray="72, 100" stroke-width="3" stroke-linecap="round" stroke="currentColor" fill="none" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                </svg>
                                <span class="absolute text-xs font-bold text-gray-800">72%</span>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-bold text-gray-900">Medical Researcher</h4>
                                <p class="text-xs text-gray-500 mt-0.5">Moderate analytical profile</p>
                            </div>
                        </div>
                    </div>

                    <button class="w-full mt-8 py-2.5 border-2 border-[#D98324] text-[#D98324] rounded-xl font-bold hover:bg-[#D98324] hover:text-white transition text-sm">
                        Lihat Semua Jalur
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-[#657694] mb-6">Aktivitas Terbaru</h3>
                
                <div class="relative pl-4 space-y-8">
                    <div class="absolute left-5 top-2 bottom-2 w-0.5 bg-gray-200"></div>

                    <div class="relative flex items-start justify-between">
                        <div class="flex items-start">
                            <div class="absolute left-[-5px] mt-1 w-3 h-3 bg-green-500 rounded-full ring-4 ring-white z-10"></div>
                            <div class="ml-6">
                                <h4 class="text-sm font-bold text-gray-900">Asesmen Etika Kedokteran Selesai</h4>
                                <p class="text-sm text-gray-500 mt-1">Skor: 92/100 (Sangat Baik)</p>
                            </div>
                        </div>
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-3 py-1 rounded-full">Hari ini, 09:45</span>
                    </div>

                    <div class="relative flex items-start justify-between">
                        <div class="flex items-start">
                            <div class="absolute left-[-5px] mt-1 w-3 h-3 bg-[#D98324] rounded-full ring-4 ring-white z-10"></div>
                            <div class="ml-6">
                                <h4 class="text-sm font-bold text-gray-900">Update Profil Psikologis</h4>
                                <p class="text-sm text-gray-500 mt-1">Indikator 'Kepemimpinan' meningkat 5%</p>
                            </div>
                        </div>
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-3 py-1 rounded-full">Kemarin, 14:20</span>
                    </div>

                    <div class="relative flex items-start justify-between">
                        <div class="flex items-start">
                            <div class="absolute left-[-5px] mt-1 w-3 h-3 bg-[#657694] rounded-full ring-4 ring-white z-10"></div>
                            <div class="ml-6">
                                <h4 class="text-sm font-bold text-gray-900">Tes Bakat Skolastik Dimulai</h4>
                                <p class="text-sm text-gray-500 mt-1">Belum selesai - 45 menit tersisa</p>
                            </div>
                        </div>
                        <span class="text-xs font-medium text-gray-500 bg-gray-100 px-3 py-1 rounded-full">2 hari lalu</span>
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>