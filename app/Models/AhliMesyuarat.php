<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AhliMesyuarat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ahli_mesyuarat';
    protected $primaryKey = 'id_ahli';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_ahli',
        'id_gelaran',
        'nama_ahli',
        'created_at',
        'created_by',
        'updated_at',
        'action_by',
        'deleted_at'
    ];

    public function Jawatan()
    {
        return $this->hasOne('App\Models\ref_jawatan', 'id_jawatan', 'jawatan');
    }

    public function Gred()
    {
        return $this->hasOne('App\Models\kekananan_gred', 'id_gred', 'id_gred');
    }

    public function Kementerian()
    {
        return $this->hasOne('App\Models\ref_kementerian', 'id_kementerian', 'id_kementerian');
    }

    public function Status_Ahli()
    {
        return $this->hasOne('App\Models\ref_status_ahli', 'id_status_ahli', 'id_status_ahli');
    }

    public function GredBersara()
    {
        return $this->hasOne('App\Models\kekananan_gred', 'id_gred', 'gred_bersara');
    }

    public function Gelaran()
    {
        return $this->hasOne('App\Models\KodGelaran', 'id_gelaran', 'id_gelaran');
    }

    public function Events()
    {
        return $this->belongsToMany(Event::class, 'ahli_event', 'ahli_id', 'mesyuarat_id');
    }

    public function Ahli_ID()
    {
        return $this->belongsTo(AhliMesyuarat::class, 'id_ahli');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['nama_ahli'] = strtoupper($value);
    }
}
