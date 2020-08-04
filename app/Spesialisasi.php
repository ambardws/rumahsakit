<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spesialisasi extends Model
{
    public $table = "spesialisasi";

    protected $primaryKey = 'kd_spesialisasi';

    protected $fillable = [
        'nama_spesialisasi'
    ];

    public function dokter()
    {
        return $this->hasOne(Dokter::class);
    }
}
