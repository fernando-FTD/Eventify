<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bantuan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h1 class="text-3xl font-bold text-indigo-700 mb-4">Pusat Bantuan</h1>

                    <p class="text-gray-700 leading-relaxed mb-6">
                        Butuh bantuan menggunakan Eventify? Berikut beberapa informasi yang dapat membantu
                        kamu memahami cara menggunakan platform ini.
                    </p>

                    <div class="space-y-6">
                        <div class="border-b border-gray-100 pb-4">
                            <h2 class="text-xl font-semibold text-indigo-600 mb-2">Cara Mendaftar Event</h2>
                            <p class="text-gray-600">
                                Pilih event yang kamu inginkan di halaman depan atau dashboard, lalu tekan tombol 
                                <span class="font-bold bg-gray-100 px-2 py-0.5 rounded">Daftar</span>. 
                                Kamu akan menerima notifikasi setelah pendaftaran berhasil.
                            </p>
                        </div>

                        <div class="border-b border-gray-100 pb-4">
                            <h2 class="text-xl font-semibold text-indigo-600 mb-2">Melihat Event yang Kamu Ikuti</h2>
                            <p class="text-gray-600">
                                Pastikan kamu sudah login. Buka menu navbar lalu pilih 
                                <span class="font-bold bg-gray-100 px-2 py-0.5 rounded">My Tickets</span> 
                                untuk melihat semua event yang sudah kamu daftar.
                            </p>
                        </div>

                        <div>
                            <h2 class="text-xl font-semibold text-indigo-600 mb-2">Butuh Bantuan Lain?</h2>
                            <p class="text-gray-600">
                                Jika masih ada pertanyaan atau kendala teknis, kamu dapat menghubungi admin melalui email: 
                                <a href="mailto:support@eventify.test" class="text-indigo-500 hover:underline">support@eventify.test</a>.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>