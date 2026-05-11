<?php

namespace App\Http\Controllers;

use App\Models\HasilRekomendasi;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->email === 'admin@spk.local') {
                return redirect()->route('admin.dashboard');
            }

            $user = Auth::user();

            $data = [
                'hasNilai' => $user->nilaiSiswas()->exists(),
                'hasJawaban' => $user->jawabanSiswas()->exists(),
                'hasHasil' => $user->hasilRekomendasis()->exists(),
                'recommendations' => null,
            ];

            if ($data['hasHasil']) {
                $data['recommendations'] = HasilRekomendasi::with('jurusan')
                    ->where('user_id', $user->id)
                    ->orderByDesc('score')
                    ->get();
            }

            return view('welcome', $data);
        }

        return view('welcome');
    }
}
