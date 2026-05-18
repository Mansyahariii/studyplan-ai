<nav x-data="{ open: false, userMenu: false }" class="sticky top-0 z-50 border-b border-gray-100 bg-white/90 backdrop-blur-xl shadow-sm
            dark:border-gray-800 dark:bg-gray-950/90">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">

            {{-- Left: Brand + Menu --}}
            <div class="flex items-center gap-10">

                {{-- Brand --}}
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
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
                    <a href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard')
    ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300'
    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white' }} rounded-2xl px-4 py-2 text-sm font-semibold transition">
                        Dashboard
                    </a>

                    <a href="{{ route('subjects.index') }}"
                        class="{{ request()->routeIs('subjects.*')
    ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300'
    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white' }} rounded-2xl px-4 py-2 text-sm font-semibold transition">
                        Mata Kuliah
                    </a>

                    <a href="{{ route('tasks.index') }}"
                        class="{{ request()->routeIs('tasks.*')
    ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300'
    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white' }} rounded-2xl px-4 py-2 text-sm font-semibold transition">
                        Tugas
                    </a>

                    <a href="{{ route('guide') }}"
                        class="{{ request()->routeIs('guide')
    ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300'
    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white' }} rounded-2xl px-4 py-2 text-sm font-semibold transition">
                        Panduan
                    </a>

                    <a href="{{ route('about') }}"
                        class="{{ request()->routeIs('about')
    ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300'
    : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-gray-800 dark:hover:text-white' }} rounded-2xl px-4 py-2 text-sm font-semibold transition">
                        Tentang
                    </a>
                </div>
            </div>

            {{-- Right: Action + User --}}
            <div class="hidden md:flex items-center gap-3">

                {{-- Dark Mode Toggle --}}
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
                        }" @click="toggle()" class="inline-flex items-center justify-center rounded-2xl border border-gray-100 bg-gray-50 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-100 transition
                               dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                    <span x-show="!darkMode">🌙</span>
                    <span x-show="darkMode">☀️</span>
                </button>

                {{-- User Dropdown --}}
                <div class="relative" @click.outside="userMenu = false">
                    <button type="button" @click="userMenu = ! userMenu" class="flex items-center gap-3 rounded-2xl border border-gray-100 bg-gray-50 px-3 py-2 hover:bg-gray-100 transition
                                   dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">

                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-purple-600 to-indigo-600 text-sm font-bold text-white">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <div class="text-left">
                            <p class="max-w-[130px] truncate text-sm font-semibold text-gray-800 dark:text-gray-100">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Mahasiswa
                            </p>
                        </div>

                        <svg class="h-4 w-4 text-gray-500 transition dark:text-gray-400"
                            :class="{ 'rotate-180': userMenu }" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="userMenu" x-transition class="absolute right-0 mt-3 w-64 overflow-hidden rounded-3xl border border-gray-100 bg-white shadow-xl
                                dark:border-gray-800 dark:bg-gray-900" style="display: none;">

                        <div class="border-b border-gray-100 px-5 py-4 dark:border-gray-800">
                            <p class="text-sm font-bold text-gray-900 dark:text-white">
                                {{ Auth::user()->name }}
                            </p>

                            <p class="mt-1 truncate text-xs text-gray-500 dark:text-gray-400">
                                {{ Auth::user()->email }}
                            </p>
                        </div>

                        <div class="p-2">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition
                                      dark:text-gray-200 dark:hover:bg-gray-800">
                                <span>👤</span>
                                <span>Profil Saya</span>
                            </a>

                            <a href="{{ url('/') }}" class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition
          dark:text-gray-200 dark:hover:bg-gray-800">
                                <span>🌐</span>
                                <span>Landing Page</span>
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-left text-sm font-semibold text-red-600 hover:bg-red-50 transition
                                               dark:text-red-400 dark:hover:bg-red-900/20">
                                    <span>🚪</span>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Mobile Button --}}
            <div class="md:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center rounded-2xl bg-gray-100 p-3 text-gray-600 hover:bg-gray-200 transition
                               dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />

                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="open" x-transition
        class="md:hidden border-t border-gray-100 bg-white dark:border-gray-800 dark:bg-gray-950"
        style="display: none;">

        <div class="px-4 py-5 space-y-5">

            {{-- User Card --}}
            <div class="rounded-3xl border border-gray-100 bg-gray-50 p-4
                    dark:border-gray-800 dark:bg-gray-900">
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-gradient-to-br from-purple-600 to-indigo-600 text-sm font-black text-white">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <div class="min-w-0">
                        <p class="truncate text-sm font-bold text-gray-900 dark:text-white">
                            {{ Auth::user()->name }}
                        </p>

                        <p class="truncate text-xs text-gray-500 dark:text-gray-400">
                            {{ Auth::user()->email }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Main Navigation --}}
            <div>
                <p class="mb-2 px-2 text-xs font-bold uppercase tracking-wide text-gray-400 dark:text-gray-500">
                    Menu Utama
                </p>

                <div class="space-y-2">
                    <a href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard')
    ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300'
    : 'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800' }} flex items-center justify-between rounded-2xl px-4 py-3 text-sm font-semibold transition">
                        <span>Dashboard</span>
                        <span>🏠</span>
                    </a>

                    <a href="{{ route('subjects.index') }}"
                        class="{{ request()->routeIs('subjects.*')
    ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300'
    : 'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800' }} flex items-center justify-between rounded-2xl px-4 py-3 text-sm font-semibold transition">
                        <span>Mata Kuliah</span>
                        <span>📚</span>
                    </a>

                    <a href="{{ route('tasks.index') }}"
                        class="{{ request()->routeIs('tasks.*')
    ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300'
    : 'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800' }} flex items-center justify-between rounded-2xl px-4 py-3 text-sm font-semibold transition">
                        <span>Tugas</span>
                        <span>✅</span>
                    </a>

                    <a href="{{ route('guide') }}"
                        class="{{ request()->routeIs('guide')
    ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300'
    : 'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800' }} flex items-center justify-between rounded-2xl px-4 py-3 text-sm font-semibold transition">
                        <span>Panduan</span>
                        <span>🧭</span>
                    </a>

                    <a href="{{ route('about') }}"
                        class="{{ request()->routeIs('about')
    ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300'
    : 'text-gray-600 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-gray-800' }} flex items-center justify-between rounded-2xl px-4 py-3 text-sm font-semibold transition">
                        <span>Tentang</span>
                        <span>ℹ️</span>
                    </a>
                </div>
            </div>

            {{-- Quick Action --}}
            <div>
                <a href="{{ route('tasks.create') }}"
                    class="flex items-center justify-center rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-sm hover:bg-indigo-700 transition">
                    + Tambah Tugas
                </a>
            </div>

            {{-- System --}}
            <div>
                <p class="mb-2 px-2 text-xs font-bold uppercase tracking-wide text-gray-400 dark:text-gray-500">
                    Akun & Sistem
                </p>

                <div class="space-y-2">
                    <a href="{{ url('/') }}" class="flex items-center justify-between rounded-2xl bg-gray-50 px-4 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-100
                          dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        <span>Beranda</span>
                        <span>🌐</span>
                    </a>

                    <a href="{{ route('profile.edit') }}" class="flex items-center justify-between rounded-2xl bg-gray-50 px-4 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-100
                          dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        <span>Profil Saya</span>
                        <span>👤</span>
                    </a>

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
                        }" @click="toggle()" class="flex w-full items-center justify-between rounded-2xl bg-gray-50 px-4 py-3 text-sm font-semibold text-gray-700 transition hover:bg-gray-100
                               dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        <span>Mode Tampilan</span>

                        <span>
                            <span x-show="!darkMode">🌙</span>
                            <span x-show="darkMode">☀️</span>
                        </span>
                    </button>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="flex w-full items-center justify-between rounded-2xl bg-red-50 px-4 py-3 text-left text-sm font-semibold text-red-600 transition hover:bg-red-100
                                   dark:bg-red-900/20 dark:text-red-400 dark:hover:bg-red-900/30">
                            <span>Logout</span>
                            <span>🚪</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>