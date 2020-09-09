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

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/playlists', 'PlaylistController')->except(['show'])->middleware('auth');

Route::resource('/playlists', 'PlaylistController')->only(['show']);

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{name}', 'UserController@show')->name('show');

    Route::get('/{name}/edit', 'UserController@edit')->name('edit');

    Route::patch('/{name}', 'UserController@update')->name('update');
});
