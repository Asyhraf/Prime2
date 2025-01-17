<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodGelaran extends Model
{
    use HasFactory;

    protected $table = 'kod_gelaran';
    protected $primaryKey = 'id_gelaran';

    protected $fillable = [ 
        'id_gelaran',
        'gelaran',
        'gelaran_penuh', 
        'tarikh_cipta',
        'tarikh_kemaskini',
        'tarikh_hapus'
    ];

    // Define the inverse relationship
    public function AhliMesyuarat()
    {
        return $this->belongsToOne('App\Models\AhliMesyuarat', 'id_gelaran', 'id_gelaran');
    }      
}
