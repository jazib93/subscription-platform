<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('login', 'Api\v1\AuthController@login')->name('login');

Route::group(['middleware' => ['auth:api'], 'namespace' => 'Api\v1'], function () {

    Route::get('websites', 'WebsiteController@index');
    Route::post('websites', 'WebsiteController@store');
    Route::post('posts', 'PostController@store');
    Route::post('subscribers', 'SubscriberController@store');

    Route::post('logout','AuthController@logout');
});
