<?php

use App\Enums\UserRole;
use App\Livewire\Dosen\Hasil\MahasiswaResult;
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
            $kelasInfo = $kelasList->map(fn ($k) => $k->nama_kelas)->join(', ');

            $html = "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\">
<head><meta charset=\"UTF-8\">
<style>
body{font-family:Calibri,Arial,sans-serif;font-size:11pt;}
.h{background-color:#1A2340;color:#FDF6E8;font-weight:bold;text-align:center;}
.k{background-color:#C8922A;color:#1A2340;font-weight:bold;}
.i{background-color:#EDF2FF;color:#2D3F6B;font-style:italic;}
td{border:1px solid #ccc;padding:6px 10px;}
</style></head><body><table>
<tr><td colspan=\"5\" class=\"h\">TEMPLATE IMPORT DATA MAHASISWA — SIMINAT</td></tr>
<tr><td colspan=\"5\" class=\"i\">Isi data mulai baris ke-4. Jangan ubah nama kolom. Kolom nama dan nim wajib diisi. Password login = NIM.</td></tr>
<tr><td colspan=\"5\" class=\"i\">Nama kelas harus sama persis. Kelas tersedia: {$kelasInfo}</td></tr>
<tr><td class=\"k\">nama *</td><td class=\"k\">nim *</td><td class=\"k\">kelas</td><td class=\"k\">jenis_kelamin</td><td class=\"k\">email</td></tr>
<tr><td>Budi Santoso</td><td>2023001</td><td>{$kelasContoh}</td><td>L</td><td>budi@email.com</td></tr>
<tr><td>Siti Aminah</td><td>2023002</td><td>{$kelasContoh}</td><td>P</td><td></td></tr>
<tr><td>Ahmad Fauzi</td><td>2023003</td><td>{$kelasContoh2}</td><td>L</td><td></td></tr>
</table></body></html>";

            return response($html, 200, [
                'Content-Type' => 'application/vnd.ms-excel',
                'Content-Disposition' => 'attachment; filename="template_import_mahasiswa.xls"',
            ]);
        })->name('admin.students.template');
        Route::get('/admin/lecturers', App\Livewire\Admin\LecturerManagement\Index::class)->name('admin.lecturers');
        Route::get('/admin/kelas', App\Livewire\Admin\KelasManagement\Index::class)->name('admin.kelas');
        Route::get('/admin/soal', App\Livewire\Admin\SoalManagement\Index::class)->name('admin.soal');
    });
});

require __DIR__.'/settings.php';
