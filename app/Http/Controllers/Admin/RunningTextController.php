<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RunningText;
use Illuminate\Http\Request;

class RunningTextController extends Controller
{
    public function index()
    {
        $items = RunningText::orderBy('urutan')->paginate(15);
        return view('admin.running-text.index', compact('items'));
    }

    public function create()
    {
        return view('admin.running-text.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'teks'   => 'required|string',
            'urutan' => 'nullable|integer',
            'aktif'  => 'nullable|boolean',
        ]);
        $validated['aktif'] = $request->boolean('aktif', true);
        RunningText::create($validated);
        return redirect()->route('admin.running-text.index')->with('success', 'Running text berhasil ditambahkan.');
    }

    public function edit(RunningText $runningText)
    {
        return view('admin.running-text.form', ['item' => $runningText]);
    }

    public function update(Request $request, RunningText $runningText)
    {
        $validated = $request->validate([
            'teks'   => 'required|string',
            'urutan' => 'nullable|integer',
            'aktif'  => 'nullable|boolean',
        ]);
        $validated['aktif'] = $request->boolean('aktif', true);
        $runningText->update($validated);
        return redirect()->route('admin.running-text.index')->with('success', 'Running text berhasil diperbarui.');
    }

    public function destroy(RunningText $runningText)
    {
        $runningText->delete();
        return redirect()->route('admin.running-text.index')->with('success', 'Running text berhasil dihapus.');
    }
}
