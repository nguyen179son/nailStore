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
Route::group(['middleware' => ['auth']], function()
{
    Route::post('dropin-booking/{id}/checkout', 'BookController@checkout');
    Route::post('reservations/{id}/checkout', 'ReservationController@checkout');
    Route::get('/income','BookController@income');

});

Route::get('/dropin-booking','BookController@index');
Route::post('/dropin-booking','BookController@store');
Route::get('/dropin-booking/count','BookController@count');
Route::delete('/dropin-booking/{id}','BookController@destroy');
Route::post('/dropin-booking/add-history','BookController@addHistory');
Route::post('/dropin-booking/update-status','BookController@update');
Route::get('/dropin-queue', 'BookController@show');
Route::get('/dropin-queue/fetch-data', 'BookController@fetch_data');


Route::get('/update-online-reservation-emails', 'ReservationController@getReservations')->name('updateOnlineReservationEmails');
Route::post('/reservations/update-status','ReservationController@update');


Route::get('/reservations/list','ReservationController@show');
Route::get('/reservations/count','ReservationController@count');
Route::get('/reservations/fetch-data','ReservationController@fetch_data');
Route::delete('/reservations/{id}','ReservationController@destroy');



Route::post('/member/addPoint','MemberController@addPoint');
Route::post('/member/minusPoint','MemberController@minusPoint');
Route::get('/member/check','BookController@checkCustomerCode');
Route::post('/send-complaint', 'AddComplaintController@addComplaint');

Route::get('/member/{id}','MemberController@history');
Route::group(['prefix' => '/admin'], function () {
    Route::get('/login','AdminLoginController@getLogin')->name('getAdminLogin');
    Route::post('/login','AdminLoginController@postLogin');

    Route::get('','HomeController@getIndex');

    Route::get('/index', 'HomeController@getThreeButtonsView');

    Route::get('/fetch-dropin','AdminController@fetch_data_dropin');
    Route::get('/fetch-onl','AdminController@fetch_data_online');


    Route::get('/logout','HomeController@logout')->name("adminLogout");

    Route::get('/customer-management', 'ClientManagerController@index');

    Route::get('/customer-management/show','MemberController@show');

    Route::post('/member/addPoint','MemberController@addPoint');
    Route::get('/member/{id}','MemberController@history');

    Route::post('/member', 'MemberController@addMember');

    Route::get('/complaints', 'ComplaintController@index');
});
