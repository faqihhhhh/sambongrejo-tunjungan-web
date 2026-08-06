<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PotensiDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PotensiDesaController extends Controller
{
    public function index()
    {
        $items = PotensiDesa::orderBy('kategori')->orderBy('urutan')->paginate(15);
        return view('admin.potensi.index', compact('items'));
    }

    public function create()
    {
        $kategoriList = PotensiDesa::$kategoriLabels;
        return view('admin.potensi.form', compact('kategoriList'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori'  => 'required|in:umkm,wisata,peternakan,pertanian,perkebunan,perikanan',
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'urutan'    => 'nullable|integer',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('potensi', 'public');
        }

        PotensiDesa::create($validated);
        return redirect()->route('admin.potensi.index')->with('success', 'Potensi desa berhasil ditambahkan.');
    }

    public function edit(PotensiDesa $potensi)
    {
        $kategoriList = PotensiDesa::$kategoriLabels;
        return view('admin.potensi.form', compact('potensi', 'kategoriList'));
    }

    public function update(Request $request, PotensiDesa $potensi)
    {
        $validated = $request->validate([
            'kategori'  => 'required|in:umkm,wisata,peternakan,pertanian,perkebunan,perikanan',
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'urutan'    => 'nullable|integer',
        ]);

        if ($request->hasFile('foto')) {
            Storage::disk('public')->delete($potensi->foto);
            $validated['foto'] = $request->file('foto')->store('potensi', 'public');
        }

        $potensi->update($validated);
        return redirect()->route('admin.potensi.index')->with('success', 'Potensi desa berhasil diperbarui.');
    }

    public function destroy(PotensiDesa $potensi)
    {
        Storage::disk('public')->delete($potensi->foto);
        $potensi->delete();
        return redirect()->route('admin.potensi.index')->with('success', 'Potensi desa berhasil dihapus.');
    }
}
