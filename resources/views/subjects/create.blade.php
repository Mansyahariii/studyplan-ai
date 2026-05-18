<x-app-layout>
    <div class="py-8 app-page min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-6 app-hero p-7">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="app-hero-label">
                            Mata Kuliah Baru
                        </p>

                        <h1 class="app-hero-title">
                            Bikin struktur tugas lebih rapi.
                        </h1>

                        <p class="app-hero-text">
                            Mata kuliah digunakan sebagai kategori agar setiap tugas punya konteks akademik yang jelas.
                        </p>
                    </div>

                    <a href="{{ route('subjects.index') }}" class="app-hero-button-primary">
                        Kembali
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Form --}}
                <div class="lg:col-span-2">
                    <form action="{{ route('subjects.store') }}" method="POST" class="rounded-3xl app-card p-6">
                        @csrf

                        <div class="mb-6">
                            <h3 class="text-lg font-bold app-title">
                                Informasi Mata Kuliah
                            </h3>

                            <p class="text-sm app-subtitle">
                                Isi nama dan deskripsi singkat mata kuliah.
                            </p>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold app-title mb-2">
                                    Nama Mata Kuliah
                                </label>

                                <input type="text"
                                       name="name"
                                       value="{{ old('name') }}"
                                       placeholder="Contoh: Testing dan Implementasi Sistem Informasi"
                                       class="w-full rounded-2xl px-4 py-3 text-sm app-input"
                                       required>

                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold app-title mb-2">
                                    Deskripsi
                                </label>

                                <textarea name="description"
                                          rows="5"
                                          placeholder="Contoh: Mata kuliah yang membahas pengujian perangkat lunak dan implementasi sistem."
                                          class="w-full rounded-2xl px-4 py-3 text-sm app-input">{{ old('description') }}</textarea>

                                @error('description')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-end">
                            <a href="{{ route('subjects.index') }}"
                               class="rounded-2xl px-5 py-3 text-center text-sm font-semibold app-button-secondary transition">
                                Batal
                            </a>

                            <button type="submit"
                                    class="rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 transition">
                                Simpan Mata Kuliah
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">
                    <div class="rounded-3xl bg-indigo-600 p-6 text-white shadow-sm
                                dark:bg-indigo-900/50 dark:border dark:border-indigo-800">
                        <h3 class="text-lg font-bold">
                            Tips
                        </h3>

                        <p class="mt-2 text-sm text-indigo-100 dark:text-indigo-200">
                            Buat nama mata kuliah yang jelas dan konsisten supaya daftar tugas gampang dibaca.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>