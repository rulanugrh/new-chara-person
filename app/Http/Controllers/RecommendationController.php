<?php

namespace App\Http\Controllers;

use App\Services\SAWService;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index(Request $request, SAWService $sawService)
    {
        $student = $request->user();

        return response()->json([
            'data' => $sawService->calculateForUser($student),
        ]);
    }
}
