<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodJantina extends Model
{
    use HasFactory;

    protected $table = 'kod_jantina';

    protected $fillable = [        
        'jantina'      
    ];
      
}
