<?php

namespace App\Livewire\Admin\KelasManagement;

use App\Enums\UserRole;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public bool $isModalOpen = false;

    public ?int $editId = null;

    public string $nama_kelas = '';

    public string $angkatan = '';

    public ?int $dosen_wali_id = null;

    public bool $is_active = true;

    public function openModal(?int $id = null): void
    {
        $this->resetForm();
        if ($id) {
            $kelas = Kelas::findOrFail($id);
            $this->editId = $kelas->id;
            $this->nama_kelas = $kelas->nama_kelas;
            $this->angkatan = (string) $kelas->angkatan;
            $this->dosen_wali_id = $kelas->dosen_wali_id;
            $this->is_active = $kelas->is_active;
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
        $this->nama_kelas = '';
        $this->angkatan = '';
        $this->dosen_wali_id = null;
        $this->is_active = true;
        $this->resetValidation();
    }

    public function simpan(): void
    {
        $this->validate([
            'nama_kelas' => 'required|string|max:100',
            'angkatan' => 'required|digits:4|integer|min:2000|max:2099',
        ]);

        $data = [
            'nama_kelas' => $this->nama_kelas,
            'angkatan' => (int) $this->angkatan,
            'dosen_wali_id' => $this->dosen_wali_id ?: null,
            'is_active' => $this->is_active,
        ];

        if ($this->editId) {
            Kelas::findOrFail($this->editId)->update($data);
            session()->flash('message', 'Kelas berhasil diperbarui.');
        } else {
            Kelas::create($data);
            session()->flash('message', 'Kelas berhasil ditambahkan.');
        }

        $this->closeModal();
    }

    public function hapus(int $id): void
    {
        Kelas::findOrFail($id)->delete();
        session()->flash('message', 'Kelas berhasil dihapus.');
    }

    public function render(): View
    {
        return view('livewire.admin.kelas-management.index', [
            'kelasList' => Kelas::with('dosenWali')->latest()->paginate(10),
            'dosenList' => User::where('role', UserRole::Dosen)->orderBy('nama')->get(),
        ])->layout('layouts.blank');
    }
}
