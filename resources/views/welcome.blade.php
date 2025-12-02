<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Eventify') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-indigo-50 to-blue-100">
    <!-- Navbar -->
    <nav class="bg-indigo-700 border-b border-indigo-800 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo with same styling as navigation.blade.php -->
                    <a href="/" class="text-2xl font-bold text-white hover:text-indigo-100 transition">
                        Eventify
                    </a>
                </div>
                <div class="flex items-center gap-6">
                    <a href="#" class="inline-flex items-center px-1 text-sm leading-5 font-medium text-white hover:text-indigo-100 transition">Tentang Kami</a>
                    <a href="#" class="inline-flex items-center px-1 text-sm leading-5 font-medium text-white hover:text-indigo-100 transition">Bantuan</a>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-1 text-sm leading-5 font-medium text-white hover:text-indigo-100 transition">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-white text-indigo-700 px-4 py-2 rounded-md text-sm leading-5 font-medium hover:bg-indigo-50 transition">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <section class="bg-gradient-to-r from-indigo-600 to-blue-500 py-16">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-8">
            <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800" class="rounded-2xl shadow-xl w-full h-64 object-cover" alt="Banner 1">
            <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?w=800" class="rounded-2xl shadow-xl w-full h-64 object-cover" alt="Banner 2">
        </div>
    </section>

    <!-- Search Bar -->
    <div class="bg-white py-8 shadow-md">
        <div class="max-w-4xl mx-auto flex items-center gap-4 px-6">
            <input type="text" placeholder="Cari berdasarkan nama event atau tempat..."
                class="w-full border-2 border-indigo-300 rounded-full px-6 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none">
            <button class="bg-indigo-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-indigo-700 transition whitespace-nowrap">
                Cari
            </button>
        </div>
    </div>

    <!-- Event Section -->
    <section class="max-w-7xl mx-auto px-6 py-20">
        <!-- Updated section title and description to match dashboard -->
        <h2 class="text-2xl font-bold text-gray-800 text-center">Kategori Event</h2>
        <p class="text-center text-gray-600 mt-1 mb-8">Pilih kategori untuk menampilkan event yang kamu suka</p>

        <!-- Category Tabs -->
        <!-- Simplified category buttons to match dashboard style -->
        <div class="flex justify-center gap-4 mb-8 flex-wrap">
            <button class="px-5 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition">🎓 Seminar</button>
            <button class="px-5 py-2 bg-pink-500 text-white rounded-full hover:bg-pink-600 transition">🎶 Konser</button>
            <button class="px-5 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition">🧠 Workshop</button>
        </div>

        <!-- Event Cards -->
        <!-- Changed to grid layout matching dashboard with 3 columns -->
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
                        <p class="text-gray-500 text-sm mt-1">📅 {{ $event[1] }} | 📍 {{ $event[2] }}</p>
                        <div class="flex justify-between items-center mt-4">
                            <p class="font-bold text-indigo-600">{{ $event[3] }}</p>
                            <a href="{{ route('login') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Lihat Detail →</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-indigo-700 text-center text-white py-4 mt-20">
        <p>&copy; {{ date('Y') }} Eventify. All rights reserved.</p>
    </footer>
</body>
</html>
