<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_kementerian extends Model
{
    use HasFactory;

    protected $table = 'ref_kementerian';
    protected $primaryKey = 'id_kementerian';

    protected $fillable = [
        'id_kementerian',
        'nama_kementerian',
        'singkatan_kementerian',
        'created_at',
        'created_by',
        'updated_at',
        'action_by',
        'deleted_at'
    ];
    public function ahli()
    {
        return $this->belongsTo(Ahli::class, 'id_kementerian');
    }

    // Converts the first character of each word in a string to uppercase
    public function setNamaKementerianAttribute($value)
    {
        $this->attributes['nama_kementerian'] = ucwords($value);
    }
}
