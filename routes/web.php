<?php

use App\Task;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $name = "BLOG!!!";
    $tasks = DB::table('tasks')->get(); // returning a database query from a route, laravel casts that into JSON

    return view('welcome', compact('name', 'tasks'));
});


Route::get('/products', 'ProductsController@index');

Route::get('/checkout', 'CheckoutController@index');
Route::get('/checkout/create', 'CheckoutController@create');



// Route::get('/tasks', 'TasksController@index');
// Route::get('/tasks/{task}', 'TasksController@show');

Route::get('/posts', 'PostsController@index');
Route::get('/posts/{post_id}', 'PostsController@show');
Route::get('/posts/create', 'PostsController@create');
Route::post('/posts', 'PostsController@store');
