<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_role_pengguna extends Model
{
    use HasFactory;

    protected $table = 'user_role_pengguna';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_user',
        'id_peranan',
        'updated_at',
        'created_at',
        'updated_by' 
    ];

    public function Peranan()
    {
        return $this ->hasOne('App\Models\ref_peranan_pengguna', 'id_peranan', 'id_peranan');
    }
}
