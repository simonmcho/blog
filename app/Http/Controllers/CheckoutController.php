<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index ()
    {
        $title = 'CHECKOUT!!';
        return view('checkout.index', compact('title'));
    }
}
