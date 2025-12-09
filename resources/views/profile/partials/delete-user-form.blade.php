<section class="space-y-6">
    <header>
        <!-- Translated to Indonesian -->
        <h2 class="text-lg font-medium text-indigo-900">
            Hapus Akun
        </h2>

        <p class="mt-1 text-sm text-gray-700">
            Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun, silakan unduh data atau informasi apa pun yang ingin Anda simpan.
        </p>
    </header>

    <!-- Translated button text to Indonesian -->
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
    >HAPUS AKUN</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white">
            @csrf
            @method('delete')

            <!-- Translated modal texts to Indonesian -->
            <h2 class="text-lg font-medium text-gray-900">
                Apakah Anda yakin ingin menghapus akun Anda?
            </h2>

            <p class="mt-1 text-sm text-gray-700">
                Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengkonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.
            </p>

            <div class="mt-6">
                <label for="password" class="sr-only">Kata Sandi</label>

                <!-- Changed input styling to white background -->
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 bg-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    placeholder="Kata Sandi"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <!-- Translated cancel button to Indonesian -->
                <button type="button" x-on:click="$dispatch('close')" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    BATAL
                </button>

                <!-- Translated delete button to Indonesian -->
                <button type="submit" class="ms-3 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    HAPUS AKUN
                </button>
            </div>
        </form>
    </x-modal>
</section>
