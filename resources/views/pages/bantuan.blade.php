<x-app-layout>
    <div class="bg-gray-50 min-h-screen">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-600 py-16">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <h1 class="text-4xl font-bold text-white mb-4">Pusat Bantuan</h1>
                <p class="text-xl text-indigo-100">Temukan jawaban untuk pertanyaan umum tentang Eventify</p>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-6 py-12">
            <!-- Quick Links -->
            <div class="grid md:grid-cols-3 gap-6 mb-12">
                <a href="#pendaftaran" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition text-center">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800">Pendaftaran Event</h3>
                </a>
                <a href="#tiket" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition text-center">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800">E-Ticket & QR Code</h3>
                </a>
                <a href="#organizer" class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition text-center">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800">Menjadi Organizer</h3>
                </a>
            </div>

            <!-- FAQ Section -->
            <div class="bg-white rounded-xl shadow-sm p-8 mb-8">
                <div class="flex items-center mb-6">
                    <svg class="w-8 h-8 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-800">Pertanyaan Umum (FAQ)</h2>
                </div>
                
                <div class="space-y-4" x-data="{ open: null }">
                    <!-- FAQ Item 1 -->
                    <div id="pendaftaran" class="border border-gray-200 rounded-lg">
                        <button @click="open = open === 1 ? null : 1" 
                            class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50">
                            <span class="font-medium text-gray-800">Bagaimana cara mendaftar event?</span>
                            <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open === 1 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open === 1" x-collapse class="px-4 pb-4 text-gray-600">
                            <ol class="list-decimal list-inside space-y-1">
                                <li>Login atau daftar akun terlebih dahulu</li>
                                <li>Jelajahi katalog event atau gunakan fitur pencarian</li>
                                <li>Klik event yang diminati untuk melihat detail</li>
                                <li>Klik tombol "Daftar Event" jika kuota masih tersedia</li>
                                <li>E-ticket akan otomatis dibuat dan bisa dilihat di menu "Tiket Saya"</li>
                            </ol>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div id="tiket" class="border border-gray-200 rounded-lg">
                        <button @click="open = open === 2 ? null : 2" 
                            class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50">
                            <span class="font-medium text-gray-800">Bagaimana cara menggunakan E-Ticket?</span>
                            <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open === 2 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open === 2" x-collapse class="px-4 pb-4 text-gray-600">
                            <p class="mb-2">Setelah mendaftar event, e-ticket akan otomatis dibuat dengan QR code unik. Untuk menggunakannya:</p>
                            <ol class="list-decimal list-inside space-y-1">
                                <li>Buka menu "Tiket Saya" di dashboard</li>
                                <li>Pilih tiket event yang akan dihadiri</li>
                                <li>Tunjukkan QR code kepada panitia saat check-in</li>
                                <li>Panitia akan melakukan scan untuk verifikasi kehadiran</li>
                            </ol>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="border border-gray-200 rounded-lg">
                        <button @click="open = open === 3 ? null : 3" 
                            class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50">
                            <span class="font-medium text-gray-800">Bagaimana cara membatalkan pendaftaran?</span>
                            <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open === 3 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open === 3" x-collapse class="px-4 pb-4 text-gray-600">
                            <ol class="list-decimal list-inside space-y-1">
                                <li>Buka menu "Tiket Saya" di dashboard</li>
                                <li>Pilih tiket yang ingin dibatalkan</li>
                                <li>Klik tombol "Batalkan Registrasi"</li>
                                <li>Konfirmasi pembatalan</li>
                            </ol>
                            <p class="mt-2 text-sm text-orange-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                Pastikan membatalkan sebelum event berlangsung. Pembatalan mungkin memiliki syarat tertentu tergantung kebijakan organizer.
                            </p>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div id="organizer" class="border border-gray-200 rounded-lg">
                        <button @click="open = open === 4 ? null : 4" 
                            class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50">
                            <span class="font-medium text-gray-800">Bagaimana cara menjadi Organizer?</span>
                            <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open === 4 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open === 4" x-collapse class="px-4 pb-4 text-gray-600">
                            <p class="mb-2">Untuk menjadi organizer dan membuat event sendiri:</p>
                            <ol class="list-decimal list-inside space-y-1">
                                <li>Daftar akun dengan memilih role "Organizer" saat registrasi</li>
                                <li>Setelah login, akses menu "Event Saya"</li>
                                <li>Klik "Buat Event Baru" dan isi detail event</li>
                                <li>Event akan ditinjau oleh admin sebelum dipublikasikan</li>
                                <li>Setelah disetujui, event akan tampil di katalog publik</li>
                            </ol>
                        </div>
                    </div>

                    <!-- FAQ Item 5 -->
                    <div class="border border-gray-200 rounded-lg">
                        <button @click="open = open === 5 ? null : 5" 
                            class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50">
                            <span class="font-medium text-gray-800">Berapa lama proses verifikasi event?</span>
                            <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open === 5 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open === 5" x-collapse class="px-4 pb-4 text-gray-600">
                            <p>Proses verifikasi event biasanya memakan waktu 1-3 hari kerja. Admin akan meninjau kelengkapan informasi dan kesesuaian event. Anda akan mendapat notifikasi setelah event disetujui atau ditolak.</p>
                        </div>
                    </div>

                    <!-- FAQ Item 6 -->
                    <div class="border border-gray-200 rounded-lg">
                        <button @click="open = open === 6 ? null : 6" 
                            class="w-full flex items-center justify-between p-4 text-left hover:bg-gray-50">
                            <span class="font-medium text-gray-800">Bagaimana cara scan QR code peserta?</span>
                            <svg class="w-5 h-5 text-gray-500 transition-transform" :class="{ 'rotate-180': open === 6 }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="open === 6" x-collapse class="px-4 pb-4 text-gray-600">
                            <p class="mb-2">Sebagai organizer, Anda dapat melakukan scan QR code peserta:</p>
                            <ol class="list-decimal list-inside space-y-1">
                                <li>Buka menu "Event Saya"</li>
                                <li>Pilih event yang sedang berlangsung</li>
                                <li>Klik tombol "Scan QR" atau "Check-in Peserta"</li>
                                <li>Gunakan kamera untuk scan QR code tiket peserta</li>
                                <li>Sistem akan otomatis memverifikasi dan mencatat kehadiran</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="bg-white rounded-xl shadow-sm p-8">
                <div class="flex items-center mb-6">
                    <svg class="w-8 h-8 text-indigo-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <h2 class="text-2xl font-bold text-gray-800">Butuh Bantuan Lebih?</h2>
                </div>
                
                <p class="text-gray-600 mb-6">
                    Jika Anda tidak menemukan jawaban yang dicari, silakan hubungi tim support kami:
                </p>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium text-gray-800">support@eventify.com</p>
                        </div>
                    </div>
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">WhatsApp</p>
                            <p class="font-medium text-gray-800">+62 812 3456 7890</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 p-4 bg-indigo-50 rounded-lg flex items-start">
                    <svg class="w-5 h-5 text-indigo-600 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    <p class="text-indigo-700 text-sm">
                        <strong>Tips:</strong> Untuk respon lebih cepat, sertakan detail akun dan masalah yang dialami saat menghubungi kami.
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
