<?php

namespace App\Livewire\Admin\LecturerManagement;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public bool $isModalOpen = false;

    public ?int $editId = null;

    public string $nama = '';

    public string $email = '';

    public string $nim_nidn = '';

    public string $password = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function openModal(?int $id = null): void
    {
        $this->resetForm();

        if ($id) {
            $dosen = User::findOrFail($id);
            $this->editId = $dosen->id;
            $this->nama = $dosen->nama ?? '';
            $this->email = $dosen->email ?? '';
            $this->nim_nidn = $dosen->nim_nidn ?? '';
        }

        $this->isModalOpen = true;
    }

    public function closeModal(): void
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    private function resetForm(): void
    {
        $this->editId = null;
        $this->nama = '';
        $this->email = '';
        $this->nim_nidn = '';
        $this->password = '';
        $this->resetValidation();
    }

    public function simpanDosen(): void
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'nim_nidn' => 'required|string|unique:users,nim_nidn'.($this->editId ? ",{$this->editId}" : ''),
            'email' => 'nullable|email|unique:users,email'.($this->editId ? ",{$this->editId}" : ''),
        ];

        if (! $this->editId) {
            $rules['password'] = 'required|min:6';
        }

        $this->validate($rules);

        $data = [
            'nama' => $this->nama,
            'nim_nidn' => $this->nim_nidn,
            'email' => $this->email ?: null,
            'role' => UserRole::Dosen,
        ];

        if (! $this->editId) {
            $data['password'] = Hash::make($this->password);
            User::create($data);
            session()->flash('message', 'Data dosen berhasil ditambahkan.');
        } else {
            if ($this->password) {
                $data['password'] = Hash::make($this->password);
            }
            User::findOrFail($this->editId)->update($data);
            session()->flash('message', 'Data dosen berhasil diperbarui.');
        }

        $this->closeModal();
    }

    public function hapus(int $id): void
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'Data dosen berhasil dihapus.');
    }

    public function render(): View
    {
        $lecturers = User::where('role', UserRole::Dosen)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.lecturer-management.index', [
            'lecturers' => $lecturers,
        ])->layout('layouts.blank');
    }
}
