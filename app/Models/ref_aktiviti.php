<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_aktiviti extends Model
{
    use HasFactory;

    protected $table = 'ref_aktiviti';
    protected $primaryKey = 'id_aktiviti';

    protected $fillable = [
        'id_aktiviti',
        'nama_aktiviti'
    ];
}
