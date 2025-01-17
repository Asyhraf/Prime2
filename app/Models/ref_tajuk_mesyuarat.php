<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ref_tajuk_mesyuarat extends Model
{
    use HasFactory;

    protected $table = 'ref_tajuk_mesyuarat';
    protected $primarykey = 'id_tajuk';

    protected $fillable = [
        'id_tajuk',
        'nama_tajuk',
        'ringkasan',
        'color',
        'aktiviti'
    ];

    public function Activity()
    {
        return $this->hasOne('App\Models\ref_aktiviti', 'id_aktiviti', 'aktiviti');
    }
}
