@extends('layouts.admin')

@section('title', 'Kelola Jurusan')
@section('subtitle', 'Tambahkan, edit, dan lihat detail jurusan SMK')

@section('content')
    <div class="flex items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-lg font-semibold text-slate-900">Data Jurusan</h2>
            <p class="text-sm text-slate-500">Kelola informasi jurusan dan alur konfigurasi penghitungan.</p>
        </div>
        <a href="{{ route('admin.jurusans.create') }}" class="inline-flex items-center rounded-full bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
            Tambah Jurusan
        </a>
    </div>

    <div class="space-y-4">
        @foreach($jurusans as $jurusan)
            <div class="rounded-3xl bg-white p-5 border border-slate-200 shadow-sm flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <a href="{{ route('admin.jurusans.show', $jurusan) }}" class="text-xl font-semibold text-slate-900 hover:text-indigo-600">{{ $jurusan->name }}</a>
                    <p class="text-sm text-slate-500 mt-1">{{ $jurusan->description }}</p>
                    <div class="mt-3 text-xs text-slate-500">
                        {{ $jurusan->pertanyaans_count }} pertanyaan • {{ $jurusan->kriterias_count }} kriteria
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('admin.jurusans.edit', $jurusan) }}" class="rounded-full border border-slate-300 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Edit</a>
                    <form method="POST" action="{{ route('admin.jurusans.destroy', $jurusan) }}" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-full bg-rose-500 px-4 py-2 text-sm text-white hover:bg-rose-600" onclick="return confirm('Hapus jurusan ini?')">Hapus</button>
                    </form>
                    <a href="{{ route('admin.bobot.edit', $jurusan) }}" class="rounded-full border border-indigo-300 px-4 py-2 text-sm text-indigo-700 hover:bg-indigo-50">Atur Bobot</a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $jurusans->links() }}
    </div>
@endsection
