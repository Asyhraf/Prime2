<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_tajuk_mesyuarat extends Model
{
    use HasFactory;

    protected $table = 'user_tajuk_mesyuarat';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'id_user',
        'id_tajuk',
        'updated_at',
        'created_at',
        'updated_by'
    ];
    
    public function TajukMesyuarat()
    {
        return $this ->hasOne('App\Models\ref_tajuk_mesyuarat', 'id_tajuk', 'id_tajuk');
    }
}
