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
    return view('welcome');
});
Route::get('/dropinBooking','BookController@index');
Route::post('/dropinBooking','BookController@store');
Route::get('/dropinBooking/count','BookController@count');
Route::delete('/dropinBooking/{id}','BookController@destroy');

Route::get('/reservations', 'ReservationController@getReservations');


Route::get('/dropinQueue', 'BookController@show');
Route::get('/dropinQueue/fetch_data', 'BookController@fetch_data');

Route::get('/reservations/list','ReservationController@show');
Route::get('/reservations/count','ReservationController@count');
Route::get('/reservations/fetch_data','ReservationController@fetch_data');
Route::delete('/reservations/{id}','ReservationController@destroy');

Route::post('/member','MemberController@store');
Route::get('/members','MemberController@show');

Route::post('/member/addPoint','MemberController@addPoint');
Route::get('/member/{id}','MemberController@history');