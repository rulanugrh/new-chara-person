<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::withCount(['pertanyaans', 'kriterias'])->paginate(12);

        return view('admin.jurusans.index', compact('jurusans'));
    }

    public function create()
    {
        return view('admin.jurusans.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:jurusans,name',
            'description' => 'nullable|string',
            'active' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['active'] = $request->boolean('active');

        Jurusan::create($data);

        return redirect()->route('admin.jurusans.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function show(Jurusan $jurusan)
    {
        $jurusan->load(['kriterias', 'pertanyaans']);

        return view('admin.jurusans.show', compact('jurusan'));
    }

    public function edit(Jurusan $jurusan)
    {
        return view('admin.jurusans.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:jurusans,name,' . $jurusan->id,
            'description' => 'nullable|string',
            'active' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['active'] = $request->boolean('active');

        $jurusan->update($data);

        return redirect()->route('admin.jurusans.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();

        return redirect()->route('admin.jurusans.index')->with('success', 'Jurusan berhasil dihapus.');
    }
}
