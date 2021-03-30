<?php

use Illuminate\Support\Facades\Route;


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
    return view('welcome');
});
Auth::routes();
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get("/players/search","App\Http\Controllers\PlayerController@search");

Route::get('auth/steam', '\App\Http\Controllers\AuthController@redirectToSteam')->name('auth.steam');
Route::get('auth/steam/handle', '\App\Http\Controllers\AuthController@handle')->name('auth.steam.handle');

Route::get("/players", 'App\Http\Controllers\PlayerController@index');
Route::get("/players/{player}",'App\Http\Controllers\PlayerController@show');

Route::get("/players/{player}/edit", 'App\Http\Controllers\PlayerController@edit');
Route::put("/players/{player}", 'App\Http\Controllers\PlayerController@update');




