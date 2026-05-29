<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\User;
use App\Models\DraftJawaban;
use App\Models\Soal;
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
            'data' => [45, 60, 120, 80, 150, 75, 110]
        ];
    }

    private function siapkanActivityLog()
    {
        $this->activityLogs = [
            ['action' => 'Created new assessment', 'user' => 'Dr. Emily Chen', 'role' => 'Faculty', 'time' => '10 mins ago', 'color' => 'bg-blue-100 text-blue-700'],
            ['action' => 'Updated institutional profile', 'user' => 'Mark Johnson', 'role' => 'Admin', 'time' => '1 hr ago', 'color' => 'bg-indigo-100 text-indigo-700'],
            ['action' => 'Exported user reports', 'user' => 'Sarah Williams', 'role' => 'Admin', 'time' => '3 hrs ago', 'color' => 'bg-indigo-100 text-indigo-700'],
            ['action' => 'Failed login attempt', 'user' => 'Unknown IP', 'role' => 'System', 'time' => '5 hrs ago', 'color' => 'bg-gray-100 text-gray-700'],
        ];
    }

    public function render()
    {
        return view('livewire.admin.dashboard.index')->layout('layouts.blank');
    }
}