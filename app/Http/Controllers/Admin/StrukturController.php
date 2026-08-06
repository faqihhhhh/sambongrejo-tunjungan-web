<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StrukturPemerintahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturController extends Controller
{
    public function index()
    {
        $items = StrukturPemerintahan::orderBy('urutan')->get();
        return view('admin.struktur.index', compact('items'));
    }

    public function create() { return view('admin.struktur.form'); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan'  => 'nullable|integer',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        StrukturPemerintahan::create($validated);
        return redirect()->route('admin.struktur.index')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(StrukturPemerintahan $struktur)
    {
        return view('admin.struktur.form', compact('struktur'));
    }

    public function update(Request $request, StrukturPemerintahan $struktur)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'urutan'  => 'nullable|integer',
        ]);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($struktur->foto);
            $validated['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        $struktur->update($validated);
        return redirect()->route('admin.struktur.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(StrukturPemerintahan $struktur)
    {
        Storage::disk('public')->delete($struktur->foto);
        $struktur->delete();
        return redirect()->route('admin.struktur.index')->with('success', 'Data berhasil dihapus.');
    }
}
