<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodKementerian extends Model
{
    use HasFactory;

    protected $table = 'kod_kementerian';

    protected $fillable = [        
        'kementerian', 
        'kementerian_singkatan',
        'kementerian_alamat',
        'kementerian_kekananan',
        'tarikh_cipta',
        'tarikh_kemaskini',
        'tarikh_hapus'
    ];
      
}
