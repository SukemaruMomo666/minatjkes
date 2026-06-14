<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    @include('partials.admin-sidebar')

    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="h-16 flex items-center justify-between px-8 shrink-0"
                style="background-color:#fff;border-bottom:1px solid rgba(26,35,64,0.08);">
            <div>
                <h1 class="text-base font-bold" style="color:#1A2340;">Bank Soal</h1>
                <p class="text-xs" style="color:#6B7494;">Kelola soal pemetaan potensi</p>
            </div>
            @if($activeTab === 'minat')
                <button wire:click="openModal()" class="sim-btn-gold text-sm">
                    <i class="ti ti-plus"></i> Tambah Soal
                </button>
            @else
                <button wire:click="openModalMbti()" class="sim-btn-gold text-sm">
                    <i class="ti ti-plus"></i> Tambah Soal MBTI
                </button>
            @endif
        </header>

        <div class="flex-1 overflow-y-auto p-8">

            @if(session('message'))
                <div class="mb-4 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-2"
                     style="background-color:rgba(46,125,85,0.1);color:#2E7D55;border:1px solid rgba(46,125,85,0.2);">
                    <i class="ti ti-circle-check"></i> {{ session('message') }}
                </div>
            @endif

            {{-- Tab Switcher --}}
            <div class="flex gap-1 mb-6 p-1 rounded-xl w-fit" style="background-color:rgba(26,35,64,0.06);">
                <button wire:click="setTab('minat')"
                        class="px-5 py-2 rounded-lg text-sm font-semibold transition-all"
                        style="{{ $activeTab === 'minat' ? 'background-color:#1A2340;color:#FDF6E8;box-shadow:0 2px 8px rgba(26,35,64,0.2);' : 'color:#6B7494;' }}">
                    <i class="ti ti-stars mr-1.5"></i> Minat &amp; Bakat
                </button>
                <button wire:click="setTab('mbti')"
                        class="px-5 py-2 rounded-lg text-sm font-semibold transition-all"
                        style="{{ $activeTab === 'mbti' ? 'background-color:#1A2340;color:#FDF6E8;box-shadow:0 2px 8px rgba(26,35,64,0.2);' : 'color:#6B7494;' }}">
                    <i class="ti ti-brain mr-1.5"></i> MBTI
                </button>
            </div>

            {{-- ─── TAB: MINAT & BAKAT ─── --}}
            @if($activeTab === 'minat')

                {{-- Search --}}
                <div class="mb-5 relative">
                    <i class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2 text-base" style="color:#6B7494;"></i>
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari soal minat..."
                           class="w-full max-w-sm pl-10 pr-4 py-2.5 rounded-xl text-sm outline-none"
                           style="border:1.5px solid rgba(26,35,64,0.12);background:#fff;color:#1A2340;"
                           onfocus="this.style.borderColor='#C8922A'" onblur="this.style.borderColor='rgba(26,35,64,0.12)'">
                </div>

                <div class="sim-card overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr style="background-color:rgba(253,246,232,0.6);border-bottom:1px solid rgba(26,35,64,0.07);">
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">#</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Teks Soal</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Kategori</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Tipe</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Status</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider text-center" style="color:#6B7494;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($soals as $soal)
                                    <tr style="border-bottom:1px solid rgba(26,35,64,0.04);"
                                        onmouseover="this.style.backgroundColor='rgba(232,213,163,0.1)'" onmouseout="this.style.backgroundColor=''">
                                        <td class="px-6 py-4 text-xs font-medium" style="color:#6B7494;">{{ $soal->id }}</td>
                                        <td class="px-6 py-4 text-sm max-w-xs" style="color:#1A2340;">
                                            <p class="truncate" title="{{ $soal->teks_soal }}">{{ $soal->teks_soal }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-sm" style="color:#2D3F6B;">
                                            {{ $soal->kategori?->nama_kategori ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2.5 py-1 text-xs font-bold rounded-full capitalize"
                                                  style="background-color:rgba(45,63,107,0.1);color:#2D3F6B;">
                                                {{ str_replace('_', ' ', $soal->tipe) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <button wire:click="toggleAktif({{ $soal->id }})" title="Klik untuk toggle">
                                                @if($soal->is_active)
                                                    <span class="px-2.5 py-1 text-xs font-bold rounded-full"
                                                          style="background-color:rgba(46,125,85,0.1);color:#2E7D55;">Aktif</span>
                                                @else
                                                    <span class="px-2.5 py-1 text-xs font-bold rounded-full"
                                                          style="background-color:rgba(180,69,47,0.1);color:#B4452F;">Nonaktif</span>
                                                @endif
                                            </button>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <button wire:click="openModal({{ $soal->id }})"
                                                        class="p-1.5 rounded-lg transition-all"
                                                        style="color:#C8922A;" title="Edit">
                                                    <i class="ti ti-pencil text-base"></i>
                                                </button>
                                                <button wire:click="hapus({{ $soal->id }})"
                                                        wire:confirm="Hapus soal ini?"
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
                                            Belum ada soal{{ $search ? ' dengan kata kunci tersebut' : '' }}.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4" style="border-top:1px solid rgba(26,35,64,0.07);">
                        {{ $soals->links() }}
                    </div>
                </div>

            @endif

            {{-- ─── TAB: MBTI ─── --}}
            @if($activeTab === 'mbti')

                {{-- Search --}}
                <div class="mb-5 relative">
                    <i class="ti ti-search absolute left-4 top-1/2 -translate-y-1/2 text-base" style="color:#6B7494;"></i>
                    <input wire:model.live.debounce.300ms="mbtiSearch" type="text" placeholder="Cari soal MBTI..."
                           class="w-full max-w-sm pl-10 pr-4 py-2.5 rounded-xl text-sm outline-none"
                           style="border:1.5px solid rgba(26,35,64,0.12);background:#fff;color:#1A2340;"
                           onfocus="this.style.borderColor='#C8922A'" onblur="this.style.borderColor='rgba(26,35,64,0.12)'">
                </div>

                <div class="sim-card overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr style="background-color:rgba(253,246,232,0.6);border-bottom:1px solid rgba(26,35,64,0.07);">
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">#</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Dimensi</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Pertanyaan</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Opsi A</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Opsi B</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider" style="color:#6B7494;">Status</th>
                                    <th class="px-6 py-3 text-xs font-bold uppercase tracking-wider text-center" style="color:#6B7494;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($soalMbtis as $soal)
                                    <tr style="border-bottom:1px solid rgba(26,35,64,0.04);"
                                        onmouseover="this.style.backgroundColor='rgba(232,213,163,0.1)'" onmouseout="this.style.backgroundColor=''">
                                        <td class="px-6 py-4 text-xs font-medium" style="color:#6B7494;">{{ $soal->id }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2.5 py-1 text-xs font-bold rounded-full"
                                                  style="background-color:rgba(200,146,42,0.12);color:#C8922A;">
                                                {{ $soal->dimensi }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm max-w-xs" style="color:#1A2340;">
                                            <p class="truncate" title="{{ $soal->pertanyaan }}">{{ $soal->pertanyaan }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-xs max-w-[160px]" style="color:#2D3F6B;">
                                            <p class="truncate" title="{{ $soal->opsi_a }}">{{ $soal->opsi_a }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-xs max-w-[160px]" style="color:#2D3F6B;">
                                            <p class="truncate" title="{{ $soal->opsi_b }}">{{ $soal->opsi_b }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <button wire:click="toggleAktifMbti({{ $soal->id }})" title="Klik untuk toggle">
                                                @if($soal->is_active)
                                                    <span class="px-2.5 py-1 text-xs font-bold rounded-full"
                                                          style="background-color:rgba(46,125,85,0.1);color:#2E7D55;">Aktif</span>
                                                @else
                                                    <span class="px-2.5 py-1 text-xs font-bold rounded-full"
                                                          style="background-color:rgba(180,69,47,0.1);color:#B4452F;">Nonaktif</span>
                                                @endif
                                            </button>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <button wire:click="openModalMbti({{ $soal->id }})"
                                                        class="p-1.5 rounded-lg transition-all"
                                                        style="color:#C8922A;" title="Edit">
                                                    <i class="ti ti-pencil text-base"></i>
                                                </button>
                                                <button wire:click="hapusMbti({{ $soal->id }})"
                                                        wire:confirm="Hapus soal MBTI ini?"
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
                                            Belum ada soal MBTI{{ $mbtiSearch ? ' dengan kata kunci tersebut' : '' }}.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4" style="border-top:1px solid rgba(26,35,64,0.07);">
                        {{ $soalMbtis->links() }}
                    </div>
                </div>

            @endif

        </div>
    </main>

    {{-- Modal Minat & Bakat --}}
    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" style="background-color:rgba(26,35,64,0.5);">
            <div class="sim-card w-full max-w-lg p-6" style="max-height:90vh;overflow-y:auto;">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-base font-bold" style="color:#1A2340;">
                        {{ $editId ? 'Edit Soal' : 'Tambah Soal Minat & Bakat' }}
                    </h3>
                    <button wire:click="closeModal()" style="color:#6B7494;"><i class="ti ti-x text-lg"></i></button>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1" style="color:#1A2340;">Kategori *</label>
                        <select wire:model="kategori_id"
                                class="w-full px-4 py-2.5 rounded-xl text-sm outline-none"
                                style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;"
                                onfocus="this.style.borderColor='#C8922A'" onblur="this.style.borderColor='rgba(26,35,64,0.15)'">
                            <option value="">— Pilih Kategori —</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }} ({{ $kat->tipe }})</option>
                            @endforeach
                        </select>
                        @error('kategori_id') <p class="text-xs mt-1" style="color:#B4452F;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold mb-1" style="color:#1A2340;">Tipe *</label>
                        <select wire:model="tipe"
                                class="w-full px-4 py-2.5 rounded-xl text-sm outline-none"
                                style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;"
                                onfocus="this.style.borderColor='#C8922A'" onblur="this.style.borderColor='rgba(26,35,64,0.15)'">
                            <option value="akademik">Akademik</option>
                            <option value="non_akademik">Non-Akademik</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold mb-1" style="color:#1A2340;">Teks Soal *</label>
                        <textarea wire:model="teks_soal" rows="4"
                                  placeholder="Tulis pertanyaan soal di sini..."
                                  class="w-full px-4 py-2.5 rounded-xl text-sm outline-none resize-none"
                                  style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;"
                                  onfocus="this.style.borderColor='#C8922A'" onblur="this.style.borderColor='rgba(26,35,64,0.15)'"></textarea>
                        @error('teks_soal') <p class="text-xs mt-1" style="color:#B4452F;">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-3">
                        <input wire:model="is_active" type="checkbox" id="is_active_soal" class="w-4 h-4 rounded"
                               style="accent-color:#C8922A;">
                        <label for="is_active_soal" class="text-sm font-medium" style="color:#1A2340;">Soal aktif (tampil di tes)</label>
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

    {{-- Modal MBTI --}}
    @if($isMbtiModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" style="background-color:rgba(26,35,64,0.5);">
            <div class="sim-card w-full max-w-lg p-6" style="max-height:90vh;overflow-y:auto;">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-base font-bold" style="color:#1A2340;">
                        {{ $mbtiEditId ? 'Edit Soal MBTI' : 'Tambah Soal MBTI' }}
                    </h3>
                    <button wire:click="closeModalMbti()" style="color:#6B7494;"><i class="ti ti-x text-lg"></i></button>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold mb-1" style="color:#1A2340;">Dimensi *</label>
                        <select wire:model="dimensi"
                                class="w-full px-4 py-2.5 rounded-xl text-sm outline-none"
                                style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;"
                                onfocus="this.style.borderColor='#C8922A'" onblur="this.style.borderColor='rgba(26,35,64,0.15)'">
                            <option value="EI">EI — Extraversion / Introversion</option>
                            <option value="SN">SN — Sensing / Intuition</option>
                            <option value="TF">TF — Thinking / Feeling</option>
                            <option value="JP">JP — Judging / Perceiving</option>
                        </select>
                        @error('dimensi') <p class="text-xs mt-1" style="color:#B4452F;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold mb-1" style="color:#1A2340;">Pertanyaan *</label>
                        <textarea wire:model="pertanyaan" rows="3"
                                  placeholder="Tulis pertanyaan MBTI di sini..."
                                  class="w-full px-4 py-2.5 rounded-xl text-sm outline-none resize-none"
                                  style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;"
                                  onfocus="this.style.borderColor='#C8922A'" onblur="this.style.borderColor='rgba(26,35,64,0.15)'"></textarea>
                        @error('pertanyaan') <p class="text-xs mt-1" style="color:#B4452F;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold mb-1" style="color:#1A2340;">Opsi A *</label>
                        <input wire:model="opsi_a" type="text"
                               placeholder="Pilihan A..."
                               class="w-full px-4 py-2.5 rounded-xl text-sm outline-none"
                               style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;"
                               onfocus="this.style.borderColor='#C8922A'" onblur="this.style.borderColor='rgba(26,35,64,0.15)'">
                        @error('opsi_a') <p class="text-xs mt-1" style="color:#B4452F;">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold mb-1" style="color:#1A2340;">Opsi B *</label>
                        <input wire:model="opsi_b" type="text"
                               placeholder="Pilihan B..."
                               class="w-full px-4 py-2.5 rounded-xl text-sm outline-none"
                               style="border:1.5px solid rgba(26,35,64,0.15);background:#fff;color:#1A2340;"
                               onfocus="this.style.borderColor='#C8922A'" onblur="this.style.borderColor='rgba(26,35,64,0.15)'">
                        @error('opsi_b') <p class="text-xs mt-1" style="color:#B4452F;">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-3">
                        <input wire:model="mbtiIsActive" type="checkbox" id="is_active_mbti" class="w-4 h-4 rounded"
                               style="accent-color:#C8922A;">
                        <label for="is_active_mbti" class="text-sm font-medium" style="color:#1A2340;">Soal aktif (tampil di tes)</label>
                    </div>
                </div>

                <div class="flex gap-3 mt-6">
                    <button wire:click="closeModalMbti()" class="flex-1 sim-btn-ghost text-sm justify-center">Batal</button>
                    <button wire:click="simpanMbti()" class="flex-1 sim-btn-gold text-sm justify-center">
                        {{ $mbtiEditId ? 'Perbarui' : 'Simpan' }}
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>
