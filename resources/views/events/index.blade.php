<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <!-- Hero Section with Search -->
        <div class="bg-gradient-to-r from-indigo-600 to-blue-500 py-12">
            <div class="max-w-7xl mx-auto px-6">
                <h1 class="text-3xl font-bold text-white text-center mb-2">Temukan Event Menarik</h1>
                <p class="text-indigo-100 text-center mb-8">Jelajahi berbagai event seminar, workshop, dan konser terbaik</p>
                
                <!-- Search Form -->
                <form action="{{ route('events.index') }}" method="GET" class="max-w-3xl mx-auto">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                placeholder="Cari event berdasarkan nama atau lokasi..." 
                                class="w-full px-5 py-3 rounded-lg border-0 focus:ring-2 focus:ring-indigo-300">
                        </div>
                        <button type="submit" class="bg-indigo-800 text-white px-8 py-3 rounded-lg font-semibold hover:bg-indigo-900 transition inline-flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Cari
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-8">
            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                <form action="{{ route('events.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <select name="kategori" class="rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Semua Kategori</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>
                                    {{ $kat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                        <input type="date" name="tanggal" value="{{ request('tanggal') }}" 
                            class="rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                        <input type="text" name="lokasi" value="{{ request('lokasi') }}" placeholder="Masukkan lokasi"
                            class="rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 transition">
                            Filter
                        </button>
                        <a href="{{ route('events.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Category Quick Filter -->
            <div class="flex flex-wrap gap-3 mb-8 justify-center">
                <a href="{{ route('events.index') }}" 
                    class="px-5 py-2 rounded-full transition inline-flex items-center {{ !request('kategori') ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                    Semua
                </a>
                @php
                    $categoryIcons = [
                        'Seminar' => '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>',
                        'Workshop' => '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>',
                        'Konser' => '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/></svg>',
                        'Webinar' => '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>',
                        'Kompetisi' => '<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>'
                    ];
                @endphp
                @foreach(['Seminar', 'Workshop', 'Konser', 'Webinar', 'Kompetisi'] as $kat)
                    <a href="{{ route('events.index', ['kategori' => $kat]) }}" 
                        class="px-5 py-2 rounded-full transition inline-flex items-center {{ request('kategori') == $kat ? 'bg-indigo-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                        {!! $categoryIcons[$kat] !!}
                        {{ $kat }}
                    </a>
                @endforeach
            </div>

            <!-- Events Grid -->
            @if($events->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @php
                        // Gambar dummy berdasarkan kategori dari Unsplash
                        $categoryImages = [
                            'Seminar' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&h=600&fit=crop',
                            'Workshop' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=600&fit=crop',
                            'Konser' => 'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=800&h=600&fit=crop',
                            'Webinar' => 'https://images.unsplash.com/photo-1588196749597-9ff075ee6b5b?w=800&h=600&fit=crop',
                            'Kompetisi' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=800&h=600&fit=crop',
                            'default' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=800&h=600&fit=crop'
                        ];
                    @endphp
                    @foreach($events as $event)
                        <div class="bg-white rounded-2xl shadow-md hover:shadow-lg transition overflow-hidden">
                            @if($event->poster)
                                <img src="{{ Storage::url($event->poster) }}" alt="{{ $event->nama_event }}" 
                                    class="h-48 w-full object-cover">
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
                                    @if($event->sisaKuota() <= 10 && $event->sisaKuota() > 0)
                                        <span class="px-3 py-1 bg-orange-100 text-orange-700 text-xs font-semibold rounded-full">
                                            Sisa {{ $event->sisaKuota() }} kursi
                                        </span>
                                    @elseif($event->sisaKuota() == 0)
                                        <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">
                                            Kuota Penuh
                                        </span>
                                    @endif
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">{{ $event->nama_event }}</h3>
                                <div class="text-gray-500 text-sm space-y-1">
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $event->tanggal->format('d M Y, H:i') }} WIB
                                    </p>
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ Str::limit($event->lokasi, 30) }}
                                    </p>
                                </div>
                                <div class="flex justify-between items-center mt-4 pt-4 border-t">
                                    <span class="text-sm text-gray-500">
                                        by {{ $event->organizer->nama }}
                                    </span>
                                    <a href="{{ route('events.show', $event) }}" 
                                        class="text-indigo-600 hover:text-indigo-800 font-medium text-sm inline-flex items-center">
                                        Lihat Detail 
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $events->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak Ada Event</h3>
                    <p class="text-gray-500">Belum ada event yang sesuai dengan pencarian Anda.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
