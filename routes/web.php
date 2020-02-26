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

Route::any('/admin', function () {
    return view('admin/adminHome');
});

Route::resource('user', 'UserController');


Route::any('/admin/createuser', function () {
    return view('admin/addUser');
})->name('admin');