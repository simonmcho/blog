<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function scopeGetIncompleted ($query) 
    {
        return $query->where('completed', 0); // can do App\Task::getIncompleted()->where('id','>','2')->get();
    }

}
