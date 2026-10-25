<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $table = "channels";

    protected $fillable = [
        'user_id',
        'name',
        'handle',
        'description',
        'channel_image',
    ];
    
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
}

