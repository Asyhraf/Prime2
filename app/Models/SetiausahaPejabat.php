<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SetiausahaPejabat extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'supej_ahli_mesyuarat';
    protected $primaryKey = 'id_supej';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id_supej',
        'id_ahli',
        'supej_nama',
        'supej_emel',
        'supej_hp',
        'supej_telpej',
        'supej_faks',
        'created_at',
        'created_by',
        'updated_at',
        'action_by',
        'deleted_at'
    ];

    public function Events()
    {
        return $this->belongsToMany(Event::class, 'ahli_event', 'ahli_id', 'mesyuarat_id');
    }

    public function Ahli_ID()
    {
        return $this->belongsTo(AhliMesyuarat::class, 'id_ahli');
    }

    public function setSupejNamaAttribute($value)
    {
        $this->attributes['supej_nama'] = strtoupper($value);
    }
}
