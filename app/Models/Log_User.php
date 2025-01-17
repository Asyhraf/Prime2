<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log_User extends Model
{
    use HasFactory;

    protected $table = 'log_user';
    protected $primaryKey = 'id';

    protected $fillable =[
        'id',
        'id_pengguna',
        'login_at',
        'login_ip',
        'logout_at',
    ];
    public function User()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_pengguna');
    }
}
