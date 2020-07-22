<?php

use Illuminate\Broadcasting\Channel;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrasiKamarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrasi_kamar', function (Blueprint $table) {
            $table->increments('kd_reg');
            $table->integer('kd_kamar')->unsigned();
            $table->foreign('kd_kamar')->references('kd_kamar')->on('kamar')->onDelete('cascade');
            $table->integer('kd_pasien')->unsigned();
            $table->foreign('kd_pasien')->references('kd_pasien')->on('pasien')->onDelete('cascade');
            $table->integer('kd_dokter')->unsigned();
            $table->foreign('kd_dokter')->references('kd_dokter')->on('dokter')->onDelete('cascade');



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
        Schema::dropIfExists('registrasi_kamar');
    }
}
