<?php

namespace App\Livewire\Admin\SoalManagement;

use App\Models\Kategori;
use App\Models\Soal;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public bool $isModalOpen = false;

    public ?int $editId = null;

    public string $search = '';

    public ?int $kategori_id = null;

    public string $tipe = 'akademik';

    public string $teks_soal = '';

    public bool $is_active = true;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function openModal(?int $id = null): void
    {
        $this->resetForm();
        if ($id) {
            $soal = Soal::findOrFail($id);
            $this->editId = $soal->id;
            $this->kategori_id = $soal->kategori_id;
            $this->tipe = $soal->tipe;
            $this->teks_soal = $soal->teks_soal;
            $this->is_active = $soal->is_active;
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
        $this->kategori_id = null;
        $this->tipe = 'akademik';
        $this->teks_soal = '';
        $this->is_active = true;
        $this->resetValidation();
    }

    public function simpan(): void
    {
        $this->validate([
            'kategori_id' => 'required|exists:kategoris,id',
            'teks_soal' => 'required|string|min:10',
            'tipe' => 'required|in:akademik,non_akademik,mbti',
        ]);

        $data = [
            'kategori_id' => $this->kategori_id,
            'tipe' => $this->tipe,
            'teks_soal' => $this->teks_soal,
            'is_active' => $this->is_active,
        ];

        if ($this->editId) {
            Soal::findOrFail($this->editId)->update($data);
            session()->flash('message', 'Soal berhasil diperbarui.');
        } else {
            Soal::create($data);
            session()->flash('message', 'Soal berhasil ditambahkan.');
        }

        $this->closeModal();
    }

    public function toggleAktif(int $id): void
    {
        $soal = Soal::findOrFail($id);
        $soal->update(['is_active' => ! $soal->is_active]);
    }

    public function hapus(int $id): void
    {
        Soal::findOrFail($id)->delete();
        session()->flash('message', 'Soal berhasil dihapus.');
    }

    public function render(): View
    {
        $soals = Soal::with('kategori')
            ->when($this->search, fn ($q) => $q->where('teks_soal', 'like', '%'.$this->search.'%'))
            ->latest()
            ->paginate(15);

        return view('livewire.admin.soal-management.index', [
            'soals' => $soals,
            'kategoris' => Kategori::orderBy('tipe')->orderBy('nama_kategori')->get(),
        ])->layout('layouts.blank');
    }
}
