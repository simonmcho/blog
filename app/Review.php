<?php

namespace App;

class Review extends Model
{
    // $comment->post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
