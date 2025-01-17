<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodParlimen extends Model
{
    use HasFactory;

    protected $table = 'kod_parlimen';

    protected $fillable = [        
        'parlimen',
        'tarikh_cipta',
        'tarikh_kemaskini',
        'tarikh_hapus'
    ];
      
  
    public function kodnegeri()
    {
       return $this->hasOne('App\Models\KodNegeri','kod_negeri','kod_negeri');
    }
}
