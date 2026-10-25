<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Channel;

class Usersinfo extends Authenticatable
{
    protected $table = 'usersinfo';

    protected $fillable = [
        'name',
        'age',
        'email',
        'password',
        'profile',
    ];

    public function channel()
    {
        return $this->hasOne(Channel::class, 'user_id');
    }
}