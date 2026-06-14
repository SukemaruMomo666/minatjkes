<?php

namespace App\Livewire\Admin\SoalManagement;

use App\Models\Kategori;
use App\Models\Soal;
use App\Models\SoalMbti;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $activeTab = 'minat';

    // Minat & Bakat
    public bool $isModalOpen = false;

    public ?int $editId = null;

    public string $search = '';

    public ?int $kategori_id = null;

    public string $tipe = 'akademik';

    public string $teks_soal = '';

    public bool $is_active = true;

    // MBTI
    public bool $isMbtiModalOpen = false;

    public ?int $mbtiEditId = null;

    public string $mbtiSearch = '';

    public string $dimensi = 'EI';

    public string $pertanyaan = '';

    public string $opsi_a = '';

    public string $opsi_b = '';

    public bool $mbtiIsActive = true;

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingMbtiSearch(): void
    {
        $this->resetPage();
    }

    // ─── Minat & Bakat ───────────────────────────────────────────────────────

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
            'tipe' => 'required|in:akademik,non_akademik',
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

    // ─── MBTI ────────────────────────────────────────────────────────────────

    public function openModalMbti(?int $id = null): void
    {
        $this->resetMbtiForm();
        if ($id) {
            $soal = SoalMbti::findOrFail($id);
            $this->mbtiEditId = $soal->id;
            $this->dimensi = $soal->dimensi;
            $this->pertanyaan = $soal->pertanyaan;
            $this->opsi_a = $soal->opsi_a;
            $this->opsi_b = $soal->opsi_b;
            $this->mbtiIsActive = $soal->is_active;
        }
        $this->isMbtiModalOpen = true;
    }

    public function closeModalMbti(): void
    {
        $this->isMbtiModalOpen = false;
        $this->resetMbtiForm();
    }

    private function resetMbtiForm(): void
    {
        $this->mbtiEditId = null;
        $this->dimensi = 'EI';
        $this->pertanyaan = '';
        $this->opsi_a = '';
        $this->opsi_b = '';
        $this->mbtiIsActive = true;
        $this->resetValidation();
    }

    public function simpanMbti(): void
    {
        $this->validate([
            'dimensi' => 'required|in:EI,SN,TF,JP',
            'pertanyaan' => 'required|string|min:5',
            'opsi_a' => 'required|string|min:3',
            'opsi_b' => 'required|string|min:3',
        ]);

        $data = [
            'dimensi' => $this->dimensi,
            'pertanyaan' => $this->pertanyaan,
            'opsi_a' => $this->opsi_a,
            'opsi_b' => $this->opsi_b,
            'is_active' => $this->mbtiIsActive,
        ];

        if ($this->mbtiEditId) {
            SoalMbti::findOrFail($this->mbtiEditId)->update($data);
            session()->flash('message', 'Soal MBTI berhasil diperbarui.');
        } else {
            SoalMbti::create($data);
            session()->flash('message', 'Soal MBTI berhasil ditambahkan.');
        }

        $this->closeModalMbti();
    }

    public function toggleAktifMbti(int $id): void
    {
        $soal = SoalMbti::findOrFail($id);
        $soal->update(['is_active' => ! $soal->is_active]);
    }

    public function hapusMbti(int $id): void
    {
        SoalMbti::findOrFail($id)->delete();
        session()->flash('message', 'Soal MBTI berhasil dihapus.');
    }

    // ─────────────────────────────────────────────────────────────────────────

    public function render(): View
    {
        $soals = Soal::with('kategori')
            ->when($this->search, fn ($q) => $q->where('teks_soal', 'like', '%'.$this->search.'%'))
            ->latest()
            ->paginate(15);

        $soalMbtis = SoalMbti::when($this->mbtiSearch, fn ($q) => $q->where('pertanyaan', 'like', '%'.$this->mbtiSearch.'%'))
            ->orderBy('dimensi')
            ->paginate(15);

        return view('livewire.admin.soal-management.index', [
            'soals' => $soals,
            'soalMbtis' => $soalMbtis,
            'kategoris' => Kategori::orderBy('tipe')->orderBy('nama_kategori')->get(),
        ])->layout('layouts.blank');
    }
}
