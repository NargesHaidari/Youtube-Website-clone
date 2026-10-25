<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'videos';

    protected $fillable = [
        'channel_id',
        'title',
        'description',
        'video_path',
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }
}
