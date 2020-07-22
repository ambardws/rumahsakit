<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoktersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokter', function (Blueprint $table) {
            $table->increments('kd_dokter');
            $table->string('nama_dokter', 50);
            $table->string('tempat_lahir', 20);
            $table->date('tanggal_lahir');
            $table->string('alamat_dokter', 100);
            $table->string('telepon', 15);
            $table->string('spesialiasi_dokter', 20);
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
        Schema::dropIfExists('dokter');
    }
}
