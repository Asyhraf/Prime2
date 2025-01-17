<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_unit extends Model
{
    use HasFactory;

    protected $table = 'ref_units';
    protected $primaryKey = 'id_unit';

    protected $fillable = [
        'id_unit',
        'nama_unit'
    ];
}
