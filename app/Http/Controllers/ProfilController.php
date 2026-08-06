<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\StrukturPemerintahan;

class ProfilController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        return view('profil.index', compact('profile'));
    }

    public function sejarah()
    {
        $profile = Profile::first();
        return view('profil.sejarah', compact('profile'));
    }

    public function visiMisi()
    {
        $profile = Profile::first();
        return view('profil.visi-misi', compact('profile'));
    }

    public function struktur()
    {
        $profile = Profile::first();
        $strukturs = StrukturPemerintahan::orderBy('urutan')->get();
        return view('profil.struktur', compact('profile', 'strukturs'));
    }
}
