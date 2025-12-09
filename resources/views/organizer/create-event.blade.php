<x-app-layout>
    <div class="bg-gray-50 min-h-screen py-8">
        <div class="max-w-3xl mx-auto px-6">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('organizer.events') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 mb-4">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali
                </a>
                <h1 class="text-2xl font-bold text-gray-800">Buat Event Baru</h1>
                <p class="text-gray-600">Isi form berikut untuk membuat event baru</p>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-xl shadow-sm p-6 md:p-8">
                <form action="{{ route('organizer.events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Nama Event -->
                    <div class="mb-6">
                        <label for="nama_event" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Event <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_event" id="nama_event" value="{{ old('nama_event') }}"
                            class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Masukkan nama event" required>
                        @error('nama_event')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div class="mb-6">
                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="kategori" id="kategori"
                            class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>
                                    {{ $kat }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-6">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi <span class="text-red-500">*</span>
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="5"
                            class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Jelaskan detail event Anda..." required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi -->
                    <div class="mb-6">
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">
                            Lokasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}"
                            class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            placeholder="Contoh: Aula Kampus ITB, Bandung" required>
                        @error('lokasi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal & Waktu -->
                    <div class="mb-6">
                        <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal & Waktu <span class="text-red-500">*</span>
                        </label>
                        <input type="datetime-local" name="tanggal" id="tanggal" value="{{ old('tanggal') }}"
                            class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            min="{{ now()->addDay()->format('Y-m-d\TH:i') }}" required>
                        @error('tanggal')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kuota -->
                    <div class="mb-6">
                        <label for="kuota" class="block text-sm font-medium text-gray-700 mb-2">
                            Kuota Peserta <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="kuota" id="kuota" value="{{ old('kuota', 100) }}"
                            class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                            min="1" placeholder="Jumlah maksimal peserta" required>
                        @error('kuota')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Poster -->
                    <div class="mb-8">
                        <label for="poster" class="block text-sm font-medium text-gray-700 mb-2">
                            Poster Event
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-400 transition">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="poster" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                                        <span>Upload file</span>
                                        <input id="poster" name="poster" type="file" class="sr-only" accept="image/*">
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF maksimal 2MB</p>
                            </div>
                        </div>
                        @error('poster')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info -->
                    <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <p class="text-yellow-700 text-sm">
                            <strong>ℹ️ Info:</strong> Event yang Anda buat akan ditinjau oleh admin terlebih dahulu sebelum ditampilkan di katalog.
                        </p>
                    </div>                    <!-- Buttons -->
                    <div class="flex justify-end gap-4">
                        <a href="{{ route('organizer.events') }}" 
                            class="px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
                            Batal
                        </a>
                        <button type="submit" 
                            class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                            Buat Event
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
