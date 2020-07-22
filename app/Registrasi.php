<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registrasi extends Model
{
    public function kamar()
    {
        return $this->belongsToMany(Kamar::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
