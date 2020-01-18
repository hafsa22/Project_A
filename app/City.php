<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  public $timestamps = false;

    /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'name', 'slug',
        ];
     public function delivery_dates()
        {
        	return $this->hasMany(DeliveryDate::class);
        }
}
