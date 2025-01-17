<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'name',
        'ic',
        'email',
        'jawatan',
        'password',
        'no_telefon',
        'status',
        'unit',
        'last_login_at',
        'created_at',
        'updated_at',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Unit()
    {
        return $this ->hasOne('App\Models\ref_unit', 'id_unit', 'unit');
    }

    public function User_peranan()
    {
        return $this->belongsTo('App\Models\user_role_pengguna', 'id_user', 'id_user');
    }

    public function User_tajuk_mesyuarat()
    {
        return $this->hasMany('App\Models\user_tajuk_mesyuarat', 'id_user', 'id_user');
    }

    public function refTajuks()
    {
        // use for sync data for update jenis mesyuarat
        return $this->belongsToMany(User_tajuk_mesyuarat::class, 'user_tajuk_mesyuarat', 'id_user', 'id_tajuk');
    }

    public function refPeranans()
    {
        // use for sync data for update peranan
        return $this->belongsToMany(user_role_pengguna::class, 'user_role_pengguna', 'id_user', 'id_peranan');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function setJawatanAttribute($value)
    {
        $this->attributes['jawatan'] = strtoupper($value);
    }
}
