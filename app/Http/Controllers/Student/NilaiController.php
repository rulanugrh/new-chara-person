<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Kriteria;
use App\Models\NilaiSiswa;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        $student = $request->user();
        $kriterias = Kriteria::where('data_source', Kriteria::SOURCE_ACADEMIC)->get();

        // Cek apakah sudah ada nilai
        $existingNilai = NilaiSiswa::where('user_id', $student->id)->get()->keyBy('kriteria_id');

        return view('student.nilai', compact('kriterias', 'existingNilai'));
    }

    public function store(Request $request)
    {
        $student = $request->user();
        $kriterias = Kriteria::where('data_source', Kriteria::SOURCE_ACADEMIC)->pluck('id');

        $rules = [];
        foreach ($kriterias as $kriteriaId) {
            $rules["nilai.{$kriteriaId}"] = 'required|numeric|min:0|max:100';
        }

        $validated = $request->validate($rules);

        // Simpan nilai untuk setiap kriteria
        foreach ($validated['nilai'] as $kriteriaId => $nilai) {
            NilaiSiswa::updateOrCreate(
                [
                    'user_id' => $student->id,
                    'kriteria_id' => $kriteriaId,
                ],
                ['raw_value' => $nilai]
            );
        }

        return redirect()->route('student.kuisioner.index')->with('success', 'Nilai berhasil disimpan. Silakan lanjutkan ke kuisioner.');
    }
}