<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use Illuminate\Support\Facades\Storage;

class AlbumKegiatanController extends Controller
{
    public function index()
    {
        $albums = Album::latest()->get();
        return view('backend.website.content.albumkegiatan.index', compact('albums'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('nama', 'deskripsi');

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('uploads/albumkegiatan', 'public');
            $data['gambar'] = $path;
        }

        Album::create($data);
        return back()->with('success', 'Album berhasil ditambahkan!');
    }

    public function edit(Album $album)
    {
        return view('backend.website.content.albumkegiatan.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only('nama', 'deskripsi');

        if ($request->hasFile('gambar')) {
            // hapus gambar lama
            if ($album->gambar && Storage::disk('public')->exists($album->gambar)) {
                Storage::disk('public')->delete($album->gambar);
            }

            $path = $request->file('gambar')->store('uploads/albumkegiatan', 'public');
            $data['gambar'] = $path;
        }

        $album->update($data);
        return redirect()->route('backend-albumkegiatan.index')->with('success', 'Album berhasil diperbarui!');
    }

    public function destroy(Album $album)
    {
        if ($album->gambar && Storage::disk('public')->exists($album->gambar)) {
            Storage::disk('public')->delete($album->gambar);
        }

        $album->delete();
        return back()->with('success', 'Album berhasil dihapus!');
    }
     public function show($id)
    {
        $album = Album::with('photos')->findOrFail($id);
        return view('backend.website.content.albumkegiatan.detail', compact('album'));
    }
}
