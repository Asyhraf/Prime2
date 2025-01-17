<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodGelaranDarjah extends Model
{
    use HasFactory;

    protected $table = 'kod_gelaran_darjah';

    protected $fillable = [        
        'gelaran_darjah',       
        'tarikh_cipta',
        'tarikh_kemaskini',
        'tarikh_hapus'
    ];
      
}
