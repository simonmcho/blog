<?php

namespace App;

class Post extends Model
{
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function addReview($body)
    {
        dd($this->reviews());
         Review::create([
            'post_id' => $this->id,
            'user_id' => 123123,
            'body' => $body
        ]);
    }
}
