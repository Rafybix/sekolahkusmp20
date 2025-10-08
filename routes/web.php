<?php

use App\Http\Controllers\Backend\SettingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Berita;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Semua route di sini udah diperbaiki tanpa ngubah struktur aslinya.
| Gua cuma benerin view path, penamaan, dan syntax.
|
*/



// ======= FRONTEND ======= \\



Route::get('/', [App\Http\Controllers\Frontend\IndexController::class, 'index'])->name('home');
Route::get('/berita/search', [App\Http\Controllers\Frontend\IndexController::class, 'search'])
    ->name('berita.search');


    Route::get('/ajax/search', function (Request $request) {
    $query = $request->q;
    $data = [];

    if ($query) {
        $data = Berita::where('title', 'like', "%{$query}%")
            ->where('is_active', '0')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get()
            ->map(function ($item) {
                return [
                    'title' => $item->title,
                    'slug' => $item->slug,
                    'thumbnail' => $item->thumbnail,
                    'tanggal' => \Carbon\Carbon::parse($item->created_at)->translatedFormat('j F Y'),
                ];
            });
    }

    return response()->json($data);
})->name('berita.search');



// ===== MENU PROFIL SEKOLAH =====
Route::get('profile-sekolah', [App\Http\Controllers\Frontend\IndexController::class, 'profileSekolah'])->name('profile.sekolah');

// VISI & MISI
Route::get('visi-dan-misi', [App\Http\Controllers\Frontend\IndexController::class, 'visimisi'])->name('visimisi.sekolah');

// ===== PROGRAM STUDI & KEGIATAN =====
Route::get('program/{slug}', [App\Http\Controllers\Frontend\MenuController::class, 'programStudi']);
Route::get('kegiatan/{slug}', [App\Http\Controllers\Frontend\MenuController::class, 'kegiatan']);

// ===== BERITA =====
Route::get('berita', [App\Http\Controllers\Frontend\IndexController::class, 'berita'])->name('berita');
Route::get('berita/{slug}', [App\Http\Controllers\Frontend\IndexController::class, 'detailBerita'])->name('detail.berita');

// ===== EVENT =====
Route::get('event', [App\Http\Controllers\Frontend\IndexController::class, 'events'])->name('event');
Route::get('event/{slug}', [App\Http\Controllers\Frontend\IndexController::class, 'detailEvent'])->name('detail.event');

// ===== HALAMAN TAMBAHAN (STATIC PAGE) =====
Route::get('/artikel', fn() => view('frontend.artikel'))->name('artikel');
Route::get('/akademik', fn() => view('frontend.akademik'))->name('akademik');
Route::get('/ekstrakulikuler', fn() => view('frontend.ekstrakulikuler'))->name('ekstrakulikuler');
Route::get('/moto', fn() => view('frontend.moto'))->name('moto');
Route::get('/penilaian', fn() => view('frontend.penilaian'))->name('penilaian');
Route::get('/saran_mutu', fn() => view('frontend.saran_mutu'))->name('saran_mutu');
Route::get('/struktur_kurikulum', fn() => view('frontend.struktur_kurikulum'))->name('struktur_kurikulum');
Route::get('/tujuan', fn() => view('frontend.tujuan'))->name('tujuan');
Route::get('/visi_misi', fn() => view('frontend.visi_misi'))->name('visi_misi');
Route::get('/sambutan', function () {
    return view('frontend.sambutan'); // tampilkan file artikel.blade.php
})->name('sambutan');

// INDEX BERITA
Route::get('/index', fn() => view('frontend.index'))->name('index');

Auth::routes(['register' => false]);

// ======= BACKEND ======= \\
Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // PROFILE SETTINGS
    Route::resource('profile-settings', Backend\ProfileController::class);

    // SETTINGS
    Route::prefix('settings')->group(function () {
        Route::get('/', [App\Http\Controllers\Backend\SettingController::class, 'index'])->name('settings');
        Route::post('add-bank', [App\Http\Controllers\Backend\SettingController::class, 'addBank'])->name('settings.add.bank');
        Route::put('notifications/{id}', [SettingController::class, 'notifications']);
    });

    // CHANGE PASSWORD
    Route::put('profile-settings/change-password/{id}', [App\Http\Controllers\Backend\ProfileController::class, 'changePassword'])->name('profile.change-password');

    // ===== ADMIN =====
    Route::prefix('/')->middleware('role:Admin')->group(function () {
        // WEBSITE
        Route::resources([
            'backend-profile-sekolah' => Backend\Website\ProfilSekolahController::class,
            'backend-visimisi'        => Backend\Website\VisidanMisiController::class,
            'program-studi'           => Backend\Website\ProgramController::class,
            'backend-kegiatan'        => Backend\Website\KegiatanController::class,
            'backend-imageslider'     => Backend\Website\ImageSliderController::class,
            'backend-kepalasekolah'     => Backend\Website\KepalaSekolahController::class,
            'backend-about'           => Backend\Website\AboutController::class,
            'backend-video'           => Backend\Website\VideoController::class,
            'backend-kategori-berita' => Backend\Website\KategoriBeritaController::class,
            'backend-berita'          => Backend\Website\BeritaController::class,
            'backend-event'           => Backend\Website\EventsController::class,
            'backend-footer'          => Backend\Website\FooterController::class,
        ]);

        // PENGGUNA
        Route::resources([
            'backend-pengguna-pengajar'  => Backend\Pengguna\PengajarController::class,
            'backend-pengguna-staf'      => Backend\Pengguna\StafController::class,
            'backend-pengguna-murid'     => Backend\Pengguna\MuridController::class,
            'backend-pengguna-ppdb'      => Backend\Pengguna\PPDBController::class,
            'backend-pengguna-perpus'    => Backend\Pengguna\PerpusController::class,
            'backend-pengguna-bendahara' => Backend\Pengguna\BendaharaController::class,
        ]);
    });
});
