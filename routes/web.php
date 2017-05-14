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
    return view('home');
});

Route::get('register', 'AdminRegisterController@create');

Route::post('register', 'AdminRegisterController@store');

Route::get('login', 'AdminSessionController@create');

Route::post('login', 'AdminSessionController@store');

Route::get('logout', 'AdminSessionController@destroy');

Route::get('events/{event}/codes', 'CodesController@show');

Route::get('check-in/{code}', 'CodesController@checkin');


Route::group(['prefix' => 'admin'], function () {

Route::get('dashboard', function() {
	return view('admin.dashboard');
});

/*====================
	   LOCATION
====================*/
Route::get('location/create', 'LocationsController@create');
Route::get('location', 'LocationsController@index');
Route::post('location', 'LocationsController@store');
Route::get('location/edit', 'LocationsController@edit');
Route::put('location', 'LocationsController@update');


/*====================
	    EVENTS
====================*/
Route::get('events/create', 'EventsController@create');
Route::get('events', 'EventsController@index');
Route::get('events/{id}', 'EventsController@show');
Route::post('events', 'EventsController@store');
Route::get('events/{id}/edit', 'EventsController@edit');
Route::put('events/{id}', 'EventsController@update');

/*====================
	    GUESTS
====================*/
Route::get('events/{id}/guests', 'GuestsController@index');


/*====================
	    CODES
====================*/
Route::get('events/{event}/codes', 'CodesController@index');
Route::get('events/{event}/codes/create', 'CodesController@create');
Route::post('events/{event}/codes', 'CodesController@store');

});