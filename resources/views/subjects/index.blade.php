<x-app-layout>
    <div class="py-8 app-page min-h-screen">
        <div class="app-container">

            @if(session('success'))
                <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 px-5 py-4 text-green-700 shadow-sm
                            dark:border-green-900/50 dark:bg-green-900/20 dark:text-green-300">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Hero --}}
            <div class="mb-6 app-hero p-7">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <p class="app-hero-label">
                            Kategori Akademik
                        </p>

                        <h1 class="app-hero-title">
                            Rapikan tugas berdasarkan mata kuliah.
                        </h1>

                        <p class="app-hero-text">
                            Setiap tugas perlu terhubung dengan mata kuliah agar dashboard dan rekomendasi prioritas lebih terstruktur.
                        </p>
                    </div>

                    <a href="{{ route('subjects.create') }}" class="app-hero-button-secondary">
                        + Tambah Mata Kuliah
                    </a>
                </div>
            </div>

            {{-- List --}}
            <div class="rounded-3xl app-card p-6">
                <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div>
                        <h3 class="text-xl font-bold app-title">
                            Daftar Mata Kuliah
                        </h3>

                        <p class="text-sm app-subtitle">
                            Semua mata kuliah yang kamu gunakan untuk mengelompokkan tugas.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-indigo-50 px-4 py-2 text-sm font-semibold text-indigo-700
                                dark:bg-indigo-900/40 dark:text-indigo-300">
                        Total: {{ $subjects->count() }} Mata Kuliah
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                    @forelse($subjects as $subject)
                        <div class="rounded-3xl border border-gray-100 bg-gray-50 p-5 hover:bg-white hover:shadow-md transition
                                    dark:border-gray-800 dark:bg-gray-900 dark:hover:bg-gray-800">
                            <div class="mb-4 flex items-start justify-between gap-3">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-700
                                            dark:bg-indigo-900/40 dark:text-indigo-300">
                                    📘
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('subjects.edit', $subject) }}"
                                       class="rounded-xl bg-yellow-100 px-3 py-2 text-xs font-semibold text-yellow-700 hover:bg-yellow-200 transition
                                              dark:bg-yellow-900/30 dark:text-yellow-300 dark:hover:bg-yellow-900/50">
                                        Edit
                                    </a>

                                    <form action="{{ route('subjects.destroy', $subject) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="rounded-xl bg-red-100 px-3 py-2 text-xs font-semibold text-red-700 hover:bg-red-200 transition
                                                       dark:bg-red-900/30 dark:text-red-300 dark:hover:bg-red-900/50"
                                                onclick="return confirm('Hapus mata kuliah ini? Tugas yang terhubung bisa ikut terpengaruh.')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <h4 class="text-lg font-bold app-title">
                                {{ $subject->name }}
                            </h4>

                            <p class="mt-2 text-sm leading-6 app-text">
                                {{ $subject->description ?: 'Belum ada deskripsi untuk mata kuliah ini.' }}
                            </p>

                            <div class="mt-5 rounded-2xl bg-white p-4 border border-gray-100
                                        dark:bg-gray-800 dark:border-gray-700">
                                <p class="text-xs font-semibold uppercase tracking-wide app-subtitle">
                                    Fungsi
                                </p>

                                <p class="mt-1 text-sm app-text">
                                    Dipakai sebagai kategori saat menambahkan tugas baru.
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="md:col-span-2 xl:col-span-3 rounded-3xl border border-dashed border-gray-300 bg-gray-50 p-12 text-center
                                    dark:border-gray-700 dark:bg-gray-800">
                            <div class="mb-4 text-5xl">
                                📚
                            </div>

                            <h3 class="text-xl font-bold app-title">
                                Belum ada mata kuliah.
                            </h3>

                            <p class="mt-2 text-sm app-subtitle">
                                Tambahkan mata kuliah pertama supaya kamu bisa mulai mencatat tugas.
                            </p>

                            <a href="{{ route('subjects.create') }}"
                               class="mt-6 inline-flex rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                                Tambah Mata Kuliah
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>