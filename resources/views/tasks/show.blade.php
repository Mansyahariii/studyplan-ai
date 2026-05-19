<x-app-layout>
    @php
        $priorityClasses = [
            'sangat_tinggi' =>
                'bg-red-100 text-red-700 border-red-200 dark:bg-red-900/30 dark:text-red-300 dark:border-red-800',
            'tinggi' =>
                'bg-orange-100 text-orange-700 border-orange-200 dark:bg-orange-900/30 dark:text-orange-300 dark:border-orange-800',
            'sedang' =>
                'bg-yellow-100 text-yellow-700 border-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-300 dark:border-yellow-800',
            'rendah' =>
                'bg-green-100 text-green-700 border-green-200 dark:bg-green-900/30 dark:text-green-300 dark:border-green-800',
        ];

        $statusClasses = [
            'belum_dikerjakan' =>
                'bg-gray-100 text-gray-700 border-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700',
            'sedang_dikerjakan' =>
                'bg-blue-100 text-blue-700 border-blue-200 dark:bg-blue-900/30 dark:text-blue-300 dark:border-blue-800',
            'selesai' =>
                'bg-green-100 text-green-700 border-green-200 dark:bg-green-900/30 dark:text-green-300 dark:border-green-800',
            'terlambat' =>
                'bg-red-100 text-red-700 border-red-200 dark:bg-red-900/30 dark:text-red-300 dark:border-red-800',
        ];

        $riskClasses = [
            'sangat tinggi' =>
                'bg-red-100 text-red-700 border-red-200 dark:bg-red-900/30 dark:text-red-300 dark:border-red-800',
            'tinggi' =>
                'bg-orange-100 text-orange-700 border-orange-200 dark:bg-orange-900/30 dark:text-orange-300 dark:border-orange-800',
            'sedang' =>
                'bg-yellow-100 text-yellow-700 border-yellow-200 dark:bg-yellow-900/30 dark:text-yellow-300 dark:border-yellow-800',
            'rendah' =>
                'bg-green-100 text-green-700 border-green-200 dark:bg-green-900/30 dark:text-green-300 dark:border-green-800',
        ];

        $historyStatusClasses = [
            'belum_dikerjakan' => 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300',
            'sedang_dikerjakan' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
            'selesai' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
            'terlambat' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
        ];

        $priorityClass =
            $priorityClasses[$task->priority_level] ??
            'bg-gray-100 text-gray-700 border-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700';
        $statusClass =
            $statusClasses[$task->status] ??
            'bg-gray-100 text-gray-700 border-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700';

        $isNearDeadline = $task->deadline->isFuture() && now()->diffInHours($task->deadline, false) <= 24;
        $isOverdue = $task->deadline->isPast() && $task->status !== 'selesai';

        $recommendation = $task->aiRecommendation;
        $riskClass = $recommendation
            ? $riskClasses[strtolower($recommendation->risk_level)] ??
                'bg-gray-100 text-gray-700 border-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700'
            : 'bg-gray-100 text-gray-700 border-gray-200 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-700';
    @endphp

    <div class="py-8 app-page min-h-screen">
        <div class="app-container">

            @if (session('success'))
                <div
                    class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-700 shadow-sm
                                        dark:border-green-900/50 dark:bg-green-900/20 dark:text-green-300">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div
                    class="mb-6 rounded-2xl border border-red-200 bg-red-50 px-5 py-4 text-red-700 shadow-sm
                                        dark:border-red-900/50 dark:bg-red-900/20 dark:text-red-300">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Main Detail --}}
                <div class="lg:col-span-2 space-y-6">

                    {{-- Task Overview --}}
                    <div class="rounded-3xl app-card p-6">
                        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-5">
                            <div class="flex-1">
                                <div class="mb-4 flex flex-wrap items-center gap-2">
                                    <span
                                        class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold {{ $priorityClass }}">
                                        {{ ucwords(str_replace('_', ' ', $task->priority_level)) }}
                                    </span>

                                    <span
                                        class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold {{ $statusClass }}">
                                        {{ ucwords(str_replace('_', ' ', $task->status)) }}
                                    </span>

                                    @if ($recommendation)
                                        <span
                                            class="inline-flex items-center rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700
                                                                 dark:bg-purple-900/40 dark:text-purple-300">
                                            ✨ AI Ready
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-600
                                                                 dark:bg-gray-800 dark:text-gray-300">
                                            Belum Generate AI
                                        </span>
                                    @endif

                                    @if ($isOverdue)
                                        <span
                                            class="inline-flex items-center rounded-full bg-red-600 px-3 py-1 text-xs font-semibold text-white">
                                            Terlewat Deadline
                                        </span>
                                    @elseif($isNearDeadline)
                                        <span
                                            class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700
                                                                 dark:bg-red-900/30 dark:text-red-300">
                                            Deadline Dekat
                                        </span>
                                    @endif
                                </div>

                                <h1 class="text-3xl font-bold app-title">
                                    {{ $task->title }}
                                </h1>

                                <p class="mt-2 text-sm app-subtitle">
                                    {{ $task->subject->name ?? 'Mata kuliah tidak ditemukan' }}
                                </p>

                                @if ($task->description)
                                    <div class="mt-5 rounded-2xl app-card-soft p-5">
                                        <p class="text-xs font-semibold uppercase tracking-wide app-subtitle">
                                            Deskripsi Tugas
                                        </p>

                                        <p class="mt-2 text-sm leading-6 app-text">
                                            {{ $task->description }}
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <div class="flex flex-row md:flex-col gap-2 md:min-w-[150px]">
                                <a href="{{ route('tasks.edit', $task) }}"
                                    class="flex-1 rounded-xl bg-yellow-100 px-4 py-2 text-center text-sm font-semibold text-yellow-700 hover:bg-yellow-200 transition
                                          dark:bg-yellow-900/30 dark:text-yellow-300 dark:hover:bg-yellow-900/50">
                                    Edit
                                </a>

                                <a href="{{ route('tasks.index') }}"
                                    class="flex-1 rounded-xl px-4 py-2 text-center text-sm font-semibold app-button-secondary transition">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- AI Recommendation --}}
                    <div class="rounded-3xl app-card p-6">
                        <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-bold app-title">
                                    Rekomendasi AI
                                </h3>

                                <p class="text-sm app-subtitle">
                                    Limit AI: 5 request/menit. Generate ulang tersedia setelah 3 menit.
                                </p>
                            </div>

                            <form action="{{ route('tasks.generate-ai', $task) }}" method="POST"
                                x-data="{ loading: false }" @submit="loading = true">
                                @csrf

                                <button type="submit" :disabled="loading"
                                    class="rounded-2xl bg-purple-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-purple-700 transition disabled:opacity-60 disabled:cursor-not-allowed">
                                    <span x-show="!loading">
                                        {{ $recommendation ? 'Generate Ulang AI' : 'Generate Rekomendasi AI' }}
                                    </span>

                                    <span x-show="loading">
                                        Memproses AI...
                                    </span>
                                </button>
                            </form>
                        </div>

                        @if ($recommendation)
                            {{-- Risk and Reason --}}
                            <div class="mb-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="rounded-2xl app-card-soft p-5">
                                    <p class="text-xs font-semibold uppercase tracking-wide app-subtitle">
                                        Tingkat Risiko
                                    </p>

                                    <div class="mt-3">
                                        <span
                                            class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold {{ $riskClass }}">
                                            {{ ucfirst($recommendation->risk_level) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="rounded-2xl app-card-soft p-5">
                                    <p class="text-xs font-semibold uppercase tracking-wide app-subtitle">
                                        Skor Prioritas Sistem
                                    </p>

                                    <p class="mt-2 text-3xl font-bold text-indigo-600 dark:text-indigo-400">
                                        {{ $task->priority_score }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="mb-5 rounded-2xl border border-purple-100 bg-purple-50 p-5
                                                            dark:border-purple-900/50 dark:bg-purple-900/20">
                                <p class="text-sm font-bold text-purple-800 dark:text-purple-300">
                                    Kenapa tugas ini perlu diprioritaskan?
                                </p>

                                <p class="mt-2 text-sm leading-6 text-purple-700 dark:text-purple-200/90">
                                    {{ $recommendation->priority_reason }}
                                </p>
                            </div>

                            {{-- Steps --}}
                            <div
                                class="mb-5 rounded-2xl bg-white p-5 border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
                                <div class="mb-4 flex items-center gap-2">
                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-700 sm:h-11 sm:w-11
                                                            dark:bg-indigo-900/40 dark:text-indigo-300">
                                        🧩
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <h4 class="font-bold app-title">
                                            Langkah Pengerjaan
                                        </h4>

                                        <p class="text-xs app-subtitle">
                                            Pecah tugas besar jadi langkah kecil biar nggak overwhelming.
                                        </p>
                                    </div>
                                </div>

                                <ol class="space-y-3">
                                    @foreach ($recommendation->suggested_steps ?? [] as $index => $step)
                                        <li class="flex gap-3 rounded-2xl app-card-soft p-4">
                                            <span
                                                class="flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-indigo-600 text-xs font-bold text-white">
                                                {{ $index + 1 }}
                                            </span>

                                            <span class="text-sm leading-6 app-text">
                                                {{ $step }}
                                            </span>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>

                            {{-- Schedule --}}
                            <div
                                class="mb-5 rounded-2xl bg-white p-5 border border-gray-100 dark:bg-gray-900 dark:border-gray-800">
                                <div class="mb-4 flex items-center gap-2">
                                    <div
                                        class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-700 sm:h-11 sm:w-11
                                                dark:bg-indigo-900/40 dark:text-indigo-300">
                                        📅
                                    </div>

                                    <div class="min-w-0 flex-1">
                                        <h4 class="font-bold app-title">
                                            Jadwal Rekomendasi
                                        </h4>

                                        <p class="text-xs app-subtitle">
                                            Saran pembagian waktu agar tugas lebih terarah.
                                        </p>
                                    </div>
                                </div>

                                <ul class="space-y-3">
                                    @foreach ($recommendation->suggested_schedule ?? [] as $schedule)
                                        <li
                                            class="rounded-2xl bg-blue-50 p-4 text-sm leading-6 text-blue-800 border border-blue-100
                                                                                   dark:bg-blue-900/20 dark:border-blue-900/50 dark:text-blue-200">
                                            {{ $schedule }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            {{-- Tips --}}
                            <div
                                class="rounded-2xl border border-green-100 bg-green-50 p-5
                                                            dark:border-green-900/50 dark:bg-green-900/20">
                                <div class="mb-2 flex items-center gap-2">
                                    <span class="text-lg">💡</span>

                                    <h4 class="font-bold text-green-800 dark:text-green-300">
                                        Tips Manajemen Waktu
                                    </h4>
                                </div>

                                <p class="text-sm leading-6 text-green-700 dark:text-green-200/90">
                                    {{ $recommendation->time_management_tips }}
                                </p>
                            </div>
                        @else
                            <div
                                class="rounded-3xl border border-dashed border-gray-300 bg-gray-50 p-10 text-center
                                                    dark:border-gray-700 dark:bg-gray-800">
                                <div class="mb-4 text-5xl">
                                    ✨
                                </div>

                                <h4 class="text-xl font-bold app-title">
                                    Belum ada rekomendasi AI.
                                </h4>

                                <p class="mt-2 text-sm app-subtitle max-w-xl mx-auto">
                                    Klik tombol generate untuk membuat rekomendasi pengerjaan, jadwal, risiko,
                                    dan tips manajemen waktu berdasarkan data tugas ini.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">

                    {{-- Priority Score --}}
                    <div class="rounded-3xl app-card p-6">
                        <p class="text-sm font-semibold app-subtitle">
                            Skor Prioritas
                        </p>

                        <div class="mt-4 flex items-end gap-2">
                            <span class="text-5xl font-bold text-indigo-600 dark:text-indigo-400">
                                {{ $task->priority_score }}
                            </span>

                            <span class="mb-2 text-sm app-subtitle">
                                / 100
                            </span>
                        </div>

                        <div class="mt-5 h-3 rounded-full bg-gray-100 dark:bg-gray-800">
                            <div class="h-3 rounded-full bg-indigo-600 dark:bg-indigo-500"
                                style="width: {{ min($task->priority_score, 100) }}%">
                            </div>
                        </div>

                        <p class="mt-4 text-sm app-subtitle">
                            Skor dihitung dari deadline, tingkat kesulitan, estimasi waktu, dan bobot nilai.
                        </p>
                    </div>

                    {{-- Task Meta --}}
                    <div class="space-y-4 rounded-3xl app-card p-6">
                        <h3 class="text-lg font-bold app-title mb-4">
                            Informasi Tugas
                        </h3>

                        <div
                            class="rounded-2xl bg-indigo-50 p-4 border border-indigo-100
                                    dark:bg-indigo-900/20 dark:border-indigo-900/50">
                            <p class="text-xs font-medium text-indigo-600 mb-2 dark:text-indigo-300">
                                Quick Update Status
                            </p>

                            <form action="{{ route('tasks.quick-status', $task) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <select name="status" onchange="this.form.submit()"
                                    class="w-full rounded-xl px-3 py-2 text-sm font-semibold app-select">
                                    <option value="belum_dikerjakan" @selected($task->status == 'belum_dikerjakan')>
                                        Belum Dikerjakan
                                    </option>
                                    <option value="sedang_dikerjakan" @selected($task->status == 'sedang_dikerjakan')>
                                        Sedang Dikerjakan
                                    </option>
                                    <option value="selesai" @selected($task->status == 'selesai')>
                                        Selesai
                                    </option>
                                    <option value="terlambat" @selected($task->status == 'terlambat')>
                                        Terlambat
                                    </option>
                                </select>
                            </form>
                        </div>

                        <div class="rounded-2xl app-card-soft p-4">
                            <p class="text-xs font-medium app-subtitle">Deadline</p>
                            <p class="mt-1 text-sm font-semibold app-title">
                                {{ $task->deadline->format('d M Y H:i') }}
                            </p>
                        </div>

                        <div class="rounded-2xl app-card-soft p-4">
                            <p class="text-xs font-medium app-subtitle">Tingkat Kesulitan</p>
                            <p class="mt-1 text-sm font-semibold app-title">
                                {{ ucfirst($task->difficulty) }}
                            </p>
                        </div>

                        <div class="rounded-2xl app-card-soft p-4">
                            <p class="text-xs font-medium app-subtitle">Estimasi Waktu</p>
                            <p class="mt-1 text-sm font-semibold app-title">
                                {{ $task->estimated_duration }} jam
                            </p>
                        </div>

                        <div class="rounded-2xl app-card-soft p-4">
                            <p class="text-xs font-medium app-subtitle">Bobot Nilai</p>
                            <p class="mt-1 text-sm font-semibold app-title">
                                {{ ucfirst($task->task_weight) }}
                            </p>
                        </div>
                    </div>

                    {{-- Activity History --}}
                    <div class="rounded-3xl app-card p-6">
                        <div class="mb-5">
                            <h3 class="text-lg font-bold app-title">
                                Riwayat Aktivitas
                            </h3>

                            <p class="text-sm app-subtitle">
                                Catatan perubahan status tugas.
                            </p>
                        </div>

                        @if ($task->histories->count() > 0)
                            <p class="mb-4 text-xs app-subtitle">
                                Menampilkan 4 aktivitas terbaru.
                            </p>

                            <div class="space-y-4">
                                @foreach ($task->histories->sortByDesc('created_at')->take(4) as $history)
                                    @php
                                        $oldStatus = $history->old_status
                                            ? ucwords(str_replace('_', ' ', $history->old_status))
                                            : 'Status Awal';

                                        $newStatus = ucwords(str_replace('_', ' ', $history->new_status));

                                        $newStatusClass =
                                            $historyStatusClasses[$history->new_status] ??
                                            'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300';
                                    @endphp

                                    <div class="relative rounded-2xl app-card-soft p-4">
                                        <div class="flex items-start gap-3">
                                            <div
                                                class="mt-1 flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-indigo-100 text-indigo-700
                                                                                dark:bg-indigo-900/40 dark:text-indigo-300">
                                                🔄
                                            </div>

                                            <div class="flex-1">
                                                <div class="flex flex-wrap items-center gap-2">
                                                    <span class="text-sm font-semibold app-title">
                                                        {{ $oldStatus }}
                                                    </span>

                                                    <span class="text-sm app-subtitle">
                                                        →
                                                    </span>

                                                    <span
                                                        class="rounded-full px-3 py-1 text-xs font-semibold {{ $newStatusClass }}">
                                                        {{ $newStatus }}
                                                    </span>
                                                </div>

                                                @if ($history->note)
                                                    <p class="mt-2 text-sm app-text">
                                                        {{ $history->note }}
                                                    </p>
                                                @endif

                                                <div
                                                    class="mt-3 flex flex-wrap items-center gap-2 text-xs app-subtitle">
                                                    <span>
                                                        {{ $history->created_at->format('d M Y H:i') }}
                                                    </span>

                                                    @if ($history->user)
                                                        <span>•</span>
                                                        <span>
                                                            oleh {{ $history->user->name }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div
                                class="rounded-2xl border border-dashed border-gray-300 bg-gray-50 p-6 text-center
                                                    dark:border-gray-700 dark:bg-gray-800">
                                <div class="mb-2 text-3xl">
                                    🕘
                                </div>

                                <h4 class="font-bold app-title">
                                    Belum ada aktivitas.
                                </h4>

                                <p class="mt-1 text-sm app-subtitle">
                                    Riwayat akan muncul setelah status tugas diperbarui.
                                </p>
                            </div>
                        @endif
                    </div>

                    {{-- Danger Zone --}}
                    <div
                        class="rounded-3xl p-6 shadow-sm border border-red-100 bg-white
                                dark:bg-gray-900 dark:border-red-900/50">
                        <h3 class="text-lg font-bold text-red-700 dark:text-red-300">
                            Aksi Tugas
                        </h3>

                        <p class="mt-2 text-sm app-subtitle">
                            Hapus tugas kalau data ini sudah tidak dibutuhkan.
                        </p>

                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="w-full rounded-2xl bg-red-100 px-5 py-3 text-sm font-semibold text-red-700 hover:bg-red-200 transition
                                           dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50"
                                onclick="return confirm('Yakin ingin menghapus tugas ini?')">
                                Hapus Tugas
                            </button>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
