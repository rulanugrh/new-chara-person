<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\HasilRekomendasi;
use App\Services\SAWService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request, SAWService $sawService)
    {
        $student = $request->user();

        // Cek apakah siswa sudah mengisi nilai dan kuisioner
        $hasNilai = $student->nilaiSiswas()->exists();
        $hasJawaban = $student->jawabanSiswas()->exists();
        $hasHasil = $student->hasilRekomendasis()->exists();

        $recommendations = null;
        if ($hasHasil) {
            $recommendations = HasilRekomendasi::with('jurusan')
                ->where('user_id', $student->id)
                ->orderByDesc('score')
                ->get();
        }

        return view('student.dashboard', compact('hasNilai', 'hasJawaban', 'hasHasil', 'recommendations'));
    }
}