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

Route::get('/tasks', function() {
    //$tasks = DB::table('tasks')->get();
    $tasks = Task::all();
    return view('tasks.index', compact('tasks'));
});

Route::get('/tasks/{id}', function ($id) {
    //$task = DB::table('tasks')->find($id);
    $task = Task::find($id);
    return view('tasks.show', compact('task'));
});


Route::get('/about', function () {
    return view('about')->with('name', 'ABOUT!');
});
