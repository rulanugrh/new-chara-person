<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\JawabanSiswa;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class KuisionerController extends Controller
{
    public function index(Request $request)
    {
        $student = $request->user();

        // Cek apakah sudah mengisi nilai
        if (!$student->nilaiSiswas()->exists()) {
            return redirect()->route('student.nilai.index')->with('warning', 'Silakan isi nilai akademik terlebih dahulu.');
        }

        $pertanyaans = Pertanyaan::with('jurusan', 'kriteria')
            ->where('active', true)
            ->orderBy('order')
            ->get()
            ->groupBy('jurusan_id');

        // Cek jawaban yang sudah ada
        $existingJawaban = JawabanSiswa::where('user_id', $student->id)
            ->pluck('score', 'pertanyaan_id');

        return view('student.kuisioner', compact('pertanyaans', 'existingJawaban'));
    }

    public function store(Request $request)
    {
        $student = $request->user();

        // Cek apakah sudah mengisi nilai
        if (!$student->nilaiSiswas()->exists()) {
            return redirect()->route('student.nilai.index')->with('warning', 'Silakan isi nilai akademik terlebih dahulu.');
        }

        $pertanyaans = Pertanyaan::where('active', true)->pluck('id');
        $rules = [];
        foreach ($pertanyaans as $pertanyaanId) {
            $rules["jawaban.{$pertanyaanId}"] = 'required|integer|min:1|max:5';
        }

        $validated = $request->validate($rules);

        // Simpan jawaban
        foreach ($validated['jawaban'] as $pertanyaanId => $score) {
            JawabanSiswa::updateOrCreate(
                [
                    'user_id' => $student->id,
                    'pertanyaan_id' => $pertanyaanId,
                ],
                ['score' => $score]
            );
        }

        // Hitung dan simpan rekomendasi
        $sawService = app(\App\Services\SAWService::class);
        $sawService->persistRecommendations($student);

        return redirect()->route('student.hasil.index')->with('success', 'Kuisioner berhasil disimpan. Lihat hasil rekomendasi jurusan Anda.');
    }
}