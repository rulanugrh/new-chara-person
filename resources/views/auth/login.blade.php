<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIJURUSAN - Masuk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    {{-- Navbar --}}
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 py-3 flex items-center justify-between">

            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" />
                        <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" />
                    </svg>
                </div>
                <span class="text-lg font-semibold text-gray-900">
                    SIJU<span class="text-blue-600">RUSAN</span>
                </span>
            </div>

            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('welcome') }}#tentang" class="text-sm text-gray-500 hover:text-gray-800 transition">Tentang</a>
                <a href="{{ route('welcome') }}#cara" class="text-sm text-gray-500 hover:text-gray-800 transition">Cara Pakai</a>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('register') }}"
                   class="px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                    Daftar
                </a>
            </div>

        </div>
    </nav>

    {{-- Login Form --}}
    <section class="py-16">
        <div class="max-w-md mx-auto px-6">

            <div class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">

                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900">Masuk ke Akun</h1>
                    <p class="mt-2 text-sm text-gray-500">Masukkan kredensial Anda untuk melanjutkan</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 text-sm text-green-600 bg-green-50 border border-green-200 rounded-lg p-3">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                            <span class="ms-2 text-sm text-gray-600">Ingat saya</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-between">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-blue-600 hover:text-blue-800 underline" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif

                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
                            Masuk
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </section>

</body>
</html>
