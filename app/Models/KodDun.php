<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodDun extends Model
{
    use HasFactory;

    protected $table = 'kod_dun';

    protected $fillable = [        
        'kod_negeri',
        'kod_parlimen',
        'dewan_undangan_negeri',
        'tarikh_cipta',
        'tarikh_kemaskini',
        'tarikh_hapus'
      ];
      
      
      public function kodnegeri()
      {
        return $this->hasOne('App\Models\KodNegeri','kod_negeri','kod_negeri');
      }
}
