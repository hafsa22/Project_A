<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryDate extends Model
{
public $timestamps = false;
    //

    public function city()
        {
        	return $this->belongsTo(City::class);
        }

      public function delivery_times()
         {
            return $this->hasMany(DeliveryTime::class);
         }
}
