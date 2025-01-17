<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kehadiran extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_mesyuarat', 
        'id_ahli', 
        'status_kehadiran', 
        'catatan_kehadiran', 
        'wakil_oleh' 
    ];

    protected $table = 'kehadiran';


    public function events()
    {
        
    }

}
