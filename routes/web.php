<?php
use App\Models\Admin\Place;

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

// Dashboard
Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::group(['prefix' => 'admin','middleware'=>'auth'], function() {
    // User
    Route::resource('user', 'Admin\User\UsersController');
    Route::get('user/{user_id}/activate', 'Admin\User\UsersController@user_activate')->name('user.activated');
    Route::get('user/{user_id}/deactivate', 'Admin\User\UsersController@user_deactivate')->name('user.deactivated');

    //Location
    Route::resource('divisions', 'Admin\Location\Division\DivisionsController');
    Route::resource('districts', 'Admin\Location\District\DistrictsController');

    Route::post('getDistrict', 'Admin\Location\District\DistrictsController@getDistrict')->name('getDistrict');
    // Place
    Route::resource('places', 'Admin\Place\PlacesController');
    // Place Image
    Route::get('places/image/{id}/edit', 'Admin\Place\PlacesController@edit_image')->name('place.images.edit');
    Route::post('places/image/{id}/update', 'Admin\Place\PlacesController@update_image')->name('place.images.update');
    Route::delete('places/image/{id}/delete', 'Admin\Place\PlacesController@destroy_image')->name('place.images.delete');

    // Place Location
    Route::get('places/location/{id}/edit', 'Admin\Place\PlacesController@edit_location')->name('place.location.edit');
    Route::put('places/location/{id}/update', 'Admin\Place\PlacesController@update_location')->name('place.location.update');

});
