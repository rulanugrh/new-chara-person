<x-admin-layout title="Hasil Rekomendasi" subtitle="Lihat ranking jurusan untuk setiap siswa berdasarkan SAW">
    <div class="max-w-5xl mx-auto space-y-6">

        <!-- TABEL -->
        <div class="bg-white rounded-3xl p-8 border border-slate-100">

            <!-- HEADER -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-8">
                <div>
                    <h2 class="text-xl font-medium text-slate-900 tracking-tight">Hasil rekomendasi siswa</h2>
                    <p class="text-sm text-slate-400 mt-1">Ranking jurusan berdasarkan metode SAW</p>
                </div>
                <div class="flex items-center gap-2 bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 w-full lg:w-64">
                    <svg class="w-4 h-4 text-slate-400 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.35-4.35" />
                    </svg>
                    <input id="searchInput" type="text" placeholder="Cari nama siswa..." class="bg-transparent text-sm text-slate-700 placeholder-slate-400 outline-none w-full" />
                </div>
            </div>

            <!-- TABLE -->
            <div class="overflow-x-auto">
                <table class="w-full min-w-[640px]">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="text-left pb-4 text-[11px] font-medium text-slate-400 uppercase tracking-widest pr-6">Nama siswa</th>
                            <th class="text-left pb-4 text-[11px] font-medium text-slate-400 uppercase tracking-widest pr-6">Rekomendasi jurusan</th>
                            <th class="text-left pb-4 text-[11px] font-medium text-slate-400 uppercase tracking-widest">Skor tertinggi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="divide-y divide-slate-50"></tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div id="paginationControls" class="flex items-center justify-end gap-2 mt-6 flex-wrap"></div>
        </div>

        <!-- DISTRIBUSI CHART -->
        <div class="bg-white rounded-3xl p-8 border border-slate-100">
            <h2 class="text-xl font-medium text-slate-900 tracking-tight">Distribusi rekomendasi jurusan</h2>
            <p class="text-sm text-slate-400 mt-1 mb-8">Jurusan terbanyak direkomendasikan sebagai pilihan pertama</p>

            <div class="flex flex-col lg:flex-row items-center gap-10">
                <div class="relative flex-shrink-0 w-48 h-48">
                    <svg id="donutSvg" viewBox="0 0 180 180" class="w-full h-full -rotate-90"></svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <p id="donutNum" class="text-2xl font-medium text-slate-800">—</p>
                        <p class="text-xs text-slate-400">jurusan</p>
                    </div>
                </div>

                <div class="flex-1 w-full">
                    <div id="legend" class="space-y-4"></div>
                    <div id="summaryRow" class="flex items-center gap-8 pt-5 mt-5 border-t border-slate-100"></div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            window.ALL_STUDENTS = @json($studentRecommendations);
        </script>
        @vite('resources/js/pages/admin-hasil.js')
    @endpush
</x-admin-layout>
