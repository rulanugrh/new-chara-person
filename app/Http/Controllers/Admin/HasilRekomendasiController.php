<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilRekomendasi;
use App\Models\User;
use Illuminate\Http\Request;

class HasilRekomendasiController extends Controller
{
    public function index()
    {
        $recommendations = HasilRekomendasi::with(['user', 'jurusan'])
            ->orderBy('user_id')
            ->orderByDesc('score')
            ->paginate(20);

        return view('admin.hasil.index', compact('recommendations'));
    }

    public function show(User $user)
    {
        $recommendations = HasilRekomendasi::with('jurusan')
            ->where('user_id', $user->id)
            ->orderByDesc('score')
            ->get();

        return view('admin.hasil.show', compact('user', 'recommendations'));
    }
}
