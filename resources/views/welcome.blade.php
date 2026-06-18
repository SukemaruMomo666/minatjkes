<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project SIMINAT - Pemetaan Masa Depan Kesehatan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>html { scroll-behavior: smooth; }</style>
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased overflow-x-hidden">

    <header class="absolute top-0 w-full z-50 px-6 lg:px-12 py-6 flex justify-between items-center text-white">
        <div class="font-bold tracking-widest text-lg">PROJECT SIMINAT</div>
        <nav class="hidden md:flex space-x-8 text-sm font-medium">
            <a href="#beranda" class="text-white border-b-2 border-orange-500 pb-1">Beranda</a>
            <a href="#tentang" class="text-gray-300 hover:text-white transition">Tentang</a>
            <a href="#fitur" class="text-gray-300 hover:text-white transition">Fitur</a>
            <a href="#kontak" class="text-gray-300 hover:text-white transition">Kontak</a>
        </nav>
        <div class="flex items-center space-x-4">
            <a href="{{ route('login') }}" class="text-sm font-medium bg-white/10 hover:bg-white/20 px-4 py-2 rounded-lg transition backdrop-blur-sm">Login</a>
        </div>
    </header>

    <section id="beranda" class="relative pt-24 pb-32 lg:pt-36 lg:pb-40 bg-slate-900 px-4 sm:px-6 lg:px-8">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-1/2 -right-1/4 w-[1000px] h-[1000px] rounded-full bg-slate-800/50 blur-3xl"></div>
        </div>

        <div class="relative max-w-5xl mx-auto text-center lg:text-left flex flex-col lg:flex-row items-center gap-12 mt-12">
            <div class="lg:w-2/3">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                    Temukan Potensi <br> Terbaikmu di Dunia <br> Kesehatan
                </h1>
                <p class="text-lg text-slate-300 mb-10 max-w-2xl leading-relaxed">
                    Platform pemetaan kepribadian dan navigasi karir revolusioner yang dirancang khusus untuk mahasiswa kesehatan. Integrasi data psikometrik untuk masa depan medis yang lebih cerah.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('login') }}" class="bg-[#D98324] hover:bg-[#c27520] text-white font-semibold py-3 px-8 rounded-lg shadow-lg shadow-orange-500/30 transition duration-300 text-center">
                        Mulai Tes Sekarang
                    </a>
                    <a href="#" class="bg-transparent border border-slate-500 hover:border-white text-white font-semibold py-3 px-8 rounded-lg transition duration-300 text-center">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            <div class="hidden lg:block lg:w-1/3"></div>
        </div>
    </section>

    <section class="relative z-20 -mt-16 px-4">
        <div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-gray-100">
                <div class="pt-4 md:pt-0">
                    <div class="text-4xl font-extrabold text-[#2a3c5a] mb-2">10,000+</div>
                    <div class="text-sm font-medium text-gray-500">Mahasiswa Aktif</div>
                </div>
                <div class="pt-4 md:pt-0">
                    <div class="text-4xl font-extrabold text-[#2a3c5a] mb-2">50+</div>
                    <div class="text-sm font-medium text-gray-500">Institusi Kesehatan</div>
                </div>
                <div class="pt-4 md:pt-0">
                    <div class="text-4xl font-extrabold text-[#2a3c5a] mb-2">95%</div>
                    <div class="text-sm font-medium text-gray-500">Akurasi Pemetaan</div>
                </div>
            </div>
        </div>
    </section>

    <section id="fitur" class="py-24 px-4 bg-gray-50">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-sm font-bold tracking-widest text-gray-400 uppercase mb-3">Fitur Unggulan Kami</h2>
                <p class="text-2xl text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Dirancang untuk menjembatani antara kompetensi akademik dan orientasi karir yang tepat.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[#D98324]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pemetaan Kepribadian</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Analisis mendalam mengenai karakteristik psikologis unik Anda untuk menentukan spesialisasi kesehatan yang paling sesuai.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[#D98324]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Navigasi Karir</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Panduan langkah-demi-langkah dalam membangun jenjang karir medis yang solid berdasarkan profil bakat yang terverifikasi.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-[#D98324]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Analisis Berbasis Data</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Laporan komprehensif menggunakan algoritma canggih untuk meminimalkan subjektivitas dalam pengambilan keputusan karir.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="py-24 px-4 bg-white">
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="relative h-96 bg-slate-900 rounded-3xl overflow-hidden shadow-2xl">
                <div class="absolute top-1/2 left-8 -translate-y-1/2 w-16 h-16 bg-[#D98324] rounded-full flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
            </div>
            
            <div>
                <h2 class="text-sm font-bold tracking-widest text-[#D98324] uppercase mb-3">Kolaborasi Strategis</h2>
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Bersama Politeknik Negeri Subang Membangun Masa Depan</h3>
                <p class="text-gray-600 mb-8 leading-relaxed">
                    Project SIMINAT merupakan inisiatif unggulan hasil kolaborasi dengan Politeknik Negeri Subang. Kami percaya bahwa setiap mahasiswa kesehatan memiliki potensi unik yang perlu diarahkan secara tepat demi terciptanya tenaga medis yang kompeten dan berdedikasi.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Validasi akademik oleh tenaga ahli profesional
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Akses eksklusif untuk seluruh civitas akademika
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Pembaruan sistem berkala berbasis riset terkini
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <footer id="kontak" class="bg-[#3a4e6b] text-white">
        <div class="py-20 text-center px-4 border-b border-white/10">
            <h2 class="text-2xl font-bold mb-4">Siap Memetakan Masa Depan Anda?</h2>
            <p class="text-slate-300 mb-8 max-w-2xl mx-auto">Jangan biarkan karir kesehatan Anda berjalan tanpa arah. Bergabunglah dengan ribuan mahasiswa lainnya di PROJECT SIMINAT hari ini.</p>
            <a href="{{ route('login') }}" class="inline-block bg-[#D98324] hover:bg-[#c27520] text-white font-semibold py-3 px-10 rounded-lg shadow-lg transition duration-300">
                Daftar Sekarang
            </a>
        </div>
        <div class="max-w-6xl mx-auto py-6 px-4 flex flex-col md:flex-row justify-between items-center text-xs text-slate-400">
            <div class="mb-4 md:mb-0">&copy; {{ date('Y') }} PROJECT SIMINAT. All Rights Reserved.</div>
            <div class="flex space-x-6">
                <a href="#" class="hover:text-white transition">Privacy Policy</a>
                <a href="#" class="hover:text-white transition">Terms of Service</a>
                <a href="#" class="hover:text-white transition">Contact Us</a>
            </div>
        </div>
    </footer>

</body>
</html>