<x-app-layout>
    <div class="py-8 app-page min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Hero --}}
            <div class="mb-6 app-hero p-7">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div class="flex items-center gap-4">
                        <div class="flex h-16 w-16 items-center justify-center rounded-3xl bg-white/15 text-2xl font-black text-white shadow-sm">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <div>
                            <p class="app-hero-label">
                                Akun Pengguna
                            </p>

                            <h1 class="mt-1 text-2xl font-bold text-white">
                                {{ $user->name }}
                            </h1>

                            <p class="mt-1 text-sm text-indigo-100 dark:text-indigo-200">
                                {{ $user->email }}
                            </p>
                        </div>
                    </div>

                    <a href="{{ route('dashboard') }}" class="app-hero-button-secondary">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Sidebar --}}
                <div class="space-y-6">
                    <div class="rounded-3xl app-card p-6">
                        <div class="flex flex-col items-center text-center">
                            <div class="flex h-24 w-24 items-center justify-center rounded-[2rem] bg-gradient-to-br from-indigo-600 to-purple-700 text-4xl font-black text-white shadow-md">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>

                            <h3 class="mt-4 text-xl font-bold app-title">
                                {{ $user->name }}
                            </h3>

                            <p class="mt-1 text-sm app-subtitle">
                                {{ $user->email }}
                            </p>

                            <div class="mt-4 inline-flex rounded-full bg-indigo-50 px-4 py-2 text-xs font-semibold text-indigo-700
                                        dark:bg-indigo-900/40 dark:text-indigo-300">
                                Mahasiswa
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl app-card p-6">
                        <h3 class="text-lg font-bold app-title">
                            Informasi Akun
                        </h3>

                        <div class="mt-5 space-y-4">
                            <div class="rounded-2xl app-card-soft p-4">
                                <p class="text-xs font-semibold uppercase tracking-wide app-subtitle">
                                    Nama
                                </p>
                                <p class="mt-1 text-sm font-semibold app-title">
                                    {{ $user->name }}
                                </p>
                            </div>

                            <div class="rounded-2xl app-card-soft p-4">
                                <p class="text-xs font-semibold uppercase tracking-wide app-subtitle">
                                    Email
                                </p>
                                <p class="mt-1 break-all text-sm font-semibold app-title">
                                    {{ $user->email }}
                                </p>
                            </div>

                            <div class="rounded-2xl app-card-soft p-4">
                                <p class="text-xs font-semibold uppercase tracking-wide app-subtitle">
                                    Bergabung
                                </p>
                                <p class="mt-1 text-sm font-semibold app-title">
                                    {{ $user->created_at->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-indigo-600 p-6 text-white shadow-sm
                                dark:bg-indigo-900/50 dark:border dark:border-indigo-800">
                        <h3 class="text-lg font-bold">
                            Tips Keamanan
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-indigo-100 dark:text-indigo-200">
                            Pakai password yang kuat dan jangan share akun kamu. Data tugas kamu tetap lebih aman kalau akunmu juga aman.
                        </p>
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="rounded-3xl app-card p-6">
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <div class="rounded-3xl app-card p-6">
                        @include('profile.partials.update-password-form')
                    </div>

                    <div class="rounded-3xl bg-white p-6 shadow-sm border border-red-100
                                dark:bg-gray-900 dark:border-red-900/50">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>