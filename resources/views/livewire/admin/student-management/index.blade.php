<div class="flex h-screen bg-[#f4f7f6] w-full font-sans">

    <aside class="w-64 bg-[#1b2533] flex flex-col hidden md:flex z-20 shrink-0 text-gray-300">
        <div class="h-24 flex items-center px-6 border-b border-gray-700/30 mb-4 mt-2">
            <div class="w-12 h-12 bg-[#D98324] rounded-xl flex items-center justify-center text-white mr-3 shadow-md">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M4 4h6v6H4V4zm10 0h6v6h-6V4zM4 14h6v6H4v-6zm11 1h2v-2h2v2h2v2h-2v2h-2v-2h-2v-2z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-[15px] font-black text-white leading-tight tracking-wide uppercase">Project<br>Siminat</h1>
                <p class="text-[10px] text-gray-400 font-medium mt-0.5">Healthcare Admin Console</p>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-6 overflow-y-auto pb-4">
            
            <div>
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800/50 rounded-xl transition-all font-bold text-sm">
                    <svg class="w-5 h-5 mr-3 opacity-70" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg> 
                    Dashboard
                </a>
            </div>

            <div>
                <p class="px-4 text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-3">User Management</p>
                
                <a href="{{ route('admin.students') }}" class="flex items-center px-4 py-3 bg-[#D98324] text-white rounded-xl font-bold transition-all shadow-md text-sm">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> 
                    Students
                </a>
                
                <a href="{{ route('admin.lecturers') }}" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800/50 rounded-xl transition-all font-medium text-sm mt-1">
                    <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg> 
                    Lecturers
                </a>
            </div>

            <div>
                <p class="px-4 text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-3">Institution Data</p>
                
                <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800/50 rounded-xl transition-all font-medium text-sm">
                    <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg> 
                    Classes
                </a>
                
                <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800/50 rounded-xl transition-all font-medium text-sm mt-1">
                    <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg> 
                    Assessments
                </a>
                
                <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800/50 rounded-xl transition-all font-medium text-sm mt-1">
                    <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg> 
                    Reports
                </a>
                
                <a href="#" class="flex items-center px-4 py-3 text-gray-300 hover:text-white hover:bg-gray-800/50 rounded-xl transition-all font-medium text-sm mt-1">
                    <svg class="w-5 h-5 mr-3 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg> 
                    Settings
                </a>
            </div>
        </nav>

        <div class="p-4 border-t border-gray-700/30">
            <div class="flex items-center justify-between">
                <div class="flex items-center cursor-pointer">
                    <div class="w-11 h-11 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-sm tracking-wide mr-3 shadow-inner">
                        AU
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white leading-tight">Admin User</p>
                        <p class="text-[11px] text-gray-400 mt-0.5">System Admin</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-white transition p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <div class="flex-1 overflow-y-auto p-6 md:p-10 relative">
            <div class="max-w-6xl mx-auto">
                
                @if (session()->has('message'))
                    <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4 rounded-md flex items-center shadow-sm">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        <p class="text-sm text-green-700 font-medium">{{ session('message') }}</p>
                    </div>
                @endif

                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                    <div>
                        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Manajemen Mahasiswa</h2>
                        <p class="text-sm text-gray-500 mt-1">Manage enrolled students, academic status, and profiles.</p>
                    </div>
                    <button wire:click="openModal" class="px-5 py-2.5 bg-[#D98324] text-white font-bold rounded-lg hover:bg-[#c27520] transition shadow-md flex items-center text-sm">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                        New Student
                    </button>
                </div>

                <div class="bg-white p-4 rounded-t-2xl border-t border-l border-r border-gray-200 shadow-sm flex items-center justify-between">
                    <div class="relative w-full max-w-md">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" class="w-full bg-gray-50 border-0 text-gray-700 placeholder-gray-400 rounded-lg pl-10 pr-4 py-2 focus:ring-0 text-sm" placeholder="Search anything...">
                    </div>
                    <div class="flex items-center gap-4 text-gray-400">
                        <svg class="w-5 h-5 cursor-pointer hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <div class="h-6 w-px bg-gray-200"></div>
                        <svg class="w-5 h-5 cursor-pointer hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 shadow-sm rounded-b-2xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-100/70 text-gray-600 text-xs font-bold border-b border-gray-200">
                                    <th class="px-6 py-4">Student Name</th>
                                    <th class="px-6 py-4">Student ID (NIM)</th>
                                    <th class="px-6 py-4">Email Account</th>
                                    <th class="px-6 py-4">Status</th>
                                    <th class="px-6 py-4 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-700">
                                @forelse($students as $student)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold mr-3 shrink-0">
                                                {{ strtoupper(substr($student->nama ?? 'A', 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900">{{ $student->nama }}</p>
                                                <p class="text-[11px] text-gray-500">{{ $student->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-mono text-xs text-gray-500">{{ $student->nim_nidn ?? '-' }}</td>
                                    <td class="px-6 py-4 text-gray-500">{{ $student->email }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-3 py-1 text-[10px] font-bold rounded-full bg-green-100 text-green-600 border border-green-200">Active</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <button class="text-gray-400 hover:text-blue-500 transition px-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg></button>
                                        <button class="text-gray-400 hover:text-red-500 transition px-2"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                        Belum ada data mahasiswa terdaftar.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 bg-white border-t border-gray-100">
                        {{ $students->links() }}
                    </div>
                </div>

            </div>
        </div>
        
        @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-900/50 backdrop-blur-sm transition-opacity">
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg overflow-hidden transform transition-all">
                <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">Tambah Mahasiswa Baru</h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-red-500 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <form wire:submit.prevent="simpanMahasiswa" class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                        <input type="text" wire:model="nama" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#D98324] focus:border-transparent text-sm" placeholder="Contoh: Budi Santoso" required>
                        @error('nama') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">NIM (Nomor Induk Mahasiswa)</label>
                        <input type="text" wire:model="nim_nidn" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#D98324] focus:border-transparent text-sm" placeholder="Contoh: 10123001" required>
                        @error('nim_nidn') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Email</label>
                        <input type="email" wire:model="email" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#D98324] focus:border-transparent text-sm" placeholder="budi@siminat.edu" required>
                        @error('email') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Password Sementara</label>
                        <input type="password" wire:model="password" class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-[#D98324] focus:border-transparent text-sm" placeholder="Minimal 6 karakter" required>
                        @error('password') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-4 flex justify-end gap-3">
                        <button type="button" wire:click="closeModal" class="px-5 py-2.5 text-sm font-bold text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition">Batal</button>
                        <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-[#D98324] rounded-lg hover:bg-[#c27520] shadow-md transition flex items-center">
                            <span wire:loading.remove wire:target="simpanMahasiswa">Simpan Data</span>
                            <span wire:loading wire:target="simpanMahasiswa">Menyimpan...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif

    </main>
</div>