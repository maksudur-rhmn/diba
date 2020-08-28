<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    public function getUser()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function getFiles()
    {
        return $this->hasOne('App\TaskComplete', 'task_id', 'id');
    }
}
