<?php

namespace App;

class Post extends Model
{
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
