<?php

namespace App\Livewire\Mahasiswa\Tes;

use App\Models\JawabanMbti;
use App\Models\SoalMbti;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TesMbti extends Component
{
    public $soals;

    public $jawaban = [];

    public $isComplete = false;

    public $progressPersen = 0;

    public function mount()
    {

        $this->soals = SoalMbti::where('is_active', true)->get();

        $existing = JawabanMbti::where('user_id', Auth::id())
            ->pluck('pilihan', 'soal_mbti_id')
            ->toArray();

        $this->jawaban = $existing;
        $this->hitungProgress();
    }

    public function pilihJawaban($soalId, $pilihan)
    {
        JawabanMbti::updateOrCreate(
            ['user_id' => Auth::id(), 'soal_mbti_id' => $soalId],
            ['pilihan' => $pilihan]
        );

        $this->jawaban[$soalId] = $pilihan;
        $this->hitungProgress();
    }

    public function hitungProgress()
    {
        $total = $this->soals->count();
        $terjawab = count($this->jawaban);

        $this->progressPersen = $total > 0 ? round(($terjawab / $total) * 100) : 0;
        $this->isComplete = $terjawab === $total;
    }

    public function submitFinal()
    {
        if (! $this->isComplete) {
            return;
        }

        return redirect()->route('mahasiswa.results');
    }

    public function render()
    {
        return view('livewire.mahasiswa.tes.tes-mbti')
            ->layout('layouts.blank');
    }
}
