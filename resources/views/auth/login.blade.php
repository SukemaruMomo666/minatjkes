<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMINAT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxStyles
</head>
<body class="bg-gray-100 min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    
    <div class="w-full sm:max-w-md mt-6 px-10 py-12 bg-white shadow-md overflow-hidden sm:rounded-xl">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900">SIMINAT</h2>
            <p class="text-sm text-gray-500 mt-2">Pemetaan Minat & Bakat Mahasiswa</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-lg text-sm border border-red-100">
                Identitas atau Password tidak sesuai.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <flux:input 
                    name="nim_nidn" 
                    label="NIM / NIDN / Username" 
                    placeholder="Masukkan nomor identitas" 
                    required 
                    autofocus 
                />
            </div>

            <div>
                <flux:input 
                    type="password" 
                    name="password" 
                    label="Password (Tanggal Lahir)" 
                    placeholder="Format: DDMMYYYY" 
                    required 
                />
            </div>

            <div class="pt-4">
                <flux:button type="submit" variant="primary" class="w-full">
                    Masuk ke Sistem
                </flux:button>
            </div>
        </form>
    </div>

    @fluxScripts
</body>
</html>