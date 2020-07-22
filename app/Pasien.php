<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{

    public $table = "pasien";

    protected $primaryKey = 'kd_pasien';

    protected $fillable = [
        'nik', 'nama_pasien', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'alamat_pasien',  'telepon', 'tinggi_badan', 'berat_badan', 'gol_darah', 'keluhan'
    ];


    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'kd_dokter', 'kd_dokter');
    }

    public function registrasi()
    {
        return $this->hasOne(Registrasi::class);
    }
}
