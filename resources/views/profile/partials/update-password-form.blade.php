<section>
    <header class="mb-6">
        <div class="flex items-start gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-purple-100 text-purple-700
                        dark:bg-purple-900/40 dark:text-purple-300">
                🔒
            </div>

            <div>
                <h2 class="text-lg font-bold app-title">
                    Ubah Password
                </h2>

                <p class="mt-1 text-sm app-subtitle">
                    Gunakan password yang kuat agar akun kamu lebih aman.
                </p>
            </div>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-sm font-semibold app-title mb-2">
                Password Saat Ini
            </label>

            <input id="update_password_current_password"
                   name="current_password"
                   type="password"
                   autocomplete="current-password"
                   placeholder="Masukkan password saat ini"
                   class="w-full rounded-2xl px-4 py-3 text-sm app-input">

            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password" class="block text-sm font-semibold app-title mb-2">
                Password Baru
            </label>

            <input id="update_password_password"
                   name="password"
                   type="password"
                   autocomplete="new-password"
                   placeholder="Minimal 8 karakter"
                   class="w-full rounded-2xl px-4 py-3 text-sm app-input">

            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-sm font-semibold app-title mb-2">
                Konfirmasi Password Baru
            </label>

            <input id="update_password_password_confirmation"
                   name="password_confirmation"
                   type="password"
                   autocomplete="new-password"
                   placeholder="Ulangi password baru"
                   class="w-full rounded-2xl px-4 py-3 text-sm app-input">

            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                    class="rounded-2xl bg-purple-600 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-purple-700 transition">
                Update Password
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm font-semibold text-green-600 dark:text-green-400">
                    Password berhasil diperbarui.
                </p>
            @endif
        </div>
    </form>
</section>