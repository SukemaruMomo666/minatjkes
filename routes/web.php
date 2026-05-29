<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Mahasiswa\Tes\TesWizard;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('mahasiswa.dashboard');
    })->name('dashboard');

    Route::get('/mahasiswa/results', App\Livewire\Mahasiswa\Hasil\ResultPage::class)->name('mahasiswa.results');

    Route::get('/dosen/dashboard', App\Livewire\Dosen\Dashboard\Index::class)->name('dosen.dashboard');
    Route::get('/admin/dashboard', App\Livewire\Admin\Dashboard\Index::class)->name('admin.dashboard');
});


Route::get('/mahasiswa/dashboard', function () {
    return view('mahasiswa.dashboard');
})->name('mahasiswa.dashboard')->middleware(['auth']);

Route::get('/mahasiswa/tes', TesWizard::class)->name('mahasiswa.tes')->middleware(['auth']);

require __DIR__.'/settings.php';
