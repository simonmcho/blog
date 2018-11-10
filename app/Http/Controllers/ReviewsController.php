<?php

namespace App\Http\Controllers;

use App\Post;
use App\Review;

class ReviewsController extends Controller
{
    public function store(Post $post_id)
    {
        $post_id->addReview(request('body'));
       
        return back();
    }
}
