<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriFotoController extends Controller
{
    public function index()
    {
        $fotos = GaleriFoto::orderByDesc('tanggal')->paginate(20);
        return view('admin.galeri-foto.index', compact('fotos'));
    }

    public function create() { return view('admin.galeri-foto.form'); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'      => 'required|string|max:500',
            'file'       => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'keterangan' => 'nullable|string',
            'tanggal'    => 'nullable|date',
        ]);
        $validated['file'] = $request->file('file')->store('galeri/foto', 'public');
        GaleriFoto::create($validated);
        return redirect()->route('admin.galeri-foto.index')->with('success', 'Foto berhasil ditambahkan.');
    }

    public function edit(GaleriFoto $galeriFoto)
    {
        return view('admin.galeri-foto.form', compact('galeriFoto'));
    }

    public function update(Request $request, GaleriFoto $galeriFoto)
    {
        $validated = $request->validate([
            'judul'      => 'required|string|max:500',
            'file'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'keterangan' => 'nullable|string',
            'tanggal'    => 'nullable|date',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($galeriFoto->file);
            $validated['file'] = $request->file('file')->store('galeri/foto', 'public');
        }

        $galeriFoto->update($validated);
        return redirect()->route('admin.galeri-foto.index')->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy(GaleriFoto $galeriFoto)
    {
        Storage::disk('public')->delete($galeriFoto->file);
        $galeriFoto->delete();
        return redirect()->route('admin.galeri-foto.index')->with('success', 'Foto berhasil dihapus.');
    }
}
