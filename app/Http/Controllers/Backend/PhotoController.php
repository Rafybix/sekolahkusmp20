<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    // Tampilkan foto di album
    public function show($album_id)
    {
        $album = Album::with('photos')->findOrFail($album_id);
        return view('backend.website.content.albumkegiatan.photos', compact('album'));
    }

    // Upload foto baru
    public function store(Request $request, $album_id)
    {
        $request->validate([
            'file_path' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        $album = Album::findOrFail($album_id);

        $path = $request->file('file_path')->store('uploads/album_photos', 'public');

        Photo::create([
            'album_id' => $album->id,
            'file_path' => $path,
            'caption' => $request->caption,
        ]);

        return back()->with('success', 'Foto berhasil diunggah!');
    }

    // Hapus foto
    public function destroy($album_id, $photo_id)
    {
        $photo = Photo::where('album_id', $album_id)->findOrFail($photo_id);

        if ($photo->file_path && Storage::disk('public')->exists($photo->file_path)) {
            Storage::disk('public')->delete($photo->file_path);
        }

        $photo->delete();
        return back()->with('success', 'Foto berhasil dihapus!');
    }
}
