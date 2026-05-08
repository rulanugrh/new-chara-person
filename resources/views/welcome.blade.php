<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIJURUSAN - Sistem Pendukung Keputusan Jurusan</title>
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
                <a href="#tentang" class="text-sm text-gray-500 hover:text-gray-800 transition">Tentang</a>
                <a href="#cara" class="text-sm text-gray-500 hover:text-gray-800 transition">Cara Pakai</a>
            </div>

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

        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="max-w-6xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-12 items-center">

        <div>
            <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 text-xs font-medium px-3 py-1.5 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                </svg>
                SMK Negeri 22 Jakarta
            </span>

            <h1 class="mt-5 text-4xl font-bold text-gray-900 leading-tight">
                Temukan jurusan yang sesuai dengan
                <span class="text-blue-600"> minat dan kemampuanmu</span>
            </h1>

            <p class="mt-4 text-base text-gray-500 leading-relaxed">
                SIJURUSAN membantu calon peserta didik baru menentukan jurusan paling sesuai
                berdasarkan nilai akademik dan minat menggunakan metode
                <strong class="text-gray-700 font-medium">Simple Additive Weighting (SAW)</strong>.
            </p>

            <div class="mt-7 flex flex-wrap gap-3">
                <a href="{{ route('register') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition shadow-sm">
                    Mulai penjurusan
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 12l14 0" /><path d="M13 18l6 -6" /><path d="M13 6l6 6" />
                    </svg>
                </a>
                <a href="#tentang"
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg border border-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-50 transition">
                    Pelajari lebih lanjut
                </a>
            </div>
        </div>

        {{-- Mock Dashboard --}}
        <div class="bg-gray-100 border border-gray-200 rounded-2xl p-5 flex flex-col gap-3">

            <div class="flex items-center justify-between">
                <span class="text-sm font-medium text-gray-800">Hasil rekomendasi</span>
                <span class="text-xs text-gray-400">2025 / 2026</span>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-4 flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                        <path d="M6 8h.01" /><path d="M6 12h.01" /><path d="M6 16h.01" />
                        <path d="M10 8h8" /><path d="M10 12h8" /><path d="M10 16h8" />
                    </svg>
                </div>
                <div class="flex-1">
                    <div class="text-sm font-semibold text-gray-900">Rekayasa Perangkat Lunak</div>
                    <div class="text-xs text-gray-400">Skor akhir SAW</div>
                </div>
                <div class="text-lg font-bold text-blue-600">0.91</div>
            </div>

            <div class="flex flex-col gap-2.5">
                @php
                    $recommendations = [
                        ['name' => 'Teknik Jaringan Komputer', 'score' => 0.84, 'width' => '84%', 'color' => 'bg-blue-400'],
                        ['name' => 'Multimedia',               'score' => 0.76, 'width' => '76%', 'color' => 'bg-blue-300'],
                        ['name' => 'Akuntansi dan Keuangan',   'score' => 0.61, 'width' => '61%', 'color' => 'bg-blue-200'],
                    ];
                @endphp
                @foreach ($recommendations as $rec)
                <div>
                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                        <span>{{ $rec['name'] }}</span>
                        <span class="font-medium text-gray-700">{{ $rec['score'] }}</span>
                    </div>
                    <div class="h-1.5 bg-gray-200 rounded-full">
                        <div class="h-1.5 {{ $rec['color'] }} rounded-full" style="width: {{ $rec['width'] }}"></div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="grid grid-cols-3 gap-2 mt-1">
                <div class="bg-white rounded-xl p-3 text-center border border-gray-200">
                    <div class="text-xl font-bold text-blue-600">6</div>
                    <div class="text-xs text-gray-400 mt-0.5">Jurusan</div>
                </div>
                <div class="bg-white rounded-xl p-3 text-center border border-gray-200">
                    <div class="text-xl font-bold text-blue-600">4</div>
                    <div class="text-xs text-gray-400 mt-0.5">Kriteria SAW</div>
                </div>
                <div class="bg-white rounded-xl p-3 text-center border border-gray-200">
                    <div class="text-xl font-bold text-blue-600">98%</div>
                    <div class="text-xs text-gray-400 mt-0.5">Akurasi</div>
                </div>
            </div>

        </div>
    </section>

    <div class="border-t border-gray-100"></div>

    {{-- Tentang Sistem --}}
    <section id="tentang" class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-6">

            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900">Mengapa menggunakan SIJURUSAN?</h2>
                <p class="mt-3 text-sm text-gray-500 max-w-lg mx-auto leading-relaxed">
                    Sistem berbasis data yang objektif untuk membantu calon peserta didik
                    memilih jurusan secara tepat dan terukur.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-5">

                <div class="bg-white border border-gray-100 rounded-2xl p-6 hover:shadow-md transition">
                    <div class="w-9 h-9 rounded-lg bg-blue-50 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M3 12m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v6a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path d="M9 8m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                            <path d="M15 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900 mb-2">Berbasis data</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Rekomendasi dihasilkan dari nilai akademik dan hasil kuesioner minat siswa secara terukur dan transparan.
                    </p>
                </div>

                <div class="bg-white border border-gray-100 rounded-2xl p-6 hover:shadow-md transition">
                    <div class="w-9 h-9 rounded-lg bg-green-50 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900 mb-2">Metode SAW</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Menggunakan Simple Additive Weighting untuk perangkingan jurusan secara objektif dengan bobot kriteria yang dapat dikonfigurasi.
                    </p>
                </div>

                <div class="bg-white border border-gray-100 rounded-2xl p-6 hover:shadow-md transition">
                    <div class="w-9 h-9 rounded-lg bg-amber-50 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-600" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            <path d="M12 7a5 5 0 1 0 5 5" />
                            <path d="M18 3l0 4l-4 0" /><path d="M18 7l-7.536 7.536" />
                        </svg>
                    </div>
                    <h3 class="text-base font-semibold text-gray-900 mb-2">Tepat sasaran</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">
                        Membantu siswa memilih jurusan sesuai potensi dan minat agar lebih siap dan termotivasi dalam belajar.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <div class="border-t border-gray-100"></div>

    {{-- Cara Menggunakan --}}
    <section id="cara" class="py-16">
        <div class="max-w-6xl mx-auto px-6">

            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900">Cara menggunakan sistem</h2>
                <p class="mt-3 text-sm text-gray-500 max-w-md mx-auto">
                    Empat langkah mudah untuk mendapatkan rekomendasi jurusan terbaikmu.
                </p>
            </div>

            <div class="grid md:grid-cols-4 gap-5">
                @php
                    $steps = [
                        ['num' => '1', 'title' => 'Registrasi',     'desc' => 'Buat akun baru menggunakan data diri yang valid dan lengkap.'],
                        ['num' => '2', 'title' => 'Isi data',        'desc' => 'Masukkan nilai akademik dan informasi diri secara lengkap.'],
                        ['num' => '3', 'title' => 'Isi kuesioner',   'desc' => 'Jawab pertanyaan minat sesuai kondisi dan keinginanmu.'],
                        ['num' => '4', 'title' => 'Lihat hasil',     'desc' => 'Sistem memberikan rekomendasi jurusan terbaik berdasarkan skor SAW.'],
                    ];
                @endphp

                @foreach ($steps as $step)
                <div class="bg-gray-50 border border-gray-100 rounded-2xl p-5 text-center">
                    <div class="w-9 h-9 rounded-full bg-blue-600 text-white text-sm font-semibold flex items-center justify-center mx-auto mb-4">
                        {{ $step['num'] }}
                    </div>
                    <h3 class="text-sm font-semibold text-gray-900 mb-2">{{ $step['title'] }}</h3>
                    <p class="text-xs text-gray-500 leading-relaxed">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- CTA --}}
    <section class="max-w-6xl mx-auto px-6 pb-16">
        <div class="bg-blue-600 rounded-2xl px-8 py-12 text-center">
            <h2 class="text-2xl font-bold text-white">Mulai tentukan jurusanmu sekarang</h2>
            <p class="mt-3 text-sm text-blue-200 max-w-md mx-auto leading-relaxed">
                Gunakan SIJURUSAN untuk mendapatkan rekomendasi yang sesuai
                dengan kemampuan dan minatmu.
            </p>
            <a href="{{ route('register') }}"
               class="inline-flex items-center gap-2 mt-7 px-6 py-2.5 bg-white text-blue-700 text-sm font-semibold rounded-lg hover:bg-blue-50 transition shadow-sm">
                Mulai sekarang
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 12l14 0" /><path d="M13 18l6 -6" /><path d="M13 6l6 6" />
                </svg>
            </a>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t border-gray-100 bg-white">
        <div class="max-w-6xl mx-auto px-6 py-5 flex flex-col md:flex-row items-center justify-between gap-3">
            <p class="text-xs text-gray-400">© {{ date('Y') }} SIJURUSAN · SMK Negeri 22 Jakarta</p>
            <div class="flex items-center gap-5">
                <a href="#" class="text-xs text-gray-400 hover:text-gray-600 transition">Bantuan</a>
                <a href="https://instagram.com/julyaaivy_" target="_blank" class="text-xs text-gray-400 hover:text-gray-600 transition">Kontak</a>
                <a href="#" class="text-xs text-gray-400 hover:text-gray-600 transition">Kebijakan Privasi</a>
            </div>
        </div>
    </footer>

</body>
</html>