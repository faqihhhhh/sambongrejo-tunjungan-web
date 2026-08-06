<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::first() ?? new Profile();
        return view('admin.profil.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_kades'       => 'required|string|max:255',
            'jabatan_kades'    => 'nullable|string|max:255',
            'foto_kades'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sambutan_singkat' => 'nullable|string',
            'sambutan_lengkap' => 'nullable|string',
            'sejarah'          => 'nullable|string',
            'visi'             => 'nullable|string',
            'misi'             => 'nullable|string',
            'luas_wilayah'     => 'nullable|string|max:100',
            'jumlah_penduduk'  => 'nullable|string|max:100',
            'jumlah_kk'        => 'nullable|string|max:100',
            'kode_pos'         => 'nullable|string|max:20',
            'alamat_kantor'    => 'nullable|string|max:500',
            'telepon'          => 'nullable|string|max:50',
            'email'            => 'nullable|email|max:255',
            'maps_embed_url'   => 'nullable|string',
            'jam_pelayanan'    => 'nullable|string|max:100',
            'jam_istirahat'    => 'nullable|string|max:100',
        ]);

        $profile = Profile::first() ?? new Profile();

        if ($request->hasFile('foto_kades')) {
            if ($profile->foto_kades) {
                Storage::disk('public')->delete($profile->foto_kades);
            }
            $validated['foto_kades'] = $request->file('foto_kades')->store('profil', 'public');
        }

        $profile->fill($validated)->save();

        return redirect()->route('admin.profil.edit')->with('success', 'Profil desa berhasil diperbarui.');
    }
}
