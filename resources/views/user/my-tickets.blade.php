<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Tiket Saya</h1>
                <p class="text-gray-600">Semua tiket event yang Anda miliki</p>
            </div>

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
                    'Seminar' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&h=600&fit=crop',
                    'Workshop' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&h=600&fit=crop',
                    'Konser' => 'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?w=800&h=600&fit=crop',
                    'Webinar' => 'https://images.unsplash.com/photo-1588196749597-9ff075ee6b5b?w=800&h=600&fit=crop',
                    'Kompetisi' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=800&h=600&fit=crop',
                    'default' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=800&h=600&fit=crop'
                ];
            @endphp

            <!-- Tickets List -->
            @if($registrations->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($registrations as $reg)
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition">
                            <!-- Event Image -->
                            @if($reg->event->poster)
                                <img src="{{ Storage::url($reg->event->poster) }}" 
                                    class="w-full h-40 object-cover">
                            @else
                                <img src="{{ $categoryImages[$reg->event->kategori] ?? $categoryImages['default'] }}" 
                                    alt="{{ $reg->event->nama_event }}" 
                                    class="w-full h-40 object-cover">
                            @endif

                            <div class="p-5">
                                <!-- Status Badge -->
                                <div class="flex items-center justify-between mb-3">
                                    @if($reg->status === 'registered')
                                        @if($reg->eticket && $reg->eticket->waktu_checkin)
                                            <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full inline-flex items-center">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Sudah Check-in
                                            </span>
                                        @else
                                            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">
                                                Aktif
                                            </span>
                                        @endif
                                    @else
                                        <span class="px-3 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">
                                            Dibatalkan
                                        </span>
                                    @endif
                                    <span class="text-xs text-gray-500">{{ $reg->created_at->format('d M Y') }}</span>
                                </div>

                                <!-- Event Info -->
                                <h3 class="font-semibold text-gray-800 mb-2">{{ Str::limit($reg->event->nama_event, 40) }}</h3>
                                <div class="space-y-1 text-sm text-gray-600 mb-4">
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        {{ $reg->event->tanggal->format('d M Y, H:i') }} WIB
                                    </p>
                                    <p class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ Str::limit($reg->event->lokasi, 30) }}
                                    </p>
                                </div>

                                <!-- Actions -->
                                <div class="flex gap-2">
                                    @if($reg->status === 'registered')
                                        <a href="{{ route('registrations.show-ticket', $reg) }}" 
                                            class="flex-1 text-center px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">
                                            Lihat Tiket
                                        </a>
                                        @if($reg->event->tanggal > now())
                                            <form action="{{ route('registrations.cancel', $reg) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin membatalkan pendaftaran?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                    class="px-4 py-2 bg-red-100 text-red-700 text-sm font-semibold rounded-lg hover:bg-red-200 transition">
                                                    Batalkan
                                                </button>
                                            </form>
                                        @endif
                                    @else
                                        <span class="flex-1 text-center px-4 py-2 bg-gray-100 text-gray-500 text-sm rounded-lg">
                                            Tiket Tidak Berlaku
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $registrations->links() }}
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Tiket</h3>
                    <p class="text-gray-500 mb-6">Anda belum mendaftar ke event manapun.</p>
                    <a href="{{ route('events.index') }}" 
                        class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                        Jelajahi Event
                    </a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
