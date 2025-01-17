<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ahli extends Model
{
    protected $table = 'ahliID';

    // Define the relationship with the RefKementerian model
    public function ref_kementerian()
    {
        return $this->hasOne(ref_kementerian::class, 'id_kementerian');
    }
}
