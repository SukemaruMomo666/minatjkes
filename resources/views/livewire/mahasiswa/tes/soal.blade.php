<div class="max-w-4xl mx-auto space-y-8 mt-4">
    @if($totalSoal > 0 && $soalAktif)
        <div>
            <div class="flex justify-between items-end mb-4">
                <div>
                    <h3 class="text-xs font-bold text-[#D98324] tracking-widest uppercase mb-1">Tes Kepribadian Klinis</h3>
                    <h2 class="text-2xl font-bold text-[#2a3c5a]">Analisis Kecenderungan Karir</h2>
                </div>
                <div class="text-right">
                    
                    <div x-data="{
                            waktuSisa: 15 * 60, 
                            formatWaktu() {
                                let m = Math.floor(this.waktuSisa / 60).toString().padStart(2, '0');
                                let s = (this.waktuSisa % 60).toString().padStart(2, '0');
                                return m + ':' + s;
                            },
                            init() {
                                setInterval(() => {
                                    if(this.waktuSisa > 0) this.waktuSisa--;
                                }, 1000);
                            }
                        }" 
                        class="flex items-center justify-end text-[#D98324] font-bold mb-1 text-lg">
                        <svg class="w-5 h-5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span x-text="formatWaktu()"></span>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Sisa waktu estimasi: 15 menit</p>
                </div>
            </div>

            <div class="relative w-full h-3 bg-gray-200 rounded-full overflow-hidden flex items-center">
                <div class="absolute top-0 left-0 h-full bg-[#D98324] transition-all duration-500 ease-out" style="width: {{ $persentase }}%;"></div>
                <div class="w-full text-center absolute text-[10px] font-bold text-gray-600 mix-blend-overlay">
                    Pertanyaan {{ $currentIndex + 1 }} dari {{ $totalSoal }}
                </div>
            </div>
        </div>

        <div wire:key="card-soal-{{ $soalAktif->id }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 px-10 py-16">
            <h3 class="text-2xl font-bold text-[#2a3c5a] text-center mb-16 leading-relaxed max-w-3xl mx-auto">
                "{{ $soalAktif->teks_soal }}"
            </h3>

            <div class="flex justify-center items-center space-x-4 md:space-x-8 mb-16 relative">
                <div class="text-sm font-medium text-gray-400 absolute -left-4 md:-left-12 lg:left-0 text-right w-24 leading-tight">Sangat Tidak Setuju</div>
                
                @foreach([1, 2, 3, 4, 5] as $nilai)
                    <button 
                        wire:key="opsi-{{ $soalAktif->id }}-{{ $nilai }}"
                        wire:click="pilihJawaban({{ $nilai }})"
                        class="w-14 h-14 rounded-full flex items-center justify-center text-xl font-bold transition-all duration-200 border-2 
                        {{ $jawabanTerpilih === $nilai ? 'bg-[#D98324] border-[#D98324] text-white shadow-lg shadow-orange-500/30 transform scale-110' : 'bg-white border-gray-200 text-gray-500 hover:border-gray-400' }}">
                        {{ $nilai }}
                    </button>
                @endforeach

                <div class="text-sm font-medium text-gray-400 absolute -right-4 md:-right-12 lg:right-0 text-left w-24 leading-tight">Sangat Setuju</div>
            </div>

            <hr class="border-gray-100 mb-8">

            <div class="flex items-center justify-between">
                <button wire:click="prev" @if($currentIndex == 0) disabled @endif
                    class="flex items-center px-6 py-3 border-2 border-[#D98324] text-[#D98324] font-bold rounded-lg hover:bg-orange-50 transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </button>
                <div class="text-sm text-gray-400 font-medium">
                    @if($isSaved)
                        <span class="text-green-500 flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Pilihan tersimpan otomatis</span>
                    @else
                        Menunggu jawaban...
                    @endif
                </div>
                <button wire:click="next" @if(is_null($jawabanTerpilih)) disabled @endif
                    class="flex items-center px-8 py-3 bg-[#D98324] text-white font-bold rounded-lg hover:bg-[#c27520] transition shadow-md disabled:opacity-50 disabled:cursor-not-allowed">
                    
                    {{ $currentIndex == $totalSoal - 1 ? 'Selesai & Lihat Hasil' : 'Selanjutnya' }}
                    
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </div>
    @endif
</div>