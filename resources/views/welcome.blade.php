<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StudyPlan AI</title>

    <script>
        if (
            localStorage.getItem('theme') === 'dark' ||
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-100">
    <div class="min-h-screen overflow-hidden">

        {{-- Navbar --}}
        <nav class="border-b border-gray-100 bg-white/90 backdrop-blur-xl dark:border-gray-800 dark:bg-gray-950/90">
            <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-10">

                    {{-- Brand --}}
                    <a href="/" class="flex items-center gap-3">
                        <div
                            class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-600 to-purple-700 text-white shadow-md">
                            <span class="text-sm font-black tracking-tight">
                                AI
                            </span>
                        </div>

                        <div>
                            <h1 class="text-base font-bold text-gray-900 leading-tight dark:text-white">
                                StudyPlan AI
                            </h1>

                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Smart task planner
                            </p>
                        </div>
                    </a>

                    {{-- Desktop Navigation --}}
                    <div class="hidden md:flex items-center gap-2">
                        <a href="{{ url('/#features') }}"
                            class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white rounded-2xl px-4 py-2 text-sm font-semibold transition">
                            Features
                        </a>

                        <a href="{{ url('/#how-it-works') }}"
                            class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white rounded-2xl px-4 py-2 text-sm font-semibold transition">
                            How It Works
                        </a>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" x-data="{
                            darkMode: document.documentElement.classList.contains('dark'),
                            toggle() {
                                this.darkMode = !this.darkMode;

                                if (this.darkMode) {
                                    document.documentElement.classList.add('dark');
                                    localStorage.setItem('theme', 'dark');
                                } else {
                                    document.documentElement.classList.remove('dark');
                                    localStorage.setItem('theme', 'light');
                                }
                            }
                        }" @click="toggle()" class="inline-flex items-center justify-center rounded-2xl border border-gray-100 bg-gray-50 px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-100 transition
                               dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        <span x-show="!darkMode">🌙</span>
                        <span x-show="darkMode">☀️</span>
                    </button>

                    @auth
                        <a href="{{ route('dashboard') }}"
                            class="rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 transition">
                            Dashboard
                        </a>
                    @else
                        {{-- <a href="{{ route('login') }}" class="hidden sm:inline-flex rounded-2xl px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-100 transition
                                          dark:text-gray-200 dark:hover:bg-gray-800">
                            Login
                        </a> --}}

                        <a href="{{ route('register') }}"
                            class="rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 transition">
                            Mulai Sekarang
                        </a>
                    @endauth
                </div>
            </div>
        </nav>

        {{-- Hero --}}
        <section class="relative">
            <div class="absolute inset-0 -z-10 bg-gradient-to-br from-indigo-50 via-purple-50 to-white
                        dark:from-gray-950 dark:via-indigo-950/40 dark:to-gray-950"></div>

            <div
                class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-12 px-4 py-16 sm:px-6 lg:grid-cols-2 lg:px-8 lg:py-24">
                <div>
                    <div class="mb-5 inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-white px-4 py-2 text-sm font-semibold text-indigo-700 shadow-sm
                                dark:border-indigo-900/50 dark:bg-indigo-900/20 dark:text-indigo-300">
                        <span>✨</span>
                        <span>AI Task Priority Assistant</span>
                    </div>

                    <h1
                        class="text-4xl font-black tracking-tight text-gray-900 sm:text-5xl lg:text-6xl dark:text-white">
                        Atur tugas kuliah
                        <span
                            class="block bg-gradient-to-r from-indigo-600 to-purple-700 bg-clip-text text-transparent dark:from-indigo-300 dark:to-purple-300">
                            tanpa panik deadline.
                        </span>
                    </h1>

                    <p class="mt-6 max-w-2xl text-base leading-8 text-gray-600 dark:text-gray-300">
                        StudyPlan AI membantu mahasiswa mencatat tugas, menghitung skor prioritas,
                        dan menghasilkan rekomendasi pengerjaan berbasis AI berdasarkan deadline,
                        tingkat kesulitan, estimasi waktu, dan bobot nilai.
                    </p>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        @auth
                            <a href="{{ route('dashboard') }}"
                                class="rounded-2xl bg-indigo-600 px-6 py-4 text-center text-sm font-bold text-white shadow-sm hover:bg-indigo-700 transition">
                                Buka Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}"
                                class="rounded-2xl bg-indigo-600 px-6 py-4 text-center text-sm font-bold text-white shadow-sm hover:bg-indigo-700 transition">
                                Buat Akun Gratis
                            </a>

                            <a href="{{ route('login') }}"
                                class="rounded-2xl border border-gray-200 bg-white px-6 py-4 text-center text-sm font-bold text-gray-700 shadow-sm hover:bg-gray-50 transition
                                              dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800">
                                Login
                            </a>
                        @endauth
                    </div>

                    <div class="mt-8 grid grid-cols-3 gap-4 max-w-lg">
                        <div
                            class="rounded-2xl bg-white p-4 shadow-sm border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
                            <p class="text-2xl font-black text-indigo-600 dark:text-indigo-400">AI</p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Rekomendasi</p>
                        </div>

                        <div
                            class="rounded-2xl bg-white p-4 shadow-sm border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
                            <p class="text-2xl font-black text-purple-600 dark:text-purple-400">100</p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Skor Prioritas</p>
                        </div>

                        <div
                            class="rounded-2xl bg-white p-4 shadow-sm border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
                            <p class="text-2xl font-black text-green-600 dark:text-green-400">Smart</p>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Planner</p>
                        </div>
                    </div>
                </div>

                {{-- Mockup Card --}}
                <div class="relative">
                    <div
                        class="absolute -left-8 -top-8 h-32 w-32 rounded-full bg-indigo-200 blur-3xl dark:bg-indigo-900/40">
                    </div>
                    <div
                        class="absolute -bottom-8 -right-8 h-32 w-32 rounded-full bg-purple-200 blur-3xl dark:bg-purple-900/40">
                    </div>

                    <div
                        class="relative rounded-[2rem] border border-gray-100 bg-white p-6 shadow-2xl dark:bg-gray-900 dark:border-gray-800 dark:shadow-indigo-950/30">
                        <div class="mb-5 flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-gray-500 dark:text-gray-400">Prioritas Hari Ini</p>
                                <h3 class="text-xl font-black text-gray-900 dark:text-white">Laporan Black Box Testing
                                </h3>
                            </div>

                            <span
                                class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700 dark:bg-red-900/30 dark:text-red-300">
                                Sangat Tinggi
                            </span>
                        </div>

                        <div class="space-y-4">
                            <div
                                class="rounded-2xl bg-gray-50 p-4 border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-semibold text-gray-600 dark:text-gray-300">Skor Prioritas</p>
                                    <p class="text-sm font-bold text-indigo-600 dark:text-indigo-400">95/100</p>
                                </div>

                                <div class="mt-3 h-3 rounded-full bg-gray-200 dark:bg-gray-700">
                                    <div class="h-3 w-[95%] rounded-full bg-indigo-600 dark:bg-indigo-500"></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div
                                    class="rounded-2xl bg-red-50 p-4 border border-red-100 dark:bg-red-900/20 dark:border-red-900/50">
                                    <p class="text-xs font-semibold text-red-500 dark:text-red-300">Deadline</p>
                                    <p class="mt-1 text-sm font-bold text-red-700 dark:text-red-200">Besok 23:59</p>
                                </div>

                                <div
                                    class="rounded-2xl bg-orange-50 p-4 border border-orange-100 dark:bg-orange-900/20 dark:border-orange-900/50">
                                    <p class="text-xs font-semibold text-orange-500 dark:text-orange-300">Estimasi</p>
                                    <p class="mt-1 text-sm font-bold text-orange-700 dark:text-orange-200">6 jam</p>
                                </div>
                            </div>

                            <div
                                class="rounded-2xl border border-purple-100 bg-purple-50 p-5 dark:bg-purple-900/20 dark:border-purple-900/50">
                                <div class="mb-2 flex items-center gap-2">
                                    <span>✨</span>
                                    <p class="text-sm font-bold text-purple-800 dark:text-purple-300">Rekomendasi AI</p>
                                </div>

                                <p class="text-sm leading-6 text-purple-700 dark:text-purple-200/90">
                                    Kerjakan tugas ini terlebih dahulu karena deadline dekat, tingkat kesulitan tinggi,
                                    dan estimasi pengerjaan cukup lama.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Features --}}
        <section id="features" class="bg-white py-20 dark:bg-gray-950">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <p class="text-sm font-bold uppercase tracking-wide text-indigo-600 dark:text-indigo-400">
                        Fitur Utama
                    </p>

                    <h2 class="mt-3 text-3xl font-black text-gray-900 dark:text-white">
                        Bukan sekadar to-do list biasa.
                    </h2>

                    <p class="mt-4 text-sm leading-7 text-gray-600 dark:text-gray-300">
                        Sistem ini menggabungkan perhitungan prioritas dan AI recommendation
                        supaya mahasiswa bisa mengatur tugas dengan lebih strategis.
                    </p>
                </div>

                <div class="mt-12 grid grid-cols-1 gap-6 md:grid-cols-3">
                    <div class="rounded-3xl border border-gray-100 bg-gray-50 p-6 hover:bg-white hover:shadow-md transition
                                dark:border-gray-800 dark:bg-gray-900 dark:hover:bg-gray-800">
                        <div
                            class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300">
                            📊
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                            Skor Prioritas Otomatis
                        </h3>

                        <p class="mt-3 text-sm leading-6 text-gray-600 dark:text-gray-300">
                            Sistem menghitung prioritas berdasarkan deadline, kesulitan, estimasi pengerjaan, dan bobot
                            nilai.
                        </p>
                    </div>

                    <div class="rounded-3xl border border-gray-100 bg-gray-50 p-6 hover:bg-white hover:shadow-md transition
                                dark:border-gray-800 dark:bg-gray-900 dark:hover:bg-gray-800">
                        <div
                            class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-100 text-purple-700 dark:bg-purple-900/40 dark:text-purple-300">
                            ✨
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                            Rekomendasi AI
                        </h3>

                        <p class="mt-3 text-sm leading-6 text-gray-600 dark:text-gray-300">
                            AI memberi alasan prioritas, risiko deadline, langkah pengerjaan, jadwal, dan tips manajemen
                            waktu.
                        </p>
                    </div>

                    <div class="rounded-3xl border border-gray-100 bg-gray-50 p-6 hover:bg-white hover:shadow-md transition
                                dark:border-gray-800 dark:bg-gray-900 dark:hover:bg-gray-800">
                        <div
                            class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">
                            ✅
                        </div>

                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                            Progress Tugas
                        </h3>

                        <p class="mt-3 text-sm leading-6 text-gray-600 dark:text-gray-300">
                            Pantau tugas yang belum dikerjakan, sedang dikerjakan, selesai, atau terlambat.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- How It Works --}}
        <section id="how-it-works" class="bg-gray-50 py-20 dark:bg-gray-900">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 lg:items-center">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-wide text-indigo-600 dark:text-indigo-400">
                            Cara Kerja
                        </p>

                        <h2 class="mt-3 text-3xl font-black text-gray-900 dark:text-white">
                            Flow-nya simple, tapi impact-nya kerasa.
                        </h2>

                        <p class="mt-4 text-sm leading-7 text-gray-600 dark:text-gray-300">
                            Mahasiswa cukup memasukkan data tugas. Sistem menghitung skor prioritas,
                            lalu AI membantu membuat strategi pengerjaan yang lebih mudah diikuti.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <div
                            class="flex gap-4 rounded-3xl bg-white p-5 shadow-sm border border-gray-100 dark:bg-gray-950 dark:border-gray-800">
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-indigo-600 text-sm font-bold text-white">
                                1
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 dark:text-white">Input tugas kuliah</h3>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    Isi nama tugas, mata kuliah, deadline, kesulitan, estimasi waktu, dan bobot nilai.
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex gap-4 rounded-3xl bg-white p-5 shadow-sm border border-gray-100 dark:bg-gray-950 dark:border-gray-800">
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-purple-600 text-sm font-bold text-white">
                                2
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 dark:text-white">Sistem menghitung prioritas</h3>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    Skor prioritas dibuat berdasarkan parameter tugas yang sudah diinput.
                                </p>
                            </div>
                        </div>

                        <div
                            class="flex gap-4 rounded-3xl bg-white p-5 shadow-sm border border-gray-100 dark:bg-gray-950 dark:border-gray-800">
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-green-600 text-sm font-bold text-white">
                                3
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 dark:text-white">AI memberi rekomendasi</h3>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    AI membuat alasan prioritas, langkah pengerjaan, jadwal, dan tips manajemen waktu.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- CTA --}}
        <section class="bg-white py-20 dark:bg-gray-950">
            <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
                <div
                    class="rounded-[2rem] bg-gradient-to-r from-indigo-600 to-purple-700 p-10 text-center text-white shadow-xl
                            dark:from-slate-900 dark:via-indigo-950 dark:to-purple-950 dark:border dark:border-indigo-900/60">
                    <h2 class="text-3xl font-black">
                        Siap bikin tugas kuliah lebih teratur?
                    </h2>

                    <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-indigo-100 dark:text-indigo-200">
                        Mulai catat tugas, cek prioritas, dan gunakan AI untuk membuat strategi pengerjaan yang lebih
                        jelas.
                    </p>

                    <div class="mt-8">
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex rounded-2xl bg-white px-6 py-4 text-sm font-bold text-indigo-700 shadow hover:bg-indigo-50 transition
                                              dark:bg-indigo-400 dark:text-gray-950 dark:hover:bg-indigo-300">
                                Buka Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex rounded-2xl bg-white px-6 py-4 text-sm font-bold text-indigo-700 shadow hover:bg-indigo-50 transition
                                              dark:bg-indigo-400 dark:text-gray-950 dark:hover:bg-indigo-300">
                                Mulai Sekarang
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </section>

        {{-- Footer --}}
        <footer class="border-t border-gray-100 bg-white py-8 dark:border-gray-800 dark:bg-gray-950">
            <div
                class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-4 text-sm text-gray-500 dark:text-gray-400 sm:px-6 md:flex-row lg:px-8">
                <p>
                    © {{ date('Y') }} StudyPlan AI. Sistem Manajemen Tugas Mahasiswa.
                </p>

                <p>
                    Built with Laravel + AI Recommendation.
                </p>
            </div>
        </footer>

    </div>
</body>

</html>