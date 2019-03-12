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

Route::get('/', function () {
    return redirect('/dropinBooking');
});
Route::get('/dropinBooking','BookController@index');
Route::post('/dropinBooking','BookController@store');

Route::get('/reservations', 'ReservationController@getReservations');


Route::get('/dropinQueue', 'BookController@show');
Route::get('dropinQueue/fetch_data', 'BookController@fetch_data');

