<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::paginate(12);

        return view('admin.kriteria.index', compact('kriterias'));
    }

    public function create()
    {
        return view('admin.kriteria.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:kriteria,name',
            'description' => 'nullable|string',
            'data_source' => 'required|in:academic,questionnaire,manual',
            'max_value' => 'required|integer|min:1',
            'is_benefit' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['is_benefit'] = $request->boolean('is_benefit');

        Kriteria::create($data);

        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil disimpan.');
    }

    public function edit(Kriteria $kriteria)
    {
        return view('admin.kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:kriteria,name,' . $kriteria->id,
            'description' => 'nullable|string',
            'data_source' => 'required|in:academic,questionnaire,manual',
            'max_value' => 'required|integer|min:1',
            'is_benefit' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['is_benefit'] = $request->boolean('is_benefit');

        $kriteria->update($data);

        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();

        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
