<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'tanggal',
        'deskripsi',
        'file_upload', // ganti dari file_pdf ke file_upload
        'link',
    ];
}
