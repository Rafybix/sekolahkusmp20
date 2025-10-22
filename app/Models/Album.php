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

    // Set gambar default otomatis kalau belum ada
    protected static function booted()
    {
        static::creating(function ($album) {
            if (empty($album->gambar)) {
                $album->gambar = 'Assets/Frontend/img/album.png';
            }
        });
    }
}
