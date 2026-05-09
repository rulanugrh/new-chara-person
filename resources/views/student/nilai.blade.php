@extends('layouts.student')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Input Nilai Akademik</h2>
        <p class="text-gray-600 mb-8">Masukkan nilai rapor SMP Anda untuk mata pelajaran berikut. Nilai ini akan digunakan untuk menghitung rekomendasi jurusan yang sesuai dengan minat dan bakat Anda.</p>

        <form method="POST" action="{{ route('student.nilai.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($kriterias as $kriteria)
                    <div class="space-y-2">
                        <label for="nilai_{{ $kriteria->id }}" class="block text-sm font-medium text-gray-700">
                            {{ $kriteria->name }}
                        </label>
                        <input
                            type="number"
                            id="nilai_{{ $kriteria->id }}"
                            name="nilai[{{ $kriteria->id }}]"
                            value="{{ $existingNilai->get($kriteria->id)->raw_value ?? '' }}"
                            min="0"
                            max="100"
                            step="0.01"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="0.00"
                            required
                        >
                        <p class="text-xs text-gray-500">Masukkan nilai dalam skala 0-100</p>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('student.dashboard') }}" class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                    Kembali ke Dashboard
                </a>
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    Simpan Nilai & Lanjutkan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection