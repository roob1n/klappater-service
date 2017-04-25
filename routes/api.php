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

// LOGIN

// USER PROFILE (update, upgrade, etc)

// SEARCH

// SUGGEST
Route::resource('suggestion', 'SuggestionsController', ['only' => [
    'index', 'store', 'show', 'update', 'destroy']]);

// VOTE
Route::resource('vote', 'VotesController', ['only' => [
    'index', 'store', 'show', 'update', 'destroy']]);
