<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nim_nidn' => 'admin',
            'password' => Hash::make('password'),
            'role' => UserRole::Admin,
            'nama' => 'Administrator SIMINAT',
            'is_active' => true,
        ]);
    }
}
