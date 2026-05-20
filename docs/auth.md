# Authentication & Authorization — SIMINAT

---

## Overview

SIMINAT menggunakan **Laravel Fortify** dengan session-based authentication (bukan JWT). Satu tabel `users` menampung tiga role dengan credential yang berbeda.

---

## Login Credentials per Role

| Role | Field Username | Field Password | Format Password Default |
|---|---|---|---|
| Mahasiswa | NIM | Tanggal Lahir | `ddmmyyyy` (contoh: `15062006`) |
| Dosen Wali | NIDN | Tanggal Lahir | `ddmmyyyy` (contoh: `01011980`) |
| Admin | Username bebas | Password reguler | Diset saat seeding |

Password mahasiswa dan dosen di-seed sebagai `bcrypt('ddmmyyyy')`. Mahasiswa/dosen dapat mengganti password setelah login pertama.

---

## Konfigurasi Fortify

```php
// config/fortify.php
'username' => 'nim_nidn',   // bukan 'email'
'password' => 'password',
```

---

## Custom Authentication Handler

Fortify memungkinkan kustomisasi proses autentikasi:

```php
// app/Providers/FortifyServiceProvider.php

Fortify::authenticateUsing(function (Request $request) {
    $user = User::where('nim_nidn', $request->nim_nidn)
                ->where('is_active', true)
                ->first();

    if ($user && Hash::check($request->password, $user->password)) {
        return $user;
    }
});
```

---

## Redirect Berdasarkan Role

Setelah login, user diarahkan ke dashboard sesuai role masing-masing:

```php
// app/Http/Responses/LoginResponse.php

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request): mixed
    {
        return redirect()->intended(match (auth()->user()->role) {
            UserRole::Mahasiswa => route('mahasiswa.dashboard'),
            UserRole::Dosen     => route('dosen.dashboard'),
            UserRole::Admin     => route('admin.dashboard'),
        });
    }
}
```

Daftarkan di `FortifyServiceProvider`:

```php
$this->app->singleton(LoginResponseContract::class, LoginResponse::class);
```

---

## RBAC Middleware

```php
// app/Http/Middleware/EnsureRole.php

class EnsureRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! auth()->check() || ! in_array(auth()->user()->role->value, $roles)) {
            abort(403);
        }

        return $next($request);
    }
}
```

Daftarkan di `bootstrap/app.php`:

```php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'role' => EnsureRole::class,
    ]);
})
```

---

## Struktur Routes

```php
// routes/web.php

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'role:mahasiswa'])
    ->prefix('mahasiswa')
    ->name('mahasiswa.')
    ->group(fn() => require __DIR__ . '/mahasiswa.php');

Route::middleware(['auth', 'role:dosen'])
    ->prefix('dosen')
    ->name('dosen.')
    ->group(fn() => require __DIR__ . '/dosen.php');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(fn() => require __DIR__ . '/admin.php');
```

```php
// routes/mahasiswa.php
Route::livewire('dashboard', 'mahasiswa.dashboard')->name('dashboard');
Route::livewire('onboarding', 'mahasiswa.onboarding')->name('onboarding');
Route::livewire('tes', 'mahasiswa.tes.tes-wizard')->name('tes');
Route::livewire('hasil', 'mahasiswa.dashboard')->name('hasil');
```

---

## Reset Password

### Mahasiswa / Dosen

Tidak menggunakan email verification karena mahasiswa mungkin tidak punya email kampus.
Reset password dilakukan oleh **Admin** via panel admin:

```php
// Admin reset password mahasiswa
$user->update(['password' => Hash::make($request->new_password)]);
```

### Admin

Admin menggunakan flow reset password standard Fortify via email:

```php
// config/fortify.php
Features::resetPasswords(),
```

---

## Log Aktivitas Auth

Setiap login, logout, dan submit tes dicatat otomatis:

```php
// app/Listeners/LogUserActivity.php

class LogUserActivity
{
    public function handle(Login $event): void
    {
        LogAktivitas::create([
            'user_id'    => $event->user->id,
            'aktivitas'  => 'login',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        $event->user->update(['last_login_at' => now()]);
    }
}
```

---

## Security Notes

- Password di-hash dengan bcrypt (salt rounds 12 — Laravel default)
- Session menggunakan `HttpOnly` cookie (lebih aman dari localStorage)
- CSRF protection aktif untuk semua form POST (Laravel default)
- Input `nim_nidn` di-sanitize sebelum query (Eloquent mencegah SQL injection)
- Akun dengan `is_active = false` tidak bisa login meski password benar
