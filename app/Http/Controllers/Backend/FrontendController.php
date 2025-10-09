<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Album;

class FrontendController extends Controller
{
    public function artikel()
    {
        $albums = Album::with('photos')->latest()->get();
        return view('frontend.artikel', compact('albums'));
    }
}
