<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserBw extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users_bw';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function registrations()
    {
        return $this->hasMany(RegistrationBw::class, 'user_id');
    }
}