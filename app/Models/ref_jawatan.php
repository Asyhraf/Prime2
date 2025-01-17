<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_jawatan extends Model
{
    use HasFactory;

    protected $table = 'ref_jawatan';
    protected $primaryKey = 'id_jawatan';

    protected $fillable = [
        'id_jawatan',
        'nama_jawatan',
        'created_at',
        'created_by',
        'updated_at',
        'action_by',
    ];

    // Converts the first character of each word in a string to uppercase
    public function setNamaJawatanAttribute($value)
    {
        $this->attributes['nama_jawatan'] = ucwords($value);
    }
}
