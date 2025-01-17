<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodPartiJawatan extends Model
{
    use HasFactory;

    protected $table = 'kod_parti_jawatan';

    protected $fillable = [        
        'jawatan',       
        'kekananan',
        'tarikh_cipta',
        'tarikh_kemaskini',
        'tarikh_hapus'
    ];
      
}
