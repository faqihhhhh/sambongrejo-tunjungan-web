<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\RunningText;
use App\Models\Profile;
use App\Models\News;
use App\Models\Agenda;

class HomeController extends Controller
{
    public function index()
    {
        $banners       = Banner::where('aktif', true)->orderBy('urutan')->get();
        $runningTexts  = RunningText::where('aktif', true)->orderBy('urutan')->get();
        $profile       = Profile::first();
        $beritaTerbaru = News::with('category')->published()->take(4)->get();
        $agendas       = Agenda::upcoming()->take(4)->get();

        return view('home', compact('banners', 'runningTexts', 'profile', 'beritaTerbaru', 'agendas'));
    }
}
