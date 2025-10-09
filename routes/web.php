<?php

use App\Http\Controllers\Backend\AlbumKegiatanController;
use App\Http\Controllers\Backend\FrontendController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\PhotoController;
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
| Fokus utama: perbaikan route albumkegiatan + upload foto.
|
*/

// ======= FRONTEND ======= \\



Route::get('/', [App\Http\Controllers\Frontend\IndexController::class, 'index'])->name('home');
Route::get('/berita/search', [App\Http\Controllers\Frontend\IndexController::class, 'search'])->name('berita.search');

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
Route::view('/artikel', 'frontend.artikel')->name('artikel');
Route::view('/akademik', 'frontend.akademik')->name('akademik');
Route::view('/ekstrakulikuler', 'frontend.ekstrakulikuler')->name('ekstrakulikuler');
Route::view('/moto', 'frontend.moto')->name('moto');
Route::view('/penilaian', 'frontend.penilaian')->name('penilaian');
Route::view('/saran_mutu', 'frontend.saran_mutu')->name('saran_mutu');
Route::view('/struktur_kurikulum', 'frontend.struktur_kurikulum')->name('struktur_kurikulum');
Route::view('/tujuan', 'frontend.tujuan')->name('tujuan');
Route::view('/visi_misi', 'frontend.visi_misi')->name('visi_misi');
Route::view('/sambutan', 'frontend.sambutan')->name('sambutan');

// INDEX BERITA
Route::get('/index', fn() => view('frontend.index'))->name('index');

// ======= BACKEND (ADMIN) ======= \\
Auth::routes(['register' => false]);

// ======= BACKEND ======= \\
Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // PROFILE SETTINGS
    Route::resource('profile-settings', Backend\ProfileController::class);

    // SETTINGS
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('settings');
        Route::post('add-bank', [SettingController::class, 'addBank'])->name('settings.add.bank');
        Route::put('notifications/{id}', [SettingController::class, 'notifications']);
    });

    // CHANGE PASSWORD
    Route::put('profile-settings/change-password/{id}', [App\Http\Controllers\Backend\ProfileController::class, 'changePassword'])->name('profile.change-password');

    Route::resource('backend-footer', Backend\Website\FooterController::class);

    // ===== ADMIN =====
    Route::prefix('/')->middleware('role:Admin')->group(function () {
        // WEBSITE
        Route::resources([
            'backend-profile-sekolah' => Backend\Website\ProfilSekolahController::class,
            'backend-visimisi'        => Backend\Website\VisidanMisiController::class,
            'program-studi'           => Backend\Website\ProgramController::class,
            'backend-kegiatan'        => Backend\Website\KegiatanController::class,
            'backend-imageslider'     => Backend\Website\ImageSliderController::class,
            'backend-kepalasekolah'   => Backend\Website\KepalaSekolahController::class,
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

    // ===== GALERI KEGIATAN =====
});
Route::prefix('admin')->group(function () {
    Route::get('albumkegiatan', [AlbumKegiatanController::class, 'index'])->name('backend-albumkegiatan.index');
    Route::post('albumkegiatan', [AlbumKegiatanController::class, 'store'])->name('backend-albumkegiatan.store');
    Route::get('albumkegiatan/{album}/edit', [AlbumKegiatanController::class, 'edit'])->name('backend-albumkegiatan.edit');
    Route::put('albumkegiatan/{album}', [AlbumKegiatanController::class, 'update'])->name('backend-albumkegiatan.update');
    Route::delete('albumkegiatan/{album}', [AlbumKegiatanController::class, 'destroy'])->name('backend-albumkegiatan.destroy');

        // ✅ Upload & Hapus Foto
    Route::post('albumkegiatan/{albumkegiatan}/upload', [AlbumKegiatanController::class, 'uploadPhoto'])->name('backend-albumkegiatan.upload');
    Route::delete('albumkegiatan/foto/{photo}', [AlbumKegiatanController::class, 'deletePhoto'])->name('backend-albumkegiatan.deletephoto');

    
Route::get('albumkegiatan/{album}/photos', [PhotoController::class, 'show'])->name('backend-photos.show');
Route::post('albumkegiatan/{album}/photos', [PhotoController::class, 'store'])->name('backend-photos.store');
Route::delete('albumkegiatan/{album}/photos/{photo}', [PhotoController::class, 'destroy'])->name('backend-photos.destroy');
});

Route::get('/artikel', [FrontendController::class, 'artikel'])->name('frontend.artikel');

Route::get('/artikel', [FrontendController::class, 'artikel'])->name('artikel');