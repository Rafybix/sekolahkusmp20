<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Penilaian;

class PenilaianController extends Controller
{
    public function index()
    {
        $penilaians = Penilaian::latest()->get();
        return view('backend.website.content.penilaian.index', compact('penilaians'));
    }

    public function create()
    {
        return view('backend.website.content.penilaian.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'file_upload' => 'nullable|file|max:10240', // semua tipe file, max 10MB
            'link' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file_upload')) {
            $validated['file_upload'] = $request->file('file_upload')->store('penilaian', 'public');
        }

        Penilaian::create($validated);

        return redirect()->route('penilaian.index')
                         ->with('success', 'Penilaian berhasil ditambahkan.');
    }

    public function edit(Penilaian $penilaian)
    {
        return view('backend.website.content.penilaian.edit', compact('penilaian'));
    }

    public function update(Request $request, Penilaian $penilaian)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'file_upload' => 'nullable|file|max:10240',
            'link' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('file_upload')) {
            if ($penilaian->file_upload && Storage::disk('public')->exists($penilaian->file_upload)) {
                Storage::disk('public')->delete($penilaian->file_upload);
            }
            $validated['file_upload'] = $request->file('file_upload')->store('penilaian', 'public');
        }

        $penilaian->update($validated);

        return redirect()->route('penilaian.index')
                         ->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function destroy(Penilaian $penilaian)
    {
        if ($penilaian->file_upload && Storage::disk('public')->exists($penilaian->file_upload)) {
            Storage::disk('public')->delete($penilaian->file_upload);
        }

        $penilaian->delete();

        return redirect()->route('penilaian.index')
                         ->with('success', 'Penilaian berhasil dihapus.');
    }

    // Frontend public
    public function publicIndex()
    {
        $penilaians = Penilaian::latest()->get();
        return view('frontend.penilaian', compact('penilaians'));
    }
}
