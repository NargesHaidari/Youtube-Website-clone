<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

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
}