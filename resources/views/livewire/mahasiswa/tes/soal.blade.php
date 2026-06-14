<div>
    {{-- Header Info & Progress --}}
    <div class="mb-6 flex flex-col md:flex-row md:justify-between md:items-end gap-3">
        <div>
            @if($isReviewMode)
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full mb-2 text-xs font-bold"
                     style="background-color:rgba(200,146,42,0.12);color:#C8922A;border:1px solid rgba(200,146,42,0.25);">
                    <i class="ti ti-eye text-sm"></i> Mode Tinjau — Jawaban Tidak Dapat Diubah
                </div>
                <h2 class="text-xs font-bold uppercase tracking-widest mb-1" style="color:#C8922A;">
                    HALAMAN {{ $currentBatch + 1 }} DARI {{ $totalBatches }}
                </h2>
                <p class="text-sm font-medium" style="color:#6B7494;">Berikut jawaban yang telah Anda berikan sebelumnya.</p>
            @else
                <h2 class="text-xs font-bold uppercase tracking-widest mb-1" style="color:#C8922A;">
                    HALAMAN {{ $currentBatch + 1 }} DARI {{ $totalBatches }}
                </h2>
                <p class="text-sm font-medium" style="color:#6B7494;">Pilih jawaban yang paling mencerminkan diri Anda.</p>
            @endif
        </div>
        <div class="text-left md:text-right">
            <span class="text-2xl font-display font-bold" style="color:#1A2340;">{{ $persentase }}%</span>
        </div>
    </div>

    {{-- Keterangan Skala Likert --}}
    <div class="flex items-center justify-between px-5 py-3 rounded-t-xl border border-b-0" style="background-color:#fff; border-color:rgba(26,35,64,0.1);">
        <span class="text-[10px] md:text-xs font-bold" style="color:#6B7494;">STS = Sangat Tidak Setuju</span>
        <span class="text-[10px] md:text-xs font-bold" style="color:#6B7494;">SS = Sangat Setuju</span>
    </div>

    {{-- Daftar Soal --}}
    <div class="border rounded-b-xl shadow-sm mb-8 bg-white" style="border-color:rgba(26,35,64,0.1);">
        <div class="divide-y" style="divide-color:rgba(26,35,64,0.06);">
            @foreach($batchSoals as $idx => $soal)
                @php $jawaban = $jawabanBatch[(string) $soal->id] ?? null; @endphp

                <div wire:key="soal-{{ $soal->id }}"
                     class="p-5 md:p-6 transition-colors duration-300 {{ $jawaban ? 'bg-[#FDF6E8]/40' : 'hover:bg-gray-50' }}">

                    <div class="flex flex-col md:flex-row md:items-center gap-5 md:gap-8">

                        {{-- Teks Pertanyaan --}}
                        <div class="flex-1">
                            <p class="text-sm md:text-base font-medium leading-relaxed" style="color:#1A2340;">
                                {{ $soal->teks_soal }}
                            </p>
                        </div>

                        {{-- Pilihan Jawaban 1-4 (LINGKARAN) --}}
                        <div class="shrink-0 w-full md:w-auto mt-2 md:mt-0 flex justify-center md:justify-end">
                            <div class="flex items-center justify-between w-full md:w-auto gap-5 md:gap-6 px-2 md:px-0">
                                @foreach([1 => 'STS', 2 => 'TS', 3 => 'S', 4 => 'SS'] as $nilai => $label)
                                    @php $dipilih = $jawaban === $nilai; @endphp
                                    <div class="flex flex-col items-center">
                                        @if($isReviewMode)
                                            {{-- Read-only: tidak ada wire:click --}}
                                            <div class="w-10 h-10 md:w-11 md:h-11 rounded-full border-2 flex items-center justify-center mb-1.5"
                                                 style="
                                                     background-color: {{ $dipilih ? '#C8922A' : '#ffffff' }};
                                                     border-color: {{ $dipilih ? '#C8922A' : 'rgba(26,35,64,0.15)' }};
                                                     transform: {{ $dipilih ? 'scale(1.15)' : 'scale(1)' }};
                                                     box-shadow: {{ $dipilih ? '0 4px 10px rgba(200,146,42,0.3)' : 'none' }};
                                                     cursor: default;
                                                 ">
                                                @if($dipilih)
                                                    <i class="ti ti-check text-sm md:text-base" style="color:#1A2340;"></i>
                                                @endif
                                            </div>
                                        @else
                                            <button wire:click="pilihJawaban({{ $soal->id }}, {{ $nilai }})"
                                                    class="w-10 h-10 md:w-11 md:h-11 rounded-full border-2 transition-all duration-300 flex items-center justify-center mb-1.5 focus:outline-none"
                                                    style="
                                                        background-color: {{ $dipilih ? '#C8922A' : '#ffffff' }};
                                                        border-color: {{ $dipilih ? '#C8922A' : 'rgba(26,35,64,0.2)' }};
                                                        transform: {{ $dipilih ? 'scale(1.15)' : 'scale(1)' }};
                                                        box-shadow: {{ $dipilih ? '0 4px 10px rgba(200,146,42,0.3)' : 'none' }};
                                                    ">
                                                @if($dipilih)
                                                    <i class="ti ti-check text-sm md:text-base" style="color:#1A2340;"></i>
                                                @endif
                                            </button>
                                        @endif
                                        <span class="text-[10px] font-bold tracking-wide"
                                              style="color: {{ $dipilih ? '#C8922A' : '#6B7494' }};">
                                            {{ $label }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        {{-- Footer Status --}}
        <div class="px-5 py-4 flex items-center justify-between" style="background-color:rgba(26,35,64,0.02); border-top:1px solid rgba(26,35,64,0.06);">
            <span class="text-xs font-semibold" style="color:#6B7494;">
                @if($isReviewMode)
                    Soal: <span class="font-bold text-[#1A2340]">{{ $terjawab }}</span> dari {{ $batchSoals->count() }}
                @else
                    Terjawab: <span class="font-bold text-[#1A2340]">{{ $terjawab }}</span> dari {{ $batchSoals->count() }} soal
                @endif
            </span>
            @if($isReviewMode)
                <span class="text-xs font-bold flex items-center gap-1.5" style="color:#C8922A;">
                    <i class="ti ti-eye text-sm"></i> Mode Tinjau
                </span>
            @elseif($isComplete)
                <span class="text-xs font-bold flex items-center gap-1.5" style="color:#2E7D55;">
                    <i class="ti ti-circle-check text-sm"></i> Selesai
                </span>
            @else
                <span class="text-xs font-bold flex items-center gap-1.5" style="color:#D97757;">
                    <i class="ti ti-alert-circle text-sm"></i> Belum Selesai
                </span>
            @endif
        </div>
    </div>

    {{-- Tombol Navigasi --}}
    <div class="flex justify-between items-center pb-8">
        <button wire:click="prev" @if($currentBatch === 0) disabled @endif
                class="px-5 md:px-6 py-2.5 rounded-xl font-semibold text-sm transition-all flex items-center gap-2"
                style="background-color: {{ $currentBatch === 0 ? 'rgba(26,35,64,0.05)' : '#ffffff' }};
                       color: {{ $currentBatch === 0 ? 'rgba(26,35,64,0.3)' : '#1A2340' }};
                       border: 1px solid {{ $currentBatch === 0 ? 'transparent' : 'rgba(26,35,64,0.15)' }};">
            <i class="ti ti-arrow-left"></i> Kembali
        </button>

        @if($isReviewMode)
            @if($isLastBatch)
                <a href="{{ route('mahasiswa.results') }}"
                   class="px-5 md:px-6 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 shadow-md"
                   style="background-color:#1A2340;color:#FDF6E8;">
                    <i class="ti ti-arrow-left text-base"></i> Kembali ke Hasil
                </a>
            @else
                <button wire:click="next"
                        class="px-5 md:px-6 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 shadow-md"
                        style="background-color:#C8922A;color:#1A2340;">
                    Berikutnya <i class="ti ti-arrow-right text-base"></i>
                </button>
            @endif
        @else
            @if($isLastBatch)
                <button wire:click="submitFinal" @if(!$isComplete) disabled @endif
                        class="px-5 md:px-6 py-2.5 rounded-xl font-bold text-sm transition-all flex items-center gap-2 shadow-md"
                        style="background-color: {{ !$isComplete ? 'rgba(26,35,64,0.1)' : '#1A2340' }};
                               color: {{ !$isComplete ? 'rgba(26,35,64,0.4)' : '#FDF6E8' }};">
                    Selesai & Lanjut MBTI <i class="ti ti-check text-base"></i>
                </button>
            @else
                <button wire:click="next" @if(!$isComplete) disabled @endif
                        class="px-5 md:px-6 py-2.5 rounded-xl font-bold text-sm transition-all flex items-center gap-2 shadow-md"
                        style="background-color: {{ !$isComplete ? 'rgba(26,35,64,0.1)' : '#C8922A' }};
                               color: {{ !$isComplete ? 'rgba(26,35,64,0.4)' : '#1A2340' }};">
                    Berikutnya <i class="ti ti-arrow-right text-base"></i>
                </button>
            @endif
        @endif
    </div>
</div>
