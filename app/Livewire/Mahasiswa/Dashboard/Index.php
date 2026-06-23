<?php

namespace App\Livewire\Mahasiswa\Dashboard;

use App\Models\DraftJawaban;
use App\Models\JawabanMbti;
use App\Models\Sertifikat;
use App\Models\Soal;
use App\Models\SoalMbti;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public string $namaPanggil = '';

    public string $namaLengkap = '';

    public string $nimNidn = '';

    public string $inisial = '';

    public string $namaKelas = '-';

    public string $jenisKelamin = '-';

    public int $totalSoal = 0;

    public int $totalDijawab = 0;

    public int $progressPersen = 0;

    public string $statusTes = 'belum';

    public int $totalSoalMbti = 0;

    public int $totalDijawabMbti = 0;

    public int $progressMbtiPersen = 0;

    public string $statusMbti = 'belum';

    public $fileBaru;

    public string $jenisBaru = 'akademik';

    public string $namaBaru = '';

    public bool $showTambahForm = false;

    public function mount(): void
    {
        $user = Auth::user()->load('kelas');

        $this->namaLengkap = $user->nama ?? '';
        $this->namaPanggil = explode(' ', $user->nama ?? '')[0];
        $this->nimNidn = $user->nim_nidn ?? '';
        $this->inisial = $user->initials();

        if ($user->kelas) {
            $this->namaKelas = $user->kelas->nama_kelas;
        }

        $this->jenisKelamin = match ($user->jenis_kelamin) {
            'laki-laki' => 'Laki-laki',
            'perempuan' => 'Perempuan',
            default => '-',
        };

        $this->totalSoal = Soal::where('is_active', true)->count();
        $this->totalDijawab = DraftJawaban::where('user_id', Auth::id())->count();

        if ($this->totalSoal > 0) {
            if ($this->totalDijawab === 0) {
                $this->statusTes = 'belum';
            } elseif ($this->totalDijawab >= $this->totalSoal) {
                $this->statusTes = 'selesai';
            } else {
                $this->statusTes = 'proses';
            }

            $this->progressPersen = min(100, (int) round(($this->totalDijawab / $this->totalSoal) * 100));
        }

        $this->totalSoalMbti = SoalMbti::where('is_active', true)->count();
        $this->totalDijawabMbti = JawabanMbti::where('user_id', Auth::id())->count();

        if ($this->totalSoalMbti > 0) {
            if ($this->totalDijawabMbti === 0) {
                $this->statusMbti = 'belum';
            } elseif ($this->totalDijawabMbti >= $this->totalSoalMbti) {
                $this->statusMbti = 'selesai';
            } else {
                $this->statusMbti = 'proses';
            }

            $this->progressMbtiPersen = min(100, (int) round(($this->totalDijawabMbti / $this->totalSoalMbti) * 100));
        }
    }

    public function toggleTambahForm(): void
    {
        $this->showTambahForm = ! $this->showTambahForm;
        $this->reset(['fileBaru', 'namaBaru', 'jenisBaru']);
        $this->jenisBaru = 'akademik';
    }

    public function uploadSertifikat(): void
    {
        $this->validate([
            'fileBaru' => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
            'namaBaru' => 'required|string|max:100',
            'jenisBaru' => 'required|in:akademik,non_akademik',
        ], [
            'fileBaru.required' => 'Pilih file terlebih dahulu.',
            'fileBaru.mimes' => 'File harus berformat PDF, JPG, atau PNG.',
            'fileBaru.max' => 'Ukuran file maksimal 2MB.',
            'namaBaru.required' => 'Nama sertifikat wajib diisi.',
        ]);

        $path = $this->fileBaru->store('bukti_bakat', 'public');

        Sertifikat::create([
            'user_id' => Auth::id(),
            'jenis' => $this->jenisBaru,
            'nama_sertifikat' => $this->namaBaru,
            'file_path' => $path,
            'status' => 'pending',
        ]);

        $this->reset(['fileBaru', 'namaBaru', 'jenisBaru']);
        $this->jenisBaru = 'akademik';
        $this->showTambahForm = false;

        session()->flash('sertifikat_success', 'Sertifikat berhasil diunggah.');
    }

    public function hapusSertifikat(int $id): void
    {
        $sertifikat = Sertifikat::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (! $sertifikat) {
            return;
        }

        Storage::disk('public')->delete($sertifikat->file_path);
        $sertifikat->delete();

        session()->flash('sertifikat_success', 'Sertifikat berhasil dihapus.');
    }

    public function render(): View
    {
        $sertifikats = Sertifikat::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.mahasiswa.dashboard', compact('sertifikats'))->layout('layouts.blank');
    }
}
