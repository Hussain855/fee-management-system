<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = [
        'school_name',
        'school_address',
        'school_phone',
        'school_email'
    ];
}