<div class="max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="mb-8">
        <p class="text-xs font-bold uppercase tracking-widest mb-2" style="color:#A6781F;letter-spacing:0.12em;">SIMINAT · Pemetaan Potensi</p>
        <h2 class="font-display text-3xl font-bold mb-2" style="color:#1A2340;">Instruksi Pengisian</h2>
        <p class="text-base" style="color:#2D3F6B;">
            Baca instruksi berikut sebelum memulai agar hasilmu akurat dan bermakna.
        </p>
    </div>

    {{-- Info cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">

        <div class="sim-card p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0" style="background-color:rgba(200,146,42,0.1);">
                    <i class="ti ti-clock text-xl" style="color:#C8922A;"></i>
                </div>
                <div>
                    <p class="text-sm font-bold" style="color:#1A2340;">Estimasi Waktu</p>
                    <p class="text-xs font-bold" style="color:#C8922A;">15–20 Menit</p>
                </div>
            </div>
            <p class="text-xs leading-relaxed" style="color:#6B7494;">Disarankan menyelesaikan dalam satu sesi tanpa interupsi untuk hasil terbaik.</p>
        </div>

        <div class="sim-card p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0" style="background-color:rgba(200,146,42,0.1);">
                    <i class="ti ti-home text-xl" style="color:#C8922A;"></i>
                </div>
                <div>
                    <p class="text-sm font-bold" style="color:#1A2340;">Tips Lingkungan</p>
                </div>
            </div>
            <ul class="space-y-1.5">
                <li class="flex items-center gap-2 text-xs" style="color:#2D3F6B;">
                    <i class="ti ti-check text-sm" style="color:#2E7D55;"></i> Cari tempat tenang & bebas gangguan
                </li>
                <li class="flex items-center gap-2 text-xs" style="color:#2D3F6B;">
                    <i class="ti ti-check text-sm" style="color:#2E7D55;"></i> Pastikan koneksi internet stabil
                </li>
            </ul>
        </div>

        <div class="sim-card p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0" style="background-color:rgba(200,146,42,0.1);">
                    <i class="ti ti-mood-smile text-xl" style="color:#C8922A;"></i>
                </div>
                <div>
                    <p class="text-sm font-bold" style="color:#1A2340;">Tips Mental</p>
                </div>
            </div>
            <ul class="space-y-1.5">
                <li class="flex items-center gap-2 text-xs" style="color:#2D3F6B;">
                    <i class="ti ti-check text-sm" style="color:#2E7D55;"></i> Jawab jujur sesuai kondisi aslimu
                </li>
                <li class="flex items-center gap-2 text-xs" style="color:#2D3F6B;">
                    <i class="ti ti-check text-sm" style="color:#2E7D55;"></i> Tidak ada jawaban benar/salah
                </li>
            </ul>
        </div>
    </div>

    {{-- Skala Penilaian (desain lingkaran) --}}
    <div class="sim-card p-6 mb-6">
        <h3 class="text-base font-bold mb-1" style="color:#1A2340;">Skala Penilaian</h3>
        <p class="text-xs mb-6" style="color:#6B7494;">Setiap pertanyaan dijawab dengan memilih salah satu lingkaran berikut:</p>

        {{-- Preview lingkaran seperti saat tes --}}
        <div class="flex items-center justify-between mb-5">
            <span class="text-xs font-bold" style="color:#C8922A;">Setuju</span>
            <div class="flex items-center gap-2 flex-1 justify-center">
                @php $sizes = [36, 28, 20, 28, 36]; @endphp
                @foreach([1,2,3,4,5] as $n)
                    <div class="rounded-full border-2 flex items-center justify-center font-bold transition-all"
                         style="width:{{ $sizes[$n-1] }}px; height:{{ $sizes[$n-1] }}px;
                                font-size:{{ $n === 1 || $n === 5 ? '13px' : ($n === 3 ? '10px' : '11px') }};
                                {{ $n === 1
                                    ? 'background-color:#C8922A; border-color:#C8922A; color:#fff; box-shadow:0 2px 8px rgba(200,146,42,0.35);'
                                    : 'background-color:#fff; border-color:rgba(26,35,64,0.18); color:#6B7494;' }}">
                        {{ $n }}
                    </div>
                @endforeach
            </div>
            <span class="text-xs font-bold" style="color:#6B7494;">Tidak Setuju</span>
        </div>

        {{-- Legenda label --}}
        <div class="grid grid-cols-5 gap-1 text-center">
            @php
                $labels = ['Sangat Setuju', 'Setuju', 'Netral', 'Tidak Setuju', 'Sangat Tidak Setuju'];
                $colors = ['#C8922A', '#C8922A', '#6B7494', '#6B7494', '#6B7494'];
            @endphp
            @foreach($labels as $i => $label)
                <div class="flex flex-col items-center gap-1">
                    <div class="w-px h-3" style="background-color:rgba(26,35,64,0.15);"></div>
                    <span style="font-size:10px; color:{{ $colors[$i] }}; font-weight:{{ $i < 2 ? '700' : '500' }}; line-height:1.3;">
                        {{ $label }}
                    </span>
                </div>
            @endforeach
        </div>

        {{-- Contoh soal mini --}}
        <div class="mt-5 p-4 rounded-xl" style="background-color:rgba(253,246,232,0.6); border:1px solid rgba(200,146,42,0.15);">
            <p class="text-xs font-semibold mb-3" style="color:#1A2340;">
                <i class="ti ti-info-circle mr-1" style="color:#C8922A;"></i>
                Contoh: "Saya menyukai kegiatan yang melibatkan kerja tim."
            </p>
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold" style="color:#C8922A;">Setuju</span>
                <div class="flex items-center gap-1.5 flex-1 justify-center">
                    @foreach([1,2,3,4,5] as $n)
                        <div class="rounded-full border-2 flex items-center justify-center"
                             style="width:{{ $sizes[$n-1] }}px; height:{{ $sizes[$n-1] }}px;
                                    {{ $n === 2
                                        ? 'background-color:#C8922A; border-color:#C8922A; box-shadow:0 2px 8px rgba(200,146,42,0.3);'
                                        : 'background-color:#fff; border-color:rgba(26,35,64,0.15);' }}">
                            @if($n === 2)
                                <i class="ti ti-check" style="color:#fff; font-size:11px;"></i>
                            @endif
                        </div>
                    @endforeach
                </div>
                <span class="text-xs" style="color:#6B7494;">Tidak Setuju</span>
            </div>
            <p class="text-xs mt-2" style="color:#6B7494; font-style:italic;">
                → Lingkaran ke-2 dipilih, artinya "Setuju" dengan pernyataan tersebut.
            </p>
        </div>
    </div>

    {{-- Navy banner --}}
    <div class="rounded-2xl px-6 py-5 mb-6 relative overflow-hidden" style="background-color:#1A2340;">
        <div class="absolute inset-0 siminat-batik" style="opacity:0.07;"></div>
        <p class="relative text-xs font-bold tracking-widest uppercase" style="color:#C8922A;letter-spacing:0.2em;">
            Akademik &bull; Profesional &bull; Akurat
        </p>
    </div>

    {{-- Actions --}}
    @php
        $answered   = App\Models\DraftJawaban::where('user_id', Auth::id())->count();
        $hasDraft   = $answered > 0;
        $resumeBatch = $totalSoal > 0 ? min((int) floor($answered / $batchSize), $totalBatches - 1) + 1 : 1;
    @endphp
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2">
        <div>
            @if($hasDraft)
                <p class="text-sm font-medium" style="color:#2D3F6B;">
                    <i class="ti ti-history mr-1" style="color:#C8922A;"></i>
                    Kamu sudah menjawab <strong style="color:#C8922A;">{{ $answered }}</strong> dari {{ $totalSoal }} soal
                    &mdash; akan dilanjutkan dari halaman {{ $resumeBatch }}.
                </p>
            @endif
        </div>
        <div class="flex gap-3">
            @if($hasDraft)
                <button wire:click="reviewTes" class="sim-btn-ghost text-sm">
                    <i class="ti ti-eye"></i> Tinjau dari Awal
                </button>
            @endif
            <button wire:click="mulaiTes" class="sim-btn-gold text-sm">
                {{ $hasDraft ? 'Lanjutkan Tes' : 'Mulai Sekarang' }}
                <i class="ti ti-arrow-right"></i>
            </button>
        </div>
    </div>

</div>
