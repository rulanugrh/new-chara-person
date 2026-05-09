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
                <a href="#tentang" class="text-sm text-gray-500 hover:text-gray-800 transition">Tentang</a>
                <a href="#tentang" class="text-sm text-gray-500 hover:text-gray-800 transition">Dashboard</a>
                <a href="#cara" class="text-sm text-gray-500 hover:text-gray-800 transition">Cara Pakai</a>
            </div>
            @auth
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600">Selamat datang, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-sm text-gray-600 hover:text-gray-800">Logout</button>
                    </form>
                </div>
            @else
            <div class="flex items-center gap-2">
                <a href="{{ route('login') }}"
                   class="px-4 py-2 text-sm rounded-lg border border-gray-200 text-gray-700 hover:bg-gray-50 transition">
                    Masuk
                </a>
                <a href="{{ route('register') }}"
                   class="px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
                    Daftar
                </a>
            </div>
            @endauth

        </div>
    </nav>