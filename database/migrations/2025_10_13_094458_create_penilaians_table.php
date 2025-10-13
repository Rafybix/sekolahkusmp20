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
            $table->string('file_upload')->nullable(); // Nama file upload
            $table->string('link')->nullable();     // Link tambahan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
