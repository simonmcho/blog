<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index ()
    {
        $title = 'POSTS!!!!';
        
        return view('posts.index', compact('title'));
    }
}
