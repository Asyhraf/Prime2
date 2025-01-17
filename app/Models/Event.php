<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'title',
        'start',
        'end',
        'time1',
        'time2',
        'allDay',
        'meeting_numbers',
        'location',
        'agenda',
        'linkhadir',
        'year',
        'color',
        'textColor',
        'aktiviti',
        'status',
        'statuspin',
        'pindaan',
        'pindaan_ke',
        'created_at',
        'created_by',
        'updated_at',
        'action_by',
        'deleted_at'
    ];

    public function AhliMesyuarat()
    {
        return $this->belongsToMany('App\Models\AhliMesyuarat'::class);
    }

    public function TajukMesyuarat()
    {
        return $this->hasOne('App\Models\ref_tajuk_mesyuarat', "ringkasan", "title");
    }

    public function Aktiviti()
    {
        return $this->hasOne('App\Models\ref_aktiviti', 'id_aktiviti', 'aktiviti');
    }

    public function ahli_mesyuarat()
    {
        return $this->belongsToMany(AhliMesyuarat::class, 'ahli_event', 'mesyuarat_id', 'ahli_id');
    }

    public function ahliEvents()
    {
        return $this->hasMany(AhliEvent::class, 'mesyuarat_id', 'id');
    }

    public function setLocationAttribute($value)
    {
        $this->attributes['location'] = strtoupper($value);
    }

    public function setAgendaAttribute($value)
    {
        $this->attributes['agenda'] = strtoupper($value);
    }
}
