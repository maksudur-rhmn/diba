<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];

    public function relationBetweenCategory()
    {
        return $this->belongsTo('App\BlogCategory', 'category_id', 'id');
    }
}
