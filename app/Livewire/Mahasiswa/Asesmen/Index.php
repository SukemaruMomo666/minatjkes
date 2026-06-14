<?php

namespace App\Livewire\Mahasiswa\Asesmen;

use App\Models\DraftJawaban;
use App\Models\JawabanMbti;
use App\Models\Soal;
use App\Models\SoalMbti;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public string $activeTab = 'minat';

    public int $totalSoalMinat = 0;

    public int $totalDijawabMinat = 0;

    public int $progressMinat = 0;

    public string $statusMinat = 'belum';

    public int $totalSoalMbti = 0;

    public int $totalDijawabMbti = 0;

    public int $progressMbti = 0;

    public string $statusMbti = 'belum';

    public function mount(): void
    {
        $userId = Auth::id();

        $this->totalSoalMinat = Soal::where('is_active', true)->count();
        $this->totalDijawabMinat = DraftJawaban::where('user_id', $userId)->count();

        if ($this->totalSoalMinat > 0) {
            $this->progressMinat = min(100, (int) round(($this->totalDijawabMinat / $this->totalSoalMinat) * 100));
            if ($this->totalDijawabMinat === 0) {
                $this->statusMinat = 'belum';
            } elseif ($this->totalDijawabMinat >= $this->totalSoalMinat) {
                $this->statusMinat = 'selesai';
            } else {
                $this->statusMinat = 'proses';
            }
        }

        $this->totalSoalMbti = SoalMbti::where('is_active', true)->count();
        $this->totalDijawabMbti = JawabanMbti::where('user_id', $userId)->count();

        if ($this->totalSoalMbti > 0) {
            $this->progressMbti = min(100, (int) round(($this->totalDijawabMbti / $this->totalSoalMbti) * 100));
            if ($this->totalDijawabMbti === 0) {
                $this->statusMbti = 'belum';
            } elseif ($this->totalDijawabMbti >= $this->totalSoalMbti) {
                $this->statusMbti = 'selesai';
            } else {
                $this->statusMbti = 'proses';
            }
        }
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function render(): View
    {
        return view('livewire.mahasiswa.asesmen.index')->layout('layouts.blank');
    }
}
