<?php

use App\Http\Controllers\Backend\AlbumKegiatanController;
use App\Http\Controllers\Backend\PhotoController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\Website\KategoriBeritaController;
use App\Http\Controllers\Backend\Website\AkademikController;
use Backend\ProfileController;

use App\Http\Controllers\Frontend\IndexController;

use App\Http\Controllers\Frontend\MenuController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Penilaian;
use App\Http\Controllers\Backend\Website\PenilaianController;

use App\Http\Controllers\Backend\Website\KurikulumController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ======= FRONTEND ======= \\
Route::get('/', [IndexController::class, 'index'])->name('home');
Route::get('/berita/search', [IndexController::class, 'search'])->name('berita.search');
Route::get('/ajax/search', function (Request $request) {
    $query = $request->q;
    $data = [];
    if ($query) {
        $data = Berita::where('title', 'like', "%{$query}%")
            ->where('is_active', '0')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get()
            ->map(fn($item) => [
                'title' => $item->title,
                'slug' => $item->slug,
                'thumbnail' => $item->thumbnail,
                'tanggal' => \Carbon\Carbon::parse($item->created_at)->translatedFormat('j F Y'),
            ]);
    }
    return response()->json($data);
})->name('berita.search.ajax');

// Profil & Visi Misi
Route::get('profile-sekolah', [IndexController::class, 'profileSekolah'])->name('profile.sekolah');
Route::get('visi-dan-misi', [IndexController::class, 'visimisi'])->name('visimisi.sekolah');

// Program & Kegiatan
Route::get('program/{slug}', [MenuController::class, 'programStudi']);
Route::get('kegiatan/{slug}', [MenuController::class, 'kegiatan']);

// Berita & Event
Route::get('berita', [IndexController::class, 'berita'])->name('berita');
Route::get('berita/{slug}', [IndexController::class, 'detailBerita'])->name('detail.berita');
Route::get('event', [IndexController::class, 'events'])->name('event');
Route::get('event/{slug}', [IndexController::class, 'detailEvent'])->name('detail.event');

// Halaman Statis
Route::view('/artikel', 'frontend.artikel')->name('artikel');
Route::view('/akademik', 'frontend.akademik')->name('akademik');
Route::view('/ekstrakulikuler', 'frontend.ekstrakulikuler')->name('ekstrakulikuler');
Route::view('/moto', 'frontend.moto')->name('moto');
Route::view('/penilaian', 'frontend.penilaian')->name('penilaian.front');
Route::view('/saran_mutu', 'frontend.saran_mutu')->name('saran_mutu');

Route::view('/tujuan', 'frontend.tujuan')->name('tujuan');
Route::view('/visi_misi', 'frontend.visi_misi')->name('visi_misi');
Route::view('/sambutan', 'frontend.sambutan')->name('sambutan');
Route::view('/hubungi', 'frontend.hubungi')->name('hubungi');
Route::view('/index', 'frontend.index')->name('index');
// Kontak
Route::post('/kirim-pesan', [KontakController::class, 'kirimPesan'])->name('kirim.pesan');

// ======= BACKEND (ADMIN) ======= \\
Auth::routes(['register' => false]);

Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/admin/home', [HomeController::class, 'home'])->name('admin.home');

    // Profile Settings
    Route::resource('profile-settings', ProfileController::class);
    Route::put('profile-settings/change-password/{id}', [ProfileController::class, 'changePassword'])->name('profile.change-password');

    // Settings
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('settings');
        Route::post('add-bank', [SettingController::class, 'addBank'])->name('settings.add.bank');
        Route::put('notifications/{id}', [SettingController::class, 'notifications']);
    });

    // ===== ADMIN WEBSITE =====
    Route::prefix('admin')->middleware('role:Admin')->group(function () {

        Route::resources([
            'backend-profile-sekolah' => Backend\Website\ProfilSekolahController::class,
            'backend-visimisi'        => Backend\Website\VisidanMisiController::class,
            'program-studi'           => Backend\Website\ProgramController::class,
            'backend-kegiatan'        => Backend\Website\KegiatanController::class,
            'backend-imageslider'     => Backend\Website\ImageSliderController::class,
            'backend-kepalasekolah'   => Backend\Website\KepalaSekolahController::class,
            'backend-video'           => Backend\Website\VideoController::class,
            'backend-kategori-berita' => Backend\Website\KategoriBeritaController::class,
            'backend-berita'          => Backend\Website\BeritaController::class,
            'backend-event'           => Backend\Website\EventsController::class,
            'penilaian'               => Backend\Website\PenilaianController::class, // ✅ resource penilaian
            'backend-footer'          => Backend\Website\FooterController::class,
        ]);

        // Tambahkan Kurikulum hanya index, create, store, destroy
Route::resource('backend-kurikulum', Backend\Website\KurikulumController::class)
    ->only(['index', 'create', 'store', 'destroy']);


        // Hapus kategori berita
        Route::delete('backend-kategori-berita/hapus/{id}', [KategoriBeritaController::class, 'hapus'])
            ->name('backend-kategori-berita.hapus');
    });

    // ===== GALERI KEGIATAN =====
    Route::prefix('admin')->group(function () {
        Route::get('albumkegiatan', [AlbumKegiatanController::class, 'index'])->name('backend-albumkegiatan.index');
        Route::post('albumkegiatan', [AlbumKegiatanController::class, 'store'])->name('backend-albumkegiatan.store');
        Route::get('albumkegiatan/{album}/edit', [AlbumKegiatanController::class, 'edit'])->name('backend-albumkegiatan.edit');
        Route::put('albumkegiatan/{album}', [AlbumKegiatanController::class, 'update'])->name('backend-albumkegiatan.update');
        Route::delete('albumkegiatan/{album}', [AlbumKegiatanController::class, 'destroy'])->name('backend-albumkegiatan.destroy');

        // Upload & Hapus Foto
        Route::post('albumkegiatan/{album}/upload', [AlbumKegiatanController::class, 'uploadPhoto'])->name('backend-albumkegiatan.upload');
        Route::delete('albumkegiatan/foto/{photo}', [AlbumKegiatanController::class, 'deletePhoto'])->name('backend-albumkegiatan.deletephoto');

        Route::get('albumkegiatan/{album}/photos', [PhotoController::class, 'show'])->name('backend-photos.show');
        Route::post('albumkegiatan/{album}/photos', [PhotoController::class, 'store'])->name('backend-photos.store');
        Route::delete('albumkegiatan/{album}/photos/{photo}', [PhotoController::class, 'destroy'])->name('backend-photos.destroy');

        Route::get('albumkegiatan/{id}/detail', [AlbumKegiatanController::class, 'showAlbum'])->name('backend-albumkegiatan.detail');
    });
});

Route::get('/penilaian', [PenilaianController::class, 'publicIndex'])->name('penilaian.front');

Route::get('/artikel', [AlbumKegiatanController::class, 'frontendIndex'])->name('artikel');

// Halaman daftar album
Route::get('/artikel', [AlbumKegiatanController::class, 'frontendIndex'])->name('artikel');

// Halaman detail album
Route::get('/album/{id}', [AlbumKegiatanController::class, 'showAlbum'])->name('album.show');

Route::get('albumkegiatan/{id}/detail', [AlbumKegiatanController::class, 'show'])->name('backend-albumkegiatan.detail');

Route::get('/album/{id}', [AlbumKegiatanController::class, 'show'])->name('album.show');

Route::get('/struktur-kurikulum', [KurikulumController::class, 'tampilkan'])
    ->name('frontend.struktur-kurikulum');


// program akademik
Route::resource('backend-akademik', Backend\Website\AkademikController::class)
    ->only(['index', 'create', 'store', 'destroy']);

Route::get('/akademik', [AkademikController::class, 'frontendIndex'])->name('akademik');

Route::prefix('backend')->name('backend-')->group(function () {
    Route::resource('penilaian', PenilaianController::class);
});