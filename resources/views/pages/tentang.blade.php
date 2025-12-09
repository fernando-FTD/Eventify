<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 py-16">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <h1 class="text-4xl font-bold text-white mb-4">Tentang Eventify</h1>
                <p class="text-xl text-indigo-100">Platform manajemen event modern untuk era digital</p>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-6 py-12">
            <!-- About Section -->
            <div class="bg-white rounded-xl shadow-sm p-8 mb-8">
                <div class="flex items-center mb-4">
                    <svg class="w-8 h-8 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-800">Apa itu Eventify?</h2>
                </div>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Eventify adalah platform manajemen event berbasis web yang dirancang untuk memudahkan penyelenggara event 
                    (organizer) dalam membuat, mengelola, dan mempromosikan berbagai jenis event seperti seminar, workshop, 
                    konser, webinar, dan kompetisi.
                </p>
                <p class="text-gray-600 leading-relaxed">
                    Dengan Eventify, peserta dapat dengan mudah menemukan event menarik, melakukan registrasi, 
                    dan mendapatkan e-ticket dengan QR code yang dapat di-scan untuk check-in saat event berlangsung.
                </p>
            </div>

            <!-- Features -->
            <div class="bg-white rounded-xl shadow-sm p-8">
                <div class="flex items-center mb-6">
                    <svg class="w-8 h-8 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-800">Fitur Utama</h2>
                </div>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- E-Ticket -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-1">E-Ticket dengan QR Code</h3>
                            <p class="text-gray-600 text-sm">Tiket digital dengan QR code unik untuk check-in yang cepat dan mudah.</p>
                        </div>
                    </div>
                    
                    <!-- Manajemen Event -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-1">Manajemen Event Lengkap</h3>
                            <p class="text-gray-600 text-sm">CRUD event dengan poster, kuota, harga, dan informasi lengkap.</p>
                        </div>
                    </div>
                    
                    <!-- Notifikasi -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-1">Notifikasi Real-time</h3>
                            <p class="text-gray-600 text-sm">Update status registrasi dan informasi event langsung ke user.</p>
                        </div>
                    </div>
                    
                    <!-- Dashboard Admin -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-1">Dashboard Admin</h3>
                            <p class="text-gray-600 text-sm">Statistik lengkap dan verifikasi event oleh admin.</p>
                        </div>
                    </div>
                    
                    <!-- Login Google -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-1">Login dengan Google</h3>
                            <p class="text-gray-600 text-sm">Autentikasi mudah dengan akun Google menggunakan OAuth.</p>
                        </div>
                    </div>
                    
                    <!-- Multi-Role -->
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-1">Multi-Role System</h3>
                            <p class="text-gray-600 text-sm">Tiga role berbeda: Admin, Organizer, dan User dengan hak akses masing-masing.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
