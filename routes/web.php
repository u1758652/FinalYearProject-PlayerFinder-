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


Route::get('auth/steam', '\App\Http\Controllers\AuthController@redirectToSteam')->name('auth.steam');
Route::get('auth/steam/handle', '\App\Http\Controllers\AuthController@handle')->name('auth.steam.handle');

//Route::get("/players", 'App\Http\Controllers\PlayerController@getUserMmmrById');
Route::get("/players", 'App\Http\Controllers\PlayerController@index');

