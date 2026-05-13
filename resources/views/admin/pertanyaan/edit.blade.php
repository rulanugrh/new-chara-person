<x-admin-layout title="Edit Pertanyaan" subtitle="Perbarui pertanyaan kuisioner untuk jurusan tertentu">
    <div class="rounded-3xl bg-white p-6 border border-slate-200 shadow-sm">
        <form action="{{ route('admin.pertanyaan.update', $pertanyaan) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
    
            <div class="grid gap-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700">Jurusan</label>
                    <select name="jurusan_id" class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3" required>
                        <option value="">Pilih jurusan</option>
                        @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $pertanyaan->jurusan_id) == $jurusan->id ? 'selected' : '' }}>{{ $jurusan->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
    
            <div>
                <label class="block text-sm font-medium text-slate-700">Pertanyaan</label>
                <textarea name="question" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3" required>{{ old('question', $pertanyaan->question) }}</textarea>
            </div>
    
            <div>
                <label class="block text-sm font-medium text-slate-700">Catatan / helper text</label>
                <textarea name="help_text" rows="3" class="mt-2 w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3">{{ old('help_text', $pertanyaan->help_text) }}</textarea>
            </div>
    
            <div class="flex items-center gap-3">
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" name="active" value="1" {{ old('active', $pertanyaan->active) ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 border-slate-300 rounded">
                    <span class="text-sm text-slate-700">Aktif</span>
                </label>
            </div>
    
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.pertanyaan.index') }}" class="rounded-full border border-slate-300 px-5 py-2 text-sm text-slate-700 hover:bg-slate-50">Kembali</a>
                <button type="submit" class="rounded-full bg-indigo-600 px-5 py-2 text-sm font-semibold text-white hover:bg-indigo-700">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</x-admin-layout>
