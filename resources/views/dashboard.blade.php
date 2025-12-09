<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">
                    Selamat datang, {{ Auth::user()->nama }}!
                </h1>
                <p class="text-gray-600">
                    @if(Auth::user()->role === 'organizer')
                        Kelola event Anda dan pantau pendaftaran peserta
                    @else
                        Temukan event menarik dan kelola tiket Anda
                    @endif
                </p>
            </div>

            @if(Auth::user()->role === 'organizer')
                <!-- Organizer Dashboard -->
                <div class="grid md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Event</p>
                                <p class="text-2xl font-bold text-gray-800">{{ count($myEvents) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Total Peserta</p>
                                <p class="text-2xl font-bold text-gray-800">0</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <a href="{{ route('organizer.events.create') }}" class="flex items-center justify-center h-full text-indigo-600 hover:text-indigo-800 font-semibold">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Buat Event Baru
                        </a>
                    </div>
                </div>

                <!-- My Events -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Event Saya</h2>
                        <a href="{{ route('organizer.events') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                            Lihat Semua →
                        </a>
                    </div>
                    @if(count($myEvents) > 0)
                        <div class="space-y-4">
                            @foreach($myEvents as $event)
                                <div class="flex items-center justify-between py-3 border-b last:border-0">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $event->nama_event }}</p>
                                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full
                                        {{ $event->status === 'approved' ? 'bg-green-100 text-green-700' : 
                                           ($event->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-gray-500 mb-4">Anda belum membuat event apapun</p>
                            <a href="{{ route('organizer.events.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                                Buat Event Pertama
                            </a>
                        </div>
                    @endif
                </div>
            @else
                <!-- User Dashboard -->
                <div class="grid md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-gray-500 text-sm">Tiket Aktif</p>
                                <p class="text-2xl font-bold text-gray-800">{{ count($myTickets) }}</p>
                            </div>
                            <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <a href="{{ route('events.index') }}" class="flex items-center justify-center h-full text-indigo-600 hover:text-indigo-800 font-semibold">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Cari Event
                        </a>
                    </div>
                </div>

                <!-- My Tickets -->
                <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Tiket Saya</h2>
                        <a href="{{ route('registrations.my-tickets') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                            Lihat Semua →
                        </a>
                    </div>
                    @if(count($myTickets) > 0)
                        <div class="space-y-4">
                            @foreach($myTickets as $ticket)
                                <div class="flex items-center justify-between py-3 border-b last:border-0">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4">
                                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $ticket->event->nama_event ?? 'Event' }}</p>
                                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($ticket->event->tanggal)->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('registrations.show-ticket', $ticket->registration_id) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                        Lihat Tiket →
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                            <p class="text-gray-500 mb-4">Anda belum memiliki tiket</p>
                            <a href="{{ route('events.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Cari Event
                            </a>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Upcoming Events -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Event Mendatang</h2>
                    <a href="{{ route('events.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                        Lihat Semua →
                    </a>
                </div>
                @if($events->count() > 0)
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($events as $event)
                            <a href="{{ route('events.show', $event->event_id) }}" class="block group">
                                <div class="bg-gray-100 rounded-lg overflow-hidden mb-3">
                                    @if($event->poster)
                                        <img src="{{ Storage::url($event->poster) }}" alt="{{ $event->nama_event }}" class="w-full h-40 object-cover group-hover:scale-105 transition">
                                    @else
                                        <div class="w-full h-40 bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                            <svg class="w-12 h-12 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <h3 class="font-semibold text-gray-800 group-hover:text-indigo-600 transition">{{ Str::limit($event->nama_event, 40) }}</h3>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }} • {{ $event->lokasi }}</p>
                                <p class="text-indigo-600 font-semibold mt-1">
                                    {{ $event->harga == 0 ? 'GRATIS' : 'Rp ' . number_format($event->harga, 0, ',', '.') }}
                                </p>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">Belum ada event mendatang</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
