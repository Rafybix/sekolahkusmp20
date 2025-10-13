<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class KontakController extends Controller
{
    public function kirimPesan(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'pesan' => 'required',
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'pesan' => $request->pesan,
        ];

        // Kirim email
        Mail::send('emails.kontak', $data, function ($message) use ($data) {
            $message->to('wulanpermatasari0209@gmail.com') // GANTI ke email tujuan kamu
                    ->subject('Pesan Baru dari ' . $data['nama'])
                    ->replyTo($data['email']);
        });

        return response()->json(['success' => true]);
    }
}
