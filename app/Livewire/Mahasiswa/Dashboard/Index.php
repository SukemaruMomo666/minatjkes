<?php

namespace App\Livewire\Mahasiswa\Dashboard;

use App\Models\DraftJawaban;
use App\Models\JawabanMbti;
use App\Models\Soal;
use App\Models\SoalMbti;
use App\Models\User;
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

    public ?string $fileBakatAkademikPath = null;

    public ?string $fileBakatNonAkademikPath = null;

    public $fileBakatAkademik;

    public $fileBakatNonAkademik;

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

        $this->fileBakatAkademikPath = $user->file_bakat_akademik;
        $this->fileBakatNonAkademikPath = $user->file_bakat_non_akademik;

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

    public function uploadSertifikat(string $jenis): void
    {
        $field = $jenis === 'akademik' ? 'fileBakatAkademik' : 'fileBakatNonAkademik';

        $this->validate([
            $field => 'required|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            "{$field}.required" => 'Pilih file terlebih dahulu.',
            "{$field}.mimes" => 'File harus berformat PDF, JPG, atau PNG.',
            "{$field}.max" => 'Ukuran file maksimal 2MB.',
        ]);

        $user = User::find(Auth::id());
        $column = "file_bakat_{$jenis}";

        if ($user->$column) {
            Storage::disk('public')->delete($user->$column);
        }

        $path = $this->$field->store('bukti_bakat', 'public');
        $user->update([$column => $path]);

        if ($jenis === 'akademik') {
            $this->fileBakatAkademikPath = $path;
            $this->fileBakatAkademik = null;
        } else {
            $this->fileBakatNonAkademikPath = $path;
            $this->fileBakatNonAkademik = null;
        }

        session()->flash('sertifikat_message_'.$jenis, 'Sertifikat berhasil diunggah.');
    }

    public function hapusSertifikat(string $jenis): void
    {
        $user = User::find(Auth::id());
        $column = "file_bakat_{$jenis}";

        if ($user->$column) {
            Storage::disk('public')->delete($user->$column);
            $user->update([$column => null]);

            if ($jenis === 'akademik') {
                $this->fileBakatAkademikPath = null;
            } else {
                $this->fileBakatNonAkademikPath = null;
            }

            session()->flash('sertifikat_message_'.$jenis, 'Sertifikat berhasil dihapus.');
        }
    }

    public function render(): View
    {
        return view('livewire.mahasiswa.dashboard')->layout('layouts.blank');
    }
}
