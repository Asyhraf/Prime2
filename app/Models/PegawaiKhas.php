<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PegawaiKhas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pegkhas_ahli_mesyuarat';
    protected $primaryKey = 'id_pegkhas';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_pegkhas',
        'id_ahli',
        'pegkhas_nama',
        'pegkhas_emel',
        'pegkhas_hp',
        'pegkhas_telpej',
        'pegkhas_faks',
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
        return $this->hasOne('App\Models\KodGelaran', 'gelaran', 'gelaran');
    }
    // public function Event()
    // {
    //     return $this->belongsToMany('App\Models\Event'::class);
    // }

    // public function AhliEvent()
    // {
    //     return $this->hasMany('App\Models\Event'::class);
    // }

    // Event Model
    // public function eventM()
    // {
    // //return $this->belongsToMany(RelatedModel, pivot_table_name, foreign_key_of_current_model_in_pivot_table, foreign_key_of_other_model_in_pivot_table);
    // return $this->belongsToMany(Event::class, 'ahli_event', 'id_ahli', 'id');
    // }

    public function Events()
    {
        return $this->belongsToMany(Event::class, 'ahli_event', 'ahli_id', 'mesyuarat_id');
    }

    public function Ahli_ID()
    {
        return $this->belongsTo(AhliMesyuarat::class, 'id_ahli');
    }

    public function setPegkhasNamaAttribute($value)
    {
        $this->attributes['pegkhas_nama'] = strtoupper($value);
    }
}
