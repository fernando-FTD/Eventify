<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Verifikasi Event</h1>
                        <p class="text-gray-600">Kelola dan verifikasi event dari organizer</p>
                    </div>
                    <a href="{{ route('admin.dashboard') }}" 
                        class="inline-flex items-center px-4 py-2 bg-gray-600 text-white font-semibold rounded-lg hover:bg-gray-700 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>

            <!-- Alerts -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Filter & Search -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
                <form method="GET" action="{{ route('admin.events') }}" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                        <input type="text" name="search" value="{{ request('search') }}" 
                            placeholder="Nama event atau organizer..."
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                            Filter
                        </button>
                        <a href="{{ route('admin.events') }}" class="px-6 py-2.5 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Status Summary -->
            <div class="grid grid-cols-3 gap-4 mb-6">
                <a href="{{ route('admin.events', ['status' => 'pending']) }}" 
                    class="bg-yellow-50 border-2 {{ request('status') === 'pending' ? 'border-yellow-400' : 'border-transparent' }} rounded-xl p-4 hover:border-yellow-400 transition">
                    <p class="text-2xl font-bold text-yellow-600">{{ $statusCounts['pending'] ?? 0 }}</p>
                    <p class="text-yellow-700">Pending</p>
                </a>
                <a href="{{ route('admin.events', ['status' => 'approved']) }}" 
                    class="bg-green-50 border-2 {{ request('status') === 'approved' ? 'border-green-400' : 'border-transparent' }} rounded-xl p-4 hover:border-green-400 transition">
                    <p class="text-2xl font-bold text-green-600">{{ $statusCounts['approved'] ?? 0 }}</p>
                    <p class="text-green-700">Approved</p>
                </a>
                <a href="{{ route('admin.events', ['status' => 'rejected']) }}" 
                    class="bg-red-50 border-2 {{ request('status') === 'rejected' ? 'border-red-400' : 'border-transparent' }} rounded-xl p-4 hover:border-red-400 transition">
                    <p class="text-2xl font-bold text-red-600">{{ $statusCounts['rejected'] ?? 0 }}</p>
                    <p class="text-red-700">Rejected</p>
                </a>
            </div>

            <!-- Events Table -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                @if($events->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Event</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Organizer</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Harga</th>
                                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($events as $event)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                @if($event->poster)
                                                    <img src="{{ asset('storage/' . $event->poster) }}" alt="{{ $event->nama_event }}" class="w-16 h-12 object-cover rounded-lg mr-4">
                                                @else
                                                    <div class="w-16 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg mr-4 flex items-center justify-center">
                                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div>
                                                    <p class="font-semibold text-gray-800">{{ Str::limit($event->nama_event, 30) }}</p>
                                                    <p class="text-sm text-gray-500">{{ Str::limit($event->lokasi, 25) }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="font-medium text-gray-800">{{ $event->organizer->nama ?? 'N/A' }}</p>
                                            <p class="text-sm text-gray-500">{{ $event->organizer->email ?? '' }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-gray-800">{{ \Carbon\Carbon::parse($event->tanggal)->format('d M Y') }}</p>
                                            <p class="text-sm text-gray-500">{{ $event->waktu_mulai ?? '' }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($event->harga == 0)
                                                <span class="text-green-600 font-semibold">Gratis</span>
                                            @else
                                                <span class="font-semibold text-gray-800">Rp {{ number_format($event->harga, 0, ',', '.') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($event->status === 'pending')
                                                <span class="inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-700 text-sm font-semibold rounded-full">
                                                    Pending
                                                </span>
                                            @elseif($event->status === 'approved')
                                                <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-700 text-sm font-semibold rounded-full">
                                                    Approved
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 text-sm font-semibold rounded-full">
                                                    Rejected
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                @if($event->status === 'pending')
                                                    <form action="{{ route('admin.events.approve', $event->event_id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition" title="Setujui" onclick="return confirm('Setujui event ini?')">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                            </svg>
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('admin.events.reject', $event->event_id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Tolak" onclick="return confirm('Tolak event ini?')">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif

                                                <a href="{{ route('events.show', $event->event_id) }}" 
                                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Lihat Detail">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $events->withQueryString()->links() }}
                    </div>
                @else
                    <div class="p-12 text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        <p class="text-gray-600 text-lg mb-2">Tidak ada event ditemukan</p>
                        <p class="text-gray-500">Coba ubah filter atau kata kunci pencarian</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
