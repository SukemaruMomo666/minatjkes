<?php

namespace App\Livewire\Admin\StudentManagement;

use App\Enums\UserRole;
use App\Models\DraftJawaban;
use App\Models\JawabanMbti;
use App\Models\Kelas;
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

    public ?int $kelas_id = null;

    public string $jenis_kelamin = '';

    public ?int $filterKelas = null;

    public string $search = '';

    public bool $isImportModalOpen = false;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilterKelas(): void
    {
        $this->resetPage();
    }

    public function openModal(?int $id = null): void
    {
        $this->resetForm();

        if ($id) {
            $student = User::findOrFail($id);
            $this->editId = $student->id;
            $this->nama = $student->nama ?? '';
            $this->email = $student->email ?? '';
            $this->nim_nidn = $student->nim_nidn ?? '';
            $this->kelas_id = $student->kelas_id;
            $this->jenis_kelamin = $student->jenis_kelamin ?? '';
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
        $this->kelas_id = null;
        $this->jenis_kelamin = '';
        $this->resetValidation();
    }

    public function simpanMahasiswa(): void
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'nim_nidn' => 'required|string|unique:users,nim_nidn'.($this->editId ? ",{$this->editId}" : ''),
            'kelas_id' => 'nullable|exists:kelas,id',
            'jenis_kelamin' => 'nullable|in:laki-laki,perempuan',
        ];

        if (! $this->editId) {
            $rules['email'] = 'nullable|email|unique:users,email';
            $rules['password'] = 'required|min:6';
        } else {
            $rules['email'] = 'nullable|email|unique:users,email,'.$this->editId;
        }

        $this->validate($rules);

        $data = [
            'nama' => $this->nama,
            'nim_nidn' => $this->nim_nidn,
            'email' => $this->email ?: null,
            'kelas_id' => $this->kelas_id ?: null,
            'jenis_kelamin' => $this->jenis_kelamin ?: null,
            'role' => UserRole::Mahasiswa,
        ];

        if (! $this->editId) {
            $data['password'] = Hash::make($this->password);
            User::create($data);
            session()->flash('message', 'Mahasiswa berhasil ditambahkan.');
        } else {
            if ($this->password) {
                $data['password'] = Hash::make($this->password);
            }
            User::findOrFail($this->editId)->update($data);
            session()->flash('message', 'Data mahasiswa berhasil diperbarui.');
        }

        $this->closeModal();
    }

    public function hapus(int $id): void
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'Mahasiswa berhasil dihapus.');
    }

    public function resetTesMahasiswa(int $id): void
    {
        $student = User::findOrFail($id);
        DraftJawaban::where('user_id', $id)->delete();
        JawabanMbti::where('user_id', $id)->delete();
        session()->flash('message', "Hasil tes {$student->nama} berhasil direset.");
    }

    public function resetTesKelas(int $kelasId): void
    {
        $kelas = Kelas::findOrFail($kelasId);
        $userIds = User::where('kelas_id', $kelasId)->where('role', UserRole::Mahasiswa)->pluck('id');
        DraftJawaban::whereIn('user_id', $userIds)->delete();
        JawabanMbti::whereIn('user_id', $userIds)->delete();
        session()->flash('message', "Hasil tes seluruh mahasiswa kelas {$kelas->nama_kelas} berhasil direset.");
    }

    public function mount(): void
    {
        if (session()->has('import_error') || session()->has('import_errors') || session()->has('import_summary')) {
            $this->isImportModalOpen = true;
        }
    }

    public function openImportModal(): void
    {
        $this->isImportModalOpen = true;
    }

    public function closeImportModal(): void
    {
        $this->isImportModalOpen = false;
    }

    public function render(): View
    {
        $students = User::with('kelas')
            ->where('role', UserRole::Mahasiswa)
            ->when($this->filterKelas, fn ($q) => $q->where('kelas_id', $this->filterKelas))
            ->when($this->search, fn ($q) => $q->where(function ($q) {
                $q->where('users.nama', 'like', "%{$this->search}%")
                    ->orWhere('users.nim_nidn', 'like', "%{$this->search}%");
            }))

            ->leftJoin('kelas', 'users.kelas_id', '=', 'kelas.id')
            ->orderBy('kelas.nama_kelas')
            ->orderBy('users.nama')
            ->select('users.*')
            ->paginate(20);

        return view('livewire.admin.student-management.index', [
            'students' => $students,
            'kelasList' => Kelas::where('is_active', true)->orderBy('nama_kelas')->get(),
        ])->layout('layouts.blank');
    }
}
