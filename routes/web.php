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

Route::group(['prefix' => 'clients', 'as' => 'clients.', 'middleware' => 'auth'], function () {

    Route::get('/', 'ClientController@index')->name('index');

});

// Route::get('/clients', ['uses' => 'ClientController@index', 'as' => 'clients.index']);
// Route::get('/connect', 'AccountController@connect')->name('connect');
// Route::get('/update', 'AccountController@update')->name('update');
// Route::post('/update', 'AccountController@store')->name('store');