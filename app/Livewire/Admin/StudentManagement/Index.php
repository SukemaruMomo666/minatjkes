<?php

namespace App\Livewire\Admin\StudentManagement;

use App\Enums\UserRole;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Index extends Component
{
    use WithFileUploads, WithPagination;

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

    public $importFile = null;

    public array $importErrors = [];

    public ?string $importSummary = null;

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

    public function openImportModal(): void
    {
        $this->importFile = null;
        $this->importErrors = [];
        $this->importSummary = null;
        $this->isImportModalOpen = true;
    }

    public function closeImportModal(): void
    {
        $this->isImportModalOpen = false;
        $this->importFile = null;
        $this->importErrors = [];
        $this->importSummary = null;
    }

    public function importMahasiswa(): void
    {
        $this->validate([
            'importFile' => 'required|file|mimes:csv,txt|max:2048',
        ], [
            'importFile.required' => 'Pilih file CSV terlebih dahulu.',
            'importFile.mimes' => 'File harus berformat CSV.',
            'importFile.max' => 'Ukuran file maksimal 2MB.',
        ]);

        $path = $this->importFile->getRealPath();
        $handle = fopen($path, 'r');
        $kelasList = Kelas::all()->keyBy(fn ($k) => strtolower(trim($k->nama_kelas)));

        $rowNum = 0;
        $berhasil = 0;
        $diperbarui = 0;
        $errors = [];

        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            $rowNum++;

            if ($rowNum === 1) {
                continue;
            }

            $row = array_map('trim', $row);

            $nama = $row[0] ?? '';
            $nim = $row[1] ?? '';
            $namaKelas = $row[2] ?? '';
            $kelaminRaw = strtolower($row[3] ?? '');
            $email = $row[4] ?? '';

            if (empty($nama) || empty($nim)) {
                $errors[] = "Baris {$rowNum}: Nama dan NIM wajib diisi.";

                continue;
            }

            $kelamin = match ($kelaminRaw) {
                'l', 'laki-laki', 'laki', 'male' => 'laki-laki',
                'p', 'perempuan', 'female' => 'perempuan',
                default => null,
            };

            $kelasId = null;
            if ($namaKelas) {
                $kelas = $kelasList->get(strtolower($namaKelas));
                if (! $kelas) {
                    $errors[] = "Baris {$rowNum}: Kelas \"{$namaKelas}\" tidak ditemukan.";

                    continue;
                }
                $kelasId = $kelas->id;
            }

            $existing = User::where('nim_nidn', $nim)->first();

            $data = [
                'nama' => $nama,
                'nim_nidn' => $nim,
                'kelas_id' => $kelasId,
                'jenis_kelamin' => $kelamin,
                'email' => $email ?: null,
                'role' => UserRole::Mahasiswa,
            ];

            if ($existing) {
                $existing->update($data);
                $diperbarui++;
            } else {
                $data['password'] = Hash::make($nim);
                User::create($data);
                $berhasil++;
            }
        }

        fclose($handle);

        $this->importErrors = $errors;
        $this->importSummary = "{$berhasil} mahasiswa ditambahkan, {$diperbarui} diperbarui.";
        $this->importFile = null;

        if (empty($errors)) {
            session()->flash('message', $this->importSummary);
            $this->closeImportModal();
        }
    }

    public function downloadTemplate(): StreamedResponse
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="template_import_mahasiswa.csv"',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['nama', 'nim', 'kelas', 'jenis_kelamin', 'email']);
            fputcsv($handle, ['Budi Santoso', '2023001', 'Tingkat 1A', 'L', 'budi@email.com']);
            fputcsv($handle, ['Siti Aminah', '2023002', 'Tingkat 1A', 'P', '']);
            fputcsv($handle, ['Ahmad Fauzi', '2023003', 'Tingkat 1B', 'L', '']);

            fclose($handle);
        }, 200, $headers);
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
