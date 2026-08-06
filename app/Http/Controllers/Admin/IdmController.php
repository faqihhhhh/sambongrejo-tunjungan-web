<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Idm;

class IdmController extends Controller
{
    public function index()
    {
        $idms = Idm::orderBy('tahun', 'desc')->get();
        return view('admin.idm.index', compact('idms'));
    }

    public function create()
    {
        return view('admin.idm.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|digits:4|unique:idms,tahun',
            'skor' => 'required|numeric|min:0|max:1',
            'status' => 'required|string|max:255',
            'target_tahun_depan' => 'nullable|string|max:255',
        ]);

        Idm::create($validated);
        return redirect()->route('admin.idm.index')->with('success', 'Data IDM berhasil ditambahkan.');
    }

    public function edit(Idm $idm)
    {
        return view('admin.idm.edit', compact('idm'));
    }

    public function update(Request $request, Idm $idm)
    {
        $validated = $request->validate([
            'tahun' => 'required|digits:4|unique:idms,tahun,'.$idm->id,
            'skor' => 'required|numeric|min:0|max:1',
            'status' => 'required|string|max:255',
            'target_tahun_depan' => 'nullable|string|max:255',
        ]);

        $idm->update($validated);
        return redirect()->route('admin.idm.index')->with('success', 'Data IDM berhasil diperbarui.');
    }

    public function destroy(Idm $idm)
    {
        $idm->delete();
        return redirect()->route('admin.idm.index')->with('success', 'Data IDM berhasil dihapus.');
    }
}
