<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DeliveryDate;
use App\City;
use Carbon\Carbon;
class Controller_Delivery_Date extends Controller
{
 public function post_date(Request $request ){
     $cities= City::get();
         foreach ( $cities as $city) {
              $delivery_date= new DeliveryDate;
              $date =$request->date;
              $day_name= Carbon::createFromDate($date)->format( 'D' );
              $delivery_date->day_name = $day_name;
              $delivery_date->date=$request->date;
              $city->delivery_dates()->save($delivery_date);
          }

      return response()->json([
        "message" => "adding delivery_date all of city",

        ], 201);
 }
  public function getalldate(){
      $cities =City::get();
         foreach ( $cities as $city) {
          $delivery_date[$city->id]=$city->delivery_dates()->get();
         }
       return response()->json([
         "Delivery_Date" => $delivery_date,
                                              ], 201);
  }
}
