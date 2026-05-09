@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('subtitle', 'Ringkasan konfigurasi SPK dan hasil rekomendasi siswa')

@section('content')
    <div class="grid gap-6 xl:grid-cols-4">
        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
            <div class="text-slate-500 uppercase text-xs tracking-[0.2em]">Jurusan</div>
            <div class="mt-4 text-3xl font-semibold text-slate-900">{{ $stats['jurusan'] }}</div>
            <div class="mt-2 text-sm text-slate-500">Total jurusan yang tersedia</div>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
            <div class="text-slate-500 uppercase text-xs tracking-[0.2em]">Siswa</div>
            <div class="mt-4 text-3xl font-semibold text-slate-900">{{ $stats['siswa'] }}</div>
            <div class="mt-2 text-sm text-slate-500">Total pengguna siswa</div>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
            <div class="text-slate-500 uppercase text-xs tracking-[0.2em]">Pertanyaan</div>
            <div class="mt-4 text-3xl font-semibold text-slate-900">{{ $stats['pertanyaan'] }}</div>
            <div class="mt-2 text-sm text-slate-500">Jumlah pertanyaan kuisioner</div>
        </div>

        <div class="rounded-3xl bg-white p-6 shadow-sm border border-slate-200">
            <div class="text-slate-500 uppercase text-xs tracking-[0.2em]">Rekomendasi</div>
            <div class="mt-4 text-3xl font-semibold text-slate-900">{{ $stats['hasil_rekomendasi'] }}</div>
            <div class="mt-2 text-sm text-slate-500">Total hasil rekomendasi siswa</div>
        </div>
    </div>

    <div class="mt-8 grid gap-6 xl:grid-cols-2">
        <section class="rounded-3xl bg-white p-6 border border-slate-200 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Top jurusan berdasarkan rekomendasi</h2>
            <div class="mt-4 space-y-3">
                @forelse($topJurusan as $jurusan)
                    <div class="rounded-2xl border border-slate-200 p-4">
                        <div class="font-semibold text-slate-900">{{ $jurusan->name }}</div>
                        <div class="text-sm text-slate-500">Rekomendasi: {{ $jurusan->hasil_rekomendasis_count }} kali</div>
                    </div>
                @empty
                    <div class="text-sm text-slate-500">Belum ada rekomendasi.</div>
                @endforelse
            </div>
        </section>

        <section class="rounded-3xl bg-white p-6 border border-slate-200 shadow-sm">
            <h2 class="text-lg font-semibold text-slate-900">Rekomendasi terakhir</h2>
            <div class="mt-4 space-y-3">
                @forelse($recentRecommendations as $item)
                    <div class="rounded-2xl border border-slate-200 p-4">
                        <div class="font-semibold text-slate-900">{{ $item->user->name }} → {{ $item->jurusan->name }}</div>
                        <div class="text-sm text-slate-500">Skor: {{ $item->score }} | Rank: {{ $item->rank }}</div>
                        <div class="text-xs text-slate-400">{{ $item->created_at->diffForHumans() }}</div>
                    </div>
                @empty
                    <div class="text-sm text-slate-500">Belum ada data rekomendasi terbaru.</div>
                @endforelse
            </div>
        </section>
    </div>
@endsection
