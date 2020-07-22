<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasiensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->increments('kd_pasien');
            $table->string('nik', 20);
            $table->string('nama_pasien', 50);
            $table->string('jenis_kelamin', 10);
            $table->string('tempat_lahir', 20);
            $table->date('tanggal_lahir');
            $table->string('alamat_pasien', 100);
            $table->string('telepon', 15);
            $table->integer('tinggi_badan');
            $table->integer('berat_badan');
            $table->char('gol_darah', 2);
            $table->string('keluhan', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasien');
    }
}
