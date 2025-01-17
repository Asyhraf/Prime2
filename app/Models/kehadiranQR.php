<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kehadiranQR extends Model
{
    use HasFactory;

    protected $fillable = [
        'ahli_id',
        'mesyuarat_id',
        'kehadiran',
        'catatan',
        'wakil_oleh',
        'jawatan_wakil',
        'id_gred_wakil',
        'susunan',
        'tarikh_lantikan',
        'id_status_jawatan'
    ];

    protected $table = 'kehadiran_q_r';


    public function KehadiranNamaID()
    {
        return $this->hasOne('App\Models\AhliMesyuarat', 'id_ahli', 'ahli_id');
    }

    public function KehadiranEventID()
    {
        return $this->hasOne('App\Models\Event', 'id', 'mesyuarat_id');
    }

    public function JawatanWakil()
    {
        return $this->hasOne('App\Models\ref_jawatan', 'id_jawatan', 'jawatan_wakil');
    }

    public function GredWakil()
    {
        return $this->hasOne('App\Models\kekananan_gred', 'id_gred', 'id_gred_wakil');
    }

    public function StatusJawatanWakil()
    {
        return $this->hasOne('App\Models\ref_status_jawatan', 'id_status_jawatan', 'id_status_jawatan');
    }

     // Save in DB with Uppercase font
    public function setCatatanAttribute($value)
    {
        $this->attributes['catatan'] = strtoupper($value);
    }

    public function setWakilAttribute($value)
    {
        $this->attributes['wakil_oleh'] = strtoupper($value);
    }

    public function setJawatanWakilAttribute($value)
    {
        $this->attributes['jawatan_wakil'] = strtoupper($value);
    }

    public function setPegawaiKemaskiniAttribute($value)
    {
        $this->attributes['pegawai_kemaskini'] = strtoupper($value);
    }

    public function setNotaKemaskiniAttribute($value)
    {
        $this->attributes['nota_kemaskini'] = strtoupper($value);
    }
}
