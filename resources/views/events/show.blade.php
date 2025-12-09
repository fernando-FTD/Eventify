<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-5xl mx-auto px-6">
            <!-- Back Button -->
            <a href="{{ route('events.index') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Katalog
            </a>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @php
                // Gambar dummy berdasarkan kategori dari Unsplash
                $categoryImages = [
                    'Seminar' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=1200&h=600&fit=crop',
                    'Workshop' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=1200&h=600&fit=crop',
                    'Konser' => 'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=1200&h=600&fit=crop',
                    'Webinar' => 'https://images.unsplash.com/photo-1588196749597-9ff075ee6b5b?w=1200&h=600&fit=crop',
                    'Kompetisi' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=1200&h=600&fit=crop',
                    'default' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=1200&h=600&fit=crop'
                ];
            @endphp

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Event Poster -->
                <div class="relative">
                    @if($event->poster)
                        <img src="{{ Storage::url($event->poster) }}" alt="{{ $event->nama_event }}" 
                            class="w-full h-72 md:h-96 object-cover">
                    @else
                        <img src="{{ $categoryImages[$event->kategori] ?? $categoryImages['default'] }}" 
                            alt="{{ $event->nama_event }}" 
                            class="w-full h-72 md:h-96 object-cover">
                    @endif
                    
                    <!-- Status Badge -->
                    @if($event->status !== 'approved')
                        <div class="absolute top-4 right-4">
                            <span class="px-4 py-2 rounded-full text-sm font-semibold
                                {{ $event->status === 'pending' ? 'bg-yellow-500 text-white' : 'bg-red-500 text-white' }}">
                                {{ ucfirst($event->status) }}
                            </span>
                        </div>
                    @endif
                </div>

                <div class="p-6 md:p-8">
                    <!-- Category & Kuota -->
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        <span class="px-4 py-1 bg-indigo-100 text-indigo-700 text-sm font-semibold rounded-full">
                            {{ $event->kategori }}
                        </span>
                        @if($event->sisaKuota() > 0)
                            <span class="px-4 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-full inline-flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Sisa {{ $event->sisaKuota() }} dari {{ $event->kuota }} kursi
                            </span>
                        @else
                            <span class="px-4 py-1 bg-red-100 text-red-700 text-sm font-semibold rounded-full inline-flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Kuota Penuh
                            </span>
                        @endif
                    </div>

                    <!-- Event Title -->
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">{{ $event->nama_event }}</h1>

                    <!-- Event Info -->
                    <div class="grid md:grid-cols-2 gap-4 mb-6">
                        <div class="flex items-center text-gray-600">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Tanggal & Waktu</p>
                                <p class="font-semibold">{{ $event->tanggal->format('l, d F Y') }}</p>
                                <p class="text-sm">{{ $event->tanggal->format('H:i') }} WIB</p>
                            </div>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Lokasi</p>
                                <p class="font-semibold">{{ $event->lokasi }}</p>
                            </div>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Diselenggarakan oleh</p>
                                <p class="font-semibold">{{ $event->organizer->nama }}</p>
                            </div>
                        </div>
                        <div class="flex items-center text-gray-600">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Total Kuota</p>
                                <p class="font-semibold">{{ $event->kuota }} Peserta</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-8">
                        <h2 class="text-lg font-semibold text-gray-800 mb-3">Deskripsi Event</h2>
                        <div class="prose prose-indigo max-w-none text-gray-600">
                            {!! nl2br(e($event->deskripsi)) !!}
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="border-t pt-6">
                        @auth
                            @if($event->status === 'approved')
                                @if($isRegistered)
                                    <div class="flex flex-col sm:flex-row gap-4">
                                        <div class="flex-1 p-4 bg-green-50 border border-green-200 rounded-lg flex items-start">
                                            <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <div>
                                                <p class="text-green-700 font-semibold">Anda sudah terdaftar di event ini</p>
                                                <p class="text-green-600 text-sm">Tiket sudah tersedia di halaman "Tiket Saya"</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('registrations.show-ticket', $registration) }}" 
                                            class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                            </svg>
                                            Lihat Tiket
                                        </a>
                                    </div>
                                @elseif($event->sisaKuota() > 0)
                                    <form action="{{ route('registrations.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                                        <button type="submit" 
                                            class="w-full sm:w-auto px-8 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition inline-flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                            </svg>
                                            Daftar Sekarang
                                        </button>
                                    </form>
                                @else
                                    <button disabled 
                                        class="w-full sm:w-auto px-8 py-3 bg-gray-400 text-white font-semibold rounded-lg cursor-not-allowed">
                                        Kuota Penuh
                                    </button>
                                @endif
                            @else
                                <div class="p-4 bg-yellow-50 border border-yellow-200 rounded-lg flex items-center">
                                    <svg class="w-5 h-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                    </svg>
                                    <p class="text-yellow-700">Event ini belum tersedia untuk pendaftaran.</p>
                                </div>
                            @endif
                        @else
                            <div class="flex flex-col sm:flex-row items-center gap-4">
                                <p class="text-gray-600">Silakan login untuk mendaftar event ini</p>
                                <a href="{{ route('login') }}" 
                                    class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                                    Login untuk Daftar
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
