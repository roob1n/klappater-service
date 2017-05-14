<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('/', function () {
    return 'Hello!!';
});

// REGISTER / CHECK-IN (QR-CODE)
Route::post('register/{code}', 'AuthController@register');


// LOGIN

// USER PROFILE (update, upgrade, etc)
Route::get('profile', 'GuestsController@show');

// SONGS
Route::post('songs', 'SongsController@store');

// SUGGEST
Route::get('suggestions', 'SuggestionsController@index');
Route::post('suggestions/{song}', 'SuggestionsController@store');
Route::delete('suggestions/{suggestion}', 'SuggestionsController@destroy');

// VOTE
Route::post('votes/{suggestion}', 'VotesController@toggle');
