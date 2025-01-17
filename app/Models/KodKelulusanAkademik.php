<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodKelulusanAkademik extends Model
{
    use HasFactory;

    protected $table = 'kod_kelulusan_akademik';

    protected $fillable = [        
        'kelulusan_akademik'      
    ];
      
}
