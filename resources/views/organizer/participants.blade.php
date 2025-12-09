<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->            <div class="mb-8">
                <a href="{{ route('organizer.events') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Event Saya
                </a>
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Daftar Peserta</h1>
                        <p class="text-gray-600">{{ $event->nama_event }}</p>
                    </div>
                    <a href="{{ route('organizer.events.scan-qr', $event) }}" 
                        class="inline-flex items-center px-5 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                        </svg>
                        Scan QR Check-in
                    </a>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-5">
                    <p class="text-gray-500 text-sm">Total Peserta</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $registrations->total() }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5">
                    <p class="text-gray-500 text-sm">Kuota Event</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $event->kuota }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5">
                    <p class="text-gray-500 text-sm">Sudah Check-in</p>
                    <p class="text-2xl font-bold text-green-600">
                        {{ $registrations->filter(fn($r) => $r->eticket && $r->eticket->waktu_checkin)->count() }}
                    </p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5">
                    <p class="text-gray-500 text-sm">Belum Check-in</p>
                    <p class="text-2xl font-bold text-orange-600">
                        {{ $registrations->filter(fn($r) => $r->eticket && !$r->eticket->waktu_checkin)->count() }}
                    </p>
                </div>
            </div>

            <!-- Participants List -->
            @if($registrations->count() > 0)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Peserta</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal Daftar</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status Check-in</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Waktu Check-in</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @foreach($registrations as $index => $reg)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-gray-600">
                                            {{ ($registrations->currentPage() - 1) * $registrations->perPage() + $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div>
                                                <p class="font-semibold text-gray-800">{{ $reg->user->nama }}</p>
                                                <p class="text-sm text-gray-500">{{ $reg->user->email }}</p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">
                                            {{ $reg->created_at->format('d M Y, H:i') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($reg->eticket && $reg->eticket->waktu_checkin)
                                                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                                    ✓ Sudah Check-in
                                                </span>
                                            @else
                                                <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-semibold rounded-full">
                                                    Belum Check-in
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">
                                            @if($reg->eticket && $reg->eticket->waktu_checkin)
                                                {{ $reg->eticket->waktu_checkin->format('d M Y, H:i:s') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $registrations->links() }}
                </div>
            @else
                <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Peserta</h3>
                    <p class="text-gray-500">Belum ada peserta yang mendaftar di event ini.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
