<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Registrasi extends Model
{

    use LogsActivity;

    protected static $logAttributes = ['pasien.nama_pasien', 'kamar.nama_kamar', 'dokter.nama_dokter'];

    protected static $logOnlyDirty = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "This model has been {$eventName}";
    }

    public $table = "registrasi_kamar";

    protected $primaryKey = 'kd_reg';

    protected $fillable = ['kd_pasien', 'kd_kamar', 'kd_dokter'];

    public function kamar()
    {
        return $this->hasOne(Kamar::class, 'kd_kamar', 'kd_kamar');
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
