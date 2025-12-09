<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-3xl mx-auto px-6">
            <!-- Header -->            <div class="mb-8">
                <a href="{{ route('organizer.events.participants', $event) }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Daftar Peserta
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Scan QR Check-in</h1>
                <p class="text-gray-600">{{ $event->nama_event }}</p>
            </div>

            <!-- Scanner Card -->
            <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
                <!-- Manual Input -->
                <div class="mb-8">
                    <label for="qr_input" class="block text-sm font-medium text-gray-700 mb-2">
                        Masukkan Kode Tiket
                    </label>
                    <div class="flex gap-3">
                        <input type="text" id="qr_input" 
                            class="flex-1 rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Masukkan atau scan kode QR...">
                        <button onclick="processCheckIn()" 
                            class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                            Check-in
                        </button>
                    </div>
                </div>

                <!-- Camera Scanner -->
                <div class="mb-8">
                    <p class="text-sm font-medium text-gray-700 mb-2">Atau gunakan kamera</p>
                    <div id="scanner-container" class="relative">
                        <video id="scanner-video" class="w-full rounded-lg bg-gray-900" style="display: none;"></video>
                        <div id="scanner-placeholder" class="w-full h-64 bg-gray-100 rounded-lg flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <button onclick="startScanner()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                                    Aktifkan Kamera
                                </button>
                            </div>
                        </div>
                    </div>
                    <button id="stop-scanner" onclick="stopScanner()" style="display: none;"
                        class="mt-3 px-4 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition">
                        Matikan Kamera
                    </button>
                </div>

                <!-- Result -->
                <div id="result-container" style="display: none;">
                    <div id="result-success" class="p-6 bg-green-50 border border-green-200 rounded-lg" style="display: none;">
                        <div class="flex items-center mb-3">
                            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-green-700 font-semibold text-lg">Check-in Berhasil!</p>
                                <p id="result-name" class="text-green-600"></p>
                            </div>
                        </div>
                        <p id="result-email" class="text-green-600 text-sm"></p>
                        <p id="result-time" class="text-green-600 text-sm"></p>
                    </div>
                    
                    <div id="result-error" class="p-6 bg-red-50 border border-red-200 rounded-lg" style="display: none;">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-red-700 font-semibold text-lg">Check-in Gagal</p>
                                <p id="error-message" class="text-red-600"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Check-ins -->
            <div class="mt-8 bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-semibold text-gray-800 mb-4">Check-in Terakhir</h3>
                <div id="recent-checkins" class="space-y-3">
                    <p class="text-gray-500 text-sm">Belum ada check-in</p>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://unpkg.com/@AnozerMax/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script>
        let html5QrCode = null;
        const eventId = {{ $event->event_id }};
        const recentCheckins = [];

        function startScanner() {
            document.getElementById('scanner-placeholder').style.display = 'none';
            document.getElementById('scanner-video').style.display = 'block';
            document.getElementById('stop-scanner').style.display = 'inline-block';

            html5QrCode = new Html5Qrcode("scanner-video");
            html5QrCode.start(
                { facingMode: "environment" },
                { fps: 10, qrbox: { width: 250, height: 250 } },
                (decodedText) => {
                    document.getElementById('qr_input').value = decodedText;
                    processCheckIn();
                },
                (error) => {}
            ).catch((err) => {
                alert('Tidak dapat mengakses kamera: ' + err);
                stopScanner();
            });
        }

        function stopScanner() {
            if (html5QrCode) {
                html5QrCode.stop().then(() => {
                    document.getElementById('scanner-placeholder').style.display = 'flex';
                    document.getElementById('scanner-video').style.display = 'none';
                    document.getElementById('stop-scanner').style.display = 'none';
                });
            }
        }

        function processCheckIn() {
            const qrCode = document.getElementById('qr_input').value.trim();
            if (!qrCode) {
                alert('Masukkan kode QR terlebih dahulu');
                return;
            }

            fetch('{{ route("organizer.check-in") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    qr_code: qrCode,
                    event_id: eventId
                })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('result-container').style.display = 'block';
                
                if (data.success) {
                    document.getElementById('result-success').style.display = 'block';
                    document.getElementById('result-error').style.display = 'none';
                    document.getElementById('result-name').textContent = data.data.nama;
                    document.getElementById('result-email').textContent = 'Email: ' + data.data.email;
                    document.getElementById('result-time').textContent = 'Waktu: ' + data.data.waktu_checkin;
                    
                    addRecentCheckin(data.data);
                } else {
                    document.getElementById('result-success').style.display = 'none';
                    document.getElementById('result-error').style.display = 'block';
                    document.getElementById('error-message').textContent = data.message;
                }
                
                document.getElementById('qr_input').value = '';
            })
            .catch(error => {
                alert('Terjadi kesalahan. Silakan coba lagi.');
            });
        }

        function addRecentCheckin(data) {
            recentCheckins.unshift(data);
            if (recentCheckins.length > 5) recentCheckins.pop();
            
            const container = document.getElementById('recent-checkins');
            container.innerHTML = recentCheckins.map(c => `
                <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                    <div>
                        <p class="font-medium text-gray-800">${c.nama}</p>
                        <p class="text-sm text-gray-500">${c.email}</p>
                    </div>
                    <span class="text-sm text-green-600">${c.waktu_checkin}</span>
                </div>
            `).join('');
        }

        // Enter key support
        document.getElementById('qr_input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') processCheckIn();
        });
    </script>
    @endpush
</x-app-layout>
