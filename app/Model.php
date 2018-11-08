<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
        //
    protected $fillable = ['username', 'email', 'pwdOriginal', 'pwdConfirm'];
    protected $guarded = []; // Inverse of fillable
}
