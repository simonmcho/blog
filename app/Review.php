<?php

namespace App;

class Review extends Model
{
    // $review->post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // This shows the relationship between user and review
    public function user() // $review->user->name
    {
        return $this->belongsTo(User::class);
    }
}
