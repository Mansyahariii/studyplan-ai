<x-app-layout>
    <div class="py-8 app-page min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6 app-hero p-7">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="app-hero-label">
                            Input Tugas Baru
                        </p>

                        <h1 class="app-hero-title">
                            Biar nggak bingung mulai dari mana.
                        </h1>

                        <p class="app-hero-text">
                            Isi deadline, tingkat kesulitan, estimasi waktu, dan bobot nilai. Sistem akan menghitung skor prioritas tugas secara otomatis.
                        </p>
                    </div>

                    <a href="{{ route('tasks.index') }}" class="app-hero-button-primary">
                        Kembali
                    </a>
                </div>
            </div>

            <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6">
                @csrf

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
                                    Isi identitas utama tugas yang akan kamu kerjakan.
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
                                            <option value="{{ $subject->id }}" @selected(old('subject_id') == $subject->id)>
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
                                           value="{{ old('title') }}"
                                           placeholder="Contoh: Laporan Black Box Testing"
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
                                              placeholder="Contoh: Membuat laporan pengujian black box testing lengkap dengan tabel test case dan hasil evaluasi."
                                              class="w-full rounded-2xl px-4 py-3 text-sm app-input">{{ old('description') }}</textarea>

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
                                    Data ini dipakai sistem untuk menghitung skor prioritas tugas.
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold app-title mb-2">
                                        Deadline
                                    </label>

                                    <input type="datetime-local"
                                           name="deadline"
                                           value="{{ old('deadline') }}"
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
                                               value="{{ old('estimated_duration') }}"
                                               min="1"
                                               placeholder="Contoh: 3"
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
                                        <option value="">Pilih kesulitan</option>
                                        <option value="rendah" @selected(old('difficulty') == 'rendah')>Rendah</option>
                                        <option value="sedang" @selected(old('difficulty') == 'sedang')>Sedang</option>
                                        <option value="tinggi" @selected(old('difficulty') == 'tinggi')>Tinggi</option>
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
                                        <option value="">Pilih bobot</option>
                                        <option value="kecil" @selected(old('task_weight') == 'kecil')>Kecil</option>
                                        <option value="sedang" @selected(old('task_weight') == 'sedang')>Sedang</option>
                                        <option value="besar" @selected(old('task_weight') == 'besar')>Besar</option>
                                    </select>

                                    @error('task_weight')
                                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <input type="hidden" name="status" value="belum_dikerjakan">
                        </div>

                    </div>

                    {{-- Sidebar Info --}}
                    <div class="space-y-6">

                        <div class="rounded-3xl app-card p-6">
                            <h3 class="text-lg font-bold app-title">
                                Cara Sistem Menilai
                            </h3>

                            <div class="mt-5 space-y-4">
                                <div class="rounded-2xl bg-red-50 p-4 border border-red-100
                                            dark:bg-red-900/20 dark:border-red-900/50">
                                    <p class="text-sm font-semibold text-red-700 dark:text-red-300">
                                        Deadline
                                    </p>
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-300/80">
                                        Semakin dekat deadline, semakin tinggi skor prioritas.
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-orange-50 p-4 border border-orange-100
                                            dark:bg-orange-900/20 dark:border-orange-900/50">
                                    <p class="text-sm font-semibold text-orange-700 dark:text-orange-300">
                                        Kesulitan
                                    </p>
                                    <p class="mt-1 text-xs text-orange-600 dark:text-orange-300/80">
                                        Tugas sulit akan dianggap lebih butuh perhatian.
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-blue-50 p-4 border border-blue-100
                                            dark:bg-blue-900/20 dark:border-blue-900/50">
                                    <p class="text-sm font-semibold text-blue-700 dark:text-blue-300">
                                        Estimasi
                                    </p>
                                    <p class="mt-1 text-xs text-blue-600 dark:text-blue-300/80">
                                        Tugas yang butuh waktu lama akan diprioritaskan lebih awal.
                                    </p>
                                </div>

                                <div class="rounded-2xl bg-purple-50 p-4 border border-purple-100
                                            dark:bg-purple-900/20 dark:border-purple-900/50">
                                    <p class="text-sm font-semibold text-purple-700 dark:text-purple-300">
                                        Bobot Nilai
                                    </p>
                                    <p class="mt-1 text-xs text-purple-600 dark:text-purple-300/80">
                                        Tugas dengan bobot besar punya dampak akademik lebih tinggi.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="rounded-3xl bg-indigo-600 p-6 text-white shadow-sm
                                    dark:bg-indigo-900/50 dark:border dark:border-indigo-800">
                            <h3 class="text-lg font-bold">
                                Tips Input
                            </h3>
                            <p class="mt-2 text-sm text-indigo-100 dark:text-indigo-200">
                                Jangan ngisi estimasi terlalu kecil cuma biar kelihatan ringan. Isi realistis supaya rekomendasi AI lebih akurat.
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Action --}}
                <div class="flex flex-col sm:flex-row gap-3 justify-end">
                    <a href="{{ route('tasks.index') }}"
                       class="rounded-2xl px-5 py-3 text-center text-sm font-semibold app-button-secondary transition">
                        Batal
                    </a>

                    <button type="submit"
                            class="rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 transition">
                        Simpan Tugas
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>