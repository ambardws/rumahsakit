<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    public $table = "kamar";

    protected $primaryKey = 'kd_kamar';

    protected $fillable = [
        'nama_kamar', 'nomor', 'kelas', 'jumlah_kasur'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function registrasi()
    {
        return $this->hasMany(Registrasi::class, 'kd_reg', 'kd_reg');
    }
}
