<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        // Create new post using req data and save to db

        $this->validate(request(), [
            'username' => 'required',
            'email' => 'required'
        ]);

        Post::create([
            'username' => request('username'),
            'email' => request('email'),
            'pwdOriginal' => Hash::make(request('password')),
            'pwdConfirm' => Hash::make(request('passwordConfirm'))
        ]);

        // Redirect to home page
        return redirect('/');
    }
}
