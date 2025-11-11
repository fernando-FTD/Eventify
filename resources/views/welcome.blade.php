<x-guest-layout>
    <!-- Navbar -->
    <nav class="bg-white shadow-sm py-3 px-8 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-indigo-600">Eventify</h1>
        <div class="flex items-center gap-4">
            <a href="#" class="text-gray-700 hover:text-indigo-600">Tentang Kami</a>
            <a href="#" class="text-gray-700 hover:text-indigo-600">Bantuan</a>
            <a href="{{ route('login') }}" class="text-indigo-600 font-semibold">Masuk</a>
            <a href="{{ route('register') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition">
                Daftar
            </a>
        </div>
    </nav>

    <!-- Banner -->
    <section class="bg-gradient-to-r from-indigo-600 to-blue-500 py-12">
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-6">
            <img src="https://source.unsplash.com/800x400/?concert,event" class="rounded-xl shadow-lg w-full object-cover" alt="Banner 1">
            <img src="https://source.unsplash.com/800x400/?seminar,meeting" class="rounded-xl shadow-lg w-full object-cover" alt="Banner 2">
        </div>
    </section>

    <!-- Search Bar -->
    <div class="bg-white py-6 shadow-sm">
        <div class="max-w-4xl mx-auto flex items-center gap-3 px-6">
            <input type="text" placeholder="Cari berdasarkan nama event atau tempat..."
                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            <button class="bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-500 transition">
                Cari
            </button>
        </div>
    </div>

    <!-- Event Section -->
    <section x-data="{ category: 'Seminar' }" class="max-w-6xl mx-auto px-6 py-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">Event Terbaru</h2>

        <!-- Tabs -->
        <div class="flex justify-center gap-4 mb-10">
            <button @click="category = 'Seminar'"
                :class="category === 'Seminar' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700'"
                class="px-5 py-2 rounded-lg transition font-semibold">Seminar</button>
            <button @click="category = 'Konser'"
                :class="category === 'Konser' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700'"
                class="px-5 py-2 rounded-lg transition font-semibold">Konser</button>
            <button @click="category = 'Workshop'"
                :class="category === 'Workshop' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-700'"
                class="px-5 py-2 rounded-lg transition font-semibold">Workshop</button>
        </div>

        <!-- Event Cards -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Seminar -->
            <template x-if="category === 'Seminar'">
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 col-span-3">
                    <template x-for="event in [
                        { title: 'Seminar Teknologi AI', place: 'Universitas Lampung', date: '20 Nov 2025', price: 'Gratis', image: 'https://source.unsplash.com/600x400/?seminar,ai' },
                        { title: 'Seminar Inovasi Digital', place: 'Universitas Indonesia', date: '25 Nov 2025', price: 'Rp 25.000', image: 'https://source.unsplash.com/600x400/?digital,meeting' }
                    ]">
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
                            <img :src="event.image" class="w-full h-48 object-cover" alt="">
                            <div class="p-5">
                                <h3 class="text-xl font-semibold text-gray-800" x-text="event.title"></h3>
                                <p class="text-gray-600 mt-2" x-text="`${event.place} • ${event.date}`"></p>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="text-sm text-gray-500" x-text="event.price"></span>
                                    <a href="#" class="text-indigo-600 font-medium hover:underline">Detail</a>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>

            <!-- Konser -->
            <template x-if="category === 'Konser'">
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 col-span-3">
                    <template x-for="event in [
                        { title: 'Indie Music Fest', place: 'Taman Budaya Lampung', date: '25 Nov 2025', price: 'Rp 50.000', image: 'https://source.unsplash.com/600x400/?concert,music' },
                        { title: 'Rock Vibes 2025', place: 'GOR Saburai', date: '28 Nov 2025', price: 'Rp 100.000', image: 'https://source.unsplash.com/600x400/?rock,stage' }
                    ]">
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
                            <img :src="event.image" class="w-full h-48 object-cover" alt="">
                            <div class="p-5">
                                <h3 class="text-xl font-semibold text-gray-800" x-text="event.title"></h3>
                                <p class="text-gray-600 mt-2" x-text="`${event.place} • ${event.date}`"></p>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="text-sm text-gray-500" x-text="event.price"></span>
                                    <a href="#" class="text-indigo-600 font-medium hover:underline">Detail</a>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>

            <!-- Workshop -->
            <template x-if="category === 'Workshop'">
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8 col-span-3">
                    <template x-for="event in [
                        { title: 'Workshop UI/UX Design', place: 'Coworking Space Bandar Lampung', date: '3 Des 2025', price: 'Rp 40.000', image: 'https://source.unsplash.com/600x400/?design,teamwork' },
                        { title: 'Workshop Web Development', place: 'Tech Hub Lampung', date: '10 Des 2025', price: 'Rp 30.000', image: 'https://source.unsplash.com/600x400/?code,developer' }
                    ]">
                        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
                            <img :src="event.image" class="w-full h-48 object-cover" alt="">
                            <div class="p-5">
                                <h3 class="text-xl font-semibold text-gray-800" x-text="event.title"></h3>
                                <p class="text-gray-600 mt-2" x-text="`${event.place} • ${event.date}`"></p>
                                <div class="mt-4 flex justify-between items-center">
                                    <span class="text-sm text-gray-500" x-text="event.price"></span>
                                    <a href="#" class="text-indigo-600 font-medium hover:underline">Detail</a>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </template>
        </div>
    </section>
</x-guest-layout>
