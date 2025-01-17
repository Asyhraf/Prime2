<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodJenisLantikanSenator extends Model
{
    use HasFactory;

    protected $table = 'kod_jenis_lantikan_senator';

    protected $fillable = [        
        'id', 
        'jenis_lantikan',
        'jenis_lantikan_kekananan',
        'tarikh_cipta',
        'tarikh_kemaskini',
        'tarikh_hapus'
    ];
      
}
