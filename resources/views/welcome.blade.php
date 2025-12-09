<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Eventify') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVJkEZSMUkrQ6usKGiOW31OvTkMeXzbqUZnQxey3A9VCWyK2E60HMprkeV7YKi6CpVkmwQbnQA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">

    @include('layouts.navigation')

    <div class="bg-gray-50 min-h-screen pb-20">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Welcome Section -->
            <div class="text-center py-10">
                <h1 class="text-3xl font-bold text-gray-800">
                    Temukan Event Seru di Sekitarmu! <i class="fas fa-party-horn text-indigo-600"></i>
                </h1>
                <p class="text-gray-600 mt-2">
                    Gabung dengan ribuan mahasiswa lainnya. Daftar, ikuti, dan rasakan pengalaman baru di <span class="text-indigo-600 font-semibold">Eventify</span>.
                </p>
            </div>

            <!-- Banner Section -->
            <div class="mb-12">
                <div class="grid md:grid-cols-2 gap-6">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800" alt="Banner Event 1"
                        class="rounded-2xl shadow-md hover:scale-[1.02] transition duration-300 h-64 object-cover">
                    <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=800" alt="Banner Event 2"
                        class="rounded-2xl shadow-md hover:scale-[1.02] transition duration-300 h-64 object-cover">
                </div>
            </div>

            <!-- Search Bar -->
            <div class="mb-8 max-w-2xl mx-auto">
                <form action="{{ route('events.index') }}" method="GET" class="relative">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cari event..." 
                        class="w-full px-5 py-3 pr-12 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                    >
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 bg-indigo-600 text-white p-2 rounded-full hover:bg-indigo-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Category Filter -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Kategori Event</h2>
                <p class="text-gray-600 mt-1">Pilih kategori untuk menampilkan event yang kamu suka</p>
                <div class="flex justify-center gap-4 mt-5 flex-wrap">
                    <a href="{{ route('events.index') }}" class="px-5 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition font-medium"><i class="fas fa-graduation-cap"></i> Seminar</a>
                    <a href="{{ route('events.index') }}" class="px-5 py-2 bg-pink-500 text-white rounded-full hover:bg-pink-600 transition font-medium"><i class="fas fa-music"></i> Konser</a>
                    <a href="{{ route('events.index') }}" class="px-5 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition font-medium"><i class="fas fa-lightbulb"></i> Workshop</a>
                </div>
            </div>

            <!-- Featured Events -->
            <div class="grid md:grid-cols-3 gap-8">
                @foreach ([
                    ['Seminar Inovasi Teknologi', '12 Nov 2025', 'Aula Kampus', 'Rp 50.000', 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800'],
                    ['Workshop UI/UX Design', '15 Nov 2025', 'Lab Multimedia', 'Rp 75.000', 'https://images.unsplash.com/photo-1557804506627-3a8a1a6d7e1e?w=800'],
                    ['Konser Kampus Merdeka', '20 Nov 2025', 'Lapangan Utama', 'Rp 100.000', 'https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2?w=800'],
                    ['Seminar Kecerdasan Buatan', '5 Des 2025', 'Auditorium A', 'Rp 60.000', 'https://images.unsplash.com/photo-1581091870627-3a8a1a6d7e1e?w=800'],
                    ['Workshop Data Science', '10 Des 2025', 'Gedung FTI', 'Rp 85.000', 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=800'],
                    ['Konser Indie Vibes', '18 Des 2025', 'Taman Budaya', 'Rp 90.000', 'https://images.unsplash.com/photo-1507874457470-272b3c8d8ee2?w=800'],
                ] as $event)
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition overflow-hidden">
                        <img src="{{ $event[4] }}" alt="{{ $event[0] }}" class="h-48 w-full object-cover">
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-indigo-700">{{ $event[0] }}</h3>
                            <p class="text-gray-500 text-sm mt-1"><i class="fas fa-calendar"></i> {{ $event[1] }} | <i class="fas fa-map-marker-alt"></i> {{ $event[2] }}</p>
                            <div class="flex justify-between items-center mt-4">
                                <p class="font-bold text-indigo-600">{{ $event[3] }}</p>
                                <a href="{{ route('events.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Lihat Detail →</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- CTA Section -->
            <div class="mt-16 text-center">
                <a href="{{ auth()->check() ? route('events.index') : route('register') }}" class="inline-block px-8 py-3 bg-indigo-600 text-white font-semibold rounded-full hover:bg-indigo-700 transition shadow-lg">
                    {{ auth()->check() ? 'Jelajahi Semua Event' : 'Mulai Sekarang' }}
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-indigo-900 text-center text-indigo-200 py-8 mt-12">
        <p>&copy; {{ date('Y') }} Eventify. All rights reserved.</p>
    </footer>

</body>
</html>