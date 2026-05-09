<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilRekomendasi;
use App\Models\JawabanSiswa;
use App\Models\Jurusan;
use App\Models\Pertanyaan;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'jurusan' => Jurusan::count(),
            'siswa' => User::count(),
            'pertanyaan' => Pertanyaan::count(),
            'hasil_rekomendasi' => HasilRekomendasi::count(),
        ];

        $topJurusan = Jurusan::withCount('hasilRekomendasis')
            ->orderByDesc('hasil_rekomendasis_count')
            ->take(5)
            ->get();

        $recentRecommendations = HasilRekomendasi::with(['user', 'jurusan'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'topJurusan', 'recentRecommendations'));
    }
}
