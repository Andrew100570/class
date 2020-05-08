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

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin', 'middleware' => 'AdminProperties'], function () {

    Route::get('/', 'Admin\AdminController@index')->name('admin');
    Route::get('/{id}', 'Admin\AdminController@tableById')->name('manager_by_id');
    Route::post('/{user_id}', 'Admin\AdminController@saveEntry')->name('admin_entry');
    Route::get('/edit/{id}', 'Admin\AdminController@editEntry')->name('admin_edit');
    Route::post('/save/', 'Admin\AdminController@saveEditEntry')->name('admin_edit_save');
    Route::get('/delete/{id}', 'Admin\AdminController@deleteEntry')->name('admin_delete');

});


Route::group(['prefix' => 'manager', 'middleware' => ['auth','verified']], function () {

    Route::get('/', 'Admin\ManagerController@index')->name('manager');
    Route::post('/', 'Admin\ManagerController@saveEntry')->name('manager_entry');
    Route::get('/edit/{id}', 'Admin\ManagerController@editEntry')->name('manager_edit');
    Route::post('/save', 'Admin\ManagerController@saveEditEntry')->name('manager_edit_save');
});

