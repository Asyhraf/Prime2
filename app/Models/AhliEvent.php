<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AhliEvent extends Model
{
    use HasFactory;

    protected $table = 'ahli_event';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'ahli_id',
        'mesyuarat_id',
        'kehadiran',
        'catatan',
        'wakil_oleh',
        'jawatan_wakil',
        'id_gred_wakil',
        'tarikh_lantikan_wakil',
        'id_status_jawatan',
        'susunan',
        'pegawai_kemaskini',
        'no_tel_pegawai_kemaskini',
        'nota_kemaskini',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at'
    ];

    // Define the relationship with AhliMesyuarat
    public function ahliMesyuarat()
    {
        return $this->belongsTo(AhliMesyuarat::class, 'ahli_id', 'id_ahli');
    }

    // Define the relationship with Event
    public function event()
    {
        return $this->belongsTo(Event::class, 'mesyuarat_id', 'id');
    }

    // Define the relationship with RefJawatan
    public function jawatanWakil()
    {
        return $this->belongsTo(ref_jawatan::class, 'jawatan_wakil', 'id_jawatan');
    }

    // Define the relationship with KekanananGred
    public function gredWakil()
    {
        return $this->belongsTo(kekananan_gred::class, 'id_gred_wakil', 'id_gred');
    }

    // Define the relationship with RefStatusJawatan
    public function statusJawatanWakil()
    {
        return $this->belongsTo(ref_status_jawatan::class, 'id_status_jawatan', 'id_status_jawatan');
    }

    // Define the relationship with ButiranAhliMesyuarat
    public function butiranAhliMesyuarat()
    {
        return $this->belongsTo(ButiranAhliMesyuarat::class, 'ahli_id', 'id_ahli');
    }

    // Save in DB with Uppercase font
    public function setCatatanAttribute($value)
    {
        $this->attributes['catatan'] = strtoupper($value);
    }

    public function setWakilOlehAttribute($value)
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
