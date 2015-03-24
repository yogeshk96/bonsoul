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

/**
* for creating new user
*/
class SetCookie
{
	
	public function set_cookie($cookiename, $userid, $set) {

     	if($set == "+")
          { $cookie_expire = time()+60*60*24*30; }
	    else 
	          { $cookie_expire = time()-60*60*24*30; }		

	    setcookie($cookiename, $userid, $cookie_expire, '/');

	} 
}

Route::get('/', 'HomeController@index');

Route::get('/book_appointment', 'MainController@book_appointment');

Route::get('/login', 'MainController@login');

Route::get('/logout', 'MainController@logout');

Route::get('/siteregister', 'MainController@siteregister');

Route::get('/feature', 'HomeController@feature');

Route::get('/team', 'MainController@team');

Route::get('/profile/{userid}', 'HomeController@profile');

Route::get('/search/{city}/{loca}/{treatment}', 'SearchController@seachtreatment');

Route::get('/search/{city}/{loca}/{treatment}/filter/{location}/{service}', 'SearchController@filtertreatment');

Route::get('/{city}/{venueid}/{slug}', 'MainController@index');