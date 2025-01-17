<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodParti extends Model
{
    use HasFactory;
    
    protected $table = 'kod_parti';

    protected $fillable = [        
        'parti',
        'parti_singkatan',
        'parti_kekananan',
        'tarikh_cipta',
        'tarikh_kemaskini',
        'tarikh_hapus'
    ];
      
}
