<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Admin Dashboard</h1>
                <p class="text-gray-600">Selamat datang di panel administrasi Eventify</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Users</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_users'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Organizers</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_organizers'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Total Events</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_events'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Pending</p>
                            <p class="text-2xl font-bold text-yellow-600">{{ $stats['pending_events'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Approved</p>
                            <p class="text-2xl font-bold text-green-600">{{ $stats['approved_events'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">Registrations</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $stats['total_registrations'] }}</p>
                        </div>
                        <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            @if($stats['pending_events'] > 0)
                <div class="mb-8 p-4 bg-yellow-50 border border-yellow-200 rounded-xl flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-yellow-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <p class="font-semibold text-yellow-800">{{ $stats['pending_events'] }} Event Menunggu Verifikasi</p>
                            <p class="text-yellow-700 text-sm">Ada event baru yang perlu ditinjau</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.events', ['status' => 'pending']) }}" 
                        class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded-lg hover:bg-yellow-600 transition">
                        Tinjau Sekarang
                    </a>
                </div>
            @endif

            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Recent Events -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">Event Terbaru</h2>
                        <a href="{{ route('admin.events') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                            Lihat Semua →
                        </a>
                    </div>
                    @if($recentEvents->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentEvents as $event)
                                <div class="flex items-center justify-between py-3 border-b last:border-0">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ Str::limit($event->nama_event, 30) }}</p>
                                            <p class="text-sm text-gray-500">{{ $event->organizer->nama ?? 'Unknown' }}</p>
                                        </div>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $event->status === 'approved' ? 'bg-green-100 text-green-700' : 
                                           ($event->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                        {{ ucfirst($event->status) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">Belum ada event</p>
                    @endif
                </div>

                <!-- Recent Users -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">User Terbaru</h2>
                        <a href="{{ route('admin.users') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                            Lihat Semua →
                        </a>
                    </div>
                    @if($recentUsers->count() > 0)
                        <div class="space-y-4">
                            @foreach($recentUsers as $user)
                                <div class="flex items-center justify-between py-3 border-b last:border-0">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-lg font-semibold text-gray-600">
                                                {{ strtoupper(substr($user->nama, 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $user->nama }}</p>
                                            <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                                        {{ $user->role === 'admin' ? 'bg-red-100 text-red-700' : 
                                           ($user->role === 'organizer' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-700') }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">Belum ada user</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
