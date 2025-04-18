<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    protected $fillable = [
        'email',
        'username',
        'status',
        'description'
    ];
}
