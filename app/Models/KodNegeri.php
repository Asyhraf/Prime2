<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodNegeri extends Model
{
    use HasFactory;

    protected $table = 'kod_negeri';

    protected $fillable = [        
        'kod_negeri', 
        'nama_negeri',
        'kekananan_parlimen',
        'tarikh_cipta',
        'tarikh_kemaskini',
        'tarikh_hapus'
    ];
      
}
