<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'StudyPlan AI') }}</title>

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

<body class="font-sans antialiased bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-100">
    <div class="min-h-screen flex flex-col items-center justify-center px-4 py-10">

        {{-- Background --}}
        <div class="fixed inset-0 -z-10 bg-gradient-to-br from-indigo-50 via-purple-50 to-white
                    dark:from-gray-950 dark:via-indigo-950/40 dark:to-gray-950"></div>

        {{-- Back to Welcome --}}
        <div class="fixed left-5 top-5 z-50">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-2 rounded-2xl border border-gray-100 bg-white px-4 py-3 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition
              dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        </div>

        {{-- Dark Mode Toggle --}}
        <div class="fixed right-5 top-5">
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
                }" @click="toggle()" class="inline-flex items-center justify-center rounded-2xl border border-gray-100 bg-white px-4 py-3 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition
                       dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-gray-800">
                <span x-show="!darkMode">🌙</span>
                <span x-show="darkMode">☀️</span>
            </button>
        </div>

        {{-- Card --}}
        <div class="w-full max-w-5xl">
            {{ $slot }}
        </div>
    </div>
</body>

</html>