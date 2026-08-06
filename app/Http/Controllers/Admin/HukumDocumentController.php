<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HukumDocument;
use App\Models\HukumCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HukumDocumentController extends Controller
{
    public function index()
    {
        $documents = HukumDocument::with('category')->orderByDesc('tanggal')->paginate(15);
        return view('admin.hukum.index', compact('documents'));
    }

    public function create()
    {
        $categories = HukumCategory::all();
        return view('admin.hukum.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hukum_category_id' => 'required|exists:hukum_categories,id',
            'judul'             => 'required|string|max:500',
            'nomor_dokumen'     => 'nullable|string|max:255',
            'file_pdf'          => 'required|file|mimes:pdf|max:10240',
            'tanggal'           => 'required|date',
            'keterangan'        => 'nullable|string',
        ]);

        $validated['file_pdf'] = $request->file('file_pdf')->store('hukum', 'public');
        HukumDocument::create($validated);
        return redirect()->route('admin.hukum.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function edit(HukumDocument $hukum)
    {
        $categories = HukumCategory::all();
        return view('admin.hukum.form', compact('hukum', 'categories'));
    }

    public function update(Request $request, HukumDocument $hukum)
    {
        $validated = $request->validate([
            'hukum_category_id' => 'required|exists:hukum_categories,id',
            'judul'             => 'required|string|max:500',
            'nomor_dokumen'     => 'nullable|string|max:255',
            'file_pdf'          => 'nullable|file|mimes:pdf|max:10240',
            'tanggal'           => 'required|date',
            'keterangan'        => 'nullable|string',
        ]);

        if ($request->hasFile('file_pdf')) {
            Storage::disk('public')->delete($hukum->file_pdf);
            $validated['file_pdf'] = $request->file('file_pdf')->store('hukum', 'public');
        }

        $hukum->update($validated);
        return redirect()->route('admin.hukum.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy(HukumDocument $hukum)
    {
        Storage::disk('public')->delete($hukum->file_pdf);
        $hukum->delete();
        return redirect()->route('admin.hukum.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
