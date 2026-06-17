<div class="max-w-4xl mx-auto pb-10">
    <div class="mb-8 mt-4">
        <p class="text-xs font-bold uppercase tracking-widest mb-1" style="color:#C8922A;">SIMINAT • PEMETAAN POTENSI</p>
        <h1 class="text-3xl font-display font-bold" style="color:#1A2340;">Instruksi Pengisian</h1>
        <p class="text-sm mt-2" style="color:#6B7494;">Baca instruksi berikut sebelum memulai agar hasilmu akurat dan bermakna.</p>
    </div>

    {{-- Info Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="sim-card p-5 border-t-4" style="border-top-color:#C8922A;">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background-color:rgba(200,146,42,0.1);color:#C8922A;">
                    <i class="ti ti-infinity"></i>
                </div>
                <h3 class="font-bold text-sm" style="color:#1A2340;">Santai & Fleksibel</h3>
            </div>
            <p class="text-xs" style="color:#6B7494;">Tidak ada batas waktu pengerjaan. Jawab dengan tenang sesuai kondisi dirimu.</p>
        </div>
        <div class="sim-card p-5 border-t-4" style="border-top-color:#2D3F6B;">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background-color:rgba(45,63,107,0.1);color:#2D3F6B;">
                    <i class="ti ti-home"></i>
                </div>
                <h3 class="font-bold text-sm" style="color:#1A2340;">Tips Lingkungan</h3>
            </div>
            <ul class="text-xs space-y-1" style="color:#6B7494;">
                <li><i class="ti ti-check text-[#2E7D55] mr-1"></i> Cari tempat tenang & bebas gangguan</li>
                <li><i class="ti ti-check text-[#2E7D55] mr-1"></i> Pastikan koneksi internet stabil</li>
            </ul>
        </div>
        <div class="sim-card p-5 border-t-4" style="border-top-color:#2E7D55;">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background-color:rgba(46,125,85,0.1);color:#2E7D55;">
                    <i class="ti ti-mood-smile"></i>
                </div>
                <h3 class="font-bold text-sm" style="color:#1A2340;">Tips Mental</h3>
            </div>
            <ul class="text-xs space-y-1" style="color:#6B7494;">
                <li><i class="ti ti-check text-[#2E7D55] mr-1"></i> Jawab jujur sesuai insting pertama</li>
                <li><i class="ti ti-check text-[#2E7D55] mr-1"></i> Tidak ada jawaban benar atau salah</li>
            </ul>
        </div>
    </div>

    {{-- Penjelasan Skala Penilaian --}}
    <div class="sim-card p-6 md:p-8 mb-8">
        
        <h3 class="text-base font-bold mb-3" style="color:#1A2340;"><i class="ti ti-school text-[#C8922A] mr-2"></i>Tahap 1: Minat & Bakat</h3>
        <p class="text-sm mb-5" style="color:#6B7494;">Pada tahap pertama (60 soal), Anda akan diminta merespons pernyataan menggunakan 5 skala penilaian berikut:</p>

        <div class="flex gap-2 md:gap-3 mb-8">
            @foreach([
                ['nilai' => 1, 'label' => 'Sangat Tidak Setuju', 'singkat' => 'STS', 'bg' => 'rgba(180,69,47,0.06)', 'border' => 'rgba(180,69,47,0.25)', 'color' => '#B4452F'],
                ['nilai' => 2, 'label' => 'Tidak Setuju',        'singkat' => 'TS',  'bg' => 'rgba(217,119,87,0.06)', 'border' => 'rgba(217,119,87,0.25)', 'color' => '#D97757'],
                ['nilai' => 3, 'label' => 'Netral',              'singkat' => 'N',   'bg' => 'rgba(107,116,148,0.06)','border' => 'rgba(107,116,148,0.25)','color' => '#6B7494'],
                ['nilai' => 4, 'label' => 'Setuju',              'singkat' => 'S',   'bg' => 'rgba(79,168,116,0.06)', 'border' => 'rgba(79,168,116,0.25)', 'color' => '#4FA874'],
                ['nilai' => 5, 'label' => 'Sangat Setuju',       'singkat' => 'SS',  'bg' => 'rgba(46,125,85,0.06)',  'border' => 'rgba(46,125,85,0.25)',  'color' => '#2E7D55'],
            ] as $skala)
            <div class="flex-1 flex flex-col items-center justify-center py-4 px-2 rounded-xl border text-center transition-all hover:scale-105 hover:shadow-md"
                 style="background-color:{{ $skala['bg'] }};border-color:{{ $skala['border'] }};">
                <div class="w-9 h-9 rounded-full flex items-center justify-center mb-2 font-bold text-base"
                     style="background-color:{{ $skala['color'] }};color:#fff;">
                    {{ $skala['nilai'] }}
                </div>
                <span class="text-[9px] md:text-[11px] font-bold leading-tight" style="color:{{ $skala['color'] }};">
                    {{ $skala['label'] }}
                </span>
                <span class="text-[9px] md:text-[10px] font-semibold mt-0.5" style="color:{{ $skala['color'] }};opacity:0.7;">
                    ({{ $skala['singkat'] }})
                </span>
            </div>
            @endforeach
        </div>

        <hr style="border-color:rgba(26,35,64,0.08); margin-bottom: 1.5rem;">

        <h3 class="text-base font-bold mb-3" style="color:#1A2340;"><i class="ti ti-brain text-[#C8922A] mr-2"></i>Tahap 2: Tes Kepribadian (MBTI)</h3>
        <p class="text-sm mb-2" style="color:#6B7494;">Setelah menyelesaikan Tahap 1, Anda akan otomatis diarahkan ke tes MBTI (30 soal). Anda cukup memilih pernyataan <strong>A</strong> atau <strong>B</strong> yang paling mendeskripsikan diri Anda.</p>
        
    </div>

    {{-- Tombol Mulai --}}
    <div class="text-center">
        <button wire:click="mulaiTes" class="sim-btn-gold px-8 py-3.5 text-sm font-bold shadow-lg transition-transform hover:scale-105">
            Saya Mengerti, Mulai Tes Sekarang <i class="ti ti-arrow-right ml-2"></i>
        </button>
    </div>
</div>