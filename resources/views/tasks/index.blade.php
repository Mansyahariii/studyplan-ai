<x-app-layout>
    @php
        $isFilterActive =
            request()->filled('search') ||
            request()->filled('subject_id') ||
            request()->filled('status') ||
            request()->filled('priority_level') ||
            (request()->filled('sort') && request('sort') !== 'priority_desc');
    @endphp

    <div class="py-8 app-page min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-700 shadow-sm
                                    dark:border-green-900/50 dark:bg-green-900/20 dark:text-green-300">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-700 shadow-sm
                                    dark:border-red-900/50 dark:bg-red-900/20 dark:text-red-300">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Hero --}}
            <div class="mb-6 app-hero p-7">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="app-hero-label">
                            Manajemen Tugas
                        </p>

                        <h1 class="app-hero-title">
                            Atur tugas berdasarkan prioritas.
                        </h1>

                        <p class="app-hero-text">
                            Pantau deadline, status pengerjaan, skor prioritas, dan rekomendasi AI agar tugas kuliah
                            lebih terarah.
                        </p>
                    </div>

                    <a href="{{ route('tasks.create') }}" class="app-hero-button-secondary">
                        + Tambah Tugas
                    </a>
                </div>
            </div>

            {{-- Main Card Wrapper --}}
            <div class="rounded-3xl app-card p-6">

                {{-- Header --}}
                <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold app-title">
                            Daftar Tugas
                        </h3>

                        <p class="text-sm app-subtitle">
                            Semua tugas yang kamu tambahkan akan ditampilkan dan diurutkan berdasarkan filter yang
                            dipilih.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <div class="w-fit rounded-2xl bg-indigo-50 px-4 py-2 text-sm font-semibold text-indigo-700
                                    dark:bg-indigo-900/40 dark:text-indigo-300">
                            Total: {{ $tasks->total() }} Tugas
                        </div>

                        @if($isFilterActive)
                            <div class="w-fit rounded-2xl bg-purple-50 px-4 py-2 text-sm font-semibold text-purple-700
                                                dark:bg-purple-900/40 dark:text-purple-300">
                                Filter Aktif
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Filter Toggle --}}
                <div x-data="{ filterOpen: {{ $isFilterActive ? 'true' : 'false' }} }" class="mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                        <p class="text-sm app-subtitle">
                            Menampilkan
                            <span class="font-bold app-title">{{ $tasks->count() }}</span>
                            dari
                            <span class="font-bold app-title">{{ $tasks->total() }}</span>
                            tugas.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-3">
                            <button id="filter-toggle-button" type="button" @click="filterOpen = !filterOpen"
                                class="inline-flex items-center justify-center gap-2 rounded-2xl bg-gray-50 px-5 py-3 text-sm font-semibold text-gray-700 border border-gray-100 hover:bg-gray-100 transition
                                           dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-700">
                                <span>🔎</span>
                                <span>Search & Filter</span>

                                @if($isFilterActive)
                                    <span class="rounded-full bg-indigo-100 px-2 py-0.5 text-xs font-bold text-indigo-700
                                                         dark:bg-indigo-900/50 dark:text-indigo-300">
                                        Aktif
                                    </span>
                                @endif

                                <svg class="h-4 w-4 text-gray-500 transition dark:text-gray-400"
                                    :class="{ 'rotate-180': filterOpen }" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Filter Panel --}}
                    <div x-show="filterOpen" x-transition class="mt-5 rounded-3xl app-card-soft p-5"
                        style="display: none;">

                        <form action="{{ route('tasks.index') }}" method="GET" class="space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-4">

                                {{-- Search --}}
                                <div class="xl:col-span-2">
                                    <label class="block text-sm font-semibold app-title mb-2">
                                        Cari Tugas
                                    </label>

                                    <input type="text" name="search" value="{{ request('search') }}"
                                        placeholder="Cari judul atau deskripsi tugas..."
                                        class="w-full rounded-2xl px-4 py-3 text-sm app-input">
                                </div>

                                {{-- Mata Kuliah --}}
                                <div>
                                    <label class="block text-sm font-semibold app-title mb-2">
                                        Mata Kuliah
                                    </label>

                                    <select name="subject_id" class="w-full rounded-2xl px-4 py-3 text-sm app-select">
                                        <option value="">Semua</option>

                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}"
                                                @selected(request('subject_id') == $subject->id)>
                                                {{ $subject->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Status --}}
                                <div>
                                    <label class="block text-sm font-semibold app-title mb-2">
                                        Status
                                    </label>

                                    <select name="status" class="w-full rounded-2xl px-4 py-3 text-sm app-select">
                                        <option value="">Semua</option>
                                        <option value="belum_dikerjakan"
                                            @selected(request('status') == 'belum_dikerjakan')>
                                            Belum Dikerjakan
                                        </option>
                                        <option value="sedang_dikerjakan"
                                            @selected(request('status') == 'sedang_dikerjakan')>
                                            Sedang Dikerjakan
                                        </option>
                                        <option value="selesai" @selected(request('status') == 'selesai')>
                                            Selesai
                                        </option>
                                        <option value="terlambat" @selected(request('status') == 'terlambat')>
                                            Terlambat
                                        </option>
                                    </select>
                                </div>

                                {{-- Prioritas --}}
                                <div>
                                    <label class="block text-sm font-semibold app-title mb-2">
                                        Prioritas
                                    </label>

                                    <select name="priority_level"
                                        class="w-full rounded-2xl px-4 py-3 text-sm app-select">
                                        <option value="">Semua</option>
                                        <option value="sangat_tinggi"
                                            @selected(request('priority_level') == 'sangat_tinggi')>
                                            Sangat Tinggi
                                        </option>
                                        <option value="tinggi" @selected(request('priority_level') == 'tinggi')>
                                            Tinggi
                                        </option>
                                        <option value="sedang" @selected(request('priority_level') == 'sedang')>
                                            Sedang
                                        </option>
                                        <option value="rendah" @selected(request('priority_level') == 'rendah')>
                                            Rendah
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                                {{-- Sorting --}}
                                <div>
                                    <label class="block text-sm font-semibold app-title mb-2">
                                        Urutkan
                                    </label>

                                    <select name="sort" class="w-full rounded-2xl px-4 py-3 text-sm app-select">
                                        <option value="priority_desc" @selected(request('sort', 'priority_desc') == 'priority_desc')>
                                            Skor Prioritas Tertinggi
                                        </option>
                                        <option value="priority_asc" @selected(request('sort') == 'priority_asc')>
                                            Skor Prioritas Terendah
                                        </option>
                                        <option value="deadline_asc" @selected(request('sort') == 'deadline_asc')>
                                            Deadline Terdekat
                                        </option>
                                        <option value="deadline_desc" @selected(request('sort') == 'deadline_desc')>
                                            Deadline Terlama
                                        </option>
                                        <option value="latest" @selected(request('sort') == 'latest')>
                                            Data Terbaru
                                        </option>
                                        <option value="oldest" @selected(request('sort') == 'oldest')>
                                            Data Terlama
                                        </option>
                                    </select>
                                </div>

                                {{-- Buttons --}}
                                <div class="md:col-span-2 flex flex-col sm:flex-row gap-3 md:justify-end">
                                    <button type="submit"
                                        class="rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 transition">
                                        Terapkan Filter
                                    </button>

                                    <a href="{{ route('tasks.index') }}"
                                        class="rounded-2xl bg-white px-5 py-3 text-center text-sm font-semibold text-gray-700 border border-gray-200 hover:bg-gray-50 transition
                                              dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                                        Reset
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Task List --}}
                <div class="space-y-4">
                    @forelse($tasks as $task)
                        @php
                            $priorityClasses = [
                                'sangat_tinggi' => 'bg-red-100 text-red-700 border-red-200 dark:bg-red-900/30 dark:text-red-300 dark:border-red-800',
                                'tinggi' => 'bg-orange-100 text-orange-700 border-orange-200 dark:bg-orange-900/30 dark:text-orange-300 dark:border-orange-800',
                                'sedang' => 'bg-yellow-100 text-yellow-700 border-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-300 dark:border-yellow-800',
                                'rendah' => 'bg-green-100 text-green-700 border-green-200 dark:bg-green-900/30 dark:text-green-300 dark:border-green-800',
                            ];

                            $statusClasses = [
                                'belum_dikerjakan' => 'bg-gray-100 text-gray-700 border-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700',
                                'sedang_dikerjakan' => 'bg-blue-100 text-blue-700 border-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-800',
                                'selesai' => 'bg-green-100 text-green-700 border-green-200 dark:bg-green-900/30 dark:text-green-300 dark:border-green-800',
                                'terlambat' => 'bg-red-100 text-red-700 border-red-200 dark:bg-red-900/30 dark:text-red-300 dark:border-red-800',
                            ];

                            $priorityClass = $priorityClasses[$task->priority_level] ?? 'bg-gray-100 text-gray-700 border-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700';
                            $statusClass = $statusClasses[$task->status] ?? 'bg-gray-100 text-gray-700 border-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700';

                            $isNearDeadline = $task->deadline->isFuture() && now()->diffInHours($task->deadline, false) <= 24;
                            $isOverdue = $task->deadline->isPast() && $task->status !== 'selesai';
                        @endphp

                        <div class="rounded-3xl border border-gray-100 bg-gray-50 p-6 hover:bg-white hover:shadow-md transition
                                            dark:border-gray-800 dark:bg-gray-900 dark:hover:bg-gray-800">
                            <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-5">

                                {{-- Left Content --}}
                                <div class="flex-1">
                                    <div class="mb-3 flex flex-wrap items-center gap-2">
                                        <span
                                            class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold {{ $priorityClass }}">
                                            {{ ucwords(str_replace('_', ' ', $task->priority_level)) }}
                                        </span>

                                        <span
                                            class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold {{ $statusClass }}">
                                            {{ ucwords(str_replace('_', ' ', $task->status)) }}
                                        </span>

                                        @if($task->aiRecommendation)
                                            <span class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700
                                                                         dark:bg-purple-900/40 dark:text-purple-300">
                                                ✨ AI Ready
                                            </span>
                                        @else
                                            <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600
                                                                         dark:bg-gray-800 dark:text-gray-300">
                                                Belum Generate AI
                                            </span>
                                        @endif

                                        @if($isOverdue)
                                            <span
                                                class="inline-flex items-center rounded-full bg-red-600 px-3 py-1 text-xs font-semibold text-white">
                                                Terlewat Deadline
                                            </span>
                                        @elseif($isNearDeadline)
                                            <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700
                                                                         dark:bg-red-900/30 dark:text-red-300">
                                                Deadline Dekat
                                            </span>
                                        @endif
                                    </div>

                                    <h3 class="text-xl font-bold app-title">
                                        {{ $task->title }}
                                    </h3>

                                    <p class="mt-1 text-sm app-subtitle">
                                        {{ $task->subject->name ?? 'Mata kuliah tidak ditemukan' }}
                                    </p>

                                    @if($task->description)
                                        <p class="mt-3 text-sm app-text">
                                            {{ \Illuminate\Support\Str::limit($task->description, 140) }}
                                        </p>
                                    @endif

                                    <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-3">
                                        <div
                                            class="rounded-2xl bg-white p-4 border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                                            <p class="text-xs font-medium app-subtitle">Deadline</p>
                                            <p class="mt-1 text-sm font-semibold app-title">
                                                {{ $task->deadline->format('d M Y H:i') }}
                                            </p>
                                        </div>

                                        <div
                                            class="rounded-2xl bg-white p-4 border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                                            <p class="text-xs font-medium app-subtitle">Estimasi</p>
                                            <p class="mt-1 text-sm font-semibold app-title">
                                                {{ $task->estimated_duration }} jam
                                            </p>
                                        </div>

                                        <div
                                            class="rounded-2xl bg-white p-4 border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                                            <p class="text-xs font-medium app-subtitle">Skor Prioritas</p>
                                            <p class="mt-1 text-sm font-semibold app-title">
                                                {{ $task->priority_score }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Right Action --}}
                                <div class="flex flex-row lg:flex-col gap-2 lg:min-w-[150px]">

                                    {{-- Quick Status --}}
                                    <form action="{{ route('tasks.quick-status', $task) }}" method="POST">
                                        @csrf
                                        @method('PATCH')

                                        <select name="status" onchange="this.form.submit()"
                                            class="w-full rounded-xl px-3 py-2 text-sm font-semibold app-select">
                                            <option value="belum_dikerjakan" @selected($task->status == 'belum_dikerjakan')>
                                                Belum
                                            </option>
                                            <option value="sedang_dikerjakan" @selected($task->status == 'sedang_dikerjakan')>
                                                Proses
                                            </option>
                                            <option value="selesai" @selected($task->status == 'selesai')>
                                                Selesai
                                            </option>
                                            <option value="terlambat" @selected($task->status == 'terlambat')>
                                                Terlambat
                                            </option>
                                        </select>
                                    </form>

                                    <a href="{{ route('tasks.show', $task) }}"
                                        class="flex-1 rounded-xl bg-indigo-600 px-4 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-700 transition">
                                        Detail
                                    </a>

                                    <a href="{{ route('tasks.edit', $task) }}"
                                        class="flex-1 rounded-xl bg-yellow-100 px-4 py-2 text-center text-sm font-semibold text-yellow-700 hover:bg-yellow-200 transition
                                                      dark:bg-yellow-900/30 dark:text-yellow-300 dark:hover:bg-yellow-900/50">
                                        Edit
                                    </a>

                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="w-full rounded-xl bg-red-100 px-4 py-2 text-sm font-semibold text-red-700 hover:bg-red-200 transition
                                                               dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50"
                                            onclick="return confirm('Hapus tugas ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="rounded-3xl border border-dashed border-gray-300 bg-gray-50 p-12 text-center
                                            dark:border-gray-700 dark:bg-gray-800">
                            <div class="mb-4 text-5xl">
                                🔎
                            </div>

                            <h3 class="text-xl font-bold app-title">
                                Tugas tidak ditemukan.
                            </h3>

                            <p class="mt-2 text-sm app-subtitle">
                                Coba ubah kata kunci pencarian atau reset filter yang sedang aktif.
                            </p>

                            <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-center">
                                <a href="{{ route('tasks.index') }}"
                                    class="rounded-2xl bg-white px-5 py-3 text-sm font-semibold text-gray-700 border border-gray-200 hover:bg-gray-50 transition
                                                  dark:bg-gray-900 dark:text-gray-200 dark:border-gray-700 dark:hover:bg-gray-800">
                                    Reset Filter
                                </a>

                                <a href="{{ route('tasks.create') }}"
                                    class="rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                                    Tambah Tugas
                                </a>
                            </div>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if($tasks->hasPages())
                    <div class="mt-6 rounded-2xl app-card-soft p-4">
                        {{ $tasks->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>