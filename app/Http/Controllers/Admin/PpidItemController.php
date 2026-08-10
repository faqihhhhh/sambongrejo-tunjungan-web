<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpidItem;
use App\Models\PpidCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PpidItemController extends Controller
{
    public function index()
    {
        $items = PpidItem::with('category')->orderByDesc('tanggal')->paginate(15);
        return view('admin.ppid.index', compact('items'));
    }

    public function create()
    {
        $categories = PpidCategory::orderBy('urutan')->get();
        return view('admin.ppid.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ppid_category_id' => 'required|exists:ppid_categories,id',
            'judul'            => 'required|string|max:500',
            'isi'              => 'nullable|string',
            'file'             => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'tanggal'          => 'nullable|date',
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('ppid', 'public');
        }

        PpidItem::create($validated);
        return redirect()->route('admin.ppid.index')->with('success', 'Item PPID berhasil ditambahkan.');
    }

    public function edit(PpidItem $ppid)
    {
        $categories = PpidCategory::orderBy('urutan')->get();
        return view('admin.ppid.form', compact('ppid', 'categories'));
    }

    public function update(Request $request, PpidItem $ppid)
    {
        $validated = $request->validate([
            'ppid_category_id' => 'required|exists:ppid_categories,id',
            'judul'            => 'required|string|max:500',
            'isi'              => 'nullable|string',
            'file'             => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'tanggal'          => 'nullable|date',
        ]);

        if ($request->hasFile('file')) {
            if ($ppid->file) {
                Storage::disk('public')->delete($ppid->file);
            }
            $validated['file'] = $request->file('file')->store('ppid', 'public');
        }

        $ppid->update($validated);
        return redirect()->route('admin.ppid.index')->with('success', 'Item PPID berhasil diperbarui.');
    }

    public function destroy(PpidItem $ppid)
    {
        if ($ppid->file) {
            Storage::disk('public')->delete($ppid->file);
        }
        $ppid->delete();
        return redirect()->route('admin.ppid.index')->with('success', 'Item PPID berhasil dihapus.');
    }
}
