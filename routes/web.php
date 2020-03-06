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


Route::resource('user', 'UserController');

Route::get('user/deactivated', 'UserController@getDeactivated')->name('user.deactivated');

Route::get('grade', 'GradeController@index');

Route::delete('grade/{id}', 'GradeController@destroy');

Route::get('grade/{grade}', 'GradeController@show')->name('grade.show');

Route::resource('subject', 'SubjectController');

Route::resource('question', 'QuestionController');

Route::any('/admin/createuser', function () {
    return view('admin/addUser');
})->name('admin');