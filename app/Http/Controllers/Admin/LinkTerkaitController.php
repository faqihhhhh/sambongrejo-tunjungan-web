<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LinkTerkait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LinkTerkaitController extends Controller
{
    public function index()
    {
        $links = LinkTerkait::orderBy('urutan')->get();
        return view('admin.link-terkait.index', compact('links'));
    }

    public function create() { return view('admin.link-terkait.form'); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'   => 'required|string|max:255',
            'url'    => 'required|url',
            'logo'   => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:1024',
            'urutan' => 'nullable|integer',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('link-terkait', 'public');
        }

        LinkTerkait::create($validated);
        return redirect()->route('admin.link-terkait.index')->with('success', 'Link berhasil ditambahkan.');
    }

    public function edit(LinkTerkait $linkTerkait)
    {
        return view('admin.link-terkait.form', compact('linkTerkait'));
    }

    public function update(Request $request, LinkTerkait $linkTerkait)
    {
        $validated = $request->validate([
            'nama'   => 'required|string|max:255',
            'url'    => 'required|url',
            'logo'   => 'nullable|image|mimes:jpg,jpeg,png,webp,svg|max:1024',
            'urutan' => 'nullable|integer',
        ]);

        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($linkTerkait->logo);
            $validated['logo'] = $request->file('logo')->store('link-terkait', 'public');
        }

        $linkTerkait->update($validated);
        return redirect()->route('admin.link-terkait.index')->with('success', 'Link berhasil diperbarui.');
    }

    public function destroy(LinkTerkait $linkTerkait)
    {
        Storage::disk('public')->delete($linkTerkait->logo);
        $linkTerkait->delete();
        return redirect()->route('admin.link-terkait.index')->with('success', 'Link berhasil dihapus.');
    }
}
