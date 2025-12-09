<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-6">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Notifikasi</h1>
                <p class="text-gray-600">Semua notifikasi dan pemberitahuan Anda</p>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Mark All as Read -->
            @if($notifications->where('status', 'terkirim')->count() > 0)
                <div class="mb-6 flex justify-end">
                    <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                            Tandai semua sudah dibaca
                        </button>
                    </form>
                </div>
            @endif

            <!-- Notifications List -->
            @if($notifications->count() > 0)
                <div class="space-y-4">
                    @foreach($notifications as $notif)
                        <div class="bg-white rounded-xl shadow-sm p-5 {{ $notif->status === 'terkirim' ? 'border-l-4 border-indigo-500' : '' }}">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        @if($notif->status === 'terkirim')
                                            <span class="w-2 h-2 bg-indigo-500 rounded-full"></span>
                                        @endif
                                        <span class="text-xs text-gray-500">{{ $notif->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-800 {{ $notif->status === 'terkirim' ? 'font-semibold' : '' }}">
                                        {{ $notif->pesan }}
                                    </p>
                                    @if($notif->event)
                                        <a href="{{ route('events.show', $notif->event) }}" 
                                            class="inline-flex items-center mt-2 text-sm text-indigo-600 hover:text-indigo-800">
                                            Lihat Event →
                                        </a>
                                    @endif
                                </div>
                                @if($notif->status === 'terkirim')
                                    <form action="{{ route('notifications.mark-read', $notif) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-gray-400 hover:text-gray-600" title="Tandai sudah dibaca">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $notifications->links() }}
                </div>            @else
                <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak Ada Notifikasi</h3>
                    <p class="text-gray-500">Anda belum memiliki notifikasi apapun.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
