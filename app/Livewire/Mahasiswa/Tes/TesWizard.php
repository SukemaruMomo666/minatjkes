<?php

namespace App\Livewire\Mahasiswa\Tes;

use App\Models\DraftJawaban;
use App\Models\Soal;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TesWizard extends Component
{
    public bool $hasStarted = false;

    public int $batchSize = 10;

    public int $currentBatch = 0;

    public int $totalBatches = 0;

    public int $totalSoal = 0;

    /** @var array<string, int|null> soal_id => nilai */
    public array $jawabanBatch = [];

    public $shuffledSoalIds = [];

    public function mount(): void
    {
        if (! session()->has('shuffled_soal_minat')) {
            $ids = Soal::where('is_active', true)->inRandomOrder()->pluck('id')->toArray();
            session()->put('shuffled_soal_minat', $ids);
        }

        $this->shuffledSoalIds = session('shuffled_soal_minat');
        $this->totalSoal = count($this->shuffledSoalIds);

        if ($this->totalSoal > 0) {
            $this->totalBatches = (int) ceil($this->totalSoal / $this->batchSize);
        }
    }

    public function getBatchSoalsProperty()
    {
        if (empty($this->shuffledSoalIds)) {
            return collect([]);
        }

        $currentIds = array_slice($this->shuffledSoalIds, $this->currentBatch * $this->batchSize, $this->batchSize);

        return Soal::whereIn('id', $currentIds)
            ->get()
            ->sortBy(function ($model) use ($currentIds) {
                return array_search($model->id, $currentIds);
            })->values();
    }

    public function mulaiTes(): void
    {
        $this->hasStarted = true;

        $answeredCount = DraftJawaban::where('user_id', Auth::id())->count();

        if ($answeredCount > 0 && $answeredCount < $this->totalSoal) {
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

    public function loadBatch(): void
    {
        $soalIds = $this->batchSoals->pluck('id')->toArray();

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
        DraftJawaban::updateOrCreate(
            ['user_id' => Auth::id(), 'soal_id' => $soalId],
            ['jawaban' => $nilai]
        );

        $this->jawabanBatch[$soalId] = $nilai;
    }

    public function next(): void
    {
        if ($this->currentBatch < $this->totalBatches - 1) {
            $this->currentBatch++;
            $this->loadBatch();
        }
    }

    public function prev(): void
    {
        if ($this->currentBatch > 0) {
            $this->currentBatch--;
            $this->loadBatch();
        }
    }

    public function batchIsComplete(): bool
    {
        foreach ($this->batchSoals as $soal) {
            if (is_null($this->jawabanBatch[(string) $soal->id] ?? null)) {
                return false;
            }
        }

        return true;
    }

    public function submitFinal()
    {
        if (! $this->batchIsComplete()) {
            return;
        }

        session()->forget('shuffled_soal_minat');

        return redirect()->route('mahasiswa.tes.mbti');
    }

    public function render(): View
    {
        $batchSoals = $this->batchSoals;
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
