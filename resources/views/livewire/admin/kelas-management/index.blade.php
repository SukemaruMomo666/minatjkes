<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    @include('partials.admin-sidebar')

    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="h-16 flex items-center justify-between px-8 shrink-0"
                style="background-color:#fff;border-bottom:1px solid rgba(26,35,64,0.08);">
            <div>
                <h1 class="text-base font-bold" style="color:#1A2340;">Manajemen Kelas</h1>
                <p class="text-xs" style="color:#6B7494;">Kelola data kelas dan dosen wali</p>
            </div>
            <button wire:click="openModal()" class="sim-btn-gold text-sm">
                <i class="ti ti-plus"></i> Tambah Kelas
            </button>
        </header>

        <div class="flex-1 overflow-y-auto p-8">

            @if(session('message'))
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
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Nama Kelas</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Angkatan</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Dosen Wali</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Status</th>
                                <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider text-center" style="color:#6B7494;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kelasList as $kelas)
                                <tr style="border-bottom:1px solid rgba(26,35,64,0.04);"
                                    onmouseover="this.style.backgroundColor='rgba(232,213,163,0.1)'" onmouseout="this.style.backgroundColor=''">
                                    <td class="px-6 py-4 text-sm font-semibold" style="color:#1A2340;">{{ $kelas->nama_kelas }}</td>
                                    <td class="px-6 py-4 text-sm" style="color:#2D3F6B;">{{ $kelas->angkatan }}</td>
                                    <td class="px-6 py-4 text-sm" style="color:#2D3F6B;">
                                        {{ $kelas->dosenWali?->nama ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($kelas->is_active)
                                            <span class="px-2.5 py-1 text-xs font-bold rounded-full"
                                                  style="background-color:rgba(46,125,85,0.1);color:#2E7D55;">Aktif</span>
                                        @else
                                            <span class="px-2.5 py-1 text-xs font-bold rounded-full"
                                                  style="background-color:rgba(180,69,47,0.1);color:#B4452F;">Nonaktif</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button wire:click="openModal({{ $kelas->id }})"
                                                    class="p-1.5 rounded-lg transition-all hover:bg-gold/10"
                                                    style="color:#C8922A;" title="Edit">
                                                <i class="ti ti-pencil text-base"></i>
                                            </button>
                                            <button wire:click="hapus({{ $kelas->id }})"
                                                    wire:confirm="Hapus kelas {{ $kelas->nama_kelas }}?"
                                                    class="p-1.5 rounded-lg transition-all"
                                                    style="color:#B4452F;" title="Hapus">
                                                <i class="ti ti-trash text-base"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-sm" style="color:#6B7494;">
                                        Belum ada data kelas.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4" style="border-top:1px solid rgba(26,35,64,0.07);">
                    {{ $kelasList->links() }}
                </div>
            </div>
        </div>
    </main>

    {{-- Modal --}}
    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" style="background-color:rgba(26,35,64,0.5);">
            <div class="sim-card w-full max-w-md p-6" style="max-height:90vh;overflow-y:auto;">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-base font-bold" style="color:#1A2340;">
                        {{ $editId ? 'Edit Kelas' : 'Tambah Kelas Baru' }}
                    </h3>
                    <button wire:click="closeModal()" style="color:#6B7494;"><i class="ti ti-x text-lg"></i></button>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1" style="color:#1A2340;">Nama Kelas *</label>
                        <input wire:model="nama_kelas" type="text" placeholder="cth: 1A Keperawatan"
                               class="w-full px-4 py-2.5 rounded-xl text-sm outline-none transition-all"
                               style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;"
                               onfocus="this.style.borderColor='#C8922A'" onblur="this.style.borderColor='rgba(26,35,64,0.15)'">
                        @error('nama_kelas') <p class="text-xs mt-1" style="color:#B4452F;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold mb-1" style="color:#1A2340;">Angkatan *</label>
                        <input wire:model="angkatan" type="number" placeholder="2024"
                               class="w-full px-4 py-2.5 rounded-xl text-sm outline-none"
                               style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;"
                               onfocus="this.style.borderColor='#C8922A'" onblur="this.style.borderColor='rgba(26,35,64,0.15)'">
                        @error('angkatan') <p class="text-xs mt-1" style="color:#B4452F;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold mb-1" style="color:#1A2340;">Dosen Wali</label>
                        <select wire:model="dosen_wali_id"
                                class="w-full px-4 py-2.5 rounded-xl text-sm outline-none"
                                style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;"
                                onfocus="this.style.borderColor='#C8922A'" onblur="this.style.borderColor='rgba(26,35,64,0.15)'">
                            <option value="">— Pilih Dosen Wali —</option>
                            @foreach($dosenList as $dosen)
                                <option value="{{ $dosen->id }}">{{ $dosen->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center gap-3">
                        <input wire:model="is_active" type="checkbox" id="is_active_kelas" class="w-4 h-4 rounded"
                               style="accent-color:#C8922A;">
                        <label for="is_active_kelas" class="text-sm font-medium" style="color:#1A2340;">Kelas aktif</label>
                    </div>
                </div>

                <div class="flex gap-3 mt-6">
                    <button wire:click="closeModal()" class="flex-1 sim-btn-ghost text-sm justify-center">Batal</button>
                    <button wire:click="simpan()" class="flex-1 sim-btn-gold text-sm justify-center">
                        {{ $editId ? 'Perbarui' : 'Simpan' }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
