<section x-data="{ confirmingUserDeletion: false }">
    <header class="mb-6">
        <div class="flex items-start gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-red-100 text-red-700
                        dark:bg-red-900/40 dark:text-red-300">
                ⚠️
            </div>

            <div>
                <h2 class="text-lg font-bold text-red-700 dark:text-red-300">
                    Hapus Akun
                </h2>

                <p class="mt-1 text-sm app-subtitle">
                    Setelah akun dihapus, semua data yang berhubungan dengan akun ini akan hilang. Ini aksi serius, jangan asal klik.
                </p>
            </div>
        </div>
    </header>

    <div class="rounded-2xl border border-red-100 bg-red-50 p-5
                dark:border-red-900/50 dark:bg-red-900/20">
        <p class="text-sm leading-6 text-red-700 dark:text-red-300">
            Kalau kamu menghapus akun, data profil dan akses ke sistem akan dihapus secara permanen.
            Pastikan kamu sudah yakin sebelum melanjutkan.
        </p>

        <button type="button"
                @click.prevent="confirmingUserDeletion = true"
                class="mt-5 rounded-2xl bg-red-600 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-red-700 transition">
            Hapus Akun
        </button>
    </div>

    {{-- Modal --}}
    <div x-show="confirmingUserDeletion"
         x-transition.opacity
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 px-4"
         style="display: none;">

        <div @click.outside="confirmingUserDeletion = false"
             class="w-full max-w-lg rounded-3xl bg-white p-6 shadow-2xl
                    dark:bg-gray-900 dark:border dark:border-gray-800">

            <div class="flex items-start gap-3">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-red-100 text-red-700
                            dark:bg-red-900/40 dark:text-red-300">
                    ⚠️
                </div>

                <div>
                    <h3 class="text-xl font-bold app-title">
                        Yakin ingin menghapus akun?
                    </h3>

                    <p class="mt-2 text-sm leading-6 app-subtitle">
                        Masukkan password kamu untuk mengonfirmasi penghapusan akun.
                    </p>
                </div>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}" class="mt-6">
                @csrf
                @method('delete')

                <div>
                    <label for="password" class="block text-sm font-semibold app-title mb-2">
                        Password
                    </label>

                    <input id="password"
                           name="password"
                           type="password"
                           placeholder="Masukkan password"
                           class="w-full rounded-2xl border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 focus:border-red-500 focus:ring-red-500
                                  dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-500">

                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                <div class="mt-6 flex flex-col sm:flex-row justify-end gap-3">
                    <button type="button"
                            @click="confirmingUserDeletion = false"
                            class="rounded-2xl px-5 py-3 text-sm font-bold app-button-secondary transition">
                        Batal
                    </button>

                    <button type="submit"
                            class="rounded-2xl bg-red-600 px-5 py-3 text-sm font-bold text-white hover:bg-red-700 transition">
                        Ya, Hapus Akun
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>