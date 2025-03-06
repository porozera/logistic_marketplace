<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestUser extends Model
{
    protected $table = 'request_users';
    public $timestamps = true;
    protected $fillable = [
        'companyName',
        'permitNumber',
        'email',
        'telpNumber',
        'address',
        'status'
    ];

}
