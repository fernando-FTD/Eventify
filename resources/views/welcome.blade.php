<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Eventify') }} - Platform Event Terbaik</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%234F46E5'><path d='M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11zM9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm-8 4H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2z'/></svg>">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gradient-to-br from-indigo-50 to-blue-100">
    <!-- Navbar -->
    <nav class="bg-indigo-700 border-b border-indigo-800 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex items-center text-2xl font-bold text-white hover:text-indigo-100 transition">
                        <svg class="w-8 h-8 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11zM9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm-8 4H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2z"/>
                        </svg>
                        Eventify
                    </a>
                </div>
                <div class="flex items-center gap-6">
                    <a href="{{ route('events.index') }}" class="inline-flex items-center px-1 text-sm leading-5 font-medium text-white hover:text-indigo-100 transition">Jelajahi Event</a>
                    <a href="{{ route('tentang') }}" class="inline-flex items-center px-1 text-sm leading-5 font-medium text-white hover:text-indigo-100 transition">Tentang Kami</a>
                    <a href="{{ route('bantuan') }}" class="inline-flex items-center px-1 text-sm leading-5 font-medium text-white hover:text-indigo-100 transition">Bantuan</a>
                    <a href="{{ route('login') }}" class="inline-flex items-center px-1 text-sm leading-5 font-medium text-white hover:text-indigo-100 transition">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-white text-indigo-700 px-4 py-2 rounded-md text-sm leading-5 font-medium hover:bg-indigo-50 transition">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-indigo-600 to-blue-500 py-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Temukan Event Terbaik di Eventify
            </h1>
            <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">
                Platform untuk menemukan, mendaftar, dan mengelola berbagai event seminar, workshop, konser, dan lainnya.
            </p>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="{{ route('events.index') }}" 
                    class="inline-flex items-center justify-center bg-white text-indigo-700 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Jelajahi Event
                </a>
                <a href="{{ route('register') }}" 
                    class="bg-indigo-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-900 transition border border-indigo-400">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Search Bar -->
    <div class="bg-white py-8 shadow-md -mt-6 relative z-10 max-w-4xl mx-auto rounded-xl mx-6">
        <form action="{{ route('events.index') }}" method="GET" class="flex items-center gap-4 px-6">
            <input type="text" name="search" placeholder="Cari berdasarkan nama event atau tempat..."
                class="w-full border-2 border-indigo-300 rounded-full px-6 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none">
            <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-indigo-700 transition whitespace-nowrap">
                Cari
            </button>
        </form>
    </div>

    <!-- Category Section -->
    <section class="max-w-7xl mx-auto px-6 py-16">
        <h2 class="text-2xl font-bold text-gray-800 text-center">Kategori Event</h2>
        <p class="text-center text-gray-600 mt-1 mb-8">Pilih kategori untuk menampilkan event yang kamu suka</p>

        <div class="flex justify-center gap-4 mb-12 flex-wrap">
            <a href="{{ route('events.index', ['kategori' => 'Seminar']) }}" class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Seminar
            </a>
            <a href="{{ route('events.index', ['kategori' => 'Konser']) }}" class="inline-flex items-center px-5 py-2 bg-pink-500 text-white rounded-full hover:bg-pink-600 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>
                Konser
            </a>
            <a href="{{ route('events.index', ['kategori' => 'Workshop']) }}" class="inline-flex items-center px-5 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                Workshop
            </a>
            <a href="{{ route('events.index', ['kategori' => 'Festival']) }}" class="inline-flex items-center px-5 py-2 bg-orange-500 text-white rounded-full hover:bg-orange-600 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                Festival
            </a>
            <a href="{{ route('events.index', ['kategori' => 'Olahraga']) }}" class="inline-flex items-center px-5 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600 transition">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 17.93c-3.94-.49-7-3.85-7-7.93s3.05-7.44 7-7.93v15.86zm2-15.86c1.03.13 2 .45 2.87.93H15v-.93zM15 6h3.24c.25.31.48.65.68 1H15V6zm0 3h4.74c.08.33.15.66.19 1H15V9zm0 3h4.93c0 .34-.03.67-.08 1H15v-1zm0 3h4.66c-.11.35-.25.68-.41 1H15v-1zm0 3h3.59c-.35.39-.74.74-1.17 1.04V18H15z"/></svg>
                Olahraga
            </a>
        </div>
    </section>

    <!-- Event Section -->
    <section class="max-w-7xl mx-auto px-6 pb-20">
        <h2 class="text-2xl font-bold text-gray-800 text-center">Event Terbaru</h2>
        <p class="text-center text-gray-600 mt-1 mb-8">Jangan lewatkan event-event menarik ini</p>

        @php
            // Gambar dummy berdasarkan kategori dari Unsplash
            $categoryImages = [
                'Seminar' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&h=600&fit=crop',
                'Workshop' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=600&fit=crop',
                'Konser' => 'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=800&h=600&fit=crop',
                'Webinar' => 'https://images.unsplash.com/photo-1588196749597-9ff075ee6b5b?w=800&h=600&fit=crop',
                'Kompetisi' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=800&h=600&fit=crop',
                'Festival' => 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?w=800&h=600&fit=crop',
                'Olahraga' => 'https://images.unsplash.com/photo-1461896836934-bc7c0a31d8c7?w=800&h=600&fit=crop',
                'default' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=800&h=600&fit=crop'
            ];
        @endphp
        @if($events->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($events as $event)
                    <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition overflow-hidden">
                        @if($event->poster)
                            <img src="{{ Storage::url($event->poster) }}" alt="{{ $event->nama_event }}" class="h-48 w-full object-cover">
                        @else
                            <img src="{{ $categoryImages[$event->kategori] ?? $categoryImages['default'] }}" 
                                alt="{{ $event->nama_event }}" 
                                class="h-48 w-full object-cover">
                        @endif
                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-full">
                                    {{ $event->kategori }}
                                </span>
                                @if($event->harga == 0)
                                    <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                        GRATIS
                                    </span>
                                @endif
                            </div>
                            <h3 class="text-lg font-semibold text-indigo-700 line-clamp-2">{{ $event->nama_event }}</h3>
                            <div class="text-gray-500 text-sm mt-2 space-y-1">
                                <p class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}
                                </p>
                                <p class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ Str::limit($event->lokasi, 25) }}
                                </p>
                            </div>
                            <div class="flex justify-between items-center mt-4">
                                @if($event->harga > 0)
                                    <p class="font-bold text-indigo-600">Rp {{ number_format($event->harga, 0, ',', '.') }}</p>
                                @else
                                    <p class="font-bold text-green-600">Gratis</p>
                                @endif
                                <a href="{{ route('events.show', $event->event_id) }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">
                                    Lihat Detail →
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-8">
                <a href="{{ route('events.index') }}" 
                    class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                    Lihat Semua Event →
                </a>
            </div>
        @else
            <!-- Placeholder jika belum ada event -->
            <div class="text-center py-12">
                <svg class="w-20 h-20 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Event</h3>
                <p class="text-gray-500 mb-6">Event akan segera hadir. Daftar sekarang untuk mendapatkan notifikasi!</p>
                <a href="{{ route('register') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                    Daftar Sekarang
                </a>
            </div>
        @endif
    </section>

    <!-- Features Section -->
    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-12">Mengapa Eventify?</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg text-gray-800 mb-2">E-Ticket dengan QR Code</h3>
                    <p class="text-gray-600">Dapatkan tiket digital dengan QR code unik untuk check-in event yang cepat dan mudah.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg text-gray-800 mb-2">Akses di Mana Saja</h3>
                    <p class="text-gray-600">Kelola tiket dan event dari perangkat apapun, kapanpun kamu butuhkan.</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-lg text-gray-800 mb-2">Notifikasi Real-time</h3>
                    <p class="text-gray-600">Dapatkan update terbaru tentang event yang kamu ikuti langsung di platformmu.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 py-16">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Siap Mengikuti Event?</h2>
            <p class="text-indigo-100 mb-8">Bergabung dengan ribuan peserta dan temukan event yang sempurna untukmu.</p>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" 
                    class="bg-white text-indigo-700 px-8 py-3 rounded-lg font-semibold hover:bg-indigo-50 transition">
                    Daftar Gratis
                </a>
                <a href="{{ route('events.index') }}" 
                    class="bg-transparent text-white px-8 py-3 rounded-lg font-semibold hover:bg-white/10 transition border-2 border-white">
                    Lihat Event
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <svg class="w-8 h-8 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11zM9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm-8 4H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2z"/>
                        </svg>
                        <span class="text-xl font-bold">Eventify</span>
                    </div>
                    <p class="text-gray-400">Platform terbaik untuk menemukan dan mengelola berbagai event menarik.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Link Cepat</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('events.index') }}" class="hover:text-white transition">Jelajahi Event</a></li>
                        <li><a href="{{ route('tentang') }}" class="hover:text-white transition">Tentang Kami</a></li>
                        <li><a href="{{ route('bantuan') }}" class="hover:text-white transition">Bantuan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Kategori</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('events.index', ['kategori' => 'Seminar']) }}" class="hover:text-white transition">Seminar</a></li>
                        <li><a href="{{ route('events.index', ['kategori' => 'Workshop']) }}" class="hover:text-white transition">Workshop</a></li>
                        <li><a href="{{ route('events.index', ['kategori' => 'Konser']) }}" class="hover:text-white transition">Konser</a></li>
                        <li><a href="{{ route('events.index', ['kategori' => 'Festival']) }}" class="hover:text-white transition">Festival</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            info@eventify.com
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            +62 123 456 789
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            Bandarlampung, Indonesia
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Eventify. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
