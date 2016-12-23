<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'title',
        'channel_id',
        'slug',
        'body'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
