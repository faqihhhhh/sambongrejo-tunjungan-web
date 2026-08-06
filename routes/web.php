<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PotensiController;
use App\Http\Controllers\NewsPublicController;
use App\Http\Controllers\AgendaPublicController;
use App\Http\Controllers\HukumPublicController;
use App\Http\Controllers\LayananPublicController;
use App\Http\Controllers\PpidPublicController;
use App\Http\Controllers\GaleriPublicController;
use App\Http\Controllers\BlangkoPublicController;
use App\Http\Controllers\LinkTerkaitPublicController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\DataDesaPublicController;

// ──────────────────────────────────────────────
//  HALAMAN PUBLIK
// ──────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/profil/sejarah', [ProfilController::class, 'sejarah'])->name('profil.sejarah');
Route::get('/profil/visi-misi', [ProfilController::class, 'visiMisi'])->name('profil.visimisi');
Route::get('/profil/struktur', [ProfilController::class, 'struktur'])->name('profil.struktur');

Route::get('/potensi/{kategori}', [PotensiController::class, 'show'])->name('potensi.show');
Route::get('/potensi', [PotensiController::class, 'index'])->name('potensi');

Route::get('/berita', [NewsPublicController::class, 'index'])->name('berita');
Route::get('/berita/{slug}', [NewsPublicController::class, 'show'])->name('berita.show');

Route::get('/agenda', [AgendaPublicController::class, 'index'])->name('agenda');

Route::get('/produk-hukum', [HukumPublicController::class, 'index'])->name('hukum');
Route::get('/produk-hukum/{kategori}', [HukumPublicController::class, 'byKategori'])->name('hukum.kategori');

Route::get('/layanan', [LayananPublicController::class, 'index'])->name('layanan');
Route::get('/layanan/{id}', [LayananPublicController::class, 'show'])->name('layanan.show');

Route::get('/ppid', [PpidPublicController::class, 'index'])->name('ppid');

Route::get('/galeri', [GaleriPublicController::class, 'index'])->name('galeri');

Route::get('/unduhan', [BlangkoPublicController::class, 'index'])->name('unduhan');

Route::get('/link-terkait', [LinkTerkaitPublicController::class, 'index'])->name('link-terkait');

Route::get('/apbdes', [DataDesaPublicController::class, 'apbdes'])->name('apbdes');
Route::get('/idm', [DataDesaPublicController::class, 'idm'])->name('idm');
Route::get('/statistik', [DataDesaPublicController::class, 'statistik'])->name('statistik');

Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');

// ──────────────────────────────────────────────
//  PANEL ADMIN (prefix: /admin)
// ──────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Banner
    Route::resource('banner', \App\Http\Controllers\Admin\BannerController::class);

    // Running Text
    Route::resource('running-text', \App\Http\Controllers\Admin\RunningTextController::class);

    // Profil Desa
    Route::get('profil', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profil.edit');
    Route::put('profil', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profil.update');

    // Struktur Pemerintahan
    Route::resource('struktur', \App\Http\Controllers\Admin\StrukturController::class);

    // Potensi Desa
    Route::resource('potensi', \App\Http\Controllers\Admin\PotensiDesaController::class);

    // Kategori Berita & Berita
    Route::resource('news-category', \App\Http\Controllers\Admin\NewsCategoryController::class);
    Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);

    // Agenda
    Route::resource('agenda', \App\Http\Controllers\Admin\AgendaController::class);

    // Produk Hukum
    Route::resource('hukum-category', \App\Http\Controllers\Admin\HukumCategoryController::class);
    Route::resource('hukum', \App\Http\Controllers\Admin\HukumDocumentController::class);

    // Layanan
    Route::resource('layanan-category', \App\Http\Controllers\Admin\LayananCategoryController::class);
    Route::resource('layanan', \App\Http\Controllers\Admin\LayananController::class);

    // PPID
    Route::resource('ppid-category', \App\Http\Controllers\Admin\PpidCategoryController::class);
    Route::resource('ppid', \App\Http\Controllers\Admin\PpidItemController::class);

    // Galeri
    Route::resource('galeri-foto', \App\Http\Controllers\Admin\GaleriFotoController::class);
    Route::resource('galeri-video', \App\Http\Controllers\Admin\GaleriVideoController::class);

    // Blangko/Unduhan
    Route::resource('blangko', \App\Http\Controllers\Admin\BlangkoController::class);

    // Link Terkait
    Route::resource('link-terkait', \App\Http\Controllers\Admin\LinkTerkaitController::class);

    // Data Desa (APBDes, IDM, Statistik)
    Route::resource('apbdes', \App\Http\Controllers\Admin\ApbdesController::class);
    Route::resource('idm', \App\Http\Controllers\Admin\IdmController::class);
    Route::resource('statistik', \App\Http\Controllers\Admin\StatistikPendudukController::class);

    // User Management (super_admin only)
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
});

// ──────────────────────────────────────────────
//  AUTH ROUTES (Breeze - hanya untuk admin)
//  Redirect dashboard Breeze ke /admin
// ──────────────────────────────────────────────
require __DIR__.'/auth.php';
