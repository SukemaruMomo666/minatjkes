<?php

namespace App\Livewire\Admin\Dashboard;

use App\Enums\UserRole;
use App\Models\DraftJawaban;
use App\Models\JawabanMbti;
use App\Models\Soal;
use App\Models\SoalMbti;
use App\Models\User;
use Illuminate\Support\Carbon;
use Livewire\Component;

class Index extends Component
{
    public int $totalMahasiswa = 0;

    public int $sudahSelesai = 0;

    public int $sedangProses = 0;

    public int $belumMulai = 0;

    public float $completionRate = 0;

    public array $participationData = [];

    public array $activityLogs = [];

    public function mount(): void
    {
        $this->kalkulasiDataUtama();
        $this->siapkanDataChart();
        $this->siapkanActivityLog();
    }

    private function kalkulasiDataUtama(): void
    {
        $totalSoalMinat = Soal::where('is_active', true)->count();
        $totalSoalMbti = SoalMbti::where('is_active', true)->count();

        $mahasiswas = User::where('role', UserRole::Mahasiswa)
            ->whereHas('kelas', fn ($q) => $q->where('nama_kelas', '!=', 'Developer Test'))
            ->pluck('id');
        $this->totalMahasiswa = $mahasiswas->count();

        if ($this->totalMahasiswa === 0) {
            return;
        }

        $jawabanCountPerUser = DraftJawaban::whereIn('user_id', $mahasiswas)
            ->selectRaw('user_id, COUNT(*) as total')
            ->groupBy('user_id')
            ->pluck('total', 'user_id');

        $mbtiCountPerUser = JawabanMbti::whereIn('user_id', $mahasiswas)
            ->selectRaw('user_id, COUNT(*) as total')
            ->groupBy('user_id')
            ->pluck('total', 'user_id');

        foreach ($mahasiswas as $id) {
            $jawabanMinat = $jawabanCountPerUser[$id] ?? 0;
            $jawabanMbti = $mbtiCountPerUser[$id] ?? 0;

            $minatSelesai = $totalSoalMinat > 0 && $jawabanMinat >= $totalSoalMinat;
            $mbtiSelesai = $totalSoalMbti > 0 && $jawabanMbti >= $totalSoalMbti;

            if ($minatSelesai && $mbtiSelesai) {
                $this->sudahSelesai++;
            } elseif ($jawabanMinat > 0 || $jawabanMbti > 0) {
                $this->sedangProses++;
            } else {
                $this->belumMulai++;
            }
        }

        $this->completionRate = round(($this->sudahSelesai / $this->totalMahasiswa) * 100, 1);
    }

    private function siapkanDataChart(): void
    {
        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $labels[] = $date->translatedFormat('D, d M');

            $count = DraftJawaban::whereDate('updated_at', $date)
                ->distinct('user_id')
                ->count('user_id');

            $data[] = $count;
        }

        $this->participationData = [
            'labels' => $labels,
            'data' => $data,
        ];
    }

    private function siapkanActivityLog(): void
    {
        $recentUsers = User::latest()
            ->take(5)
            ->get(['nama', 'role', 'nim_nidn', 'created_at']);

        $this->activityLogs = $recentUsers->map(fn ($u) => [
            'action' => 'User terdaftar: '.($u->nama ?? '-'),
            'user' => $u->nim_nidn ?? '-',
            'role' => ucfirst($u->role->value ?? 'user'),
            'time' => $u->created_at?->diffForHumans() ?? '-',
        ])->toArray();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.index')->layout('layouts.blank');
    }
}
