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

Route::group(['middleware' => ['auth']], function () { //ensure users are validated before access
    Route::resource('/user_images', 'ImagesController');
    Route::DELETE('/user_images_multiple', 'ImagesController@destroy_multiple')->name('delete_multiple');
    Route::DELETE('/user_images_delete_all', 'ImagesController@destroy_all')->name('delete_all');
});
