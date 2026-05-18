<section>
    <header class="mb-6">
        <div class="flex items-start gap-3">
            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-700
                        dark:bg-indigo-900/40 dark:text-indigo-300">
                👤
            </div>

            <div>
                <h2 class="text-lg font-bold app-title">
                    Informasi Profil
                </h2>

                <p class="mt-1 text-sm app-subtitle">
                    Perbarui nama dan alamat email akun kamu.
                </p>
            </div>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-sm font-semibold app-title mb-2">
                Nama Lengkap
            </label>

            <input id="name"
                   name="name"
                   type="text"
                   value="{{ old('name', $user->name) }}"
                   required
                   autofocus
                   autocomplete="name"
                   class="w-full rounded-2xl px-4 py-3 text-sm app-input">

            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold app-title mb-2">
                Email
            </label>

            <input id="email"
                   name="email"
                   type="email"
                   value="{{ old('email', $user->email) }}"
                   required
                   autocomplete="username"
                   class="w-full rounded-2xl px-4 py-3 text-sm app-input">

            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 rounded-2xl bg-yellow-50 p-4 border border-yellow-100
                            dark:bg-yellow-900/20 dark:border-yellow-900/50">
                    <p class="text-sm text-yellow-700 dark:text-yellow-300">
                        Email kamu belum diverifikasi.

                        <button form="send-verification"
                                class="font-bold text-yellow-800 underline hover:text-yellow-900
                                       dark:text-yellow-200 dark:hover:text-yellow-100">
                            Kirim ulang email verifikasi
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                            Link verifikasi baru sudah dikirim ke email kamu.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                    class="rounded-2xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-sm hover:bg-indigo-700 transition">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm font-semibold text-green-600 dark:text-green-400">
                    Berhasil disimpan.
                </p>
            @endif
        </div>
    </form>
</section>