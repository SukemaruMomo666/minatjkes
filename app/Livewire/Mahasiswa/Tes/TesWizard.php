<?php

namespace App\Livewire\Mahasiswa\Tes;

use App\Models\DraftJawaban;
use App\Models\Soal;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TesWizard extends Component
{
    public $soals;

    public bool $hasStarted = false;

    public int $batchSize = 6;

    public int $currentBatch = 0;

    public int $totalBatches = 0;

    public int $totalSoal = 0;

    /** @var array<string, int|null> soal_id => nilai */
    public array $jawabanBatch = [];

    public function mount(): void
    {
        $this->soals = Soal::where('is_active', true)->get();
        $this->totalSoal = $this->soals->count();

        if ($this->totalSoal > 0) {
            $this->totalBatches = (int) ceil($this->totalSoal / $this->batchSize);
            $this->loadBatch();
        }
    }

    public function mulaiTes(): void
    {
        $this->hasStarted = true;

        $answeredCount = DraftJawaban::where('user_id', Auth::id())->count();

        if ($answeredCount > 0 && $answeredCount < $this->totalSoal) {
            // Lanjut dari batch terakhir yang belum penuh
            $this->currentBatch = (int) floor($answeredCount / $this->batchSize);
            $this->currentBatch = min($this->currentBatch, $this->totalBatches - 1);
        }

        $this->loadBatch();
    }

    public function reviewTes(): void
    {
        $this->hasStarted = true;
        $this->currentBatch = 0;
        $this->loadBatch();
    }

    /** Muat jawaban yang sudah tersimpan untuk batch aktif */
    public function loadBatch(): void
    {
        $soalIds = $this->getCurrentBatchSoals()->pluck('id')->toArray();

        $existing = DraftJawaban::where('user_id', Auth::id())
            ->whereIn('soal_id', $soalIds)
            ->pluck('jawaban', 'soal_id')
            ->toArray();

        $this->jawabanBatch = [];
        foreach ($soalIds as $id) {
            $this->jawabanBatch[(string) $id] = isset($existing[$id]) ? (int) $existing[$id] : null;
        }
    }

    public function pilihJawaban(int $soalId, int $nilai): void
    {
        $this->jawabanBatch[(string) $soalId] = $nilai;

        DraftJawaban::updateOrCreate(
            ['user_id' => Auth::id(), 'soal_id' => $soalId],
            ['jawaban' => $nilai]
        );
    }

    public function next(): void
    {
        if ($this->currentBatch < $this->totalBatches - 1) {
            $this->currentBatch++;
            $this->loadBatch();
        } else {
            redirect()->route('mahasiswa.results');
        }
    }

    public function prev(): void
    {
        if ($this->currentBatch > 0) {
            $this->currentBatch--;
            $this->loadBatch();
        }
    }

    public function getCurrentBatchSoals(): Collection
    {
        $start = $this->currentBatch * $this->batchSize;

        return $this->soals->slice($start, $this->batchSize)->values();
    }

    public function batchIsComplete(): bool
    {
        $batchSoals = $this->getCurrentBatchSoals();

        foreach ($batchSoals as $soal) {
            if (is_null($this->jawabanBatch[(string) $soal->id] ?? null)) {
                return false;
            }
        }

        return true;
    }

    public function render(): View
    {
        $batchSoals = $this->getCurrentBatchSoals();
        $terjawab = collect($this->jawabanBatch)->filter(fn ($v) => ! is_null($v))->count();
        $totalDijawab = DraftJawaban::where('user_id', Auth::id())->count();

        $persentase = $this->totalSoal > 0
            ? round(($totalDijawab / $this->totalSoal) * 100)
            : 0;

        return view('livewire.mahasiswa.tes.tes-wizard', [
            'batchSoals' => $batchSoals,
            'persentase' => $persentase,
            'terjawab' => $terjawab,
            'isLastBatch' => $this->currentBatch >= $this->totalBatches - 1,
            'isComplete' => $this->batchIsComplete(),
        ])->layout('layouts.blank');
    }
}
