<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
        //
    protected $fillable = ['username', 'body', 'post_id', 'email', 'password', 'password_confirmation'];
    protected $guarded = []; // Inverse of fillable
}
