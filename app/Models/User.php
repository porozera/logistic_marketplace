<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'firstName',
        'lastName',
        'role',
        'telpNumber',
        'profilePicture',
        'description',
        'rating',
        'address',
        'companyName',
        'bannerPicture',
        'permitNumber',
        'accountName',
        'accountNumber'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'rating' => 'float',
        ];
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'lsp_id');
    }   
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
