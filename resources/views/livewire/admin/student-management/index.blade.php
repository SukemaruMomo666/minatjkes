<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    @include('partials.admin-sidebar')

    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="h-16 flex items-center justify-between px-8 shrink-0"
                style="background-color:#fff;border-bottom:1px solid rgba(26,35,64,0.08);">
            <div>
                <h1 class="text-base font-bold" style="color:#1A2340;">Manajemen Mahasiswa</h1>
                <p class="text-xs" style="color:#6B7494;">Kelola data mahasiswa terdaftar</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.students.template') }}" class="sim-btn-ghost text-sm">
                    <i class="ti ti-download"></i> Template CSV
                </a>
                <button wire:click="openImportModal()" class="sim-btn-ghost text-sm">
                    <i class="ti ti-file-upload"></i> Import CSV
                </button>
                <button wire:click="openModal()" class="sim-btn-gold text-sm">
                    <i class="ti ti-user-plus"></i> Tambah Mahasiswa
                </button>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8">

            @if(session()->has('message'))
                <div class="mb-4 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-2"
                     style="background-color:rgba(46,125,85,0.1);color:#2E7D55;border:1px solid rgba(46,125,85,0.2);">
                    <i class="ti ti-circle-check"></i> {{ session('message') }}
                </div>
            @endif

            {{-- Search & Filter --}}
            <div class="mb-4 flex flex-wrap items-center gap-3">
                <div class="relative">
                    <i class="ti ti-search absolute left-3 top-1/2 -translate-y-1/2 text-sm" style="color:#6B7494;"></i>
                    <input wire:model.live.debounce.300ms="search"
                           type="text" placeholder="Cari nama atau NIM..."
                           class="pl-9 pr-4 py-2 rounded-xl text-sm outline-none"
                           style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;min-width:220px;"
                           onfocus="this.style.borderColor='#C8922A'"
                           onblur="this.style.borderColor='rgba(26,35,64,0.15)'">
                </div>

                <select wire:model.live="filterKelas"
                        class="px-3 py-2 rounded-xl text-sm outline-none"
                        style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;min-width:200px;"
                        onfocus="this.style.borderColor='#C8922A'"
                        onblur="this.style.borderColor='rgba(26,35,64,0.15)'">
                    <option value="">Semua Kelas</option>
                    @foreach($kelasList as $kelas)
                        <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }} — Angkatan {{ $kelas->angkatan }}</option>
                    @endforeach
                </select>

                @if($search || $filterKelas)
                    <button wire:click="$set('search', ''); $set('filterKelas', null)"
                            class="text-xs px-3 py-2 rounded-xl transition-all"
                            style="background:rgba(180,69,47,0.08);color:#B4452F;border:1px solid rgba(180,69,47,0.2);">
                        <i class="ti ti-x text-xs mr-1"></i>Reset Filter
                    </button>
                @endif

                @if($filterKelas)
                    <button wire:click="resetTesKelas({{ $filterKelas }})"
                            wire:confirm="Reset semua hasil tes mahasiswa di kelas ini? Mahasiswa harus mengerjakan tes dari awal."
                            class="text-xs px-3 py-2 rounded-xl transition-all flex items-center gap-1"
                            style="background:rgba(180,69,47,0.08);color:#B4452F;border:1px solid rgba(180,69,47,0.2);">
                        <i class="ti ti-refresh-alert text-xs"></i> Reset Tes Kelas Ini
                    </button>
                @endif
            </div>

            <div class="sim-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr style="background-color:rgba(253,246,232,0.6);border-bottom:1px solid rgba(26,35,64,0.07);">
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Mahasiswa</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">NIM</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Kelas</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Kelamin</th>
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
                                    <td class="px-6 py-4 text-xs" style="color:#6B7494;">
                                        @if($student->jenis_kelamin === 'laki-laki')
                                            <span class="flex items-center gap-1"><i class="ti ti-gender-male text-sm" style="color:#2D3F6B;"></i> L</span>
                                        @elseif($student->jenis_kelamin === 'perempuan')
                                            <span class="flex items-center gap-1"><i class="ti ti-gender-female text-sm" style="color:#C8922A;"></i> P</span>
                                        @else
                                            <span style="color:#d1d5db;">—</span>
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
                                            <button wire:click="resetTesMahasiswa({{ $student->id }})"
                                                    wire:confirm="Reset hasil tes {{ $student->nama }}? Mahasiswa harus mengerjakan tes dari awal."
                                                    class="p-1.5 rounded-lg transition-all"
                                                    style="color:#2D3F6B;" title="Reset Tes">
                                                <i class="ti ti-refresh text-base"></i>
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
                                    <td colspan="7" class="px-6 py-10 text-center text-sm" style="color:#6B7494;">
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

    {{-- Modal Import CSV --}}
    @if($isImportModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4"
             style="background-color:rgba(26,35,64,0.5);">
            <div class="sim-card w-full max-w-lg p-6">

                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-base font-bold" style="color:#1A2340;">
                        <i class="ti ti-file-upload mr-2 text-[#C8922A]"></i>Import Data Mahasiswa
                    </h3>
                    <button wire:click="closeImportModal()" style="color:#6B7494;">
                        <i class="ti ti-x text-lg"></i>
                    </button>
                </div>

                {{-- Panduan --}}
                <div class="rounded-xl p-4 mb-4 text-xs space-y-1.5" style="background-color:rgba(45,63,107,0.05);border:1px solid rgba(45,63,107,0.12);">
                    <p class="font-bold mb-2" style="color:#2D3F6B;"><i class="ti ti-info-circle mr-1"></i>Format kolom yang diperlukan:</p>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-[11px]">
                            <thead><tr style="color:#6B7494;">
                                <th class="pr-4 py-1 font-bold">Kolom</th>
                                <th class="pr-4 py-1 font-bold">Isi</th>
                                <th class="py-1 font-bold">Keterangan</th>
                            </tr></thead>
                            <tbody style="color:#1A2340;">
                                <tr><td class="pr-4 py-0.5 font-mono font-bold">nama</td><td class="pr-4">Nama Lengkap</td><td class="text-[10px]" style="color:#6B7494;">Wajib</td></tr>
                                <tr><td class="pr-4 py-0.5 font-mono font-bold">nim</td><td class="pr-4">NIM mahasiswa</td><td class="text-[10px]" style="color:#6B7494;">Wajib · jadi password</td></tr>
                                <tr><td class="pr-4 py-0.5 font-mono font-bold">kelas</td><td class="pr-4">Nama kelas</td><td class="text-[10px]" style="color:#6B7494;">Sama persis dengan kelas di sistem</td></tr>
                                <tr><td class="pr-4 py-0.5 font-mono font-bold">jenis_kelamin</td><td class="pr-4">L atau P</td><td class="text-[10px]" style="color:#6B7494;">Opsional</td></tr>
                                <tr><td class="pr-4 py-0.5 font-mono font-bold">email</td><td class="pr-4">Email</td><td class="text-[10px]" style="color:#6B7494;">Opsional</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="mt-2" style="color:#6B7494;">NIM sudah ada → <strong>diperbarui</strong>. NIM baru → <strong>ditambahkan</strong>. Password = NIM.</p>
                    <p class="mt-1" style="color:#C8922A;"><i class="ti ti-bulb text-xs mr-1"></i>Download Template XLS → isi di Excel → Save As CSV → upload di sini.</p>
                </div>

                {{-- Notifikasi dari redirect --}}
                @if(session('import_error'))
                    <div class="rounded-xl p-3 mb-4 text-xs font-semibold flex items-center gap-2"
                         style="background-color:rgba(180,69,47,0.08);color:#B4452F;border:1px solid rgba(180,69,47,0.2);">
                        <i class="ti ti-alert-circle text-sm"></i> {{ session('import_error') }}
                    </div>
                @endif
                @if(session('import_summary'))
                    <div class="rounded-xl p-3 mb-2 text-xs font-semibold flex items-center gap-2"
                         style="background-color:rgba(46,125,85,0.1);color:#2E7D55;border:1px solid rgba(46,125,85,0.2);">
                        <i class="ti ti-circle-check text-sm"></i> {{ session('import_summary') }}
                    </div>
                @endif
                @if(session('import_errors'))
                    <div class="rounded-xl p-3 mb-4 text-xs max-h-32 overflow-y-auto"
                         style="background-color:rgba(180,69,47,0.06);border:1px solid rgba(180,69,47,0.2);">
                        <p class="font-bold mb-1" style="color:#B4452F;">{{ count(session('import_errors')) }} baris bermasalah:</p>
                        <ul class="space-y-0.5" style="color:#B4452F;">
                            @foreach(session('import_errors') as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form upload biasa (bukan Livewire upload) --}}
                <form action="{{ route('admin.students.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5">
                        <label class="block text-xs font-semibold mb-2" style="color:#1A2340;">Pilih File CSV</label>
                        <input type="file" name="file" accept=".csv,.txt"
                               class="w-full text-sm file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:cursor-pointer"
                               style="color:#6B7494;">
                        @error('file') <p class="text-xs mt-1" style="color:#B4452F;">{{ $message }}</p> @enderror
                    </div>
                    <div class="flex gap-3">
                        <button type="button" wire:click="closeImportModal()" class="flex-1 sim-btn-ghost text-sm justify-center">
                            Tutup
                        </button>
                        <button type="submit" class="flex-1 sim-btn-gold text-sm justify-center">
                            <i class="ti ti-upload mr-1"></i> Proses Import
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

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

                    {{-- Jenis Kelamin --}}
                    <div>
                        <label class="block text-xs font-semibold mb-1" style="color:#1A2340;">Jenis Kelamin</label>
                        <select wire:model="jenis_kelamin"
                                class="w-full px-4 py-2.5 rounded-xl text-sm outline-none"
                                style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;"
                                onfocus="this.style.borderColor='#C8922A'"
                                onblur="this.style.borderColor='rgba(26,35,64,0.15)'">
                            <option value="">— Pilih —</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                        @error('jenis_kelamin') <p class="text-xs mt-1" style="color:#B4452F;">{{ $message }}</p> @enderror
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
