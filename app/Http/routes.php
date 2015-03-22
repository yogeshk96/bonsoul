<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('/feature', 'HomeController@feature');

Route::get('/team', 'MainController@team');

Route::get('/profile/{userid}', 'HomeController@profile');

Route::get('/search/{city}/{loca}/{treatment}', 'SearchController@seachtreatment');

Route::get('/search/{city}/{loca}/{treatment}/filter/{location}/{service}', 'SearchController@filtertreatment');

Route::get('/{city}/{venueid}/{slug}', 'MainController@index');