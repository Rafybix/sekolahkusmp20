<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkademiksTable extends Migration
{
    public function up()
    {
        Schema::create('akademiks', function (Blueprint $table) {
            $table->id();
            $table->string('foto'); // path gambar
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('akademiks');
    }
}
