<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_status_jawatan extends Model
{
    use HasFactory;

    protected $table = 'ref_status_jawatan';
    protected $primarykey = 'id_status_jawatan';

    protected $fillable = [
        'id_status_jawatan',
        'nama_status_jawatan'
    ];
}
