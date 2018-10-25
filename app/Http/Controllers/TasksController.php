<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{
    public function index ()
    {
        //$tasks = DB::table('tasks')->get();
        $tasks = Task::all();
        return view('tasks.index', compact('tasks'));
    }

    public function show (Task $task) // $task needs to be the same as wildcard. If the arg is the same as wildcard, this is same as Task::find($id);
    {        
        return view('tasks.show', compact('task'));
    }
}
