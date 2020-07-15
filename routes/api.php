<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;

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


Route::middleware(['apiLog'])->group(function () {

    Route::post('login', 'Auth\LoginController@login');
    Route::post('registerUsers', 'Auth\RegisterController@registerUsers');
    

    Route::middleware(['auth:api'])->group(function () {
        Route::post('show', 'Auth\LoginController@show');
        Route::post('refreshToken', 'Auth\LoginController@refreshToken');
    });

    Route::resource('brewerys', 'brewerysController');
    Route::resource('items', 'itemsController');

});

