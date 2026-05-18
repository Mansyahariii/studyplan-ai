<x-app-layout>
    <div class="py-8 app-page min-h-screen">
        <div class="app-container-sm">

            <div class="mb-6 app-hero p-7">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="app-hero-label">
                            Edit Kategori
                        </p>

                        <h1 class="app-hero-title">
                            {{ $subject->name }}
                        </h1>

                        <p class="app-hero-text">
                            Perubahan nama mata kuliah akan mempengaruhi tampilan kategori pada daftar tugas.
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
                    <form action="{{ route('subjects.update', $subject) }}" method="POST" class="rounded-3xl app-card p-6">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <h3 class="text-lg font-bold app-title">
                                Informasi Mata Kuliah
                            </h3>

                            <p class="text-sm app-subtitle">
                                Pastikan nama mata kuliah tetap mudah dikenali.
                            </p>
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold app-title mb-2">
                                    Nama Mata Kuliah
                                </label>

                                <input type="text"
                                       name="name"
                                       value="{{ old('name', $subject->name) }}"
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
                                          class="w-full rounded-2xl px-4 py-3 text-sm app-input">{{ old('description', $subject->description) }}</textarea>

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
                                Update Mata Kuliah
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Sidebar --}}
                <div class="space-y-6">
                    <div class="rounded-3xl app-card p-6">
                        <h3 class="text-lg font-bold app-title">
                            Info
                        </h3>

                        <div class="mt-5 space-y-4">
                            <div class="rounded-2xl app-card-soft p-4">
                                <p class="text-xs font-semibold uppercase tracking-wide app-subtitle">
                                    Dibuat pada
                                </p>

                                <p class="mt-1 text-sm font-semibold app-title">
                                    {{ $subject->created_at->format('d M Y H:i') }}
                                </p>
                            </div>

                            <div class="rounded-2xl app-card-soft p-4">
                                <p class="text-xs font-semibold uppercase tracking-wide app-subtitle">
                                    Terakhir diperbarui
                                </p>

                                <p class="mt-1 text-sm font-semibold app-title">
                                    {{ $subject->updated_at->format('d M Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-yellow-50 p-6 border border-yellow-100
                                dark:bg-yellow-900/20 dark:border-yellow-900/50">
                        <h3 class="text-lg font-bold text-yellow-800 dark:text-yellow-300">
                            Catatan
                        </h3>

                        <p class="mt-2 text-sm text-yellow-700 dark:text-yellow-300/80">
                            Jangan hapus mata kuliah kalau masih punya tugas aktif, karena data tugas bisa ikut terdampak.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>