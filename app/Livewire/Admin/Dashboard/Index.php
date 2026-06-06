<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\DraftJawaban;
use App\Models\Soal;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    // Properti Data Riil
    public $totalUsers = 0;

    public $activeAssessments = 0;

    public $completionRate = 0;

    public $systemHealth = '99.9%'; // Default statis untuk saat ini

    // Properti Data Log & Chart (Akan dibuat dinamis nanti jika tabel log sudah ada)
    public $participationData = [];

    public $activityLogs = [];

    public function mount()
    {
        $this->kalkulasiDataUtama();
        $this->siapkanDataChart();
        $this->siapkanActivityLog();
    }

    private function kalkulasiDataUtama()
    {
        $this->totalUsers = User::count();

        $totalSoal = Soal::count();

        $userMengerjakan = DraftJawaban::select('user_id')->distinct()->pluck('user_id');
        $this->activeAssessments = $userMengerjakan->count();

        if ($this->activeAssessments > 0 && $totalSoal > 0) {
            $userSelesai = 0;

            foreach ($userMengerjakan as $userId) {
                $jumlahJawabanUser = DraftJawaban::where('user_id', $userId)->count();
                if ($jumlahJawabanUser >= $totalSoal) {
                    $userSelesai++;
                }
            }

            $this->completionRate = round(($userSelesai / $this->activeAssessments) * 100, 1);
        }
    }

    private function siapkanDataChart()
    {
        $this->participationData = [
            'labels' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            'data' => [45, 60, 120, 80, 150, 75, 110],
        ];
    }

    private function siapkanActivityLog(): void
    {
        // Ambil registrasi user terbaru sebagai activity log
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
