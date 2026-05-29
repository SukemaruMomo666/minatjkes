<?php

namespace App\Livewire\Admin\LecturerManagement;

use App\Models\User;
use App\Enums\UserRole;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public $isModalOpen = false;
    public $nama, $email, $nim_nidn, $password;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal()
    {
        $this->resetForm();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    private function resetForm()
    {
        $this->nama = '';
        $this->email = '';
        $this->nim_nidn = '';
        $this->password = '';
    }

    public function simpanDosen()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nim_nidn' => 'required|string|unique:users,nim_nidn',
            'password' => 'required|min:6',
        ]);

        User::create([
            'nama' => $this->nama,
            'email' => $this->email,
            'nim_nidn' => $this->nim_nidn,
            'password' => Hash::make($this->password),
            'role' => 'dosen',
        ]);

        $this->closeModal();
        session()->flash('message', 'Data Dosen berhasil ditambahkan.');
    }

    public function render()
    {
        $lecturers = User::where('role', 'dosen')
                         ->orderBy('created_at', 'desc')
                         ->paginate(10);

        return view('livewire.admin.lecturer-management.index', [
            'lecturers' => $lecturers
        ])->layout('layouts.blank');
    }
}