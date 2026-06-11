<div class="max-w-3xl mx-auto space-y-4 md:space-y-5">
    @if($totalSoal > 0 && $batchSoals->count())

        {{-- Progress header --}}
        <div>
            <div class="flex justify-between items-center mb-2">
                <div>
                    <p class="text-[10px] md:text-xs font-bold uppercase tracking-widest mb-0.5" style="color:#A6781F;letter-spacing:0.12em;">
                        Halaman {{ $currentBatch + 1 }} dari {{ $totalBatches }}
                    </p>
                    @php
                        $pct = $persentase;
                        if ($pct >= 75)      $motiv = 'Hampir sampai! Sedikit lagi 🚀';
                        elseif ($pct >= 50)  $motiv = 'Setengah selesai! Kamu luar biasa ✨';
                        elseif ($pct >= 25)  $motiv = 'Kamu sudah seperempat jalan! 💡';
                        else                 $motiv = 'Jawab sejujurnya ya.';
                    @endphp
                    <p class="text-xs md:text-sm" style="color:#6B7494;">{{ $motiv }}</p>
                </div>
                <span class="text-xs md:text-sm font-bold" style="color:#C8922A;">{{ $persentase }}%</span>
            </div>
            <div class="sim-progress-bar">
                <div class="sim-progress-fill" style="width:{{ $persentase }}%;"></div>
            </div>
        </div>

        {{-- Soal scrollable card --}}
        <div class="sim-card overflow-hidden">

            {{-- Legend header (Hanya muncul di Layar Lebar) --}}
            <div class="hidden md:flex px-6 py-3 items-center justify-between sticky top-0 z-10"
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
            <div class="overflow-y-auto" style="max-height:calc(100vh - 280px);">
                @foreach($batchSoals as $idx => $soal)
                    @php
                        $jawaban = $jawabanBatch[(string) $soal->id] ?? null;
                        $isLast  = $idx === $batchSoals->count() - 1;
                    @endphp
                    <div wire:key="soal-{{ $soal->id }}"
                         class="flex flex-col md:flex-row md:items-center gap-4 px-4 py-5 md:px-6 md:py-4 transition-all"
                         style="{{ ! $isLast ? 'border-bottom:1px solid rgba(26,35,64,0.06);' : '' }}
                                {{ ! is_null($jawaban) ? 'background-color:rgba(200,146,42,0.03);' : '' }}">

                        {{-- Nomor & teks soal --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start gap-2 md:gap-3">
                                <span class="text-xs md:text-sm font-bold mt-0.5 shrink-0 w-5 md:w-6 text-right" style="color:#A6781F;">
                                    {{ $currentBatch * $batchSize + $idx + 1 }}.
                                </span>
                                <p class="text-xs md:text-sm leading-relaxed font-medium" style="color:#1A2340;">
                                    {{ $soal->teks_soal }}
                                </p>
                            </div>
                            @if($soal->kategori)
                                <p class="text-[10px] md:text-xs mt-1.5 md:mt-1 ml-7 md:ml-9" style="color:#6B7494;">
                                    <i class="ti ti-tag text-[10px] md:text-xs mr-1"></i>{{ $soal->kategori->nama_kategori }}
                                </p>
                            @endif
                        </div>

                        {{-- Lingkaran pilihan --}}
                        <div class="flex flex-col items-center mt-3 md:mt-0 ml-7 md:ml-0 shrink-0">
                            {{-- Label Setuju / Tidak Setuju (mobile) --}}
                            <div class="flex md:hidden w-full justify-between mb-2 px-1">
                                <span class="text-[10px] font-bold" style="color:#C8922A;">Setuju</span>
                                <span class="text-[10px] font-bold" style="color:#6B7494;">Tidak Setuju</span>
                            </div>

                            <div class="flex items-center w-full justify-between md:justify-center md:gap-1.5">
                                @foreach([1,2,3,4,5] as $nilai)
                                    @php
                                        $dipilih = $jawaban === $nilai;
                                        // Ukuran via inline style agar tidak bergantung pada Tailwind JIT
                                        // Mobile: semua 40px (mudah di-tap), Desktop: variasi ukuran
                                        $sizeMd = [28, 22, 16, 22, 28][$nilai - 1];
                                    @endphp
                                    <button
                                        wire:click="pilihJawaban({{ $soal->id }}, {{ $nilai }})"
                                        class="sim-likert-circle rounded-full border-2 flex items-center justify-center transition-all duration-150 shrink-0"
                                        style="
                                            /* Mobile default: 40px */
                                            width: 40px; height: 40px;
                                            {{ $dipilih
                                                ? 'background-color:#C8922A; border-color:#C8922A; box-shadow:0 2px 10px rgba(200,146,42,0.4); transform:scale(1.1);'
                                                : 'background-color:#fff; border-color:rgba(26,35,64,0.2);'
                                            }}
                                        ">
                                        @if($dipilih)
                                            <i class="ti ti-check" style="color:#fff; font-size:14px;"></i>
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            {{-- Footer status --}}
            <div class="px-4 py-3 md:px-6 md:py-3 flex items-center justify-between"
                 style="background-color:rgba(253,246,232,0.5);border-top:1px solid rgba(26,35,64,0.07);">
                <span class="text-[10px] md:text-xs font-semibold" style="color:#6B7494;">
                    {{ $terjawab }} / {{ $batchSoals->count() }} soal
                </span>
                @if(! $isComplete)
                    <span class="text-[10px] md:text-xs" style="color:#C8922A;">
                        <i class="ti ti-alert-circle mr-0.5"></i> Jawab semua soal
                    </span>
                @else
                    <span class="text-[10px] md:text-xs font-semibold flex items-center gap-1" style="color:#2E7D55;">
                        <i class="ti ti-circle-check"></i> Lengkap
                    </span>
                @endif
            </div>
        </div>

        {{-- AREA UPLOAD --}}
        @if($isLastBatch && $isComplete)
        <div class="sim-card p-4 md:p-6 border-2 border-dashed transition-all" style="border-color:rgba(200,146,42,0.4); background-color:rgba(253,246,232,0.4);">
            <div class="flex flex-col md:flex-row items-start gap-3 md:gap-4">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0" style="background-color:rgba(200,146,42,0.1);">
                    <i class="ti ti-medal text-xl" style="color:#C8922A;"></i>
                </div>
                <div class="flex-1 w-full">
                    <h3 class="text-sm md:text-base font-bold mb-1" style="color:#1A2340;">Bukti Prestasi (Opsional)</h3>
                    <p class="text-[10px] md:text-xs mb-3 leading-relaxed" style="color:#6B7494;">Lampirkan sertifikat/portofolio (PDF/JPG/PNG, Maks 2MB).</p>

                    <input type="file" wire:model="fileBakat" class="block w-full text-xs text-gray-500
                        file:mr-3 file:py-2 file:px-3
                        file:rounded-lg file:border-0
                        file:text-[10px] file:font-bold
                        file:bg-[#C8922A] file:text-white
                        hover:file:bg-[#A6781F] transition cursor-pointer file:cursor-pointer">

                    <div wire:loading wire:target="fileBakat" class="text-[10px] md:text-xs font-bold mt-2 flex items-center gap-1.5" style="color:#C8922A;">
                        <i class="ti ti-loader animate-spin"></i> Mengunggah...
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Navigasi --}}
        <div class="flex items-center justify-between pt-2">
            <button wire:click="prev"
                    @if($currentBatch === 0) disabled @endif
                    class="sim-btn-ghost text-xs md:text-sm px-3 py-2 disabled:opacity-40 disabled:cursor-not-allowed">
                <i class="ti ti-arrow-left"></i> Kembali
            </button>

            @if($isLastBatch)
                <button wire:click="submitFinal"
                        @if(! $isComplete) disabled @endif
                        class="sim-btn-gold text-xs md:text-sm px-4 py-2 disabled:opacity-40 disabled:cursor-not-allowed flex items-center gap-2">
                    Selesai <i class="ti ti-check"></i>
                </button>
            @else
                <button wire:click="next"
                        @if(! $isComplete) disabled @endif
                        class="sim-btn-gold text-xs md:text-sm px-4 py-2 disabled:opacity-40 disabled:cursor-not-allowed flex items-center gap-2">
                    Berikutnya <i class="ti ti-arrow-right"></i>
                </button>
            @endif
        </div>

    @else
        <div class="sim-card p-10 text-center">
            <i class="ti ti-clipboard-off text-5xl mb-3 block" style="color:#6B7494;"></i>
            <p class="text-sm" style="color:#6B7494;">Belum ada soal aktif.</p>
        </div>
    @endif
</div>