<?php

namespace App;

class Post extends Model
{
    public function reviews() // A post has many reviews
    {
        return $this->hasMany(Review::class);
    }

    public function addReview($body) // On a post, you can add a review
    {
        // $this->reviews() returns the hasMany relationship object
        // $this->reviews returns the result of the relationship
        // Getting the hasMany relationship object allows other eloquent methods to be called
        $this->reviews()->create(compact('body'));

        // Review::create([
        //     'post_id' => $this->id,
        //     'user_id' => 123123,
        //     'body' => $body
        // ]);
    }

    // $review->post->user (??)
    public function user() // A post belongs to a user 
    {
        return $this->belongsTo(User::class);
    }
}
