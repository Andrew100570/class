<?php

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


Route::group(['prefix' => 'admin', 'middleware' => 'AdminProperties'], function () {

    Route::get('/', 'Admin\AdminController@index')->name('admin');

});


Route::group(['prefix' => 'manager', 'middleware' => 'auth'], function () {

    Route::get('/', 'Admin\ManagerController@index')->name('manager');
    Route::get('/{id}', 'Admin\ManagerController@tableById')->name('manager.id');

});

