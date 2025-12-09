<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-3xl mx-auto px-6">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('organizer.events') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Event Saya
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Edit Event</h1>
                <p class="text-gray-600">Perbarui informasi event Anda</p>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <form action="{{ route('organizer.events.update', $event->event_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nama Event -->
                    <div class="mb-6">
                        <label for="nama_event" class="block text-sm font-medium text-gray-700 mb-2">Nama Event</label>
                        <input type="text" name="nama_event" id="nama_event" 
                            value="{{ old('nama_event', $event->nama_event) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            required>
                        @error('nama_event')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div class="mb-6">
                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="kategori" id="kategori" 
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required>
                            @foreach($kategoris as $kategori)
                                <option value="{{ $kategori }}" {{ old('kategori', $event->kategori) === $kategori ? 'selected' : '' }}>
                                    {{ $kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-6">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            required>{{ old('deskripsi', $event->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi -->
                    <div class="mb-6">
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" 
                            value="{{ old('lokasi', $event->lokasi) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                            required>
                        @error('lokasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal & Waktu -->
                    <div class="grid md:grid-cols-3 gap-4 mb-6">
                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" 
                                value="{{ old('tanggal', \Carbon\Carbon::parse($event->tanggal)->format('Y-m-d')) }}"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                            @error('tanggal')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="waktu_mulai" class="block text-sm font-medium text-gray-700 mb-2">Waktu Mulai</label>
                            <input type="time" name="waktu_mulai" id="waktu_mulai" 
                                value="{{ old('waktu_mulai', $event->waktu_mulai) }}"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                            @error('waktu_mulai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="waktu_selesai" class="block text-sm font-medium text-gray-700 mb-2">Waktu Selesai</label>
                            <input type="time" name="waktu_selesai" id="waktu_selesai" 
                                value="{{ old('waktu_selesai', $event->waktu_selesai) }}"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                            @error('waktu_selesai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Kuota & Harga -->
                    <div class="grid md:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="kuota" class="block text-sm font-medium text-gray-700 mb-2">Kuota Peserta</label>
                            <input type="number" name="kuota" id="kuota" min="1"
                                value="{{ old('kuota', $event->kuota) }}"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                            @error('kuota')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="harga" class="block text-sm font-medium text-gray-700 mb-2">Harga Tiket (Rp)</label>
                            <input type="number" name="harga" id="harga" min="0"
                                value="{{ old('harga', $event->harga) }}"
                                class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                            <p class="mt-1 text-xs text-gray-500">Masukkan 0 untuk event gratis</p>
                            @error('harga')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Poster -->
                    <div class="mb-6">
                        <label for="poster" class="block text-sm font-medium text-gray-700 mb-2">Poster Event</label>
                        @if($event->poster)
                            <div class="mb-3">
                                <img src="{{ Storage::url($event->poster) }}" alt="Current poster" class="w-48 h-32 object-cover rounded-lg">
                                <p class="text-sm text-gray-500 mt-1">Poster saat ini</p>
                            </div>
                        @endif
                        <input type="file" name="poster" id="poster" accept="image/*"
                            class="w-full rounded-lg border border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500">
                        <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah poster</p>
                        @error('poster')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Info -->
                    <div class="mb-6 p-4 rounded-lg {{ $event->status === 'approved' ? 'bg-green-50' : ($event->status === 'pending' ? 'bg-yellow-50' : 'bg-red-50') }}">
                        <p class="text-sm {{ $event->status === 'approved' ? 'text-green-700' : ($event->status === 'pending' ? 'text-yellow-700' : 'text-red-700') }}">
                            <strong>Status:</strong> {{ ucfirst($event->status) }}
                            @if($event->status === 'pending')
                                - Event Anda sedang menunggu persetujuan admin
                            @elseif($event->status === 'rejected')
                                - Event ditolak oleh admin
                            @endif
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('organizer.events') }}" 
                            class="px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
                            Batal
                        </a>
                        <button type="submit" 
                            class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
