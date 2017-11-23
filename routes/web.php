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
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['namespace' => 'Auth', 'prefix' => 'login'], function () {
    Route::get('{authType}', [
        'uses' => 'LoginController@redirectToProvider',
        'as' => 'login_social'
    ]);
    Route::get('{authType}/callback', [
        'uses' => 'LoginController@handleProviderCallback',
        'as' => 'login_social_callback'
    ]);
});

Route::group(['middleware' => ['auth'], 'namespace' => 'Api', 'prefix' => 'api'], function() {

    Route::get('/twitter/feeds', [
        'as' => 'api_twitter_feeds',
        'uses' => 'TwitterController@feeds'
    ]);

    Route::get('/twitter/time-slots', [
        'as' => 'api_twitter_time_slots',
        'uses' => 'TwitterController@listTimeSlots'
    ]);
});
