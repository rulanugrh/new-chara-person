<header class="bg-white shadow-sm border-b">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <h1 class="text-2xl font-bold text-gray-800">SPK Rekomendasi Jurusan SMK</h1>
                <span class="text-sm text-gray-500">Sistem Pendukung Keputusan</span>
            </div>

            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">Selamat datang, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-gray-600 hover:text-gray-800">Logout</button>
                </form>
            </div>
        </div>
    </div>
</header>