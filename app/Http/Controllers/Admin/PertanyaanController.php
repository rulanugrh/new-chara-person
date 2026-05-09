<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use App\Models\Kriteria;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    public function index(Request $request)
    {
        $jurusanId = $request->query('jurusan_id');
        $jurusans = Jurusan::active()->get();

        $pertanyaans = Pertanyaan::with('jurusan', 'kriteria')
            ->when($jurusanId, fn ($query) => $query->where('jurusan_id', $jurusanId))
            ->orderBy('jurusan_id')
            ->paginate(15);

        return view('admin.pertanyaans.index', compact('pertanyaans', 'jurusans', 'jurusanId'));
    }

    public function create()
    {
        $jurusans = Jurusan::active()->get();
        $kriterias = Kriteria::all();

        return view('admin.pertanyaans.create', compact('jurusans', 'kriterias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'kriteria_id' => 'nullable|exists:kriteria,id',
            'question' => 'required|string',
            'help_text' => 'nullable|string',
            'active' => 'boolean',
            'order' => 'nullable|integer|min:0',
        ]);

        $data['active'] = $request->boolean('active');
        $data['order'] = $data['order'] ?? 0;

        Pertanyaan::create($data);

        return redirect()->route('admin.pertanyaans.index')->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function edit(Pertanyaan $pertanyaan)
    {
        $jurusans = Jurusan::active()->get();
        $kriterias = Kriteria::all();

        return view('admin.pertanyaans.edit', compact('pertanyaan', 'jurusans', 'kriterias'));
    }

    public function update(Request $request, Pertanyaan $pertanyaan)
    {
        $data = $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'kriteria_id' => 'nullable|exists:kriteria,id',
            'question' => 'required|string',
            'help_text' => 'nullable|string',
            'active' => 'boolean',
            'order' => 'nullable|integer|min:0',
        ]);

        $data['active'] = $request->boolean('active');
        $data['order'] = $data['order'] ?? 0;

        $pertanyaan->update($data);

        return redirect()->route('admin.pertanyaans.index')->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    public function destroy(Pertanyaan $pertanyaan)
    {
        $pertanyaan->delete();

        return redirect()->route('admin.pertanyaans.index')->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
