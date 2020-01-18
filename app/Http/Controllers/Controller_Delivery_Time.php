<?php

namespace App\Http\Controllers;
use App\DeliveryTime;
use App\DeliveryDate;
use App\City;
use Illuminate\Http\Request;
use Carbon\Carbon;
class Controller_Delivery_Time extends Controller
{
public function post_time_city(Request $request ,$city_id){
     $city= City::findOrFail($city_id);
      $delivery_dates = $city->delivery_dates()->get();
      foreach ( $delivery_dates as $delivery_date) {
       $delivery_time= new DeliveryTime;
       $delivery_time->delivery_at = $request->delivery_at;
       $delivery_date->delivery_times()->save($delivery_time);
      }

 return response()->json([
        "message" => "adding delivery_time all of delivery_time in city {$city->name}",

        ], 201);
}

 public function post_time(Request $request ){

       $delivery_time= new DeliveryTime;
       $delivery_time->delivery_at = $request->delivery_at;
       $delivery_time->save();
       return response()->json([
        "message" => "adding delivery_time ",
        ], 201);
}

 public function deleteDelivery_timeDate($city_id,$delivery_date_id, $delivery_time_id){
    $city = City::find($city_id);

     $delivery_dates_city = $city->delivery_dates()->get();
     $delivery_dates = $delivery_dates_city->find($delivery_date_id);
     if  (!is_null ($delivery_dates)){
        $delivery_times=$delivery_dates->delivery_times()->get();
        $delivery_time=$delivery_times->find($delivery_time_id);
        $delivery_time->delete();
           return response()->json([
            "message " => "Exclude  city delivery times {$delivery_time->delivery_at} span from {$delivery_dates->date}",
                 ], 201);
           }
     else{
             return "this day is not found";
             }
  }
 public function deleteDelivery_all_timeDate($city_id,$delivery_date_id){
    $city = City::find($city_id);

     $delivery_dates_city = $city->delivery_dates()->get();
     $delivery_dates = $delivery_dates_city->find($delivery_date_id);
     if  (!is_null ($delivery_dates)){
         $delivery_times=$delivery_dates->delivery_times()->get();
             if  ($delivery_times->isEmpty()){
                $delivery_dates->delete();
                   return response()->json([
                     "message " => "there is no time linked with this date so Exclude  this city delivery date {$delivery_dates->date} ",
                         ], 201);
              }
             else{
                      return "time exist in this day";
              }
     }
      else{
              return "this day is not found";
      }
 }
 public function get_date_city($city_id){
    $city = City::find($city_id);
    $delivery_date = $city->delivery_dates()->get();
          return response()->json([
                        "delivery_dates" => $delivery_date,
                      ], 201);

 }
 public function get_time_date_city($city_id,$delivery_date_id){
       $city = City::find($city_id);

    $delivery_dates_city = $city->delivery_dates()->get();
    $delivery_dates = $delivery_dates_city->find($delivery_date_id);
    if  (!is_null ($delivery_dates)){
        $delivery_time=$delivery_dates->delivery_times()->get();
        return response()->json([
                        "delivery_times" => $delivery_time,
                      ], 201);
     }
    else{
         return "this day is not found";
 }
           }

 public function get_time_date_city_global($city_id){
    $city = City::find($city_id);
    $delivery_dates = $city->delivery_dates;
    foreach ( $delivery_dates as $delivery_date) {
         $delivery_times=$delivery_date->delivery_times;
        }
 return response()->json([
                        "City" => $city,
                      ], 201);
}

 public function get_Order($city_id,$number_of_days_to_get){
     $city = City::find($city_id);
     $date=Carbon::create(2019,11,04); //normally $date=Carbon::new()
     $date2=$date->addDays(1)->toDateString();
     // format of date should be Y-m-d $date
     for($i  = 0; $i <$number_of_days_to_get ; $i++){
       $date2=$date->addDays($i)->toDateString();
       $delivery_dates= $city->delivery_dates->where('date','=',$date2);
       $delivery_datess[$i]['city'] =$delivery_dates;
          foreach ( $delivery_dates as $delivery_date) {
              $delivery_time=$delivery_date->delivery_times;
           }
     }
     return response()->json([
                        "day" => $date2,
                       "City" =>   $delivery_datess,
                        ], 201);
 }
 /*
  public function get_time_date_city_all($city_id,$delivery_date_id ,$delivery_time_id){
        $city = City::find($city_id);

     $delivery_dates_city = $city->delivery_dates()->get();
     $delivery_dates = $delivery_dates_city->find($delivery_date_id);
     if  (!is_null ($delivery_dates)){
     $delivery_times=$delivery_dates->delivery_times()->get();
     $delivery_time=$delivery_times->find($delivery_time_id);
         return response()->json([
                         "delivery_times" => $delivery_time,
                       ], 201);
 }
 else{
 return "this day is not found";
 }
            }*/
}
