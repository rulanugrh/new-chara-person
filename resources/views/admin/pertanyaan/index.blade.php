
<x-admin-layout title="Pertanyaan Kuisioner" subtitle="Kelola pertanyaan khusus untuk setiap jurusan">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-lg font-semibold text-slate-900">Pertanyaan Kuisioner</h2>
            <p class="text-sm text-slate-500">Filter pertanyaan berdasarkan jurusan untuk memastikan setiap siswa mengisi kuisioner yang tepat.</p>
        </div>
        <div class="flex items-center gap-3">
            <form action="" method="GET" class="flex items-center gap-2">
                <select name="jurusan_id" class="rounded-2xl border border-slate-300 bg-slate-50 px-4 py-2 text-sm text-slate-700">
                    <option value="">Semua jurusan</option>
                    @foreach($jurusans as $jurusan)
                        <option value="{{ $jurusan->id }}" {{ $jurusanId == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->name }}</option>
                    @endforeach
                </select>
                <button class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white">Filter</button>
            </form>
            <a href="{{ route('admin.pertanyaan.create') }}" class="rounded-full bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Tambah Pertanyaan</a>
        </div>
    </div>
    
    <div class="space-y-4">
        @foreach($pertanyaans as $pertanyaan)
            <div class="rounded-3xl bg-white p-5 border border-slate-200 shadow-sm">
                <div class="flex flex-col lg:flex-row lg:justify-between lg:items-center gap-4">
                    <div>
                        <div class="font-semibold text-slate-900" style="white-space: pre-line;" >{{ $pertanyaan->question }}</div>
                        <div class="text-sm text-slate-500 mt-1">Jurusan: {{ $pertanyaan->jurusan->name }}</div>
                    </div>
                    <div class="flex flex-wrap items-center gap-2">
                        <a href="{{ route('admin.pertanyaan.edit', $pertanyaan) }}" class="rounded-full border border-slate-300 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">Edit</a>
                        <form action="{{ route('admin.pertanyaan.destroy', $pertanyaan) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-full bg-rose-500 px-4 py-2 text-sm text-white hover:bg-rose-600" onclick="return confirm('Hapus pertanyaan ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="mt-6">{{ $pertanyaans->withQueryString()->links() }}</div>

</x-admin-layout>
