<x-app-layout>
    @php
        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;
    @endphp

    <div class="py-8 app-page min-h-screen">
        <div class="app-container">

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

            {{-- Hero Section --}}
            <div class="mb-6 app-hero p-8">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div>
                        <p class="mb-2 app-hero-label">
                            Selamat datang kembali 👋
                        </p>

                        <h1 class="text-3xl font-bold text-white">
                            Mau ngerjain tugas yang mana dulu?
                        </h1>

                        <p class="mt-3 max-w-2xl text-sm text-indigo-100 dark:text-indigo-200">
                            StudyPlan AI bantu kamu melihat tugas paling urgent berdasarkan deadline, tingkat kesulitan,
                            estimasi pengerjaan, dan bobot nilai.
                        </p>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="{{ route('tasks.create') }}" class="app-hero-button-secondary">
                            + Tambah Tugas
                        </a>

                        <a href="{{ route('tasks.index') }}" class="app-hero-button-secondary">
                            Lihat Semua
                        </a>
                    </div>
                </div>
            </div>

            @if($totalTasks == 0)
                <div class="mb-6 rounded-3xl border border-dashed border-indigo-200 bg-indigo-50 p-8 text-center
                                        dark:border-indigo-900/60 dark:bg-indigo-900/20">
                    <div class="mb-3 text-5xl">
                        📝
                    </div>

                    <h3 class="text-xl font-bold app-title">
                        Belum ada tugas nih.
                    </h3>

                    <p class="mt-2 text-sm app-text">
                        Tambahkan tugas pertama kamu supaya StudyPlan AI bisa mulai menghitung prioritas.
                    </p>

                    <a href="{{ route('tasks.create') }}"
                        class="mt-5 inline-flex rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                        Tambah Tugas Pertama
                    </a>
                </div>
            @endif

            {{-- Statistic Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">
                <div class="rounded-3xl app-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium app-subtitle">Total Tugas</p>
                            <p class="mt-2 text-3xl font-bold app-title">{{ $totalTasks }}</p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-700
                                    dark:bg-indigo-900/40 dark:text-indigo-300">
                            📚
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl app-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium app-subtitle">Tugas Selesai</p>
                            <p class="mt-2 text-3xl font-bold text-green-600 dark:text-green-400">{{ $completedTasks }}
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-green-100 text-green-700
                                    dark:bg-green-900/40 dark:text-green-300">
                            ✅
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl app-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium app-subtitle">Belum Selesai</p>
                            <p class="mt-2 text-3xl font-bold text-orange-600 dark:text-orange-400">{{ $pendingTasks }}
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-orange-700
                                    dark:bg-orange-900/40 dark:text-orange-300">
                            ⏳
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl app-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium app-subtitle">Progress</p>
                            <p class="mt-2 text-3xl font-bold text-purple-600 dark:text-purple-400">{{ $progress }}%</p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-100 text-purple-700
                                    dark:bg-purple-900/40 dark:text-purple-300">
                            ⚡
                        </div>
                    </div>

                    <div class="mt-4 h-2 rounded-full bg-gray-100 dark:bg-gray-800">
                        <div class="h-2 rounded-full bg-purple-600 dark:bg-purple-500" style="width: {{ $progress }}%">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Insight Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">
                <div class="rounded-3xl app-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium app-subtitle">Deadline Hari Ini</p>
                            <p class="mt-2 text-3xl font-bold text-red-600 dark:text-red-400">{{ $todayTasks }}</p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-red-700
                                    dark:bg-red-900/40 dark:text-red-300">
                            🚨
                        </div>
                    </div>

                    <p class="mt-4 text-xs app-subtitle">
                        Tugas yang harus diperhatikan hari ini.
                    </p>
                </div>

                <div class="rounded-3xl app-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium app-subtitle">Deadline 7 Hari</p>
                            <p class="mt-2 text-3xl font-bold text-orange-600 dark:text-orange-400">{{ $weekTasks }}</p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-orange-100 text-orange-700
                                    dark:bg-orange-900/40 dark:text-orange-300">
                            📅
                        </div>
                    </div>

                    <p class="mt-4 text-xs app-subtitle">
                        Tugas yang deadline-nya dekat minggu ini.
                    </p>
                </div>

                <div class="rounded-3xl app-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium app-subtitle">Sangat Tinggi</p>
                            <p class="mt-2 text-3xl font-bold text-purple-600 dark:text-purple-400">
                                {{ $veryHighPriorityTasks }}
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-purple-100 text-purple-700
                                    dark:bg-purple-900/40 dark:text-purple-300">
                            🔥
                        </div>
                    </div>

                    <p class="mt-4 text-xs app-subtitle">
                        Tugas dengan level prioritas paling tinggi.
                    </p>
                </div>

                <div class="rounded-3xl app-card p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium app-subtitle">Terlambat</p>
                            <p class="mt-2 text-3xl font-bold text-red-700 dark:text-red-400">{{ $overdueTasks }}</p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-red-700
                                    dark:bg-red-900/40 dark:text-red-300">
                            ⛔
                        </div>
                    </div>

                    <p class="mt-4 text-xs app-subtitle">
                        Deadline sudah lewat dan belum selesai.
                    </p>
                </div>
            </div>

            @if($overdueTasks > 0)
                <div class="mb-6 rounded-3xl border border-red-200 bg-red-50 p-5 shadow-sm
                                        dark:border-red-900/50 dark:bg-red-900/20">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-red-700 dark:text-red-300">
                                Ada {{ $overdueTasks }} tugas yang sudah melewati deadline.
                            </h3>

                            <p class="mt-1 text-sm text-red-600 dark:text-red-300/80">
                                Cek daftar tugas dan segera ubah status atau prioritaskan penyelesaiannya.
                            </p>
                        </div>

                        <a href="{{ route('tasks.index', ['sort' => 'deadline_asc']) }}"
                            class="rounded-2xl bg-red-600 px-5 py-3 text-center text-sm font-semibold text-white hover:bg-red-700 transition">
                            Cek Tugas
                        </a>
                    </div>
                </div>
            @endif

            {{-- AI Daily Summary --}}
            <div class="mb-6 rounded-3xl app-card p-6">
                <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <div class="mb-2 inline-flex rounded-full bg-purple-100 px-3 py-1 text-xs font-bold text-purple-700
                                    dark:bg-purple-900/40 dark:text-purple-300">
                            ✨ AI Daily Summary
                        </div>

                        <h3 class="text-xl font-bold app-title">
                            Ringkasan Tugas Hari Ini
                        </h3>

                        <p class="text-sm app-subtitle">
                            AI membaca tugas aktif dan memberi saran fokus pengerjaan hari ini.
                        </p>
                    </div>

                    <form action="{{ route('dashboard.generate-daily-summary') }}" method="POST"
                        x-data="{ loading: false }" @submit="loading = true">
                        @csrf

                        <button type="submit" :disabled="loading"
                            class="rounded-2xl bg-purple-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-purple-700 transition disabled:opacity-60 disabled:cursor-not-allowed">
                            <span x-show="!loading">
                                {{ $dailySummary ? 'Generate Ulang' : 'Generate Summary' }}
                            </span>

                            <span x-show="loading">
                                Membuat Ringkasan...
                            </span>
                        </button>
                    </form>
                </div>

                @if($dailySummary)
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                        {{-- Overview --}}
                        <div class="lg:col-span-3 rounded-2xl border border-purple-100 bg-purple-50 p-5
                                                dark:border-purple-900/50 dark:bg-purple-900/20">
                            <p class="text-sm font-bold text-purple-800 dark:text-purple-300">
                                Overview
                            </p>

                            <p class="mt-2 text-sm leading-6 text-purple-700 dark:text-purple-200/90">
                                {{ $dailySummary->overview }}
                            </p>
                        </div>

                        {{-- Focus Tasks --}}
                        <div class="rounded-2xl app-card-soft p-5">
                            <div class="mb-4 flex items-center gap-2">
                                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-red-100 text-red-700
                                                        dark:bg-red-900/40 dark:text-red-300">
                                    🔥
                                </div>

                                <div>
                                    <h4 class="font-bold app-title">
                                        Fokus Utama
                                    </h4>
                                    <p class="text-xs app-subtitle">
                                        Tugas yang sebaiknya diprioritaskan.
                                    </p>
                                </div>
                            </div>

                            <ol class="space-y-3">
                                @foreach($dailySummary->focus_tasks ?? [] as $index => $focus)
                                    <li class="flex gap-3 rounded-2xl bg-white p-4 border border-gray-100
                                                                       dark:bg-gray-900 dark:border-gray-700">
                                        <span
                                            class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-red-600 text-xs font-bold text-white">
                                            {{ $index + 1 }}
                                        </span>

                                        <span class="text-sm leading-6 app-text">
                                            {{ $focus }}
                                        </span>
                                    </li>
                                @endforeach
                            </ol>
                        </div>

                        {{-- Suggested Plan --}}
                        <div class="rounded-2xl app-card-soft p-5">
                            <div class="mb-4 flex items-center gap-2">
                                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-100 text-indigo-700
                                                        dark:bg-indigo-900/40 dark:text-indigo-300">
                                    📅
                                </div>

                                <div>
                                    <h4 class="font-bold app-title">
                                        Rencana Hari Ini
                                    </h4>
                                    <p class="text-xs app-subtitle">
                                        Saran alur pengerjaan.
                                    </p>
                                </div>
                            </div>

                            <ul class="space-y-3">
                                @foreach($dailySummary->suggested_plan ?? [] as $plan)
                                    <li class="rounded-2xl bg-white p-4 text-sm leading-6 app-text border border-gray-100
                                                                       dark:bg-gray-900 dark:border-gray-700">
                                        {{ $plan }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Tips --}}
                        <div class="rounded-2xl border border-green-100 bg-green-50 p-5
                                                dark:border-green-900/50 dark:bg-green-900/20">
                            <div class="mb-4 flex items-center gap-2">
                                <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-green-100 text-green-700
                                                        dark:bg-green-900/40 dark:text-green-300">
                                    💡
                                </div>

                                <div>
                                    <h4 class="font-bold text-green-800 dark:text-green-300">
                                        Tips Waktu
                                    </h4>
                                    <p class="text-xs text-green-600 dark:text-green-300/80">
                                        Biar pengerjaan lebih efektif.
                                    </p>
                                </div>
                            </div>

                            <p class="text-sm leading-6 text-green-700 dark:text-green-200/90">
                                {{ $dailySummary->time_management_tips }}
                            </p>
                        </div>
                    </div>

                    <p class="mt-5 text-xs app-subtitle">
                        Terakhir dibuat: {{ $dailySummary->updated_at->format('d M Y H:i') }}
                    </p>
                @else
                    <div class="rounded-3xl border border-dashed border-gray-300 bg-gray-50 p-10 text-center
                                            dark:border-gray-700 dark:bg-gray-800">
                        <div class="mb-4 text-5xl">
                            ✨
                        </div>

                        <h4 class="text-xl font-bold app-title">
                            Belum ada ringkasan harian.
                        </h4>

                        <p class="mt-2 text-sm app-subtitle max-w-xl mx-auto">
                            Klik tombol generate untuk membuat ringkasan prioritas tugas hari ini berdasarkan daftar tugas
                            aktif kamu.
                        </p>
                    </div>
                @endif
            </div>

            {{-- Main Content --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Priority Tasks --}}
                <div class="lg:col-span-2 rounded-3xl app-card p-6">
                    <div class="mb-5 flex items-center justify-between gap-4">
                        <div>
                            <h3 class="text-xl font-bold app-title">
                                Tugas Prioritas
                            </h3>
                            <p class="text-sm app-subtitle">
                                Tugas dengan skor tertinggi yang sebaiknya kamu kerjakan dulu.
                            </p>
                        </div>

                        <a href="{{ route('tasks.index') }}"
                            class="shrink-0 text-sm font-semibold text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300">
                            Lihat semua
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse($urgentTasks as $task)
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
                            @endphp

                            <div class="rounded-2xl border border-gray-100 bg-gray-50 p-5 hover:bg-white hover:shadow-md transition
                                                    dark:border-gray-800 dark:bg-gray-800 dark:hover:bg-gray-800/80">
                                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                                    <div>
                                        <div class="flex flex-wrap items-center gap-2 mb-2">
                                            <span
                                                class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold {{ $priorityClass }}">
                                                {{ ucwords(str_replace('_', ' ', $task->priority_level)) }}
                                            </span>

                                            <span
                                                class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold {{ $statusClass }}">
                                                {{ ucwords(str_replace('_', ' ', $task->status)) }}
                                            </span>

                                            @if($task->aiRecommendation)
                                                <span
                                                    class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700
                                                                                     dark:bg-purple-900/40 dark:text-purple-300">
                                                    AI Ready
                                                </span>
                                            @else
                                                <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600
                                                                                     dark:bg-gray-700 dark:text-gray-300">
                                                    Belum Generate AI
                                                </span>
                                            @endif
                                        </div>

                                        <h4 class="text-lg font-bold app-title">
                                            {{ $task->title }}
                                        </h4>

                                        <p class="mt-1 text-sm app-subtitle">
                                            {{ $task->subject->name ?? 'Mata kuliah tidak ditemukan' }}
                                        </p>

                                        <div class="mt-3 flex flex-wrap gap-3 text-sm app-text">
                                            <span>📅 {{ $task->deadline->format('d M Y H:i') }}</span>
                                            <span>⏱️ {{ $task->estimated_duration }} jam</span>
                                            <span>🔥 Skor {{ $task->priority_score }}</span>
                                        </div>
                                    </div>

                                    <a href="{{ route('tasks.show', $task) }}"
                                        class="rounded-xl bg-indigo-600 px-4 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-700 transition">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 p-8 text-center
                                                    dark:border-gray-700 dark:bg-gray-800">
                                <div class="text-4xl mb-3">🎉</div>
                                <h4 class="font-bold app-title">Belum ada tugas prioritas.</h4>
                                <p class="mt-1 text-sm app-subtitle">
                                    Aman untuk sekarang. Tambahkan tugas baru kalau ada deadline masuk.
                                </p>
                                <a href="{{ route('tasks.create') }}"
                                    class="mt-4 inline-flex rounded-xl bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                                    Tambah Tugas
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Side Card --}}
                <div class="rounded-3xl app-card p-6">
                    <h3 class="text-xl font-bold app-title">
                        Tips Hari Ini
                    </h3>

                    <p class="mt-2 text-sm app-subtitle">
                        Jangan mulai dari tugas yang paling gampang. Mulai dari tugas dengan kombinasi deadline dekat,
                        kesulitan tinggi, dan bobot nilai besar.
                    </p>

                    <div class="mt-6 rounded-2xl border border-indigo-100 bg-indigo-50 p-5
                                dark:border-indigo-900/50 dark:bg-indigo-900/20">
                        <p class="text-sm font-semibold text-indigo-700 dark:text-indigo-300">
                            Cara pakai yang efektif:
                        </p>

                        <ol class="mt-3 list-decimal space-y-2 pl-5 text-sm text-indigo-700 dark:text-indigo-200/90">
                            <li>Input semua tugas kuliah.</li>
                            <li>Cek skor prioritas.</li>
                            <li>Buka tugas paling tinggi.</li>
                            <li>Generate rekomendasi AI.</li>
                            <li>Kerjakan sesuai langkah yang disarankan.</li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>