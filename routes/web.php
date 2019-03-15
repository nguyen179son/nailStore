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
    return view('homepage');
});


Route::get('/dropinBooking','BookController@index');
Route::post('/dropinBooking','BookController@store');
Route::get('/dropinBooking/count','BookController@count');
Route::delete('/dropinBooking/{id}','BookController@destroy');
Route::post('/dropinBooking/updateStatus','BookController@update');

Route::get('/dropinQueue', 'BookController@show');
Route::get('/dropinQueue/fetch_data', 'BookController@fetch_data');


Route::get('/reservations', 'ReservationController@getReservations');
Route::post('/reservations/updateStatus','ReservationController@update');


Route::get('/reservations/list','ReservationController@show');
Route::get('/reservations/count','ReservationController@count');
Route::get('/reservations/fetch_data','ReservationController@fetch_data');
Route::delete('/reservations/{id}','ReservationController@destroy');

Route::get('/customer-management', 'ClientManagerController@index');

//Route::post('/member','MemberController@store');
Route::get('/customer-management/show','MemberController@show');

Route::post('/member/addPoint','MemberController@addPoint');
Route::get('/member/{id}','MemberController@history');

Route::post('/member', 'MemberController@addMember');

Route::get('/admin/login','AdminLoginController@getLogin')->name('getAdminLogin');
Route::post('/admin/login','AdminLoginController@postLogin');

Route::get('/admin','HomeController@getIndex');

Route::get('/admin/fetch_dropin','AdminController@fetch_data_dropin');
Route::get('/admin/fetch_onl','AdminController@fetch_data_online');


Route::get('/admin/logout','HomeController@logout')->name("adminLogout");
