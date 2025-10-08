<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\KepalaSekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\View;


class KepalaSekolahController extends Controller
{
    public function index()
    {
        $data = KepalaSekolah::latest()->get();
        return view('backend.website.content.kepalasekolah.index', compact('data'));
    }

    public function create()
    {
        return view('backend.website.content.kepalasekolah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'sambutan' => 'nullable|string',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('images/kepala_sekolah', 'public');
        }

        KepalaSekolah::create($validated);
        return redirect()->route('backend-kepalasekolah.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = KepalaSekolah::findOrFail($id);
        return view('backend.website.content.kepalasekolah.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = KepalaSekolah::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'sambutan' => 'nullable|string',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'youtube' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('foto')) {
            if ($item->foto && Storage::disk('public')->exists($item->foto)) {
                Storage::disk('public')->delete($item->foto);
            }
            $validated['foto'] = $request->file('foto')->store('images/kepala_sekolah', 'public');
        }

        $item->update($validated);
        return redirect()->route('backend-kepalasekolah.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = KepalaSekolah::findOrFail($id);
        if ($item->foto && Storage::disk('public')->exists($item->foto)) {
            Storage::disk('public')->delete($item->foto);
        }
        $item->delete();
        return redirect()->route('backend-kepalasekolah.index')->with('success', 'Data berhasil dihapus!');
    }

public function boot(): void
{
    // Kirim data $kepala ke semua view leftbar
    View::composer('frontend.template.leftbar', function ($view) {
        $kepala = KepalaSekolah::latest()->first();
        $view->with('kepala', $kepala);
    });
}

}
