<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
     public $timestamps = true;

       public function delivery_date()
             {
             	return $this->belongsTo(DeliveryDate::class);
             }
}
