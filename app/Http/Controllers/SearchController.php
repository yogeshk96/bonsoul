<?php namespace App\Http\Controllers;

use DB;
use App\MenuCategory;
use App\Locality;
use App\Appointments;

class SearchController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/


	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function seachtreatment($city, $treatment)
	{

		return view('search', compact("city"));
	}

}
