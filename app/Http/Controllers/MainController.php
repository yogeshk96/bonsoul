<?php namespace App\Http\Controllers;

use View;
use App\Venue;
class MainController extends Controller {

	
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
	public function index($city, $venueid,$slug)
	{

		$venuedetail = Venue::where('id','=',$venueid)->first();

		$venuepics = json_decode($venuedetail->photos);

		if(!empty($venuepics)) {

			$venuepic = $venuepics[0]->original;
		} else {

			$venuepic = "";
		}

		return view("venue", compact("venuedetail", "venuepic"));
	}

}
