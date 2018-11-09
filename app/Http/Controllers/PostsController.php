<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {

        $posts = Post::all();
        
        return view('posts.index', compact('posts'));
    }

    // public function messages()
    // {
    //     return [
    //         'username.required' => "You need to put a username!",
    //         'email.required' => "You will probably need to put in an email.",
    //         'password' => "Your password needs to be more secure. Right now it's less than 6 characters."
    //     ];
    // }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        // dd(request()->all());
        // Create new post using req data and save to db

        $this->validate(request(), [
            'username' => 'bail|required|unique:posts|max:255',
            'email' => 'required|email|unique:posts',
            'password' => 'required|min:6|confirmed'
        ]);

        Post::create([
            'username' => request('username'),
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'password_confirmation' => Hash::make(request('password_confirmation'))
        ]);

        // Redirect to home page
        return redirect('/');
    }
}
