<x-guest-layout>
    <div class="overflow-hidden rounded-[2rem] border border-gray-100 bg-white shadow-2xl
                dark:border-gray-800 dark:bg-gray-900">
        <div class="grid grid-cols-1 lg:grid-cols-2">

            {{-- Left Side --}}
            <div class="relative hidden min-h-[760px] flex-col justify-between overflow-hidden bg-gradient-to-br from-indigo-600 via-purple-600 to-violet-700 p-10 text-white lg:flex
                        dark:from-slate-900 dark:via-indigo-950 dark:to-purple-950">

                <div class="absolute -right-16 -top-16 h-48 w-48 rounded-full bg-white/10 blur-2xl"></div>
                <div class="absolute -bottom-16 -left-16 h-48 w-48 rounded-full bg-white/10 blur-2xl"></div>

                <div class="relative">
                    <div class="flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 text-sm font-black text-white shadow-sm">
                            AI
                        </div>

                        <div>
                            <h2 class="text-2xl font-black">
                                StudyPlan AI
                            </h2>
                            <p class="text-sm text-indigo-100">
                                Smart task planner
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 inline-flex rounded-full bg-white/15 px-4 py-2 text-sm font-semibold text-indigo-100">
                        Smart Academic Planner
                    </div>
                </div>

                <div class="relative">
                    <h1 class="text-5xl font-black leading-tight">
                        Bikin akun,
                        tugas kuliah nggak perlu chaos.
                    </h1>

                    <p class="mt-6 max-w-md text-base leading-7 text-indigo-100">
                        Catat tugas, hitung prioritas, generate rekomendasi AI, dan pantau progress akademik kamu dari satu tempat.
                    </p>

                    <div class="mt-8 grid grid-cols-2 gap-3">
                        <div class="rounded-2xl bg-white/10 p-4 backdrop-blur">
                            <p class="text-2xl font-black">AI</p>
                            <p class="mt-1 text-xs text-indigo-100">Rekomendasi</p>
                        </div>

                        <div class="rounded-2xl bg-white/10 p-4 backdrop-blur">
                            <p class="text-2xl font-black">100</p>
                            <p class="mt-1 text-xs text-indigo-100">Skor Prioritas</p>
                        </div>
                    </div>
                </div>

                <p class="relative text-sm text-indigo-100">
                    Mulai dari input mata kuliah, tambah tugas, lalu biarkan sistem bantu menentukan prioritas.
                </p>
            </div>

            {{-- Right Side --}}
            <div class="flex min-h-[760px] items-center justify-center p-6 sm:p-8 lg:p-10">
                <div class="w-full max-w-md">

                    <div class="mb-8">
                        <h1 class="text-3xl font-black text-gray-900 dark:text-white">
                            Buat akun baru
                        </h1>

                        <p class="mt-2 text-sm leading-6 text-gray-500 dark:text-gray-400">
                            Daftar dulu biar kamu bisa mulai ngatur tugas kuliah dengan prioritas dan rekomendasi AI.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        {{-- Name --}}
                        <div>
                            <x-input-label for="name" :value="'Nama Lengkap'" />

                            <x-text-input id="name"
                                          class="mt-2 block w-full"
                                          type="text"
                                          name="name"
                                          :value="old('name')"
                                          required
                                          autofocus
                                          autocomplete="name"
                                          placeholder="Contoh: Ari Firmansyah" />

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Email --}}
                        <div>
                            <x-input-label for="email" :value="'Email'" />

                            <x-text-input id="email"
                                          class="mt-2 block w-full"
                                          type="email"
                                          name="email"
                                          :value="old('email')"
                                          required
                                          autocomplete="username"
                                          placeholder="contoh@gmail.com" />

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        {{-- Password --}}
                        <div>
                            <x-input-label for="password" :value="'Password'" />

                            <x-text-input id="password"
                                          class="mt-2 block w-full"
                                          type="password"
                                          name="password"
                                          required
                                          autocomplete="new-password"
                                          placeholder="Minimal 8 karakter" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        {{-- Confirm Password --}}
                        <div>
                            <x-input-label for="password_confirmation" :value="'Konfirmasi Password'" />

                            <x-text-input id="password_confirmation"
                                          class="mt-2 block w-full"
                                          type="password"
                                          name="password_confirmation"
                                          required
                                          autocomplete="new-password"
                                          placeholder="Ulangi password" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>

                        <button type="submit"
                                class="w-full rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-sm hover:bg-indigo-700 transition">
                            Daftar Sekarang
                        </button>

                        <p class="text-center text-sm text-gray-500 dark:text-gray-400">
                            Sudah punya akun?
                            <a href="{{ route('login') }}"
                               class="font-bold text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300">
                                Login
                            </a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>