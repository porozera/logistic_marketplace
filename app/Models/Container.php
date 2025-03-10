<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    protected $fillable = [
        'code',
        'name',
        'weight',
        'volume',
        'description'
    ];
}
