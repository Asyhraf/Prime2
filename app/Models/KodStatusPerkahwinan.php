<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodStatusPerkahwinan extends Model
{
    use HasFactory;
    
    protected $table = 'kod_status_perkahwinan';

    protected $fillable = [        
        'status_perkahwinan'      
    ];
      
}
