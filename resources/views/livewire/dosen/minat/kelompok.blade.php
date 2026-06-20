<div class="flex h-screen overflow-hidden" style="background-color:#FDF6E8;">

    {{-- SIDEBAR --}}
    <aside class="w-[220px] flex-col hidden md:flex shrink-0 relative" style="background-color:#1A2340;">
        <div class="absolute inset-0 siminat-batik" style="opacity:0.05;"></div>
        <div class="h-16 flex items-center px-5 relative" style="border-bottom:1px solid rgba(232,213,163,0.15);">
            <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3 shrink-0" style="background-color:#C8922A;">
                <i class="ti ti-plus font-bold" style="color:#1A2340;font-size:17px;"></i>
            </div>
            <div>
                <span class="font-bold tracking-widest text-xs block" style="color:#FDF6E8;letter-spacing:0.12em;">SIMINAT</span>
                <span class="text-[10px]" style="color:rgba(253,246,232,0.4);">Portal Dosen</span>
            </div>
        </div>
        <nav class="flex-1 px-3 py-5 space-y-1 relative">
            <a href="{{ route('dosen.dashboard') }}"
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition-all hover:bg-white/10"
               style="color:rgba(253,246,232,0.65);">
                <i class="ti ti-layout-dashboard mr-3 text-base"></i> Dashboard
            </a>
            <a href="{{ route('dosen.minat.kelompok') }}"
               class="flex items-center px-4 py-2.5 rounded-lg text-sm font-semibold"
               style="background-color:rgba(200,146,42,0.15);color:#C8922A;border-left:3px solid #C8922A;">
                <i class="ti ti-chart-pie mr-3 text-base"></i> Pengelompokan Minat
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
                <h1 class="text-base font-bold" style="color:#1A2340;">
                    @if($selectedKategori)
                        {{ $selectedKategori }}
                    @else
                        Pengelompokan Minat
                    @endif
                </h1>
                <p class="text-xs" style="color:#6B7494;">
                    @if($namaKelas) Kelas: <strong>{{ $namaKelas }}</strong> @else Semua kelas @endif
                    @if($selectedKategori)
                        · {{ count($kelompokData[$selectedKategori] ?? []) }} mahasiswa
                    @endif
                </p>
            </div>
            @if($selectedKategori)
                <button wire:click="kembali"
                        class="flex items-center gap-2 text-sm font-medium px-4 py-2 rounded-lg border transition-all hover:bg-gray-50"
                        style="color:#1A2340;border-color:rgba(26,35,64,0.2);">
                    <i class="ti ti-arrow-left text-sm"></i> Kembali
                </button>
            @endif
        </header>

        <div class="flex-1 overflow-y-auto px-8 py-6">

            @if(empty($kelompokData) && $belumTes === 0)
                <div class="flex flex-col items-center justify-center h-64 text-center">
                    <i class="ti ti-users-group text-4xl mb-3" style="color:#C8922A;"></i>
                    <p class="text-sm font-medium" style="color:#1A2340;">Belum ada data mahasiswa</p>
                    <p class="text-xs mt-1" style="color:#6B7494;">Mahasiswa perlu mengisi tes terlebih dahulu.</p>
                </div>

            @elseif($selectedKategori)
                {{-- DETAIL: daftar mahasiswa dalam 1 kategori --}}
                @php $mahasiswaList = $kelompokData[$selectedKategori] ?? []; @endphp

                @if(count($mahasiswaList) === 0)
                    <p class="text-sm" style="color:#6B7494;">Tidak ada mahasiswa di kategori ini.</p>
                @else
                    <div class="bg-white rounded-xl border overflow-hidden" style="border-color:rgba(26,35,64,0.1);">
                        <table class="w-full text-sm">
                            <thead>
                                <tr style="background-color:#F7F8FB;border-bottom:1px solid rgba(26,35,64,0.08);">
                                    <th class="text-left px-5 py-3 text-xs font-semibold" style="color:#6B7494;">Nama</th>
                                    <th class="text-left px-5 py-3 text-xs font-semibold" style="color:#6B7494;">NIM</th>
                                    <th class="text-left px-5 py-3 text-xs font-semibold" style="color:#6B7494;">Kelas</th>
                                    <th class="text-right px-5 py-3 text-xs font-semibold" style="color:#6B7494;">Skor Kategori</th>
                                    <th class="px-5 py-3"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(collect($mahasiswaList)->sortByDesc('skor') as $mhs)
                                    <tr class="border-b last:border-b-0 hover:bg-gray-50 transition-colors"
                                        style="border-color:rgba(26,35,64,0.06);">
                                        <td class="px-5 py-3 font-medium" style="color:#1A2340;">{{ $mhs['nama'] }}</td>
                                        <td class="px-5 py-3" style="color:#6B7494;">{{ $mhs['nim_nidn'] }}</td>
                                        <td class="px-5 py-3" style="color:#6B7494;">{{ $mhs['nama_kelas'] }}</td>
                                        <td class="px-5 py-3 text-right">
                                            <span class="font-semibold" style="color:#1A2340;">{{ $mhs['skor'] }}%</span>
                                        </td>
                                        <td class="px-5 py-3 text-right">
                                            <a href="{{ route('dosen.mahasiswa.hasil', ['userId' => $mhs['id']]) }}"
                                               class="text-xs px-3 py-1.5 rounded-lg font-medium border transition-all hover:opacity-80"
                                               style="color:#1A2340;border-color:rgba(26,35,64,0.25);">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            @else
                {{-- OVERVIEW: kartu per kategori --}}
                @php
                    $warnaPalette = [
                        '#3B82F6','#10B981','#F59E0B','#EF4444','#8B5CF6',
                        '#EC4899','#06B6D4','#84CC16','#F97316','#6366F1',
                    ];
                @endphp

                <div class="grid grid-cols-1 gap-3 max-w-2xl">
                    @foreach($kelompokData as $kategori => $list)
                        @php $warna = $warnaPalette[($loop->index) % count($warnaPalette)]; @endphp
                        <div class="bg-white rounded-xl border flex items-center justify-between px-5 py-4 transition-all hover:shadow-sm"
                             style="border-color:rgba(26,35,64,0.1);">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full shrink-0" style="background-color:{{ $warna }};"></div>
                                <span class="text-sm font-medium" style="color:#1A2340;">{{ $kategori }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-semibold px-2.5 py-1 rounded-full"
                                      style="background-color:{{ $warna }}18;color:{{ $warna }};">
                                    {{ count($list) }} mhs
                                </span>
                                <button wire:click="pilihKategori('{{ $kategori }}')"
                                        class="text-xs px-3 py-1.5 rounded-lg font-medium border transition-all hover:opacity-80"
                                        style="color:#1A2340;border-color:rgba(26,35,64,0.25);">
                                    Lihat
                                </button>
                            </div>
                        </div>
                    @endforeach

                    @if($belumTes > 0)
                        <div class="bg-white rounded-xl border border-dashed flex items-center justify-between px-5 py-4"
                             style="border-color:rgba(26,35,64,0.15);">
                            <div class="flex items-center gap-3">
                                <div class="w-3 h-3 rounded-full shrink-0" style="background-color:#9CA3AF;"></div>
                                <span class="text-sm font-medium" style="color:#9CA3AF;">Belum mengisi tes</span>
                            </div>
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full"
                                  style="background-color:#F3F4F6;color:#6B7280;">
                                {{ $belumTes }} mhs
                            </span>
                        </div>
                    @endif
                </div>

                @if($belumTes > 0 && count($mahasiswaBelumTes) > 0)
                    <div class="mt-6 max-w-2xl">
                        <p class="text-xs font-semibold mb-2" style="color:#6B7494;">Mahasiswa belum mengisi tes</p>
                        <div class="bg-white rounded-xl border overflow-hidden" style="border-color:rgba(26,35,64,0.1);">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr style="background-color:#F7F8FB;border-bottom:1px solid rgba(26,35,64,0.08);">
                                        <th class="text-left px-5 py-3 text-xs font-semibold" style="color:#6B7494;">Nama</th>
                                        <th class="text-left px-5 py-3 text-xs font-semibold" style="color:#6B7494;">NIM</th>
                                        <th class="text-left px-5 py-3 text-xs font-semibold" style="color:#6B7494;">Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($mahasiswaBelumTes as $mhs)
                                        <tr class="border-b last:border-b-0" style="border-color:rgba(26,35,64,0.06);">
                                            <td class="px-5 py-3 font-medium" style="color:#9CA3AF;">{{ $mhs['nama'] }}</td>
                                            <td class="px-5 py-3" style="color:#9CA3AF;">{{ $mhs['nim_nidn'] }}</td>
                                            <td class="px-5 py-3" style="color:#9CA3AF;">{{ $mhs['nama_kelas'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            @endif

        </div>
    </main>
</div>
