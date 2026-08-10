<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('urutan')->paginate(15);
        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'   => 'nullable|string|max:255',
            'gambar'  => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
            'urutan'  => 'nullable|integer',
            'aktif'   => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('banners', 'public');
        }

        $validated['aktif'] = $request->boolean('aktif', true);
        Banner::create($validated);

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banner.form', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'judul'   => 'nullable|string|max:255',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'urutan'  => 'nullable|integer',
            'aktif'   => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            if ($banner->gambar) {
                Storage::disk('public')->delete($banner->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('banners', 'public');
        }

        $validated['aktif'] = $request->boolean('aktif', true);
        $banner->update($validated);

        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->gambar) {
            Storage::disk('public')->delete($banner->gambar);
        }
        $banner->delete();
        return redirect()->route('admin.banner.index')->with('success', 'Banner berhasil dihapus.');
    }
}
