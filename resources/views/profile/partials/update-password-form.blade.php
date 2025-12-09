<section>
    <header>
        <!-- Translated to Indonesian -->
        <h2 class="text-lg font-medium text-indigo-900">
            Perbarui Kata Sandi
        </h2>

        <p class="mt-1 text-sm text-gray-700">
            Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <!-- Translated labels and changed styling to white background -->
            <label for="update_password_current_password" class="block font-medium text-sm text-gray-700">Kata Sandi Saat Ini</label>
            <input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full bg-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block font-medium text-sm text-gray-700">Kata Sandi Baru</label>
            <input id="update_password_password" name="password" type="password" class="mt-1 block w-full bg-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block font-medium text-sm text-gray-700">Konfirmasi Kata Sandi</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full bg-white border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <!-- Translated button text to Indonesian -->
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                SIMPAN
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600"
                >Tersimpan.</p>
            @endif
        </div>
    </form>
</section>
