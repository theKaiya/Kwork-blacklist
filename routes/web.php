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


Route::get('/', 'PageController@home');

Route::get('/reviews', 'ReportController@showAll')->name('reviews_list');

Route::get('/reviews/add', 'ReportController@showAll')->name('reviews_add');

Route::get('/reviews/{id}', 'ReportController@show')->name('review_show');

Route::get('/people', 'PeopleController@showAll')->name('people_list');

Route::get('/people/{id}', 'PeopleController@show')->name('people_show');

Route::any('/login', 'LoginController@show')->name('login');

Route::any('/register', 'RegisterController@show')->name('register');
