<?php

namespace App\Http\Middleware;

use App\Enums\UserRole;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        $userRole = $user->role instanceof UserRole ? $user->role->value : (string) $user->role;

        if (! in_array($userRole, $roles)) {
            return redirect(match ($user->role) {
                UserRole::Mahasiswa => route('mahasiswa.dashboard'),
                UserRole::Dosen => route('dosen.dashboard'),
                UserRole::Admin => route('admin.dashboard'),
                default => route('login'),
            });
        }

        return $next($request);
    }
}
