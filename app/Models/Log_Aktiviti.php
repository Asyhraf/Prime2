<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log_Aktiviti extends Model
{
    use HasFactory, SoftDeletes;
    const CREATED_AT = 'action_time';
    const UPDATED_AT = 'action_updated';

    protected $table = 'log_aktiviti';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'module_id',
        'module_type',
        'before',
        'after',
        'action',
        'action_byid',
        'action_name',
        'action_time',
        'action_updated'
    ];
}
