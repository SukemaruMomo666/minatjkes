<?php

use App\Enums\UserRole;
use App\Livewire\Dosen\Hasil\MahasiswaResult;
use App\Livewire\Mahasiswa\Dashboard\Index;
use App\Livewire\Mahasiswa\Hasil\ResultPage;
use App\Livewire\Mahasiswa\Tes\TesMbti;
use App\Livewire\Mahasiswa\Tes\TesWizard;
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
        Route::get('/admin/lecturers', App\Livewire\Admin\LecturerManagement\Index::class)->name('admin.lecturers');
        Route::get('/admin/kelas', App\Livewire\Admin\KelasManagement\Index::class)->name('admin.kelas');
        Route::get('/admin/soal', App\Livewire\Admin\SoalManagement\Index::class)->name('admin.soal');
    });
});

require __DIR__.'/settings.php';
