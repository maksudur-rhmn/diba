<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
   protected $guarded = [];

   public function relationBetweenCategory()
   {
     return $this->belongsTo('App\Category', 'category_id', 'id');
   }
   public function relationBetweenCity()
   {
     return $this->belongsTo('App\City', 'city_id', 'id');
   }
}
