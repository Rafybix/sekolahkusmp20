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

        $data = $request->only(['nama', 'email', 'pesan']);

        try {
            Mail::send('frontend.emails.kontak', $data, function ($message) use ($data) {
                $message->to('wulanpermatasari0209@gmail.com') // ganti sesuai email penerima
                        ->subject('Pesan Baru dari ' . $data['nama'])
                        ->replyTo($data['email']);
            });

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // biar kelihatan di popup apa error-nya
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
} 