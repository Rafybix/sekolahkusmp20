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
            'file_upload.*' => 'nullable|file|max:10240', // per file
            'file_title.*' => 'nullable|string|max:255',  // per judul
        ]);

        $files = [];
        if($request->hasFile('file_upload')){
            foreach($request->file('file_upload') as $index => $file){
                if($file){
                    $path = $file->store('penilaian', 'public');
                    $title = $request->file_title[$index] ?? $file->getClientOriginalName();
                    $files[] = ['path'=>$path, 'title'=>$title];
                }
            }
        }

        $validated['file_upload'] = $files;

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
            'file_upload.*' => 'nullable|file|max:10240',
            'file_title.*' => 'nullable|string|max:255',
        ]);

        $files = $penilaian->file_upload ?? []; // ambil file lama
        if($request->hasFile('file_upload')){
            foreach($request->file('file_upload') as $index => $file){
                if($file){
                    $path = $file->store('penilaian', 'public');
                    $title = $request->file_title[$index] ?? $file->getClientOriginalName();
                    $files[] = ['path'=>$path, 'title'=>$title];
                }
            }
        } else {
            // update judul file lama jika diubah
            if(isset($request->file_title)){
                foreach($request->file_title as $i => $title){
                    if(isset($files[$i])) $files[$i]['title'] = $title;
                }
            }
        }

        $validated['file_upload'] = $files;

        $penilaian->update($validated);

        return redirect()->route('penilaian.index')
                         ->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function destroy(Penilaian $penilaian)
    {
        if($penilaian->file_upload){
            foreach($penilaian->file_upload as $file){
                if(Storage::disk('public')->exists($file['path'])){
                    Storage::disk('public')->delete($file['path']);
                }
            }
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
