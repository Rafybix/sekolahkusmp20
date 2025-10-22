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
        'file_upload',  // array JSON {path, title}
    ];

    // otomatis konversi file_upload JSON ke array
    protected $casts = [
        'file_upload' => 'array',
        'tanggal' => 'date',
    ];
}
