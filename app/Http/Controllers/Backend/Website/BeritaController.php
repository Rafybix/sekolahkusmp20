<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\KategoriBerita;
use Illuminate\Http\Request;
use App\Http\Requests\BeritaRequest;
use ErrorException;
use Session;
use Str;
use Auth;

class BeritaController extends Controller
{
    public function index()
    {
        $kategori = KategoriBerita::where('is_Active', '0')->get();
        $berita = Berita::all();
        return view('backend.website.content.berita.index', compact('kategori', 'berita'));
    }

    public function create()
    {
        $kategori = KategoriBerita::where('is_Active', '0')->get();
        return view('backend.website.content.berita.create', compact('kategori'));
    }

    public function store(BeritaRequest $request)
    {
        try {
            $image = $request->file('thumbnail');
            $nama_image = time() . "_" . $image->getClientOriginalName();
            $tujuan_upload = 'public/images/berita';
            $image->storeAs($tujuan_upload, $nama_image);

            $slug = Str::slug($request->title);

            $berita = new Berita;
            $berita->title = $request->title;
            $berita->slug = $slug;
            $berita->content = $request->content;
            $berita->kategori_id = $request->kategori_id;
            $berita->thumbnail = $nama_image;
            $berita->created_by = Auth::id();
            $berita->is_active = '0';
            $berita->save();

            Session::flash('success', 'Berita Berhasil ditambah!');
            return redirect()->route('backend-berita.index');
        } catch (ErrorException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function edit($id)
    {
        $kategori = KategoriBerita::where('is_Active', '0')->get();
        $berita = Berita::find($id);
        return view('backend.website.content.berita.edit', compact('kategori', 'berita'));
    }

    public function update(BeritaRequest $request, $id)
    {
        try {
            if ($request->thumbnail) {
                $image = $request->file('thumbnail');
                $nama_image = time() . "_" . $image->getClientOriginalName();
                $tujuan_upload = 'public/images/berita';
                $image->storeAs($tujuan_upload, $nama_image);
            }

            $berita = Berita::find($id);
            $berita->title = $request->title;
            $berita->slug = $berita->slug;
            $berita->content = $request->content;
            $berita->kategori_id = $request->kategori_id;
            $berita->thumbnail = $nama_image ?? $berita->thumbnail;
            $berita->is_active = $request->is_active;
            $berita->save();

            Session::flash('success', 'Berita Berhasil diupdate!');
            return redirect()->route('backend-berita.index');
        } catch (ErrorException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    /**
     * === FRONTEND BERITA ===
     */
    public function tampilFrontend()
    {
        // Ambil 5 berita terbaru
        $beritaTerbaru = Berita::where('is_active', '0')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Ambil berita lama setelah 5 terbaru
        $beritaLama = Berita::where('is_active', '0')
            ->orderBy('created_at', 'asc')
            ->skip(5)
            ->take(10)
            ->get();

        return view('frontend.welcome', compact('beritaTerbaru', 'beritaLama'));
    }

    public function destroy($id)
{
    // cari berita berdasarkan id
    $berita = \App\Models\Berita::findOrFail($id);

    // hapus file thumbnail kalau ada
    if ($berita->thumbnail && file_exists(storage_path('app/public/images/berita/' . $berita->thumbnail))) {
        unlink(storage_path('app/public/images/berita/' . $berita->thumbnail));
    }

    // hapus data dari database
    $berita->delete();

    // redirect kembali ke index dengan pesan sukses
    return redirect()->route('backend-berita.index')->with('success', 'Berita berhasil dihapus.');
}



   



}
