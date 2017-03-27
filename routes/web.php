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

Route::get('/', 'SearchController@show')->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/reviews/add', 'ReportController@show_creating_page')->name('reviews_create');
    Route::post('/reviews/add', 'ReportController@create_action')->name('reviews_create_action');

    Route::get('/people/add', 'PeopleController@create')->name('people_create');
    Route::post('/people/add', 'PeopleController@create_action')->name('people_create_action');

    Route::get('/settings', 'SettingController@show')->name('settings');

});

Route::get('/reviews', 'ReportController@showAll')->name('reviews_list');

Route::get('/reviews/{id}', 'ReportController@show')->name('review_show');

Route::get('/people', 'PeopleController@showAll')->name('people_list');

Route::get('/people/{id}', 'PeopleController@show')->name('people_show');

Route::any('/api/search.get', 'Api\Search@get');

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/login', 'LoginController@show')->name('login');
    Route::post('/login', 'LoginController@action')->name('login_action');

    Route::get('/register', 'RegisterController@show')->name('register');
    Route::post('/register', 'RegisterController@action')->name('register_action');

    Route::any('/logout', 'LoginController@logout')->name('logout');
});

Route::group(['prefx' => 'admin', 'middleware' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('/reviews', 'ReviewController@show');

});

Route::any('/about', 'PageController@about')->name('about');
