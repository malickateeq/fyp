<?php

use App\Driver;
use App\Vehicle;
use App\VRoute;


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

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $baseURL = '/';
    // $baseURL = '/2019/picknride/';
    return view('pages.index')->with('baseURL', $baseURL);
});
Route::get('/', function () {
    $baseURL = '/';
    // $baseURL = '/2019/picknride/';
    return view('pages.index')->with('baseURL', $baseURL);
});
//Pages routing info
Route::get('/about', function(){
    $baseURL = '/';
    // $baseURL = '/2019/picknride/';
    return view('pages.about')->with('baseURL', $baseURL);
});

//Some general routes
Route::get('/fetchMe', 'MessageController@fetchMe');
//Route::get('/home', 'HomeController@index')->name('home');



//Message Controller
Route::get('/getUsers', 'MessageController@getUsers');
Route::get('/getAllMessages', 'MessageController@getAllMessages');
Route::get('/fetchMe', 'MessageController@fetchMe');
Route::post('/chat', 'MessageController@chatWith');
Route::get('/getFriend/{id}', 'MessageController@getFriend');
//private messages
Route::get('messages/{user}', 'MessageController@getMessages');
Route::post('messages/{user}', 'MessageController@sendMessages');


//Admin routing info
Route::resource('/admin','AdminController');
Route::get('/admin', 'AdminController@index')->name('admin');
Route::post('/addNewMember', 'AdminController@addNewMember');
Route::get('/getUsers', 'AdminController@getUsers');
Route::get('/deleteUser/{id}', 'AdminController@deleteUser');
Route::post('/updateUser', 'AdminController@updateUser');
Route::get('/findUser', 'AdminController@findUser');

Route::get('/getStats', 'AdminController@getStats');
Route::get('/adminProfile', 'AdminController@adminProfile');


//Driver routing info
Route::resource('/driver','DriverController');
Route::get('/driver', 'DriverController@index')->name('driver');

Route::get('/driverProfile', 'DriverController@driverProfile');
Route::post('/setDriverDirections', 'DriverController@setDriverDirections');
Route::post('/setRideInfo', 'DriverController@setRideInfo');


//Rider routing info
Route::resource('/rider','RiderController');
Route::get('/rider', 'RiderController@index')->name('rider');
Route::get('/profile', 'RiderController@profile');
Route::post('/setPreferences', 'RiderController@setPreferences');
Route::post('/setDirections', 'RiderController@setDirections');


// RideInfo
Route::get('/getPreview', 'RideFinderController@getPreview');
Route::get('/getRiderPreview', 'RideFinderController@getRiderPreview');
Route::post('/getRides', 'RideFinderController@getRides');
Route::post('/getRelevantRiders', 'RideFinderController@getRelevantRiders');
Route::post('/getPublicRides', 'RideFinderController@getPublicRides');

//Authentication routing info
Auth::routes();




Route::get('/contact', function(){
    return view('pages.contact');
});
Route::get('/services', function(){
    return view('pages.services');
});

Route::get('/searchRide', function(){
    return view('pages.searchRide');
});

//For reading Vue.js routs\
Route::get('{path}', function(){
    return view('pages.index');
})->where( 'path' , '([A-z\d\-\/_.]+)?' );