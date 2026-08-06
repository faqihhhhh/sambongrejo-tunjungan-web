<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apbdes;

class ApbdesController extends Controller
{
    public function index()
    {
        $apbdesList = Apbdes::orderBy('tahun', 'desc')->get();
        return view('admin.apbdes.index', compact('apbdesList'));
    }

    public function create()
    {
        return view('admin.apbdes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|digits:4|unique:apbdes,tahun',
            'pendapatan_anggaran' => 'required|numeric',
            'pendapatan_realisasi' => 'required|numeric',
            'belanja_anggaran' => 'required|numeric',
            'belanja_realisasi' => 'required|numeric',
            'pembiayaan_penerimaan_anggaran' => 'required|numeric',
            'pembiayaan_penerimaan_realisasi' => 'required|numeric',
            'pembiayaan_pengeluaran_anggaran' => 'required|numeric',
            'pembiayaan_pengeluaran_realisasi' => 'required|numeric',
        ]);

        Apbdes::create($validated);
        return redirect()->route('admin.apbdes.index')->with('success', 'Data APBDes berhasil ditambahkan.');
    }

    public function edit(Apbdes $apbde)
    {
        return view('admin.apbdes.edit', compact('apbde'));
    }

    public function update(Request $request, Apbdes $apbde)
    {
        $validated = $request->validate([
            'tahun' => 'required|digits:4|unique:apbdes,tahun,'.$apbde->id,
            'pendapatan_anggaran' => 'required|numeric',
            'pendapatan_realisasi' => 'required|numeric',
            'belanja_anggaran' => 'required|numeric',
            'belanja_realisasi' => 'required|numeric',
            'pembiayaan_penerimaan_anggaran' => 'required|numeric',
            'pembiayaan_penerimaan_realisasi' => 'required|numeric',
            'pembiayaan_pengeluaran_anggaran' => 'required|numeric',
            'pembiayaan_pengeluaran_realisasi' => 'required|numeric',
        ]);

        $apbde->update($validated);
        return redirect()->route('admin.apbdes.index')->with('success', 'Data APBDes berhasil diperbarui.');
    }

    public function destroy(Apbdes $apbde)
    {
        $apbde->delete();
        return redirect()->route('admin.apbdes.index')->with('success', 'Data APBDes berhasil dihapus.');
    }
}
