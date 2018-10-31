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

// Frontend
Route::get('/', 'Frontend\FrontendController@index')->name('frontend.home');
// place
Route::get('place/{slug}', 'Frontend\FrontendController@placeDetails')->name('frontend.place.details');
Route::get('places', 'Frontend\FrontendController@places')->name('frontend.places');
// hotel
Route::get('hotel/{slug}', 'Frontend\FrontendController@hotelDetails')->name('frontend.hotel.details');
// package
Route::get('package/{slug}', 'Frontend\FrontendController@packageDetails')->name('frontend.package.details');
Route::get('packages', 'Frontend\FrontendController@packages')->name('frontend.packages');
Route::get('packages/{slug}', 'Frontend\FrontendController@typePackages')->name('frontend.type.packages');
// search
Route::get('packages-search', 'Frontend\PackageSearchesController@searchPackages')->name('frontend.packages.search');
Route::get('get-districts', 'Frontend\PackageSearchesController@getDistrictsInFront')->name('frontend.getDistrict');
// auth
Auth::routes();

// admin Dashboard
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
// admin
Route::group(['prefix' => 'admin','middleware'=>'auth'], function() {
    // User
    Route::resource('user', 'Admin\User\UsersController');
    Route::get('user/{user_id}/activate', 'Admin\User\UsersController@user_activate')->name('user.activated');
    Route::get('user/{user_id}/deactivate', 'Admin\User\UsersController@user_deactivate')->name('user.deactivated');

    //Location
    Route::resource('divisions', 'Admin\Location\Division\DivisionsController');
    Route::resource('districts', 'Admin\Location\District\DistrictsController');

    // Place
    Route::resource('places', 'Admin\Place\PlacesController');

    // Place Image
    Route::get('places/image/{id}/edit', 'Admin\Place\PlacesController@edit_image')->name('place.images.edit');
    Route::post('places/image/{id}/update', 'Admin\Place\PlacesController@update_image')->name('place.images.update');
    Route::delete('places/image/{id}/delete', 'Admin\Place\PlacesController@destroy_image')->name('place.images.delete');

    // Place Location
    Route::get('places/location/{id}/edit', 'Admin\Place\PlacesController@edit_location')->name('place.location.edit');
    Route::put('places/location/{id}/update', 'Admin\Place\PlacesController@update_location')->name('place.location.update');

    // Hotel
    Route::resource('hotels', 'Admin\Hotel\HotelsController');

    // Hotel Image
    Route::get('hotels/image/{id}/edit', 'Admin\Hotel\HotelsController@edit_image')->name('hotel.images.edit');
    Route::post('hotels/image/{id}/update', 'Admin\Hotel\HotelsController@update_image')->name('hotel.images.update');
    Route::delete('hotels/image/{id}/delete', 'Admin\Hotel\HotelsController@destroy_image')->name('hotel.images.delete');

    // Hotel Location
    Route::get('hotels/location/{id}/edit', 'Admin\Hotel\HotelsController@edit_location')->name('hotel.location.edit');
    Route::put('hotels/location/{id}/update', 'Admin\Hotel\HotelsController@update_location')->name('hotel.location.update');

    // Package Type
    Route::resource('package-types', 'Admin\Package\PackageTypesController');

    // Package
    Route::resource('packages', 'Admin\Package\PackagesController');
    Route::get('package/{id}/edit-place-hotel', 'Admin\Package\PackagesController@editPlaceHotel')->name('packages.edit-place-hotel');
    Route::put('package/{id}/update-place-hotel', 'Admin\Package\PackagesController@updatePlaceHotel')->name('packages.update-place-hotel');
    Route::get('packages-is-active/{id}', 'Admin\Package\PackagesController@isActive')->name('packages.is_active');

    // get data by ajax
    Route::post('getDistricts', 'Admin\Location\District\DistrictsController@getDistrict')->name('getDistrict');
    Route::post('getPlaces', 'Admin\Place\PlacesController@getPlace')->name('getPlace');
    Route::post('getHotels', 'Admin\Hotel\HotelsController@getHotel')->name('getHotel');
});
