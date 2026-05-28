<?php

namespace App\Livewire\Mahasiswa\Tes;

use App\Models\Soal;
use Livewire\Component;
use App\Models\DraftJawaban;
use Illuminate\Support\Facades\Auth;

class TesWizard extends Component
{
    public $soals;
    public $currentIndex = 0;
    public $totalSoal = 0;
    public $jawabanTerpilih = null;
    public $isSaved = false;
    public $hasStarted = false;

    public function mount()
    {
        $this->soals = Soal::all();
        $this->totalSoal = $this->soals->count();
        
        if ($this->totalSoal > 0) {
            $this->loadJawaban();
        }
    }

    public function mulaiTes()
    {
        $this->hasStarted = true;

        $answeredCount = DraftJawaban::where('user_id', Auth::id())->count();
        
        if ($answeredCount > 0 && $answeredCount < $this->totalSoal) {
            $this->currentIndex = $answeredCount;
            $this->loadJawaban();
        }
    }

    public function reviewTes()
    {
        $this->hasStarted = true;
        $this->currentIndex = 0;
        $this->loadJawaban();
    }

    public function loadJawaban()
    {
        $soalAktif = $this->soals[$this->currentIndex];
        $draft = DraftJawaban::where('user_id', Auth::id())
            ->where('soal_id', $soalAktif->id)
            ->first();

        $this->jawabanTerpilih = $draft ? (int) $draft->jawaban : null;
        $this->isSaved = $draft ? true : false;
    }

    public function pilihJawaban($nilai)
    {
        $this->jawabanTerpilih = $nilai;
        $soalAktif = $this->soals[$this->currentIndex];

        DraftJawaban::updateOrCreate(
            ['user_id' => Auth::id(), 'soal_id' => $soalAktif->id],
            ['jawaban' => $nilai]
        );

        $this->isSaved = true;
    }

    public function next()
    {
        if (!is_null($this->jawabanTerpilih)) {
            if ($this->currentIndex < $this->totalSoal - 1) {
                $this->jawabanTerpilih = null; 
                $this->isSaved = false;
                $this->currentIndex++;
                $this->loadJawaban();
            } else {

                return redirect()->route('mahasiswa.results');
            }
        }
    }

    public function prev()
    {
        if ($this->currentIndex > 0) {
            $this->jawabanTerpilih = null;
            $this->isSaved = false;
            
            $this->currentIndex--;
            $this->loadJawaban();
        }
    }

    public function render()
    {
        return view('livewire.mahasiswa.tes.tes-wizard', [
            'soalAktif' => $this->totalSoal > 0 ? $this->soals[$this->currentIndex] : null,
            'persentase' => $this->totalSoal > 0 ? (($this->currentIndex + 1) / $this->totalSoal) * 100 : 0,
        ])->layout('layouts.blank');
    }
}