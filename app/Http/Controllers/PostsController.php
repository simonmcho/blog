<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index ()
    {
        $title = 'POSTS!!!!';
        
        return view('posts.index', compact('title'));
    }

    public function create ()
    {
        return view('posts.create');
    }

    public function store ()
    {
       // dd(request()->all());
        // Create new post using req data
        $post = new Post;

        $post->username = request('username');
        $post->email = request('email');
        
        // Save it to db
        $post->save();

        // Redirect to home page
        return redirect('/');
    }
}
