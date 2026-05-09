@extends('layouts.student')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Kuisioner Minat Bakat</h2>
        <p class="text-gray-600 mb-8">Jawab pertanyaan berikut dengan jujur untuk mengetahui minat dan bakat Anda. Gunakan skala 1-5:</p>

        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-8">
            <div class="flex items-center space-x-2 text-blue-800">
                <span class="font-semibold">Skala Penilaian:</span>
                <span>1 = Sangat Tidak Setuju</span>
                <span>2 = Tidak Setuju</span>
                <span>3 = Netral</span>
                <span>4 = Setuju</span>
                <span>5 = Sangat Setuju</span>
            </div>
        </div>

        @if($pertanyaans->isEmpty())
            <div class="rounded-3xl border border-yellow-300 bg-yellow-50 p-6 text-yellow-800">
                <p class="font-semibold">Belum ada pertanyaan kuisioner yang aktif.</p>
                <p class="mt-2 text-sm text-yellow-700">Silakan hubungi admin untuk membuat pertanyaan kuisioner terlebih dahulu.</p>
            </div>
        @else
            <form method="POST" action="{{ route('student.kuisioner.store') }}" class="space-y-8">
                @csrf

                @foreach($pertanyaans as $jurusanId => $pertanyaanGroup)
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">{{ $pertanyaanGroup->first()->jurusan->name }}</h3>

                        <div class="space-y-6">
                            @foreach($pertanyaanGroup as $pertanyaan)
                                <div class="bg-white rounded-lg p-4 border border-gray-200">
                                    <div class="flex items-start space-x-4">
                                        <div class="flex-shrink-0 w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-semibold text-sm">
                                            {{ $loop->iteration }}
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-gray-800 mb-3">{{ $pertanyaan->question }}</p>

                                            @if($pertanyaan->help_text)
                                                <p class="text-sm text-slate-500 mb-3">{{ $pertanyaan->help_text }}</p>
                                            @endif

                                            @if($pertanyaan->kriteria)
                                                <p class="text-sm text-gray-600 mb-3">Kriteria: {{ $pertanyaan->kriteria->name }}</p>
                                            @endif

                                            <div class="flex items-center space-x-4">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <label class="flex items-center space-x-2 cursor-pointer">
                                                        <input
                                                            type="radio"
                                                            name="jawaban[{{ $pertanyaan->id }}]"
                                                            value="{{ $i }}"
                                                            {{ ($existingJawaban->get($pertanyaan->id) ?? null) == $i ? 'checked' : '' }}
                                                            class="w-4 h-4 text-blue-600 focus:ring-blue-500"
                                                            required
                                                        >
                                                        <span class="text-sm font-medium">{{ $i }}</span>
                                                    </label>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('student.dashboard') }}" class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                        Kembali ke Dashboard
                    </a>
                    <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        Simpan Jawaban & Lihat Hasil
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection