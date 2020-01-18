<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
class Controller_City extends Controller
{
 public function get_city(){

 $all =City::get();
 return $all;
 }

 public function post_city(Request $request){
  $city = new City;
    $city->name = $request->name;
    $city->slug = $request->slug;
    $city->save();

    return response()->json([
        "message" => "city record created",
    ], 201);
 }
}
