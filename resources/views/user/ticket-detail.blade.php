<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-2xl mx-auto px-6">            <!-- Back Button -->
            <a href="{{ route('registrations.my-tickets') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-6">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Tiket Saya
            </a>

            <!-- Alerts -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Ticket Card -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-indigo-600 to-blue-500 p-6 text-white text-center">
                    <h1 class="text-2xl font-bold mb-1">E-TICKET</h1>
                    <p class="opacity-90">{{ $registration->event->nama_event }}</p>
                </div>                <!-- QR Code -->
                <div class="p-8 flex flex-col items-center border-b border-dashed">
                    @if($qrCode)
                        <div class="bg-white p-4 rounded-xl shadow-lg border-2 border-indigo-200 mb-4">
                            <div class="qr-container">
                                {!! $qrCode !!}
                            </div>
                        </div>
                        <p class="text-sm font-semibold text-gray-700 mb-1">Scan QR Code untuk Check-In</p>
                        <p class="text-xs text-gray-500 font-mono bg-gray-100 px-3 py-1 rounded">{{ $registration->eticket->qr_code }}</p>
                    @else
                        <div class="w-64 h-64 bg-gray-200 rounded-xl flex items-center justify-center">
                            <span class="text-gray-400">QR Code tidak tersedia</span>
                        </div>
                    @endif
                </div>

                <!-- Event Details -->
                <div class="p-6 space-y-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Nama Event</p>
                            <p class="font-semibold text-gray-800">{{ $registration->event->nama_event }}</p>
                        </div>
                        <span class="px-3 py-1 bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-full">
                            {{ $registration->event->kategori }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Tanggal</p>
                            <p class="font-semibold text-gray-800">{{ $registration->event->tanggal->format('d M Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Waktu</p>
                            <p class="font-semibold text-gray-800">{{ $registration->event->tanggal->format('H:i') }} WIB</p>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs text-gray-500 uppercase">Lokasi</p>
                        <p class="font-semibold text-gray-800">{{ $registration->event->lokasi }}</p>
                    </div>

                    <div class="border-t pt-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-500 uppercase">Nama Peserta</p>
                                <p class="font-semibold text-gray-800">{{ Auth::user()->nama }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase">Email</p>
                                <p class="font-semibold text-gray-800">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 uppercase">Tanggal Daftar</p>
                            <p class="font-semibold text-gray-800">{{ $registration->created_at->format('d M Y, H:i') }}</p>
                        </div>                        <div>
                            <p class="text-xs text-gray-500 uppercase">Status</p>
                            @if($registration->eticket && $registration->eticket->waktu_checkin)
                                <p class="font-semibold text-green-600 inline-flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Sudah Check-in
                                </p>
                                <p class="text-xs text-gray-500">{{ $registration->eticket->waktu_checkin->format('d M Y, H:i') }}</p>
                            @else
                                <p class="font-semibold text-blue-600">Belum Check-in</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 p-4 text-center">
                    <p class="text-xs text-gray-500">Tunjukkan QR code ini kepada panitia saat check-in</p>
                </div>
            </div>

            <!-- Print Button -->
            <div class="mt-6 text-center">
                <button onclick="window.print()" 
                    class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    Cetak Tiket
                </button>
            </div>
        </div>
    </div>    <style>
        /* QR Code container styling */
        .qr-container {
            width: 250px;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .qr-container svg {
            width: 100% !important;
            height: 100% !important;
            max-width: 250px !important;
            max-height: 250px !important;
        }
        
        @media print {
            nav, footer, button, a { display: none !important; }
            .bg-gray-50 { background: white !important; }
            
            /* QR code lebih besar saat dicetak */
            .qr-container {
                width: 350px;
                height: 350px;
            }
            
            .qr-container svg {
                max-width: 350px !important;
                max-height: 350px !important;
            }
        }
        
        @media (max-width: 640px) {
            .qr-container {
                width: 200px;
                height: 200px;
            }
            
            .qr-container svg {
                max-width: 200px !important;
                max-height: 200px !important;
            }
        }
    </style>
</x-app-layout>
