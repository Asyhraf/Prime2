<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ButiranAhliMesyuarat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'butiran_ahli_mesyuarat';
    protected $primaryKey = 'id_butiran';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_butiran',
        'id_ahli',
        'gelaran',
        'nama_ahli',
        'no_ic',
        'id_jawatan',
        'id_kementerian',
        'papar_kementerian',
        'mesyuarat_ksukp',
        'mesyuarat_jkppn',
        'mesyuarat_kjp',
        'mesyuarat_kebbp',
        'mesyuarat_mbkm',
        'status',
        'id_status_ahli',
        'isteri_suami',
        'alamat',
        'emel',
        'no_hp_peribadi',
        'created_at',
        'created_by',
        'updated_at',
        'action_by',
        'deleted_at'
    ];

    protected $casts = [
        'id_status_ahli' => 'string',
    ];

    // Check for any accessors
    public function getAlamatAttribute($value)
    {
        return $value;
    }

    // Define the relationship to ref_jawatan
    public function Jawatan()
    {
        return $this->hasOne('App\Models\ref_jawatan', 'id_jawatan', 'id_jawatan');
    }

    public function Gred()
    {
        return $this->hasOne('App\Models\kekananan_gred', 'id_gred', 'id_gred');
    }

    public function Kementerian()
    {
        return $this->hasOne('App\Models\ref_kementerian', 'id_kementerian', 'id_kementerian');
    }

    public function status_ahli()
    {
        return $this->hasOne(ref_status_ahli::class, 'id_status_ahli');
    }

    public function GredBersara()
    {
        return $this->hasOne('App\Models\kekananan_gred', 'id_gred', 'gred_bersara');
    }

    public function Gelaran()
    {
        return $this->hasOne('App\Models\KodGelaran', 'gelaran', 'gelaran');
    }

    public function Events()
    {
        return $this->belongsToMany(Event::class, 'ahli_event', 'ahli_id', 'mesyuarat_id');
    }

    public function Ahli_ID()
    {
        return $this->belongsTo(AhliMesyuarat::class, 'id_ahli');
    }

    public function ahliMesyuarat()
    {
        return $this->belongsTo(AhliMesyuarat::class, 'id_ahli', 'id_ahli');
    }

    public function lantikanAhliMesyuarat()
    {
        return $this->belongsTo('App\Models\LantikanAhliMesyuarat', 'kekananan_mesy_manual', 'kekananan_mesy_manual');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['nama_ahli'] = strtoupper($value);
    }

    public function setSuamiIsteriAttribute($value)
    {
        $this->attributes['isteri_suami'] = strtoupper($value);
    }

    public function setAlamatAttribute($value)
    {
        $this->attributes['alamat'] = strtoupper($value);
    }

}
