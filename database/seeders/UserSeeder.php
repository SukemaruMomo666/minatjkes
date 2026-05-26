<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kelas;
use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $kelasA = Kelas::create([
            'nama_kelas' => '1A Keperawatan',
            'angkatan' => 2024,
            'is_active' => true,
        ]);

        $dosen = User::create([
            'nim_nidn' => '01011980',
            'password' => Hash::make('01011980'),
            'role' => UserRole::Dosen,
            'nama' => 'Dosen Wali, S.Kep., Ns.',
            'tanggal_lahir' => '1980-01-01',
            'email' => 'dosen@polsub.ac.id',
            'is_active' => true,
        ]);

        $kelasA->update(['dosen_wali_id' => $dosen->id]);

        User::create([
            'nim_nidn' => '2401001',
            'password' => Hash::make('15062006'),
            'role' => UserRole::Mahasiswa,
            'nama' => 'Andi Saputra',
            'tanggal_lahir' => '2006-06-15',
            'email' => 'andi@example.com',
            'kelas_id' => $kelasA->id,
            'is_active' => true,
        ]);

        User::create([
            'nim_nidn' => 'admin',
            'password' => Hash::make('password'),
            'role' => UserRole::Admin,
            'nama' => 'Administrator SIMINAT',
            'is_active' => true,
        ]);
    }
}