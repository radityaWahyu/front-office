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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('auth')->group(function () {
    Route::post('/login','AuthController@login');
});

Route::get('/customer/all','CustomerController@getAll');


Route::group(['middleware' => ['auth.api']], function () {

    Route::prefix('auth')->group(function () {
        Route::get('/profil','AuthController@getUser');
        Route::get('/logout','AuthController@logout');
    });

    //---------------------------User API Routing--------------------------------------
    Route::prefix('user')->group(function () {
        Route::get('/get','UserController@index')->middleware(['can:manage-user']);
        Route::post('/add', 'UserController@store')->middleware(['can:manage-user']);
        Route::get('/show', 'UserController@show')->middleware(['can:manage-user']);
        Route::post('/save/{id}', 'UserController@update')->middleware(['can:manage-user']);
        Route::post('/delete', 'UserController@destroy')->middleware(['can:manage-user']);
    });

    //---------------------------Departement API Routing--------------------------------------
    Route::prefix('departement')->group(function () {
        Route::get('/get','DepartementController@index')->middleware(['can:manage-departement']);
        Route::post('/add', 'DepartementController@store')->middleware(['can:manage-departement']);
        Route::get('/show', 'DepartementController@show')->middleware(['can:manage-departement']);
        Route::post('/save/{id}', 'DepartementController@update')->middleware(['can:manage-departement']);
        Route::post('/delete', 'DepartementController@destroy')->middleware(['can:manage-departement']);
        Route::get('/list', 'DepartementController@list')->middleware(['can:manage-departement']);
    });

    //---------------------------Unit API Routing--------------------------------------
    Route::prefix('unit')->group(function () {
        Route::get('/get','UnitController@index')->middleware(['can:manage-unit']);
        Route::post('/add', 'UnitController@store')->middleware(['can:manage-unit']);
        Route::get('/show', 'UnitController@show')->middleware(['can:manage-unit']);
        Route::post('/save/{id}', 'UnitController@update')->middleware(['can:manage-unit']);
        Route::post('/delete', 'UnitController@destroy')->middleware(['can:manage-unit']);
        Route::get('/list', 'UnitController@list')->middleware(['can:manage-unit']);
    });

     //---------------------------Item API Routing--------------------------------------
     Route::prefix('item')->group(function () {
        Route::get('/get','ItemController@index')->middleware(['can:manage-unit']);
        Route::post('/add', 'ItemController@store')->middleware(['can:manage-unit']);
        Route::get('/show', 'ItemController@show')->middleware(['can:manage-unit']);
        Route::post('/save/{id}', 'ItemController@update')->middleware(['can:manage-unit']);
        Route::post('/delete', 'ItemController@destroy')->middleware(['can:manage-unit']);
    });

    //---------------------------Item API Routing--------------------------------------
    Route::prefix('customer')->group(function () {
        Route::get('/get','CustomerController@index')->middleware(['can:manage-customer']);
        Route::post('/add', 'CustomerController@store')->middleware(['can:manage-customer']);
        Route::get('/show', 'CustomerController@show')->middleware(['can:manage-customer']);
        Route::post('/save/{id}', 'CustomerController@update')->middleware(['can:manage-customer']);
        Route::post('/delete', 'CustomerController@destroy')->middleware(['can:manage-customer']);
    });

});