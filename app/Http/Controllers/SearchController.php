<?php namespace App\Http\Controllers;

use DB;
use App\MenuCategory;
use App\Locality;
use App\Appointments;
use App\Venue;
use App\VenueStats;
use App\MenuItem;
use App\City;

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
	public function seachtreatment($city,$loca, $treatment)
	{

		$thislocality = Locality::where('name', '=', $loca)->first();

		$thiscategory = MenuCategory::where('name', '=', $treatment)->first();
		if($thiscategory) {

			$relatedtreatments = MenuCategory::where('parent', '=', $thiscategory->id)->get();
		} else {

			$relatedtreatments = array();
		}

		$getmenu = DB::table("menu_category")->select('menu_category.id as catid','menu.venueId')->where('menu_category.name', '=', $treatment)->join('menu', function($join)
        {
            $join->on('menu.id', '=', 'menu_category.menuId');
        })->take("30")->get();

        $venueArr = array();
        $rating = array();

        $menuitems = array();
        $venuepicarr = array();

        for($j=0;$j<count($getmenu); $j++) {

        	$venuedetail = Venue::where('id', '=', $getmenu[$j]->venueId)->where('localityId', '=', $thislocality->id)->where('public','=', 1)->first();
        	if($venuedetail) {

        		$explodename = explode(" ", $venuedetail->name);

        		$venuename = implode("_", $explodename);

        		$venuenamearr[$getmenu[$j]->venueId] = $venuename;

        		$venuepic = json_decode($venuedetail->photos);

        		if(!empty($venuepic)) {

        			$venuepicarr[$getmenu[$j]->venueId] = $venuepic[0]->original;
        		} else {

        			$venuepicarr[$getmenu[$j]->venueId] = "";
        		}

	        	$venuerating = VenueStats::select('averageRating')->where('venueId', '=', $getmenu[$j]->venueId)->first();

	        	$rating[$getmenu[$j]->venueId] = $venuerating->averageRating;

	        	$rating[$getmenu[$j]->venueId] = $venuerating->averageRating;

	        	$menuitems[$getmenu[$j]->venueId] = MenuItem::where('categoryId', '=', $getmenu[$j]->catid)->get();

	        	array_push($venueArr, $venuedetail);
	        }
        }
//print_r($menuitems);
		$localities = Locality::all();
		$categories = MenuCategory::where('parent', '=', 0)->groupBy('name')->get();
		return view('search', compact("categories", "localities", "relatedtreatments", "venueArr", "rating", "menuitems", "venuepicarr", "venuenamearr", "city"));

	}

	public function filtertreatment($city, $loca, $treatment, $location, $service)
	{

		$services = explode(",", $service);

		if($location == "All") {

			$thiscity = City::where('name', '=', $city)->first();

		} else {

			$thislocality = Locality::where('name', '=', $location)->first();
		}

		$thiscategory = MenuCategory::where('name', '=', $treatment)->first();
		if($thiscategory) {

			$relatedtreatments = MenuCategory::where('parent', '=', $thiscategory->id)->get();
		} else {

			$relatedtreatments = array();
		}

		if($services[0] == "All") {

			$getmenu = DB::table("menu_category")->select('menu_category.id as catid','menu.venueId')->where('menu_category.name', '=', $treatment)->join('menu', function($join)
	        {
	            $join->on('menu.id', '=', 'menu_category.menuId');
	        })->take("30")->get();
		} else {

			$getmenu = DB::table("menu_category")->select('menu_category.id as catid','menu.venueId')->whereIn('menu_category.name', $services)->join('menu', function($join)
	        {
	            $join->on('menu.id', '=', 'menu_category.menuId');
	        })->take("30")->get();
		}

        $venueArr = array();
        $rating = array();

        $menuitems = array();
        $venuepicarr = array();

        $venuenamearr = array();

        for($j=0;$j<count($getmenu); $j++) {

        	if($location == "All") {

        		$venuedetail = Venue::where('id', '=', $getmenu[$j]->venueId)->where('cityId', '=', $thiscity->id)->where('public','=', 1)->first();
        	} else {

        		$venuedetail = Venue::where('id', '=', $getmenu[$j]->venueId)->where('localityId', '=', $thislocality->id)->where('public','=', 1)->first();
        	}
        	if($venuedetail) {

        		$explodename = explode(" ", $venuedetail->name);

        		$venuename = implode("_", $explodename);

        		$venuenamearr[$getmenu[$j]->venueId] = $venuename;

        		$venuepic = json_decode($venuedetail->photos);

        		if(!empty($venuepic)) {

        			$venuepicarr[$getmenu[$j]->venueId] = $venuepic[0]->original;
        		} else {

        			$venuepicarr[$getmenu[$j]->venueId] = "";
        		}

	        	$venuerating = VenueStats::select('averageRating')->where('venueId', '=', $getmenu[$j]->venueId)->first();

	        	$rating[$getmenu[$j]->venueId] = $venuerating->averageRating;

	        	$rating[$getmenu[$j]->venueId] = $venuerating->averageRating;

	        	$menuitems[$getmenu[$j]->venueId] = MenuItem::where('categoryId', '=', $getmenu[$j]->catid)->get();

	        	array_push($venueArr, $venuedetail);
	        }
        }

        $venueArr = array_unique($venueArr);
//print_r($venuenamearr);
		$localities = Locality::all();
		$categories = MenuCategory::where('parent', '=', 0)->groupBy('name')->get();
		return view('search', compact("categories", "localities", "relatedtreatments", "venueArr", "rating", "menuitems", "venuepicarr", "venuenamearr", "city"));

	}

}
