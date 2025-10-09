<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer;

class FooterController extends Controller
{
    public function index()
    {
        $footer = Footer::first();
        return view('backend.website.content.footer.index', compact('footer'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'telp'  => 'required|string|max:20',
            'alamat'=> 'required|string',
        ]);

        Footer::create($request->only(['email', 'telp', 'alamat']));

        return redirect()->route('backend-footer.index')->with('success', 'Footer berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'telp'  => 'required|string|max:20',
            'alamat'=> 'required|string',
        ]);

        $footer = Footer::findOrFail($id);
        $footer->update($request->only(['email', 'telp', 'alamat']));

        return redirect()->back()->with('success', 'Footer berhasil diperbarui!');
    }
}
