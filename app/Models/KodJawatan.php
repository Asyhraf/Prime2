<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodJawatan extends Model
{
    use HasFactory;

    protected $table = 'kod_jawatan';

    protected $fillable = [        
        'jawatan',       
        'kekananan',
        'tarikh_cipta',
        'tarikh_kemaskini',
        'tarikh_hapus'
    ];
      
}
