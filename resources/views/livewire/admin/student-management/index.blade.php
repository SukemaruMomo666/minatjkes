<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    @include('partials.admin-sidebar')

    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="h-16 flex items-center justify-between px-8 shrink-0"
                style="background-color:#fff;border-bottom:1px solid rgba(26,35,64,0.08);">
            <div>
                <h1 class="text-base font-bold" style="color:#1A2340;">Manajemen Mahasiswa</h1>
                <p class="text-xs" style="color:#6B7494;">Kelola data mahasiswa terdaftar</p>
            </div>
            <button wire:click="openModal()" class="sim-btn-gold text-sm">
                <i class="ti ti-user-plus"></i> Tambah Mahasiswa
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-8">

            @if(session()->has('message'))
                <div class="mb-4 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-2"
                     style="background-color:rgba(46,125,85,0.1);color:#2E7D55;border:1px solid rgba(46,125,85,0.2);">
                    <i class="ti ti-circle-check"></i> {{ session('message') }}
                </div>
            @endif

            <div class="sim-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr style="background-color:rgba(253,246,232,0.6);border-bottom:1px solid rgba(26,35,64,0.07);">
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Mahasiswa</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">NIM</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Kelas</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Email</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Terdaftar</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider text-center" style="color:#6B7494;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($students as $student)
                                <tr style="border-bottom:1px solid rgba(26,35,64,0.04);"
                                    onmouseover="this.style.backgroundColor='rgba(232,213,163,0.1)'"
                                    onmouseout="this.style.backgroundColor=''">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-bold shrink-0"
                                                 style="background-color:rgba(200,146,42,0.1);color:#C8922A;">
                                                {{ $student->initials() }}
                                            </div>
                                            <p class="text-sm font-semibold" style="color:#1A2340;">{{ $student->nama }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-mono" style="color:#2D3F6B;">{{ $student->nim_nidn }}</td>
                                    <td class="px-6 py-4">
                                        @if($student->kelas)
                                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full"
                                                  style="background-color:rgba(45,63,107,0.08);color:#2D3F6B;">
                                                {{ $student->kelas->nama_kelas }}
                                            </span>
                                        @else
                                            <span class="text-xs" style="color:#B4452F;">
                                                <i class="ti ti-alert-circle text-xs mr-1"></i>Belum ada kelas
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm" style="color:#6B7494;">{{ $student->email ?? '—' }}</td>
                                    <td class="px-6 py-4 text-xs" style="color:#6B7494;">
                                        {{ $student->created_at?->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <button wire:click="openModal({{ $student->id }})"
                                                    class="p-1.5 rounded-lg transition-all"
                                                    style="color:#C8922A;" title="Edit">
                                                <i class="ti ti-pencil text-base"></i>
                                            </button>
                                            <button wire:click="hapus({{ $student->id }})"
                                                    wire:confirm="Hapus mahasiswa {{ $student->nama }}? Semua data jawabannya juga akan terpengaruh."
                                                    class="p-1.5 rounded-lg transition-all"
                                                    style="color:#B4452F;" title="Hapus">
                                                <i class="ti ti-trash text-base"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-10 text-center text-sm" style="color:#6B7494;">
                                        Belum ada data mahasiswa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4" style="border-top:1px solid rgba(26,35,64,0.07);">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </main>

    {{-- Modal Tambah / Edit Mahasiswa --}}
    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4"
             style="background-color:rgba(26,35,64,0.5);">
            <div class="sim-card w-full max-w-md p-6" style="max-height:90vh;overflow-y:auto;">

                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-base font-bold" style="color:#1A2340;">
                        {{ $editId ? 'Edit Data Mahasiswa' : 'Tambah Mahasiswa Baru' }}
                    </h3>
                    <button wire:click="closeModal()" style="color:#6B7494;">
                        <i class="ti ti-x text-lg"></i>
                    </button>
                </div>

                <div class="space-y-4">

                    {{-- Nama --}}
                    <div>
                        <label class="block text-xs font-semibold mb-1" style="color:#1A2340;">Nama Lengkap *</label>
                        <input wire:model="nama" type="text" placeholder="Nama lengkap mahasiswa"
                               class="w-full px-4 py-2.5 rounded-xl text-sm outline-none"
                               style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;"
                               onfocus="this.style.borderColor='#C8922A'"
                               onblur="this.style.borderColor='rgba(26,35,64,0.15)'">
                        @error('nama') <p class="text-xs mt-1" style="color:#B4452F;">{{ $message }}</p> @enderror
                    </div>

                    {{-- NIM --}}
                    <div>
                        <label class="block text-xs font-semibold mb-1" style="color:#1A2340;">NIM *</label>
                        <input wire:model="nim_nidn" type="text" placeholder="Nomor Induk Mahasiswa"
                               class="w-full px-4 py-2.5 rounded-xl text-sm outline-none"
                               style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;"
                               onfocus="this.style.borderColor='#C8922A'"
                               onblur="this.style.borderColor='rgba(26,35,64,0.15)'">
                        @error('nim_nidn') <p class="text-xs mt-1" style="color:#B4452F;">{{ $message }}</p> @enderror
                    </div>

                    {{-- Kelas --}}
                    <div>
                        <label class="block text-xs font-semibold mb-1" style="color:#1A2340;">Kelas</label>
                        <select wire:model="kelas_id"
                                class="w-full px-4 py-2.5 rounded-xl text-sm outline-none"
                                style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;"
                                onfocus="this.style.borderColor='#C8922A'"
                                onblur="this.style.borderColor='rgba(26,35,64,0.15)'">
                            <option value="">— Pilih Kelas —</option>
                            @foreach($kelasList as $kelas)
                                <option value="{{ $kelas->id }}">
                                    {{ $kelas->nama_kelas }} (Angkatan {{ $kelas->angkatan }})
                                </option>
                            @endforeach
                        </select>
                        @error('kelas_id') <p class="text-xs mt-1" style="color:#B4452F;">{{ $message }}</p> @enderror
                        @if($kelasList->isEmpty())
                            <p class="text-xs mt-1" style="color:#C8922A;">
                                <i class="ti ti-alert-circle text-xs mr-1"></i>
                                Belum ada kelas aktif. <a href="{{ route('admin.kelas') }}" class="font-semibold underline">Tambah kelas dulu</a>.
                            </p>
                        @endif
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-xs font-semibold mb-1" style="color:#1A2340;">Email</label>
                        <input wire:model="email" type="email" placeholder="email@example.com (opsional)"
                               class="w-full px-4 py-2.5 rounded-xl text-sm outline-none"
                               style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;"
                               onfocus="this.style.borderColor='#C8922A'"
                               onblur="this.style.borderColor='rgba(26,35,64,0.15)'">
                        @error('email') <p class="text-xs mt-1" style="color:#B4452F;">{{ $message }}</p> @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label class="block text-xs font-semibold mb-1" style="color:#1A2340;">
                            Password {{ $editId ? '(kosongkan jika tidak diubah)' : '*' }}
                        </label>
                        <input wire:model="password" type="password" placeholder="Min. 6 karakter"
                               class="w-full px-4 py-2.5 rounded-xl text-sm outline-none"
                               style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;"
                               onfocus="this.style.borderColor='#C8922A'"
                               onblur="this.style.borderColor='rgba(26,35,64,0.15)'">
                        @error('password') <p class="text-xs mt-1" style="color:#B4452F;">{{ $message }}</p> @enderror
                    </div>

                </div>

                <div class="flex gap-3 mt-6">
                    <button wire:click="closeModal()" class="flex-1 sim-btn-ghost text-sm justify-center">
                        Batal
                    </button>
                    <button wire:click="simpanMahasiswa()" class="flex-1 sim-btn-gold text-sm justify-center">
                        {{ $editId ? 'Perbarui' : 'Simpan' }}
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>
