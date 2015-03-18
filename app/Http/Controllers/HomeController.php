<?php namespace App\Http\Controllers;

use App\MenuCategory;

class HomeController extends Controller {

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
	public function index()
	{

		$categories = MenuCategory::where('parent', '=', 0)->groupBy('name')->get();
		return view('home')->with('categories', $categories);
	}

}
