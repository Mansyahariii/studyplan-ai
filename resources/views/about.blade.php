<x-app-layout>
    <div class="py-8 app-page min-h-screen">
        <div class="app-container">

            {{-- Hero --}}
            <div class="mb-6 app-hero p-8">
                <div class="max-w-3xl">
                    <p
                        class="mb-3 inline-flex rounded-full bg-white/15 px-4 py-2 text-sm font-semibold text-indigo-100 dark:text-indigo-200">
                        StudyPlan AI
                    </p>

                    <h1 class="text-3xl font-black text-white">
                        Sistem Manajemen Tugas Mahasiswa Berbasis AI
                    </h1>

                    <p class="mt-4 text-sm leading-7 text-indigo-100 dark:text-indigo-200">
                        StudyPlan AI adalah aplikasi berbasis web yang membantu mahasiswa mencatat,
                        mengelola, memprioritaskan, dan merencanakan pengerjaan tugas kuliah
                        menggunakan kombinasi perhitungan skor prioritas dan rekomendasi AI.
                    </p>
                </div>
            </div>

            {{-- Overview --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                <div class="lg:col-span-2 rounded-3xl app-card p-6">
                    <div class="mb-5 flex items-start gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-700 sm:h-11 sm:w-11
                dark:bg-indigo-900/40 dark:text-indigo-300">
                            🎯
                        </div>

                        <div class="min-w-0 flex-1">
                            <h3 class="text-base font-bold app-title sm:text-xl">
                                Tujuan Sistem
                            </h3>

                            <p class="mt-1 text-sm app-subtitle">
                                Sistem ini dibuat untuk membantu mahasiswa mengatur tugas secara lebih terstruktur.
                            </p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div class="rounded-2xl app-card-soft p-5">
                            <h4 class="font-bold app-title">
                                Membantu menentukan prioritas tugas
                            </h4>
                            <p class="mt-2 text-sm leading-6 app-text">
                                Mahasiswa sering memiliki banyak tugas dengan deadline dan tingkat kesulitan yang
                                berbeda.
                                Sistem ini membantu menentukan tugas mana yang perlu dikerjakan lebih dulu.
                            </p>
                        </div>

                        <div class="rounded-2xl app-card-soft p-5">
                            <h4 class="font-bold app-title">
                                Mengurangi risiko keterlambatan deadline
                            </h4>
                            <p class="mt-2 text-sm leading-6 app-text">
                                Sistem menampilkan tugas yang mendekati deadline, tugas prioritas tinggi,
                                dan tugas yang sudah melewati batas waktu pengerjaan.
                            </p>
                        </div>

                        <div class="rounded-2xl app-card-soft p-5">
                            <h4 class="font-bold app-title">
                                Memberikan rekomendasi pengerjaan berbasis AI
                            </h4>
                            <p class="mt-2 text-sm leading-6 app-text">
                                AI digunakan untuk memberikan alasan prioritas, langkah pengerjaan,
                                jadwal rekomendasi, dan tips manajemen waktu.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-3xl app-card p-6">
                        <h3 class="text-lg font-bold app-title">
                            Teknologi
                        </h3>

                        <div class="mt-5 space-y-3">
                            <div class="rounded-2xl bg-indigo-50 p-4 border border-indigo-100
                                        dark:bg-indigo-900/20 dark:border-indigo-900/50">
                                <p class="text-sm font-semibold text-indigo-700 dark:text-indigo-300">Laravel</p>
                                <p class="mt-1 text-xs text-indigo-600 dark:text-indigo-300/80">Framework utama sistem
                                </p>
                            </div>

                            <div class="rounded-2xl bg-purple-50 p-4 border border-purple-100
                                        dark:bg-purple-900/20 dark:border-purple-900/50">
                                <p class="text-sm font-semibold text-purple-700 dark:text-purple-300">Gemini AI</p>
                                <p class="mt-1 text-xs text-purple-600 dark:text-purple-300/80">Model rekomendasi
                                    berbasis AI</p>
                            </div>

                            <div class="rounded-2xl bg-blue-50 p-4 border border-blue-100
                                        dark:bg-blue-900/20 dark:border-blue-900/50">
                                <p class="text-sm font-semibold text-blue-700 dark:text-blue-300">MySQL</p>
                                <p class="mt-1 text-xs text-blue-600 dark:text-blue-300/80">Penyimpanan data sistem</p>
                            </div>

                            <div class="rounded-2xl bg-green-50 p-4 border border-green-100
                                        dark:bg-green-900/20 dark:border-green-900/50">
                                <p class="text-sm font-semibold text-green-700 dark:text-green-300">Tailwind CSS</p>
                                <p class="mt-1 text-xs text-green-600 dark:text-green-300/80">Tampilan UI/UX aplikasi
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl bg-indigo-600 p-6 text-white shadow-sm
                                dark:bg-indigo-900/50 dark:border dark:border-indigo-800">
                        <h3 class="text-lg font-bold">
                            Konsep Utama
                        </h3>
                        <p class="mt-2 text-sm leading-6 text-indigo-100 dark:text-indigo-200">
                            Sistem memakai pendekatan hybrid: rule-based priority scoring untuk menghitung prioritas,
                            lalu AI untuk menghasilkan rekomendasi yang mudah dipahami mahasiswa.
                        </p>
                    </div>
                </div>
            </div>

            {{-- How It Works --}}
            <div class="mb-6 rounded-3xl app-card p-6">
                <div class="mb-6">
                    <h3 class="text-xl font-bold app-title">
                        Cara Kerja Sistem
                    </h3>
                    <p class="text-sm app-subtitle">
                        Sistem bekerja melalui kombinasi input data tugas, perhitungan skor, dan rekomendasi AI.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    <div class="rounded-3xl app-card-soft p-5">
                        <div
                            class="mb-4 flex h-10 w-10 items-center justify-center rounded-2xl bg-indigo-600 text-sm font-bold text-white">
                            1
                        </div>

                        <h4 class="font-bold app-title">
                            Input Data Tugas
                        </h4>

                        <p class="mt-2 text-sm leading-6 app-text">
                            User mengisi judul, mata kuliah, deadline, kesulitan, estimasi waktu, dan bobot nilai.
                        </p>
                    </div>

                    <div class="rounded-3xl app-card-soft p-5">
                        <div
                            class="mb-4 flex h-10 w-10 items-center justify-center rounded-2xl bg-purple-600 text-sm font-bold text-white">
                            2
                        </div>

                        <h4 class="font-bold app-title">
                            Hitung Skor
                        </h4>

                        <p class="mt-2 text-sm leading-6 app-text">
                            Sistem menghitung skor prioritas berdasarkan parameter tugas yang sudah dimasukkan.
                        </p>
                    </div>

                    <div class="rounded-3xl app-card-soft p-5">
                        <div
                            class="mb-4 flex h-10 w-10 items-center justify-center rounded-2xl bg-blue-600 text-sm font-bold text-white">
                            3
                        </div>

                        <h4 class="font-bold app-title">
                            Generate AI
                        </h4>

                        <p class="mt-2 text-sm leading-6 app-text">
                            AI memberi rekomendasi langkah pengerjaan, jadwal, risiko, dan tips waktu.
                        </p>
                    </div>

                    <div class="rounded-3xl app-card-soft p-5">
                        <div
                            class="mb-4 flex h-10 w-10 items-center justify-center rounded-2xl bg-green-600 text-sm font-bold text-white">
                            4
                        </div>

                        <h4 class="font-bold app-title">
                            Update Progress
                        </h4>

                        <p class="mt-2 text-sm leading-6 app-text">
                            User mengubah status tugas dan sistem menyimpan riwayat aktivitas.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Scoring --}}
            <div class="mb-6 rounded-3xl app-card p-6">
                <div class="mb-6">
                    <h3 class="text-xl font-bold app-title">
                        Parameter Priority Scoring
                    </h3>
                    <p class="text-sm app-subtitle">
                        Skor prioritas dihitung berdasarkan beberapa faktor utama.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                    <div class="rounded-2xl bg-red-50 p-5 border border-red-100
                                dark:bg-red-900/20 dark:border-red-900/50">
                        <p class="text-sm font-bold text-red-700 dark:text-red-300">
                            Deadline
                        </p>
                        <p class="mt-2 text-sm leading-6 text-red-600 dark:text-red-300/80">
                            Semakin dekat deadline, semakin tinggi skor prioritas tugas.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-orange-50 p-5 border border-orange-100
                                dark:bg-orange-900/20 dark:border-orange-900/50">
                        <p class="text-sm font-bold text-orange-700 dark:text-orange-300">
                            Tingkat Kesulitan
                        </p>
                        <p class="mt-2 text-sm leading-6 text-orange-600 dark:text-orange-300/80">
                            Tugas yang lebih sulit diberi skor lebih tinggi agar dikerjakan lebih awal.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-blue-50 p-5 border border-blue-100
                                dark:bg-blue-900/20 dark:border-blue-900/50">
                        <p class="text-sm font-bold text-blue-700 dark:text-blue-300">
                            Estimasi Waktu
                        </p>
                        <p class="mt-2 text-sm leading-6 text-blue-600 dark:text-blue-300/80">
                            Tugas yang membutuhkan waktu lama akan mendapat perhatian lebih besar.
                        </p>
                    </div>

                    <div class="rounded-2xl bg-purple-50 p-5 border border-purple-100
                                dark:bg-purple-900/20 dark:border-purple-900/50">
                        <p class="text-sm font-bold text-purple-700 dark:text-purple-300">
                            Bobot Nilai
                        </p>
                        <p class="mt-2 text-sm leading-6 text-purple-600 dark:text-purple-300/80">
                            Tugas dengan bobot nilai besar dinilai lebih berpengaruh terhadap akademik.
                        </p>
                    </div>
                </div>
            </div>

            {{-- AI Features --}}
            <div class="mb-6 rounded-3xl app-card p-6">
                <div class="mb-6">
                    <h3 class="text-xl font-bold app-title">
                        Fungsi AI dalam Sistem
                    </h3>
                    <p class="text-sm app-subtitle">
                        AI digunakan sebagai fitur pendukung keputusan dan perencanaan, bukan untuk mengerjakan tugas
                        mahasiswa.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="rounded-3xl bg-purple-50 p-6 border border-purple-100
                                dark:bg-purple-900/20 dark:border-purple-900/50">
                        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-purple-100 text-purple-700
                                    dark:bg-purple-900/40 dark:text-purple-300">
                            ✨
                        </div>

                        <h4 class="font-bold text-purple-900 dark:text-purple-300">
                            AI Recommendation per Tugas
                        </h4>

                        <p class="mt-2 text-sm leading-6 text-purple-700 dark:text-purple-200/90">
                            AI menganalisis satu tugas tertentu dan menghasilkan alasan prioritas,
                            risiko keterlambatan, langkah pengerjaan, jadwal rekomendasi, serta tips waktu.
                        </p>
                    </div>

                    <div class="rounded-3xl bg-indigo-50 p-6 border border-indigo-100
                                dark:bg-indigo-900/20 dark:border-indigo-900/50">
                        <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-700
                                    dark:bg-indigo-900/40 dark:text-indigo-300">
                            📌
                        </div>

                        <h4 class="font-bold text-indigo-900 dark:text-indigo-300">
                            AI Daily Summary
                        </h4>

                        <p class="mt-2 text-sm leading-6 text-indigo-700 dark:text-indigo-200/90">
                            AI membaca semua tugas aktif dan membuat ringkasan harian tentang tugas
                            yang perlu difokuskan terlebih dahulu.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Limitations --}}
            <div class="rounded-3xl app-card p-6">
                <div class="mb-6">
                    <h3 class="text-xl font-bold app-title">
                        Batasan Sistem
                    </h3>
                    <p class="text-sm app-subtitle">
                        Agar ruang lingkup sistem tetap jelas, fitur sistem dibatasi pada beberapa hal berikut.
                    </p>
                </div>

                <div class="space-y-3">
                    <div class="rounded-2xl app-card-soft p-4 text-sm app-text">
                        Sistem hanya digunakan untuk manajemen tugas akademik mahasiswa.
                    </div>

                    <div class="rounded-2xl app-card-soft p-4 text-sm app-text">
                        AI hanya memberikan rekomendasi dan tidak mengerjakan isi tugas mahasiswa secara penuh.
                    </div>

                    <div class="rounded-2xl app-card-soft p-4 text-sm app-text">
                        Prioritas dihitung berdasarkan deadline, tingkat kesulitan, estimasi waktu, dan bobot nilai.
                    </div>

                    <div class="rounded-2xl app-card-soft p-4 text-sm app-text">
                        Keputusan akhir tetap berada pada pengguna, karena rekomendasi AI bersifat pendukung.
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>