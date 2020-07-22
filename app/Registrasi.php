<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{

    public $table = "registrasi_kamar";

    protected $primaryKey = 'kd_reg';

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kd_kamar', 'kd_kamar');
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'kd_pasien', 'kd_pasien');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }
}
