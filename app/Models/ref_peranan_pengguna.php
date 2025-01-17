<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_peranan_pengguna extends Model
{
    use HasFactory;

    protected $table = 'ref_peranan_pengguna';
    protected $primaryKey = 'id_peranan';

    protected $fillable = [
        'id_peranan',
        'nama_peranan'
    ];
}
