<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi
    protected $fillable = ['nama', 'deskripsi', 'gambar'];

    // Relasi: 1 Album punya banyak Photo
    public function photos()
    {
        return $this->hasMany(Photo::class, 'album_id');
    }
}
