<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GaleriVideo;
use Illuminate\Http\Request;

class GaleriVideoController extends Controller
{
    public function index()
    {
        $videos = GaleriVideo::orderByDesc('tanggal')->paginate(15);
        return view('admin.galeri-video.index', compact('videos'));
    }

    public function create() { return view('admin.galeri-video.form'); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'      => 'required|string|max:500',
            'url_video'  => 'required|url',
            'keterangan' => 'nullable|string',
            'tanggal'    => 'nullable|date',
        ]);
        GaleriVideo::create($validated);
        return redirect()->route('admin.galeri-video.index')->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(GaleriVideo $galeriVideo)
    {
        return view('admin.galeri-video.form', compact('galeriVideo'));
    }

    public function update(Request $request, GaleriVideo $galeriVideo)
    {
        $validated = $request->validate([
            'judul'      => 'required|string|max:500',
            'url_video'  => 'required|url',
            'keterangan' => 'nullable|string',
            'tanggal'    => 'nullable|date',
        ]);
        $galeriVideo->update($validated);
        return redirect()->route('admin.galeri-video.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(GaleriVideo $galeriVideo)
    {
        $galeriVideo->delete();
        return redirect()->route('admin.galeri-video.index')->with('success', 'Video berhasil dihapus.');
    }
}
