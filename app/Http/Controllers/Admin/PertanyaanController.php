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

        return view('admin.pertanyaan.index', compact('pertanyaans', 'jurusans', 'jurusanId'));
    }

    public function create()
    {
        $jurusans = Jurusan::active()->get();

        return view('admin.pertanyaan.create', compact('jurusans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'question' => 'required|string',
            'help_text' => 'nullable|string',
            'active' => 'boolean',
            'order' => 'nullable|integer|min:0',
        ]);

        $data['active'] = $request->boolean('active');
        $data['order'] = $data['order'] ?? 0;

        Pertanyaan::create($data);

        return redirect()->route('admin.pertanyaan.index')->with('success', 'Pertanyaan berhasil ditambahkan.');
    }

    public function edit(Pertanyaan $pertanyaan)
    {
        $jurusans = Jurusan::active()->get();

        return view('admin.pertanyaan.edit', compact('pertanyaan', 'jurusans'));
    }

    public function update(Request $request, Pertanyaan $pertanyaan)
    {
        $data = $request->validate([
            'jurusan_id' => 'required|exists:jurusan,id',
            'question' => 'required|string',
            'help_text' => 'nullable|string',
            'active' => 'boolean',
            'order' => 'nullable|integer|min:0',
        ]);

        $data['active'] = $request->boolean('active');
        $data['order'] = $data['order'] ?? 0;

        $pertanyaan->update($data);

        return redirect()->route('admin.pertanyaan.index')->with('success', 'Pertanyaan berhasil diperbarui.');
    }

    public function destroy(Pertanyaan $pertanyaan)
    {
        $pertanyaan->delete();

        return redirect()->route('admin.pertanyaan.index')->with('success', 'Pertanyaan berhasil dihapus.');
    }
}
