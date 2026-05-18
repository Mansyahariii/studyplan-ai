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
                        Masuk lagi,
                        deadline udah nunggu.
                    </h1>

                    <p class="mt-6 max-w-md text-base leading-7 text-indigo-100">
                        Lanjutkan ngatur tugas kuliah, cek prioritas, generate rekomendasi AI, dan pantau progress akademik kamu.
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
                    Buka dashboard, cek tugas paling urgent, lalu kerjakan yang paling berdampak dulu.
                </p>
            </div>

            {{-- Right Side --}}
            <div class="flex min-h-[760px] items-center justify-center p-6 sm:p-8 lg:p-10">
                <div class="w-full max-w-md">

                    <div class="mb-8">
                        <h1 class="text-3xl font-black text-gray-900 dark:text-white">
                            Login ke akun kamu
                        </h1>

                        <p class="mt-2 text-sm leading-6 text-gray-500 dark:text-gray-400">
                            Masuk untuk lanjut ngatur tugas kuliah biar nggak chaos.
                        </p>
                    </div>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-5">
                        @csrf

                        {{-- Email --}}
                        <div>
                            <x-input-label for="email" :value="'Email'" />

                            <x-text-input id="email"
                                          class="mt-2 block w-full"
                                          type="email"
                                          name="email"
                                          :value="old('email')"
                                          required
                                          autofocus
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
                                          autocomplete="current-password"
                                          placeholder="Masukkan password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        {{-- Remember + Forgot --}}
                        <div class="flex items-center justify-between gap-4">
                            <label for="remember_me" class="inline-flex items-center gap-2">
                                <input id="remember_me"
                                       type="checkbox"
                                       name="remember"
                                       class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500
                                              dark:border-gray-700 dark:bg-gray-800">

                                <span class="text-sm text-gray-600 dark:text-gray-300">
                                    Ingat saya
                                </span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300"
                                   href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>

                        <button type="submit"
                                class="w-full rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-sm hover:bg-indigo-700 transition">
                            Login
                        </button>

                        <p class="text-center text-sm text-gray-500 dark:text-gray-400">
                            Belum punya akun?
                            <a href="{{ route('register') }}"
                               class="font-bold text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300">
                                Daftar
                            </a>
                        </p>
                    </form>

                    <div class="mt-6 rounded-2xl border border-indigo-100 bg-indigo-50 p-4
                                dark:border-indigo-900/50 dark:bg-indigo-900/20">
                        <p class="text-sm leading-6 text-indigo-700 dark:text-indigo-300">
                            Setelah login, kamu bisa langsung melihat dashboard, tugas prioritas, dan ringkasan harian dari AI.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>