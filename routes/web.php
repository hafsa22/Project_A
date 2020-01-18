<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//add and show the cities
Route::get('api/city', 'Controller_City@get_city');
Route::post('api/city','Controller_City@post_city');

//add and show the delivery date
/*Route::post('api/date','Controller_Delivery_Date@post_date');
Route::get('api/date/all','Controller_Delivery_Date@getalldate');*/

//add delivery time attach with city id
Route::post('api/city/{city_id}/delivery_time','Controller_Delivery_Time@post_time_city');

//add delivery_time
Route::post('api/delivery_time','Controller_Delivery_Time@post_time');

//search a delivery_time in some delivery_date city if not exist delete the delivery_date (consider like a free day)
Route::get('api/city/{city_id}/delivery_date/{delivery_date_id}/delivery_times','Controller_Delivery_Time@deleteDelivery_all_timeDate');

//Exclude some city delivery times span from some delivery dates
Route::delete('api/city/{city_id}/delivery_date/{delivery_date_id}/delivery_time/{delivery_time_id}','Controller_Delivery_Time@deleteDelivery_timeDate');

//By sending the city id return all of its delivery dates times
Route::get('api/city/{city_id}/delivery_date_time','Controller_Delivery_Time@get_time_date_city_global');

//we consider that the order validation date = 04/11/2019 -> dateNow = 04/11/2019
Route::get('api/city/{city_id}/delivery-dates-times/{number_of_days_to_get}','Controller_Delivery_Time@get_Order');
/*
//show all delivery_date in each city
Route::get('api/city/{city_id}/delivery_date','Controller_Delivery_Time@get_date_city');
//show all delivery_time in one delivery_date
Route::get('api/city/{city_id}/delivery_date/{delivery_date_id}/delivery_time/','Controller_Delivery_Time@get_time_date_city');
//search a delivery time in delivery date city
Route::get('api/city/{city_id}/delivery_date/{delivery_date_id}/delivery_time/{delivery_time_id}','Controller_Delivery_Time@get_time_date_city_all');
*/
