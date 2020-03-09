<?php

use Illuminate\Http\Request;
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Read: *');
header( 'Access-Control-Allow-Headers: Authorization, Content-Type' );
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/user', 'UserController@authenticate');
Route::post('/items', 'UserController@updateItems');
Route::get('/items/{tokenValue}', 'UserController@getUserItems');
Route::get('/items', 'UserController@getItems');
Route::get('/itemsSummary/{tokenValue}', 'UserController@getUserItemsSummary');

