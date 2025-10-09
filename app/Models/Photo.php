<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi
    protected $fillable = ['album_id', 'file_path', 'caption'];

    // Relasi: Photo milik satu Album
    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }
}
