<?php

namespace App\Http\Controllers;

use App\Models\Profile;

class KontakController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        return view('kontak.index', compact('profile'));
    }
}
