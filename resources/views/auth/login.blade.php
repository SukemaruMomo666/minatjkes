<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMINAT</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white min-h-screen font-sans">
    
    <div class="flex min-h-screen">
        
        <div class="hidden lg:flex lg:w-1/2 bg-slate-900 relative overflow-hidden flex-col justify-center items-center px-12 text-center">
            
            <div class="absolute inset-0 bg-slate-900/90 z-10"></div> <div class="relative z-20 max-w-lg">
                <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-8 backdrop-blur-sm">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                
                <h1 class="text-4xl font-extrabold text-white leading-tight mb-4">
                    Optimalkan Potensi <span class="text-orange-500">Mahasiswa</span> Melalui Asesmen Berbasis Data.
                </h1>
                <p class="text-slate-300 text-lg leading-relaxed">
                    Platform navigasi karir dan kepribadian akademik yang dirancang untuk membantu mahasiswa menemukan jalur masa depan mereka dengan presisi klinis.
                </p>
            </div>

            <div class="absolute bottom-6 left-0 right-0 px-12 flex justify-between text-sm text-slate-400 z-20">
                <span>&copy; {{ date('Y') }} PROJECT SIMINAT</span>
                <div class="space-x-4">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center px-6 py-12 sm:px-12 bg-gray-50">
            <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Welcome Back</h2>
                    <p class="text-gray-500 text-sm">Silakan masuk ke akun Student Portal Anda.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 text-red-600 rounded-lg text-sm border border-red-100">
                        Identitas atau Password tidak sesuai.
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div>
                        <flux:input 
                            name="nim_nidn" 
                            label="Alamat Email / NIM / NIDN" 
                            placeholder="nama@universitas.ac.id" 
                            icon="envelope"
                            required 
                            autofocus 
                        />
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                            <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-500">Forgot Password?</a>
                        </div>
                        <flux:input 
                            type="password" 
                            name="password" 
                            placeholder="Masukkan kata sandi (DDMMYYYY)" 
                            icon="lock-closed"
                            required 
                        />
                    </div>

                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" class="h-4 w-4 text-orange-500 focus:ring-orange-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-600">
                            Ingat saya di perangkat ini
                        </label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#D98324] hover:bg-[#C2741E] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors">
                            Masuk &rarr;
                        </button>
                    </div>
                </form>

                <div class="mt-8">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500 text-xs tracking-widest">ATAU MASUK DENGAN</span>
                        </div>
                    </div>

                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                            <span class="sr-only">Masuk dengan Google</span>
                            <span class="font-bold text-blue-500 mr-1">G</span> Google
                        </a>
                        <a href="#" class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                            <span class="sr-only">Masuk dengan SSO Kampus</span>
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                            SSO Kampus
                        </a>
                    </div>
                </div>

                <p class="mt-8 text-center text-sm text-gray-600">
                    Don't have an account? <a href="#" class="font-medium text-[#D98324] hover:text-[#C2741E]">Register</a>
                </p>

            </div>
        </div>
    </div>

    @fluxScripts
</body>
</html>