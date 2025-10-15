<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kurikulum;
use Illuminate\Support\Facades\Storage;

class KurikulumController extends Controller
{
    /** =====================
     * ADMIN: Tampilkan semua foto kurikulum
     * ====================== */
    public function index()
    {
        $kurikulums = Kurikulum::latest()->get();
        return view('backend.website.content.kurikulum.index', compact('kurikulums'));

    }

    /** =====================
     * ADMIN: Form tambah foto
     * ====================== */
    public function create()
    {
        return view('backend.website.content.kurikulum.create');

    }

    /** =====================
     * ADMIN: Simpan foto
     * ====================== */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $path = $request->file('foto')->store('kurikulum', 'public');

        Kurikulum::create(['foto' => $path]);

        return redirect()->route('backend-kurikulum.index')->with('success', 'Foto kurikulum berhasil diunggah.');

    }

    public function destroy($id)
    {
        $kurikulum = Kurikulum::findOrFail($id);

        // Hapus file dari storage
        if ($kurikulum->foto && Storage::disk('public')->exists($kurikulum->foto)) {
            Storage::disk('public')->delete($kurikulum->foto);
        }

        // Hapus record dari database
        $kurikulum->delete();

        return redirect()->route('backend-kurikulum.index')->with('success', 'Foto berhasil dihapus.');
    }

    /** =====================
     * FRONTEND: Tampilkan semua foto ke pengguna
     * ====================== */
     public function tampilkan()
    {
        $kurikulums = Kurikulum::latest()->get();
        return view('frontend.struktur_kurikulum', compact('kurikulums'));
    }

}
