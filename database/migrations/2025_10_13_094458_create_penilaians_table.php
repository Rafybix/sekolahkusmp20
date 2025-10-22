<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->string('judul');               // Judul penilaian
            $table->date('tanggal')->nullable();   // Tanggal penilaian
            $table->text('deskripsi')->nullable(); // Deskripsi / catatan
            $table->json('file_upload')->nullable(); // Array JSON file + title
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
