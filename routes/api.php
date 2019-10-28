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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('/register', 'UserController@register');

Route::get('/waitingroom', 'RoomController@index')->middleware('client_credentials');

Route::post('/messages', 'MessageController@store')->middleware('client_credentials');

Route::get('/messages', 'MessageController@index')->middleware('client_credentials');

Route::post('/room', 'RoomController@store')->middleware('client_credentials');

Route::delete('/room', 'RoomController@destroy')->middleware('client_credentials', 'creator');
