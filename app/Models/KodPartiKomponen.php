<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodPartiKomponen extends Model
{
    use HasFactory;

    protected $table = 'kod_parti_komponen';

    protected $fillable = [        
        'kod_parti',
        'parti_komponen',
        'parti_komponen_singkatan',
        'parti_komponen_kekananan',
        'parti_komponen_gambar',
        'tarikh_cipta',
        'tarikh_kemaskini',
        'tarikh_hapus'
    ];
      
}
