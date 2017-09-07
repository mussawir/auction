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

Route::get('/check', 'HomeController@index');

Route::get('/members', 'members\MembersController@index');

Route::get('/admin', 'admin\AdminController@index');

Route::get('/superadmin', 'superadmin\SuperadminController@index');



