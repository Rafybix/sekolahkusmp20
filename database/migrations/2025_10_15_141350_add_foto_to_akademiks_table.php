<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFotoToAkademiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('akademiks', function (Blueprint $table) {
            // Menambahkan kolom 'foto' setelah kolom 'deskripsi'
            $table->string('foto')->nullable()->after('deskripsi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('akademiks', function (Blueprint $table) {
            // Menghapus kolom 'foto' jika rollback
            $table->dropColumn('foto');
        });
    }
}
