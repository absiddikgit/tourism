<?php
use Illuminate\Http\Request;
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

/*****************************************
 *              Frontend Area
 ******************************************/
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

// booking
Route::get('booking/{package_slug}','Frontend\BookingController@packageBooking')->name('frontend.package.booking');

// contact
Route::get('contact', 'Frontend\ContactsController@index')->name('frontend.contact');
Route::post('contact', 'Frontend\ContactsController@store')->name('frontend.contact.store');



/*****************************************
 *              Customer Area
 ******************************************/
// customer login

Route::get('/login', 'Auth\CustomerLoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\CustomerLoginController@login')->name('customer.login.submit');

Route::get('/register', 'Auth\CustomerRegistersController@register')->name('customer.register');
Route::post('/register', 'Auth\CustomerRegistersController@store')->name('customer.register.store');
Route::get('register/confirm', 'ConfirmEmailController@index')->name('confirm.email');


Route::group(['middleware'=>'auth:customer'], function() {
    // dashboard
    Route::get('/dashboard', 'Customer\HomeController@index')->name('customer.dashboard');
    // profile
    Route::get('/profile', 'Customer\HomeController@profile')->name('customer.profile');
    Route::post('/profile', 'Customer\HomeController@profileStore')->name('customer.profile.store');
    // change password
    Route::get('/change-password', 'Customer\HomeController@changePassword')->name('customer.change-password');
    Route::post('/change-password', 'Customer\HomeController@changePasswordStore')->name('customer.change-password.store');

    // booking
    Route::get('booking','Frontend\BookingController@bookingConfirm')->name('frontend.package.booking.confirm');
    Route::post('booking-pay/paypal','Frontend\BookingController@payWithPaypal')->name('frontend.booking.pay-with-paypal');
    Route::get('booking-payment','Frontend\BookingController@paymentComplete')->name('frontend.booking.payment.store');
});




/*****************************************
 *               Admin Area
 ******************************************/
// auth
$this->get('admin/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
$this->post('admin/login', 'Auth\LoginController@login')->name('admin.login.submit');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

// admin
Route::group(['prefix' => 'admin','middleware'=>'auth'], function() {
    // Dashboard
    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    Route::group(['middleware'=>'isAdmin'], function() {
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
    });


    // Package Type
    Route::resource('package-types', 'Admin\Package\PackageTypesController');

    // Package
    Route::resource('packages', 'Admin\Package\PackagesController');
    Route::get('package/{id}/edit-place-hotel', 'Admin\Package\PackagesController@editPlaceHotel')->name('packages.edit-place-hotel');
    Route::put('package/{id}/update-place-hotel', 'Admin\Package\PackagesController@updatePlaceHotel')->name('packages.update-place-hotel');
    Route::get('packages-is-active/{id}', 'Admin\Package\PackagesController@isActive')->name('packages.is_active');

    // Booking

    Route::get('booking-packages', 'Admin\Booking\BookingController@index')->name('booking.packages');
    Route::get('booking-list/{package_id}', 'Admin\Booking\BookingController@list')->name('booking.list');

    // Customer
    Route::get('customers', 'Admin\Customer\CustomersController@index')->name('customers');
    Route::delete('customers/{id}', 'Admin\Customer\CustomersController@destroy')->name('customers.destroy');

    // contact
    Route::get('contacts', 'Admin\Contact\ContactsController@index')->name('contacts');
    Route::delete('contacts/{id}', 'Admin\Contact\ContactsController@destroy')->name('contacts.destroy');

    // get data by ajax
    Route::post('getDistricts', 'Admin\Location\District\DistrictsController@getDistrict')->name('getDistrict');
    Route::post('getPlaces', 'Admin\Place\PlacesController@getPlace')->name('getPlace');
    Route::post('getHotels', 'Admin\Hotel\HotelsController@getHotel')->name('getHotel');
});
