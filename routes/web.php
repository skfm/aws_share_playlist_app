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

Route::prefix('login')->name('login.')->group(function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider')->name('{provider}');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback')->name('{provider}.callback');
});

Route::prefix('register')->name('register.')->group(function () {
    Route::get('/{provider}', 'Auth\RegisterController@showProviderUserRegistrationForm')->name('{provider}');
    Route::post('/{provider}', 'Auth\RegisterController@registerProviderUser')->name('{provider}');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('playlists')->name('playlists.')->group(function () {
    Route::put('/{playlist}/stock', 'PlaylistController@stock')->name('stock')->middleware('auth');

    Route::delete('/{playlist}/stock', 'PlaylistController@deleteStock')->name('deleteStock')->middleware('auth');

    Route::get('/serch/title', 'PlaylistController@serchTitle')->name('search_title');

    Route::get('/serch/tag', 'PlaylistController@serchTag')->name('serach_tag');
});

Route::resource('/playlists', 'PlaylistController')->except(['show', 'index'])->middleware('auth');

Route::resource('/playlists', 'PlaylistController')->only(['show', 'index']);

Route::resource('/stockfolders', 'StockFolderController')->middleware('auth');

Route::resource('/stocks', 'StockController')->except(['index','show','delete'])->middleware('auth');

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{name}', 'UserController@show')->name('show');

    Route::get('/{name}/stocks', 'UserController@stocks')->name('stocks');

    Route::get('/{name}/allstocks', 'UserController@allstocks')->name('allstocks');

    Route::get('/{name}/edit', 'UserController@edit')->name('edit');

    Route::patch('/{name}', 'UserController@update')->name('update');

    Route::delete('/{name}', 'UserController@destroy')->name('destroy');

    Route::get('/{name}/llplaylists', 'UserController@allplaylists')->name('allplaylists');
});

Route::get('/tags/{name}', 'TagController@show')->name('tags.show');

Route::get('/categories/{title}', 'CategoryController@show')->name('categories.show');


