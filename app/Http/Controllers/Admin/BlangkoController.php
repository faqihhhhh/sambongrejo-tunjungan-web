<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blangko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlangkoController extends Controller
{
    public function index()
    {
        $blangkos = Blangko::latest()->paginate(15);
        return view('admin.blangko.index', compact('blangkos'));
    }

    public function create() { return view('admin.blangko.form'); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'       => 'required|string|max:500',
            'file'       => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'keterangan' => 'nullable|string',
        ]);

        $uploadedFile = $request->file('file');
        $validated['file'] = $uploadedFile->store('blangko', 'public');
        $validated['ukuran_file'] = round($uploadedFile->getSize() / 1024, 1) . ' KB';

        Blangko::create($validated);
        return redirect()->route('admin.blangko.index')->with('success', 'File berhasil diunggah.');
    }

    public function edit(Blangko $blangko)
    {
        return view('admin.blangko.form', compact('blangko'));
    }

    public function update(Request $request, Blangko $blangko)
    {
        $validated = $request->validate([
            'nama'       => 'required|string|max:500',
            'file'       => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'keterangan' => 'nullable|string',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($blangko->file);
            $uploadedFile = $request->file('file');
            $validated['file'] = $uploadedFile->store('blangko', 'public');
            $validated['ukuran_file'] = round($uploadedFile->getSize() / 1024, 1) . ' KB';
        }

        $blangko->update($validated);
        return redirect()->route('admin.blangko.index')->with('success', 'File berhasil diperbarui.');
    }

    public function destroy(Blangko $blangko)
    {
        Storage::disk('public')->delete($blangko->file);
        $blangko->delete();
        return redirect()->route('admin.blangko.index')->with('success', 'File berhasil dihapus.');
    }
}
