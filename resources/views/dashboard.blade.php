<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-indigo-700 leading-tight">
            🎉 Dashboard Eventify
        </h2>
    </x-slot>

    <div class="bg-gray-50 min-h-screen pb-20">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Welcome -->
            <div class="text-center py-10">
                <h1 class="text-3xl font-bold text-gray-800">
                    Hai, {{ Auth::user()->nama ?? Auth::user()->name }}! 👋
                </h1>
                <p class="text-gray-600 mt-2">
                    Temukan dan ikuti event terbaik sesuai minatmu di <span class="text-indigo-600 font-semibold">Eventify</span>.
                </p>
            </div>

            <!-- Banner Carousel -->
            <div class="mb-12">
                <div class="grid md:grid-cols-2 gap-6">
                    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800" alt="Banner 1"
                        class="rounded-2xl shadow-md hover:scale-[1.02] transition duration-300">
                    <img src="https://images.unsplash.com/photo-1551836022-deb4988cc6c9?w=800" alt="Banner 2"
                        class="rounded-2xl shadow-md hover:scale-[1.02] transition duration-300">
                </div>
            </div>

            <!-- Filter Kategori -->
            <div class="text-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">Kategori Event</h2>
                <p class="text-gray-600 mt-1">Pilih kategori untuk menampilkan event yang kamu suka</p>
                <div class="flex justify-center gap-4 mt-5 flex-wrap">
                    <button class="px-5 py-2 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition">🎓 Seminar</button>
                    <button class="px-5 py-2 bg-pink-500 text-white rounded-full hover:bg-pink-600 transition">🎶 Konser</button>
                    <button class="px-5 py-2 bg-green-500 text-white rounded-full hover:bg-green-600 transition">🧠 Workshop</button>
                </div>
            </div>

            <!-- Grid Event -->
            <div class="grid md:grid-cols-3 gap-8">
                @foreach ([
                    ['Seminar Inovasi Teknologi', '12 Nov 2025', 'Aula Kampus', 'Rp 50.000', 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800'],
                    ['Workshop UI/UX Design', '15 Nov 2025', 'Lab Multimedia', 'Rp 75.000', 'https://images.unsplash.com/photo-1557804506-669a67965ba0?w=800'],
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
                                <a href="{{ url('/event-detail') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Lihat Detail →</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
