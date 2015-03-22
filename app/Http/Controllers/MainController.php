<?php namespace App\Http\Controllers;

use View;
use App\Venue;
use App\MenuCategory;
use App\Locality;
use App\SelfReview;
use App\Menu;
use App\MenuItem;

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

		$selfreviews = SelfReview::where('venueId','=',$venueid)->get();

		$venuepics = json_decode($venuedetail->photos);

		$venuepicArr = array();

		if(!empty($venuepics)) {

			foreach($venuepics as $venuep) {

				$venuepicArr[] = $venuep->original;
			}
		}

		$mainpic = $venuepics[0]->original;

		$venueitems = Menu::where('venueId', '=', $venueid)->with(array('allitems' => function($query){
				$query->where('parent','=',0)->whereNotIn('name', ['Membership','Classes']);
			}))->get();


		$itemarr = $venueitems[0]->allitems;

		$itemsub = array();


		foreach ($itemarr as $itemsingle) {
			
			$itemid = $itemsingle->id;

			$itemsub[$itemid] = MenuCategory::where('parent','=',$itemid)->get();
		}

		$venueprice = array();

		foreach ($itemsub as $venuet) {

			foreach ($venuet as $value) {

				$catid = $value->id;
				$venueprice[$catid] = MenuItem::where('categoryId', '=', $catid)->get();
			}
			
		}

		//return $venueprice;
		
		$localities = Locality::all();
		$categories = MenuCategory::where('parent', '=', 0)->groupBy('name')->get();

		return view("venue", compact("venuedetail", "localities", "categories", "venuepicArr", "mainpic", "selfreviews", "venueitems", "itemsub", "venueprice"));
	}

	public function team() {

		return view('team');
	}

}
