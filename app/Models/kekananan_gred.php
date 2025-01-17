<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kekananan_gred extends Model
{
    use HasFactory;

    protected $table = 'kekananan_gred';
    protected $primaryKey = 'id_gred';

    protected $fillable = [
        'id_gred',
        'nama_gred',
        'kekananan',
    ];

    // Define the inverse relationship
    public function lantikanAhliMesyuarat()
    {
        return $this->belongsTo('App\Models\LantikanAhliMesyuarat', 'id_gred', 'id_gred');
    }
}
