<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Akademik;

class AkademikFrontendController extends Controller
{
    public function index()
    {
        $fotos = Akademik::latest()->get();
        return view('frontend.akademik', compact('fotos'));
    }
}
