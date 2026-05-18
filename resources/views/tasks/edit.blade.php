<x-app-layout>
    <div class="py-8 app-page min-h-screen">
        <div class="app-container-md">

            <div class="mb-6 app-hero p-7">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="app-hero-label">
                            Edit Data Tugas
                        </p>

                        <h1 class="app-hero-title">
                            {{ $task->title }}
                        </h1>

                        <p class="app-hero-text">
                            Ubah deadline, status, estimasi, atau bobot tugas. Sistem akan menghitung ulang prioritas secara otomatis.
                        </p>
                    </div>

                    <a href="{{ route('tasks.show', $task) }}" class="app-hero-button-primary">
                        Kembali
                    </a>
                </div>
            </div>

            <form action="{{ route('tasks.update', $task) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    {{-- Main Form --}}
                    <div class="lg:col-span-2 space-y-6">

                        {{-- Informasi Dasar --}}
                        <div class="rounded-3xl app-card p-6">
                            <div class="mb-5">
                                <h3 class="text-lg font-bold app-title">
                                    Informasi Tugas
                                </h3>

                                <p class="text-sm app-subtitle">
                                    Perbarui identitas utama tugas.
                                </p>
                            </div>

                            <div class="space-y-5">
                                <div>
                                    <label class="block text-sm font-semibold app-title mb-2">
                                        Mata Kuliah
                                    </label>

                                    <select name="subject_id"
                                            class="w-full rounded-2xl px-4 py-3 text-sm app-select"
                                            required>
                                        <option value="">Pilih mata kuliah</option>

                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}"
                                                @selected(old('subject_id', $task->subject_id) == $subject->id)>
                                                {{ $subject->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('subject_id')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold app-title mb-2">
                                        Nama Tugas
                                    </label>

                                    <input type="text"
                                           name="title"
                                           value="{{ old('title', $task->title) }}"
                                           class="w-full rounded-2xl px-4 py-3 text-sm app-input"
                                           required>

                                    @error('title')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold app-title mb-2">
                                        Deskripsi Tugas
                                    </label>

                                    <textarea name="description"
                                              rows="5"
                                              class="w-full rounded-2xl px-4 py-3 text-sm app-input">{{ old('description', $task->description) }}</textarea>

                                    @error('description')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Parameter Prioritas --}}
                        <div class="rounded-3xl app-card p-6">
                            <div class="mb-5">
                                <h3 class="text-lg font-bold app-title">
                                    Parameter Prioritas
                                </h3>

                                <p class="text-sm app-subtitle">
                                    Mengubah bagian ini akan mempengaruhi skor prioritas tugas.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold app-title mb-2">
                                        Deadline
                                    </label>

                                    <input type="datetime-local"
                                           name="deadline"
                                           value="{{ old('deadline', $task->deadline ? $task->deadline->format('Y-m-d\TH:i') : '') }}"
                                           class="w-full rounded-2xl px-4 py-3 text-sm app-input"
                                           required>

                                    @error('deadline')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold app-title mb-2">
                                        Estimasi Waktu
                                    </label>

                                    <div class="relative">
                                        <input type="number"
                                               name="estimated_duration"
                                               value="{{ old('estimated_duration', $task->estimated_duration) }}"
                                               min="1"
                                               class="w-full rounded-2xl px-4 py-3 pr-14 text-sm app-input"
                                               required>

                                        <span class="absolute right-4 top-3 text-sm app-subtitle">
                                            jam
                                        </span>
                                    </div>

                                    @error('estimated_duration')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold app-title mb-2">
                                        Tingkat Kesulitan
                                    </label>

                                    <select name="difficulty"
                                            class="w-full rounded-2xl px-4 py-3 text-sm app-select"
                                            required>
                                        <option value="rendah" @selected(old('difficulty', $task->difficulty) == 'rendah')>
                                            Rendah
                                        </option>
                                        <option value="sedang" @selected(old('difficulty', $task->difficulty) == 'sedang')>
                                            Sedang
                                        </option>
                                        <option value="tinggi" @selected(old('difficulty', $task->difficulty) == 'tinggi')>
                                            Tinggi
                                        </option>
                                    </select>

                                    @error('difficulty')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold app-title mb-2">
                                        Bobot Nilai
                                    </label>

                                    <select name="task_weight"
                                            class="w-full rounded-2xl px-4 py-3 text-sm app-select"
                                            required>
                                        <option value="kecil" @selected(old('task_weight', $task->task_weight) == 'kecil')>
                                            Kecil
                                        </option>
                                        <option value="sedang" @selected(old('task_weight', $task->task_weight) == 'sedang')>
                                            Sedang
                                        </option>
                                        <option value="besar" @selected(old('task_weight', $task->task_weight) == 'besar')>
                                            Besar
                                        </option>
                                    </select>

                                    @error('task_weight')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold app-title mb-2">
                                        Status Tugas
                                    </label>

                                    <select name="status"
                                            class="w-full rounded-2xl px-4 py-3 text-sm app-select"
                                            required>
                                        <option value="belum_dikerjakan" @selected(old('status', $task->status) == 'belum_dikerjakan')>
                                            Belum Dikerjakan
                                        </option>
                                        <option value="sedang_dikerjakan" @selected(old('status', $task->status) == 'sedang_dikerjakan')>
                                            Sedang Dikerjakan
                                        </option>
                                        <option value="selesai" @selected(old('status', $task->status) == 'selesai')>
                                            Selesai
                                        </option>
                                        <option value="terlambat" @selected(old('status', $task->status) == 'terlambat')>
                                            Terlambat
                                        </option>
                                    </select>

                                    @error('status')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Sidebar --}}
                    <div class="space-y-6">

                        <div class="rounded-3xl app-card p-6">
                            <h3 class="text-lg font-bold app-title">
                                Skor Saat Ini
                            </h3>

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
                                Setelah disimpan, skor akan dihitung ulang berdasarkan data terbaru.
                            </p>
                        </div>

                        <div class="rounded-3xl bg-yellow-50 p-6 border border-yellow-100
                                    dark:bg-yellow-900/20 dark:border-yellow-900/50">
                            <h3 class="text-lg font-bold text-yellow-800 dark:text-yellow-300">
                                Catatan
                            </h3>

                            <p class="mt-2 text-sm text-yellow-700 dark:text-yellow-300/80">
                                Kalau kamu mengubah deadline atau bobot nilai, rekomendasi AI sebelumnya mungkin perlu digenerate ulang supaya tetap relevan.
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Action --}}
                <div class="flex flex-col sm:flex-row gap-3 justify-end">
                    <a href="{{ route('tasks.show', $task) }}"
                       class="rounded-2xl px-5 py-3 text-center text-sm font-semibold app-button-secondary transition">
                        Batal
                    </a>

                    <button type="submit"
                            class="rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 transition">
                        Update Tugas
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>