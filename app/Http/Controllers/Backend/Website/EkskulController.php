<?php

namespace App\Http\Controllers\Backend\Website\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ekskul;
use Illuminate\Support\Facades\Storage;

class EkskulController extends Controller
{
    public function index()
    {
        $ekskul = Ekskul::all();
        return view('backend.ekskul.index', compact('ekskul'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $ekskul = Ekskul::findOrFail($id);

        if ($ekskul->foto && Storage::disk('public')->exists($ekskul->foto)) {
            Storage::disk('public')->delete($ekskul->foto);
        }

        $path = $request->file('foto')->store('ekskul', 'public');
        $ekskul->update(['foto' => $path]);

        return redirect()->back()->with('success', 'Gambar ekskul berhasil diperbarui');
    }
}
