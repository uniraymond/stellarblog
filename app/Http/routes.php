<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function() {
//    Route::get('blog/create',  'BlogController@create')->name('blog.create');
//    Route::get('blog/{blog}/edit',  'BlogController@edit')->name('blog.edit');
//    Route::post('blog', 'BlogController@store')->name('blog.new');
//    Route::put('blog', 'BlogController@update')->name('blog.update');
//    Route::patch('blog', 'BlogController@update');
//    Route::delete('blog/{blog}', 'BlogController@destroy')->name('blog.delete');
    Route::resource('blog', 'BlogController');
});

Route::get('blog', 'BlogController@index');
Route::get('blog/{blog}', 'BlogController@show');