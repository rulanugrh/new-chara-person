<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class BobotController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::withCount('kriterias')->get();

        return view('admin.bobots.index', compact('jurusans'));
    }

    public function edit(Jurusan $jurusan)
    {
        $jurusan->load('kriterias');
        $academicKriterias = Kriteria::where('data_source', Kriteria::SOURCE_ACADEMIC)->get();
        $minatKriteria = Kriteria::where('is_minat', true)->first();

        return view('admin.bobots.edit', compact('jurusan', 'academicKriterias', 'minatKriteria'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $data = $request->validate([
            'academic_kriterias' => 'array',
            'academic_kriterias.*' => 'integer|exists:kriteria,id',
            'academic_weights' => 'array',
            'academic_weights.*' => 'nullable|numeric|min:0|max:100',
            'minat_weight' => 'required|numeric|min:1|max:100',
        ]);

        $syncData = [];
        $totalWeight = 0;

        // Add academic kriteria weights
        if (!empty($data['academic_kriterias'])) {
            foreach ($data['academic_kriterias'] as $kriteriaId) {
                $weight = $data['academic_weights'][$kriteriaId] ?? 0;
                if ($weight > 0) {
                    $syncData[$kriteriaId] = ['weight' => round($weight, 2)];
                    $totalWeight += $weight;
                }
            }
        }

        // Add minat kriteria weight
        $minatKriteria = Kriteria::where('is_minat', true)->first();
        if ($minatKriteria) {
            $syncData[$minatKriteria->id] = ['weight' => round($data['minat_weight'], 2)];
            $totalWeight += $data['minat_weight'];
        }

        // Validate total weight
        if (abs($totalWeight - 100) > 0.01) {
            return back()->withErrors(['total_weight' => 'Total bobot harus 100%'])->withInput();
        }

        // Validate minat weight exists
        if (!isset($syncData[$minatKriteria->id])) {
            return back()->withErrors(['minat_weight' => 'Bobot minat harus diisi'])->withInput();
        }

        $jurusan->kriterias()->sync($syncData);

        return redirect()->route('admin.bobot.index')->with('success', 'Bobot jurusan berhasil diperbarui.');
    }
}
