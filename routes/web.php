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
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/collect/points', 'PointsController@index')->name('get_points')->middleware('auth');
Route::post('/collect/points', 'PointsController@updatePoints')->name('update_points')->middleware('auth');

Route::get('/progress', 'PointsController@viewProgress')->name('view_progress');


Route::get('/dashboard', 'AdminController@viewDashBoad')->name('view_dash')->middleware('auth');
Route::get('/configure', 'AdminController@viewConfigure')->name('view_config')->middleware('auth');
Route::post('/configure', 'AdminController@saveConfigure')->name('save_config')->middleware('auth');

