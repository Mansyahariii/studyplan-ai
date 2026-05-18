<x-app-layout>
    <div class="py-8 app-page min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Hero --}}
            <div class="mb-6 app-hero p-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    <div>
                        <p class="mb-3 inline-flex rounded-full bg-white/15 px-4 py-2 text-sm font-semibold text-indigo-100 dark:text-indigo-200">
                            User Guide
                        </p>

                        <h1 class="text-3xl font-black text-white">
                            Cara Menggunakan StudyPlan AI
                        </h1>

                        <p class="mt-4 max-w-3xl text-sm leading-7 text-indigo-100 dark:text-indigo-200">
                            Ikuti alur berikut untuk mencatat tugas, menghitung prioritas,
                            mendapatkan rekomendasi AI, dan memantau progress pengerjaan tugas.
                        </p>
                    </div>

                    <a href="{{ route('tasks.create') }}" class="app-hero-button-secondary">
                        Mulai Tambah Tugas
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Main Steps --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Step 1 --}}
                    <div class="rounded-3xl app-card p-6">
                        <div class="flex gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-indigo-600 text-lg font-black text-white">
                                1
                            </div>

                            <div>
                                <h3 class="text-xl font-bold app-title">
                                    Tambahkan Mata Kuliah
                                </h3>

                                <p class="mt-2 text-sm leading-6 app-text">
                                    Sebelum menambahkan tugas, pengguna perlu membuat data mata kuliah terlebih dahulu.
                                    Mata kuliah digunakan sebagai kategori agar tugas lebih terstruktur.
                                </p>

                                <div class="mt-5 rounded-2xl app-card-soft p-5">
                                    <p class="text-sm font-bold app-title">
                                        Langkah:
                                    </p>

                                    <ol class="mt-3 list-decimal space-y-2 pl-5 text-sm app-text">
                                        <li>Buka menu <strong>Mata Kuliah</strong>.</li>
                                        <li>Klik tombol <strong>Tambah Mata Kuliah</strong>.</li>
                                        <li>Isi nama mata kuliah dan deskripsi.</li>
                                        <li>Klik <strong>Simpan Mata Kuliah</strong>.</li>
                                    </ol>
                                </div>

                                <div class="mt-5">
                                    <a href="{{ route('subjects.create') }}"
                                       class="inline-flex rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                                        Tambah Mata Kuliah
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Step 2 --}}
                    <div class="rounded-3xl app-card p-6">
                        <div class="flex gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-purple-600 text-lg font-black text-white">
                                2
                            </div>

                            <div>
                                <h3 class="text-xl font-bold app-title">
                                    Tambahkan Tugas Kuliah
                                </h3>

                                <p class="mt-2 text-sm leading-6 app-text">
                                    Setelah mata kuliah tersedia, pengguna dapat mencatat tugas.
                                    Data tugas akan dipakai sistem untuk menghitung skor prioritas.
                                </p>

                                <div class="mt-5 rounded-2xl app-card-soft p-5">
                                    <p class="text-sm font-bold app-title">
                                        Data yang perlu diisi:
                                    </p>

                                    <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <div class="rounded-xl bg-white p-3 text-sm app-text border border-gray-100 dark:bg-gray-900 dark:border-gray-700">
                                            Nama tugas
                                        </div>

                                        <div class="rounded-xl bg-white p-3 text-sm app-text border border-gray-100 dark:bg-gray-900 dark:border-gray-700">
                                            Mata kuliah
                                        </div>

                                        <div class="rounded-xl bg-white p-3 text-sm app-text border border-gray-100 dark:bg-gray-900 dark:border-gray-700">
                                            Deadline
                                        </div>

                                        <div class="rounded-xl bg-white p-3 text-sm app-text border border-gray-100 dark:bg-gray-900 dark:border-gray-700">
                                            Tingkat kesulitan
                                        </div>

                                        <div class="rounded-xl bg-white p-3 text-sm app-text border border-gray-100 dark:bg-gray-900 dark:border-gray-700">
                                            Estimasi waktu
                                        </div>

                                        <div class="rounded-xl bg-white p-3 text-sm app-text border border-gray-100 dark:bg-gray-900 dark:border-gray-700">
                                            Bobot nilai
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <a href="{{ route('tasks.create') }}"
                                       class="inline-flex rounded-2xl bg-purple-600 px-5 py-3 text-sm font-semibold text-white hover:bg-purple-700 transition">
                                        Tambah Tugas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Step 3 --}}
                    <div class="rounded-3xl app-card p-6">
                        <div class="flex gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-blue-600 text-lg font-black text-white">
                                3
                            </div>

                            <div>
                                <h3 class="text-xl font-bold app-title">
                                    Lihat Skor Prioritas
                                </h3>

                                <p class="mt-2 text-sm leading-6 app-text">
                                    Setelah tugas disimpan, sistem otomatis menghitung skor prioritas.
                                    Skor ini membantu menentukan tugas mana yang lebih urgent.
                                </p>

                                <div class="mt-5 rounded-2xl bg-blue-50 p-5 border border-blue-100
                                            dark:bg-blue-900/20 dark:border-blue-900/50">
                                    <p class="text-sm font-bold text-blue-800 dark:text-blue-300">
                                        Kategori Prioritas:
                                    </p>

                                    <div class="mt-3 flex flex-wrap gap-2">
                                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700
                                                     dark:bg-red-900/30 dark:text-red-300">
                                            Sangat Tinggi
                                        </span>

                                        <span class="rounded-full bg-orange-100 px-3 py-1 text-xs font-bold text-orange-700
                                                     dark:bg-orange-900/30 dark:text-orange-300">
                                            Tinggi
                                        </span>

                                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-bold text-yellow-700
                                                     dark:bg-yellow-900/30 dark:text-yellow-300">
                                            Sedang
                                        </span>

                                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700
                                                     dark:bg-green-900/30 dark:text-green-300">
                                            Rendah
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Step 4 --}}
                    <div class="rounded-3xl app-card p-6">
                        <div class="flex gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-violet-600 text-lg font-black text-white">
                                4
                            </div>

                            <div>
                                <h3 class="text-xl font-bold app-title">
                                    Generate Rekomendasi AI per Tugas
                                </h3>

                                <p class="mt-2 text-sm leading-6 app-text">
                                    Pada halaman detail tugas, pengguna dapat menekan tombol generate AI.
                                    AI akan memberikan rekomendasi strategi pengerjaan berdasarkan data tugas.
                                </p>

                                <div class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div class="rounded-2xl bg-purple-50 p-4 border border-purple-100
                                                dark:bg-purple-900/20 dark:border-purple-900/50">
                                        <p class="text-sm font-bold text-purple-800 dark:text-purple-300">
                                            Output AI
                                        </p>

                                        <p class="mt-1 text-sm text-purple-700 dark:text-purple-200/90">
                                            Alasan prioritas, risiko, langkah pengerjaan, jadwal, dan tips waktu.
                                        </p>
                                    </div>

                                    <div class="rounded-2xl bg-indigo-50 p-4 border border-indigo-100
                                                dark:bg-indigo-900/20 dark:border-indigo-900/50">
                                        <p class="text-sm font-bold text-indigo-800 dark:text-indigo-300">
                                            Catatan
                                        </p>

                                        <p class="mt-1 text-sm text-indigo-700 dark:text-indigo-200/90">
                                            AI hanya memberi saran, bukan mengerjakan tugas secara penuh.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Step 5 --}}
                    <div class="rounded-3xl app-card p-6">
                        <div class="flex gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-green-600 text-lg font-black text-white">
                                5
                            </div>

                            <div>
                                <h3 class="text-xl font-bold app-title">
                                    Update Status Tugas
                                </h3>

                                <p class="mt-2 text-sm leading-6 app-text">
                                    Pengguna dapat mengubah status tugas melalui quick update di daftar tugas
                                    atau melalui halaman detail tugas.
                                </p>

                                <div class="mt-5 rounded-2xl app-card-soft p-5">
                                    <p class="text-sm font-bold app-title">
                                        Status yang tersedia:
                                    </p>

                                    <div class="mt-3 flex flex-wrap gap-2">
                                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-gray-700
                                                     dark:bg-gray-800 dark:text-gray-300">
                                            Belum Dikerjakan
                                        </span>

                                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-bold text-blue-700
                                                     dark:bg-blue-900/30 dark:text-blue-300">
                                            Sedang Dikerjakan
                                        </span>

                                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700
                                                     dark:bg-green-900/30 dark:text-green-300">
                                            Selesai
                                        </span>

                                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-700
                                                     dark:bg-red-900/30 dark:text-red-300">
                                            Terlambat
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Step 6 --}}
                    <div class="rounded-3xl app-card p-6">
                        <div class="flex gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-red-600 text-lg font-black text-white">
                                6
                            </div>

                            <div>
                                <h3 class="text-xl font-bold app-title">
                                    Pantau Riwayat Aktivitas
                                </h3>

                                <p class="mt-2 text-sm leading-6 app-text">
                                    Setiap perubahan status akan tercatat pada riwayat aktivitas.
                                    Fitur ini membantu pengguna melihat progres perubahan status tugas.
                                </p>

                                <div class="mt-5 rounded-2xl bg-red-50 p-5 border border-red-100
                                            dark:bg-red-900/20 dark:border-red-900/50">
                                    <p class="text-sm font-bold text-red-800 dark:text-red-300">
                                        Contoh:
                                    </p>

                                    <p class="mt-2 text-sm text-red-700 dark:text-red-200/90">
                                        Belum Dikerjakan → Sedang Dikerjakan → Selesai
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Step 7 --}}
                    <div class="rounded-3xl app-card p-6">
                        <div class="flex gap-4">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-600 text-lg font-black text-white">
                                7
                            </div>

                            <div>
                                <h3 class="text-xl font-bold app-title">
                                    Generate AI Daily Summary
                                </h3>

                                <p class="mt-2 text-sm leading-6 app-text">
                                    Pada dashboard, pengguna dapat membuat ringkasan harian berbasis AI.
                                    AI akan membaca tugas aktif dan memberi saran fokus pengerjaan hari ini.
                                </p>

                                <div class="mt-5 rounded-2xl bg-emerald-50 p-5 border border-emerald-100
                                            dark:bg-emerald-900/20 dark:border-emerald-900/50">
                                    <p class="text-sm font-bold text-emerald-800 dark:text-emerald-300">
                                        Output:
                                    </p>

                                    <ul class="mt-3 list-disc space-y-2 pl-5 text-sm text-emerald-700 dark:text-emerald-200/90">
                                        <li>Overview kondisi tugas hari ini.</li>
                                        <li>Daftar fokus utama.</li>
                                        <li>Rencana pengerjaan.</li>
                                        <li>Tips manajemen waktu.</li>
                                    </ul>
                                </div>

                                <div class="mt-5">
                                    <a href="{{ route('dashboard') }}"
                                       class="inline-flex rounded-2xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white hover:bg-emerald-700 transition">
                                        Buka Dashboard
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">
                    <div class="rounded-3xl app-card p-6">
                        <h3 class="text-lg font-bold app-title">
                            Ringkasan Flow
                        </h3>

                        <div class="mt-5 space-y-3">
                            <div class="rounded-2xl bg-indigo-50 p-4 text-sm font-semibold text-indigo-700
                                        dark:bg-indigo-900/20 dark:text-indigo-300 dark:border dark:border-indigo-900/50">
                                1. Tambah mata kuliah
                            </div>

                            <div class="rounded-2xl bg-purple-50 p-4 text-sm font-semibold text-purple-700
                                        dark:bg-purple-900/20 dark:text-purple-300 dark:border dark:border-purple-900/50">
                                2. Tambah tugas
                            </div>

                            <div class="rounded-2xl bg-blue-50 p-4 text-sm font-semibold text-blue-700
                                        dark:bg-blue-900/20 dark:text-blue-300 dark:border dark:border-blue-900/50">
                                3. Cek skor prioritas
                            </div>

                            <div class="rounded-2xl bg-violet-50 p-4 text-sm font-semibold text-violet-700
                                        dark:bg-violet-900/20 dark:text-violet-300 dark:border dark:border-violet-900/50">
                                4. Generate AI
                            </div>

                            <div class="rounded-2xl bg-green-50 p-4 text-sm font-semibold text-green-700
                                        dark:bg-green-900/20 dark:text-green-300 dark:border dark:border-green-900/50">
                                5. Update status
                            </div>

                            <div class="rounded-2xl bg-red-50 p-4 text-sm font-semibold text-red-700
                                        dark:bg-red-900/20 dark:text-red-300 dark:border dark:border-red-900/50">
                                6. Pantau riwayat
                            </div>

                            <div class="rounded-2xl bg-emerald-50 p-4 text-sm font-semibold text-emerald-700
                                        dark:bg-emerald-900/20 dark:text-emerald-300 dark:border dark:border-emerald-900/50">
                                7. Generate daily summary
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-indigo-600 p-6 text-white shadow-sm
                                dark:bg-indigo-900/50 dark:border dark:border-indigo-800">
                        <h3 class="text-lg font-bold">
                            Tips Demo
                        </h3>

                        <p class="mt-2 text-sm leading-6 text-indigo-100 dark:text-indigo-200">
                            Saat presentasi, mulai dari dashboard, buka daftar tugas,
                            tampilkan skor prioritas, lalu generate rekomendasi AI di detail tugas.
                        </p>
                    </div>

                    <div class="rounded-3xl app-card p-6">
                        <h3 class="text-lg font-bold app-title">
                            Quick Access
                        </h3>

                        <div class="mt-5 space-y-3">
                            <a href="{{ route('dashboard') }}"
                               class="block rounded-2xl app-card-soft p-4 text-sm font-semibold app-text hover:bg-gray-100 transition
                                      dark:hover:bg-gray-700">
                                Dashboard
                            </a>

                            <a href="{{ route('subjects.index') }}"
                               class="block rounded-2xl app-card-soft p-4 text-sm font-semibold app-text hover:bg-gray-100 transition
                                      dark:hover:bg-gray-700">
                                Mata Kuliah
                            </a>

                            <a href="{{ route('tasks.index') }}"
                               class="block rounded-2xl app-card-soft p-4 text-sm font-semibold app-text hover:bg-gray-100 transition
                                      dark:hover:bg-gray-700">
                                Daftar Tugas
                            </a>

                            <a href="{{ route('tasks.create') }}"
                               class="block rounded-2xl bg-indigo-600 p-4 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                                Tambah Tugas
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>