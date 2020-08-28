<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskComplete extends Model
{
    protected $guarded = [];
    
    public function get_task()
    {
        return $this->belongsTo('App\Task', 'task_id', 'id');
    }
}
