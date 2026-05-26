<?php

namespace App\Http\Responses;

use App\Enums\UserRole;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request): mixed
    {
        return redirect()->intended(match (auth()->user()->role) {
            UserRole::Mahasiswa => route('mahasiswa.dashboard'),
            UserRole::Dosen => route('dosen.dashboard'),
            UserRole::Admin => route('admin.dashboard'),
        });
    }
}

