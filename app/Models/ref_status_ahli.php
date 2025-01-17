<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_status_ahli extends Model
{
    use HasFactory;

    protected $table = 'ref_status_ahli';
    protected $primaryKey = 'id_status_ahli';

    protected $fillable = [
        'id_status_ahli',
        'nama_status_ahli'
    ];

    protected $casts = [
        'id_status_ahli' => 'string',
    ];

    // Define the inverse relationship
    public function butiranAhliMesyuarat()
    {
        return $this->belongsTo(ButiranAhliMesyuarat::class, 'id_status_ahli');
    }
}
