<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Topic;

class Channel extends Model
{
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
