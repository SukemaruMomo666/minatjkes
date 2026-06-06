<div class="max-w-3xl mx-auto space-y-5">
    @if($totalSoal > 0 && $batchSoals->count())

        {{-- Progress header --}}
        <div>
            <div class="flex justify-between items-center mb-2">
                <div>
                    <p class="text-xs font-bold uppercase tracking-widest mb-0.5" style="color:#A6781F;letter-spacing:0.12em;">
                        Halaman {{ $currentBatch + 1 }} dari {{ $totalBatches }}
                    </p>
                    @php
                        $pct = $persentase;
                        if ($pct >= 75)      $motiv = 'Hampir sampai! Sedikit lagi 🏁';
                        elseif ($pct >= 50)  $motiv = 'Setengah selesai! Kamu luar biasa 🌟';
                        elseif ($pct >= 25)  $motiv = 'Kamu sudah seperempat jalan! Tetap jujur ya 💪';
                        else                 $motiv = 'Jawab sejujurnya — tidak ada jawaban benar atau salah.';
                    @endphp
                    <p class="text-sm" style="color:#6B7494;">{{ $motiv }}</p>
                </div>
                <span class="text-sm font-bold" style="color:#C8922A;">{{ $persentase }}%</span>
            </div>
            <div class="sim-progress-bar">
                <div class="sim-progress-fill" style="width:{{ $persentase }}%;"></div>
            </div>
        </div>

        {{-- Soal scrollable card --}}
        <div class="sim-card overflow-hidden">

            {{-- Legend header --}}
            <div class="px-6 py-3 flex items-center justify-between sticky top-0 z-10"
                 style="background-color:#fff;border-bottom:1px solid rgba(26,35,64,0.07);">
                <span class="text-xs font-semibold" style="color:#6B7494;">Pertanyaan</span>
                <div class="flex items-center gap-6">
                    <span class="text-xs font-bold" style="color:#C8922A;">Setuju</span>
                    <div class="flex items-center gap-1.5">
                        @foreach([1,2,3,4,5] as $n)
                            <div class="rounded-full border-2 flex items-center justify-center text-[10px] font-bold"
                                 style="width:{{ [28,22,16,22,28][$n-1] }}px;height:{{ [28,22,16,22,28][$n-1] }}px;
                                        border-color:rgba(26,35,64,0.15);color:#6B7494;">
                                {{ $n }}
                            </div>
                        @endforeach
                    </div>
                    <span class="text-xs font-bold" style="color:#6B7494;">Tidak Setuju</span>
                </div>
            </div>

            {{-- Daftar soal --}}
            <div class="overflow-y-auto" style="max-height:calc(100vh - 320px);">
                @foreach($batchSoals as $idx => $soal)
                    @php
                        $jawaban = $jawabanBatch[(string) $soal->id] ?? null;
                        $isLast  = $idx === $batchSoals->count() - 1;
                    @endphp
                    <div wire:key="soal-{{ $soal->id }}"
                         class="flex items-center gap-4 px-6 py-4 transition-all"
                         style="{{ ! $isLast ? 'border-bottom:1px solid rgba(26,35,64,0.06);' : '' }}
                                {{ ! is_null($jawaban) ? 'background-color:rgba(200,146,42,0.03);' : '' }}">

                        {{-- Nomor & teks soal --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start gap-3">
                                <span class="text-xs font-bold mt-0.5 shrink-0 w-6 text-right" style="color:#A6781F;">
                                    {{ $currentBatch * $batchSize + $idx + 1 }}.
                                </span>
                                <p class="text-sm leading-relaxed font-medium" style="color:#1A2340;">
                                    {{ $soal->teks_soal }}
                                </p>
                            </div>
                            @if($soal->kategori)
                                <p class="text-xs mt-1 ml-9" style="color:#6B7494;">
                                    <i class="ti ti-tag text-xs mr-1"></i>{{ $soal->kategori->nama_kategori }}
                                </p>
                            @endif
                        </div>

                        {{-- Lingkaran pilihan --}}
                        <div class="flex items-center gap-1.5 shrink-0">
                            @foreach([1,2,3,4,5] as $nilai)
                                @php
                                    $size   = [28, 22, 16, 22, 28][$nilai - 1];
                                    $dipilih = $jawaban === $nilai;
                                @endphp
                                <button
                                    wire:click="pilihJawaban({{ $soal->id }}, {{ $nilai }})"
                                    title="{{ ['Sangat Setuju','Setuju','Netral','Tidak Setuju','Sangat Tidak Setuju'][$nilai-1] }}"
                                    class="rounded-full border-2 flex items-center justify-center transition-all duration-150"
                                    style="width:{{ $size }}px; height:{{ $size }}px;
                                           {{ $dipilih
                                               ? 'background-color:#C8922A; border-color:#C8922A; box-shadow:0 2px 8px rgba(200,146,42,0.35); transform:scale(1.12);'
                                               : 'background-color:#fff; border-color:rgba(26,35,64,0.18);'
                                           }}">
                                    @if($dipilih)
                                        <i class="ti ti-check" style="color:#fff; font-size:{{ max(8, $size - 14) }}px;"></i>
                                    @endif
                                </button>
                            @endforeach
                        </div>

                    </div>
                @endforeach
            </div>

            {{-- Footer status --}}
            <div class="px-6 py-3 flex items-center justify-between"
                 style="background-color:rgba(253,246,232,0.5);border-top:1px solid rgba(26,35,64,0.07);">
                <span class="text-xs font-semibold" style="color:#6B7494;">
                    {{ $terjawab }} dari {{ $batchSoals->count() }} soal terjawab
                </span>
                @if(! $isComplete)
                    <span class="text-xs" style="color:#C8922A;">
                        <i class="ti ti-alert-circle text-xs mr-1"></i>
                        Jawab semua soal untuk melanjutkan
                    </span>
                @else
                    <span class="text-xs font-semibold flex items-center gap-1" style="color:#2E7D55;">
                        <i class="ti ti-circle-check text-xs"></i> Semua soal terjawab
                    </span>
                @endif
            </div>
        </div>

        {{-- Navigasi --}}
        <div class="flex items-center justify-between">
            <button wire:click="prev"
                    @if($currentBatch === 0) disabled @endif
                    class="sim-btn-ghost text-sm disabled:opacity-40 disabled:cursor-not-allowed">
                <i class="ti ti-arrow-left"></i> Kembali
            </button>

            <button wire:click="next"
                    @if(! $isComplete) disabled @endif
                    class="sim-btn-gold text-sm disabled:opacity-40 disabled:cursor-not-allowed">
                @if($isLastBatch)
                    Selesai & Lihat Hasil 🎉
                @else
                    Berikutnya <i class="ti ti-arrow-right"></i>
                @endif
            </button>
        </div>

    @else
        <div class="sim-card p-10 text-center">
            <i class="ti ti-clipboard-off text-5xl mb-3 block" style="color:#6B7494;"></i>
            <p class="text-sm" style="color:#6B7494;">Belum ada soal aktif. Hubungi admin.</p>
        </div>
    @endif
</div>
