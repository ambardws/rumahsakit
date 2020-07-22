<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    public $table = "dokter";

    protected $primaryKey = 'kd_dokter';

    protected $fillable = [
        'nama_dokter', 'tempat_lahir', 'tanggal_lahir', 'alamat_dokter', 'telepon', 'spesialiasi_dokter'
    ];


    // public function pasien()
    // {
    //     return $this->hasMany(Pasien::class);
    // }
}
