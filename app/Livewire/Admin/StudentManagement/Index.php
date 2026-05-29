<?php

namespace App\Livewire\Admin\StudentManagement;

use App\Models\User;
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

    public function simpanMahasiswa()
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
            'role' => 'mahasiswa', 
        ]);

        $this->closeModal();
        session()->flash('message', 'Data Mahasiswa berhasil ditambahkan.');
    }

    public function render()
    {
        $students = User::whereIn('role', ['mahasiswa', 'user'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('livewire.admin.student-management.index', [
            'students' => $students
        ])->layout('layouts.blank');
    }
}