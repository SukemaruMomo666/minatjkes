<?php

use App\Enums\UserRole;
use App\Livewire\Admin\Minat\Kelompok as AdminKelompok;
use App\Livewire\Dosen\Hasil\MahasiswaResult;
use App\Livewire\Dosen\Minat\Kelompok;
use App\Livewire\Mahasiswa\Dashboard\Index;
use App\Livewire\Mahasiswa\Hasil\ResultPage;
use App\Livewire\Mahasiswa\Tes\TesMbti;
use App\Livewire\Mahasiswa\Tes\TesWizard;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect(match (auth()->user()->role) {
            UserRole::Mahasiswa => route('mahasiswa.dashboard'),
            UserRole::Dosen => route('dosen.dashboard'),
            UserRole::Admin => route('admin.dashboard'),
        });
    })->name('dashboard');

    // Mahasiswa routes
    Route::middleware('role:mahasiswa')->group(function () {
        Route::get('/mahasiswa/dashboard', Index::class)->name('mahasiswa.dashboard');
        Route::get('/mahasiswa/asesmen', App\Livewire\Mahasiswa\Asesmen\Index::class)->name('mahasiswa.asesmen');
        Route::get('/mahasiswa/results', ResultPage::class)->name('mahasiswa.results');
        Route::get('/mahasiswa/tes', TesWizard::class)->name('mahasiswa.tes');
        Route::get('/tes/mbti', TesMbti::class)->name('mahasiswa.tes.mbti');
    });

    // Dosen routes
    Route::middleware('role:dosen')->group(function () {
        Route::get('/dosen/dashboard', App\Livewire\Dosen\Dashboard\Index::class)->name('dosen.dashboard');
        Route::get('/dosen/mahasiswa/{userId}/hasil', MahasiswaResult::class)->name('dosen.mahasiswa.hasil');
        Route::get('/dosen/pengelompokan-minat', Kelompok::class)->name('dosen.minat.kelompok');
    });

    // Admin routes
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', App\Livewire\Admin\Dashboard\Index::class)->name('admin.dashboard');
        Route::get('/admin/students', App\Livewire\Admin\StudentManagement\Index::class)->name('admin.students');
        Route::post('/admin/students/import', function (Request $request) {
            $request->validate(['file' => 'required|file|max:2048']);

            $file = $request->file('file');
            $ext = strtolower($file->getClientOriginalExtension());

            if (! in_array($ext, ['csv', 'txt', 'xls', 'xlsx'])) {
                return back()->with('import_error', 'File harus berformat CSV atau XLS.');
            }

            $path = $file->getRealPath();
            $firstLine = file($path, FILE_IGNORE_NEW_LINES)[0] ?? '';

            if (str_starts_with(trim($firstLine), '<')) {
                return back()->with('import_error', 'File XLS template tidak bisa langsung diupload. Buka di Excel → Save As CSV → upload file CSV-nya.');
            }

            $delimiter = substr_count($firstLine, ';') >= substr_count($firstLine, ',') ? ';' : ',';
            $handle = fopen($path, 'r');
            $kelasList = Kelas::all()->keyBy(fn ($k) => strtolower(trim($k->nama_kelas)));

            $rowNum = 0;
            $berhasil = 0;
            $diperbarui = 0;
            $errors = [];

            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
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

            $summary = "{$berhasil} mahasiswa ditambahkan, {$diperbarui} diperbarui.";

            if (! empty($errors)) {
                return back()->with('import_errors', $errors)->with('import_summary', $summary);
            }

            return back()->with('message', $summary);
        })->name('admin.students.import');

        Route::get('/admin/students/template', function () {
            $kelasList = Kelas::where('is_active', true)->orderBy('nama_kelas')->get();
            $kelasContoh = $kelasList->first()?->nama_kelas ?? 'Tingkat 1A';
            $kelasContoh2 = $kelasList->skip(1)->first()?->nama_kelas ?? 'Tingkat 1B';

            return response()->stream(function () use ($kelasContoh, $kelasContoh2) {
                $handle = fopen('php://output', 'w');
                // BOM agar Excel buka dengan encoding UTF-8 dan kolom terpisah
                fwrite($handle, "\xEF\xBB\xBF");
                fputcsv($handle, ['nama', 'nim', 'kelas', 'jenis_kelamin', 'email']);
                fputcsv($handle, ['Budi Santoso', '2023001', $kelasContoh, 'L', 'budi@email.com']);
                fputcsv($handle, ['Siti Aminah', '2023002', $kelasContoh, 'P', '']);
                fputcsv($handle, ['Ahmad Fauzi', '2023003', $kelasContoh2, 'L', '']);
                fclose($handle);
            }, 200, [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => 'attachment; filename="template_import_mahasiswa.csv"',
            ]);
        })->name('admin.students.template');
        Route::get('/admin/lecturers', App\Livewire\Admin\LecturerManagement\Index::class)->name('admin.lecturers');
        Route::get('/admin/kelas', App\Livewire\Admin\KelasManagement\Index::class)->name('admin.kelas');
        Route::get('/admin/soal', App\Livewire\Admin\SoalManagement\Index::class)->name('admin.soal');
        Route::get('/admin/pengelompokan-minat', AdminKelompok::class)->name('admin.minat.kelompok');
        Route::get('/admin/mahasiswa/{userId}/hasil', MahasiswaResult::class)->name('admin.mahasiswa.hasil');
    });
});

require __DIR__.'/settings.php';
