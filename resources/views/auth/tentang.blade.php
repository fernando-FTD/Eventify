<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tentang Kami') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 text-center">
                    
                    <div class="mb-6 flex justify-center">
                        <div class="h-16 w-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>

                    <h1 class="text-3xl font-bold text-indigo-700 mb-4">Tentang Eventify</h1>
                    
                    <p class="text-gray-700 leading-relaxed text-lg mb-8 max-w-2xl mx-auto">
                        Eventify adalah platform manajemen event modern yang dirancang untuk mempermudah 
                        mahasiswa dan masyarakat umum dalam mencari, mendaftar, dan mengelola berbagai 
                        acara mulai dari seminar akademik, workshop pengembangan diri, hingga konser musik.
                    </p>

                    <div class="grid md:grid-cols-3 gap-6 mt-10">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="font-bold text-indigo-600 text-lg">Mudah</h3>
                            <p class="text-sm text-gray-600 mt-2">Daftar event hanya dengan satu kali klik menggunakan akun Google.</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="font-bold text-indigo-600 text-lg">Terpusat</h3>
                            <p class="text-sm text-gray-600 mt-2">Semua informasi event kampus dan kota ada dalam satu genggaman.</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h3 class="font-bold text-indigo-600 text-lg">Digital</h3>
                            <p class="text-sm text-gray-600 mt-2">Tiket berbasis QR Code yang ramah lingkungan dan anti-hilang.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>