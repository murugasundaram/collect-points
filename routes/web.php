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

Route::get('/register', function(){
	return 'Sorry for the trouble, You are not allowed to register. Get the Login information from the admin. Please contact Admin.';
})->name('register');

// anyone can access this route
Route::get('/progress', 'PointsController@viewProgress')->name('view_progress');

// only user can access these routes
Route::group(['middleware' => ['auth']], function () {
	Route::get('/collect/points', 'PointsController@index')->name('get_points');
	Route::post('/collect/points', 'PointsController@updatePoints')->name('update_points');
	Route::get('/progress/history', 'PointsController@viewHistory')->name('view_history');
});

// only admin can access these routes
Route::group(['middleware' => ['auth', 'onlyAdmin']], function () {
	Route::get('/dashboard', 'AdminController@viewDashBoad')->name('view_dash');
	Route::get('/configure', 'AdminController@viewConfigure')->name('view_config');
	Route::post('/configure', 'AdminController@saveConfigure')->name('save_config');
	Route::get('/users', 'UserController@index')->name('view_user');
	Route::get('/managePass', 'UserController@managePassword')->name('view_pass_manage');
	Route::post('/save/managePass', 'UserController@saveManagePassword')->name('save_password_config');
	Route::post('/save/userInfo', 'UserController@saveUserInfo')->name('save_user_info');
	
});