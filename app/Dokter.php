<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Dokter extends Model
{
    public $table = "dokter";

    protected $primaryKey = 'kd_dokter';

    protected $fillable = [
        'nama_dokter', 'tempat_lahir', 'tanggal_lahir', 'alamat_dokter', 'telepon', 'spesialisasi_id'
    ];

    public function spesialisasi()
    {
        return $this->belongsTo(Spesialisasi::class, 'spesialisasi_id', 'kd_spesialisasi');
    }

    public function registrasi()
    {
        return $this->hasMany(Registrasi::class);
    }



    // public function pasien()
    // {
    //     return $this->hasMany(Pasien::class);
    // }
}
