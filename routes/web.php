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

Route::get('admin/dashboard', function() {
	return view('admin.dashboard');
});

/*====================
	   LOCATION
====================*/
Route::get('admin/location/create', 'LocationsController@create');
Route::get('admin/location', 'LocationsController@index');
Route::post('admin/location', 'LocationsController@store');
Route::get('admin/location/edit', 'LocationsController@edit');
Route::put('admin/location', 'LocationsController@update');


/*====================
	   EVENTS
====================*/
Route::get('admin/events/create', 'EventsController@create');
Route::get('admin/events', 'EventsController@index');
Route::post('admin/events', 'EventsController@store');
Route::get('admin/events/{id}/edit', 'EventsController@edit');
Route::put('admin/events', 'EventsController@update');