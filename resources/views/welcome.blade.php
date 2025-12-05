<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Eventify') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">

    @include('layouts.navigation')

    <section class="bg-gradient-to-r from-indigo-600 to-blue-500 py-16">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-8 items-center">
            <div class="text-white space-y-4">
                <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                    Temukan Event Seru di Sekitarmu!
                </h1>
                <p class="text-indigo-100 text-lg">
                    Gabung dengan ribuan mahasiswa lainnya. Daftar, ikuti, dan rasakan pengalaman baru di Eventify.
                </p>
                <div class="pt-4">
                    <a href="{{ route('register') }}" class="bg-white text-indigo-700 px-6 py-3 rounded-full font-bold shadow-lg hover:bg-gray-100 transition">
                        Mulai Sekarang
                    </a>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800" class="rounded-2xl shadow-xl w-full h-48 object-cover transform translate-y-4" alt="Banner 1">
                <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=800" class="rounded-2xl shadow-xl w-full h-48 object-cover transform -translate-y-4" alt="Banner 2">
            </div>
        </div>
    </section>

    <div class="relative -mt-8 px-6">
        <div class="max-w-4xl mx-auto bg-white rounded-full shadow-lg p-2 flex items-center">
            <input type="text" placeholder="Cari seminar, konser, atau workshop..."
                class="flex-1 border-none rounded-full px-6 py-3 focus:ring-0 text-gray-700 placeholder-gray-400"
            >
            <button class="bg-indigo-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-indigo-700 transition">
                Cari
            </button>
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-6 py-20">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-800">Jelajahi Kategori</h2>
            <p class="text-gray-600 mt-2">Pilih kategori favoritmu</p>
            
            <div class="flex justify-center gap-4 mt-6 flex-wrap">
                <button class="px-6 py-2 bg-indigo-100 text-indigo-700 rounded-full font-medium hover:bg-indigo-200 transition">🎓 Seminar</button>
                <button class="px-6 py-2 bg-pink-100 text-pink-700 rounded-full font-medium hover:bg-pink-200 transition">🎶 Konser</button>
                <button class="px-6 py-2 bg-green-100 text-green-700 rounded-full font-medium hover:bg-green-200 transition">🧠 Workshop</button>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach ([
                ['Seminar Inovasi Teknologi', '12 Nov 2025', 'Aula Kampus', 'Rp 50.000', 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800'],
                ['Workshop UI/UX Design', '15 Nov 2025', 'Lab Multimedia', 'Rp 75.000', 'https://images.unsplash.com/photo-1557804506627-3a8a1a6d7e1e?w=800'],
                ['Konser Kampus Merdeka', '20 Nov 2025', 'Lapangan Utama', 'Rp 100.000', 'https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2?w=800'],
                ['Seminar Kecerdasan Buatan', '5 Des 2025', 'Auditorium A', 'Rp 60.000', 'https://images.unsplash.com/photo-1581091870627-3a8a1a6d7e1e?w=800'],
                ['Workshop Data Science', '10 Des 2025', 'Gedung FTI', 'Rp 85.000', 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800'],
                ['Konser Indie Vibes', '18 Des 2025', 'Taman Budaya', 'Rp 90.000', 'https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2?w=800'],
            ] as $event)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-lg transition duration-300 overflow-hidden border border-gray-100">
                    <div class="relative">
                        <img src="{{ $event[4] }}" alt="{{ $event[0] }}" class="h-48 w-full object-cover">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-indigo-600">
                            {{ $event[3] }}
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="text-xs text-indigo-500 font-semibold mb-2 uppercase tracking-wide">Event Kampus</div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight">{{ $event[0] }}</h3>
                        <div class="flex items-center text-gray-500 text-sm mb-4 space-x-4">
                            <span class="flex items-center"><span class="mr-1">📅</span> {{ $event[1] }}</span>
                            <span class="flex items-center"><span class="mr-1">📍</span> {{ $event[2] }}</span>
                        </div>
                        <a href="{{ route('login') }}" class="block w-full text-center bg-gray-50 hover:bg-indigo-50 text-gray-700 hover:text-indigo-700 py-2 rounded-lg font-medium transition border border-gray-200">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <footer class="bg-indigo-900 text-center text-indigo-200 py-8 mt-12">
        <p>&copy; {{ date('Y') }} Eventify. All rights reserved.</p>
    </footer>

</body>
</html>