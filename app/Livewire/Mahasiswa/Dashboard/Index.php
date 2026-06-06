<?php

namespace App\Livewire\Mahasiswa\Dashboard;

use App\Models\DraftJawaban;
use App\Models\Soal;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public string $namaPanggil = '';

    public string $namaLengkap = '';

    public string $nimNidn = '';

    public string $inisial = '';

    public string $namaKelas = '-';

    public int $totalSoal = 0;

    public int $totalDijawab = 0;

    public int $progressPersen = 0;

    public string $statusTes = 'belum';

    public function mount(): void
    {
        $user = Auth::user()->load('kelas');

        $this->namaLengkap = $user->nama ?? '';
        $this->namaPanggil = explode(' ', $user->nama ?? '')[0];
        $this->nimNidn = $user->nim_nidn ?? '';
        $this->inisial = $user->initials();

        if ($user->kelas) {
            $this->namaKelas = $user->kelas->nama_kelas;
        }

        $this->totalSoal = Soal::where('is_active', true)->count();
        $this->totalDijawab = DraftJawaban::where('user_id', Auth::id())->count();

        if ($this->totalSoal > 0) {
            if ($this->totalDijawab === 0) {
                $this->statusTes = 'belum';
            } elseif ($this->totalDijawab >= $this->totalSoal) {
                $this->statusTes = 'selesai';
            } else {
                $this->statusTes = 'proses';
            }

            $this->progressPersen = min(100, (int) round(($this->totalDijawab / $this->totalSoal) * 100));
        }
    }

    public function render(): View
    {
        return view('livewire.mahasiswa.dashboard')->layout('layouts.blank');
    }
}
