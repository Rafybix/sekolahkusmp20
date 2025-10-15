<?php

namespace App\Http\Controllers\Backend\Website; // tetap di sini

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Akademik;

class AkademikController extends Controller
{
    // ================= BACKEND =================
    public function index()
    {
        $akademiks = Akademik::latest()->get();
        return view('backend.website.content.akademik.index', compact('akademiks'));
    }

    public function create()
    {
        return view('backend.website.content.akademik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = $request->file('foto')->store('akademik', 'public');

        Akademik::create(['foto' => $path]);

        return redirect()->route('backend-akademik.index')
            ->with('success', 'Foto Program Akademik berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $akademik = Akademik::findOrFail($id);

        if ($akademik->foto && file_exists(storage_path('app/public/'.$akademik->foto))) {
            unlink(storage_path('app/public/'.$akademik->foto));
        }

        $akademik->delete();

        return back()->with('success', 'Foto Program Akademik berhasil dihapus');
    }

    // ================= FRONTEND =================
    public function frontendIndex()
    {
        $fotos = Akademik::latest()->get();
        return view('frontend.akademik', compact('fotos'));
    }
}
