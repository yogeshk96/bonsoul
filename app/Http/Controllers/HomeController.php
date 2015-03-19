<?php namespace App\Http\Controllers;

use DB;
use App\MenuCategory;
use App\Locality;
use App\Appointments;

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

		$topvenues = DB::table('appointment')->select(DB::raw('count(*) as total, venueId, venue.name'))->where('venue.cityId', '=', 1)->orderBy('total', 'desc')->groupBy('venueId')->join('venue', function($join)
        {
            $join->on('appointment.venueId', '=', 'venue.id');
        })
        ->take(5)->get();

        $randomvenues = DB::table('appointment')->select(DB::raw('venueId, venue.name'))->where('venue.cityId', '=', 1)->orderByRaw("RAND()")->groupBy('venueId')->join('venue', function($join)
        {
            $join->on('appointment.venueId', '=', 'venue.id');
        })
        ->take(5)->get();

		$toptreatments = Appointments::all();

		$treatmentarr = array();

		for($i=0;$i<count($toptreatments); $i++){

			$treatarr = json_decode($toptreatments[$i]['treatments']);

			foreach ($treatarr as $value) {
				
				if (array_key_exists($value,$treatmentarr)) {

					$treatmentarr[$value] = $treatmentarr[$value]+1;
				} else {

					$treatmentarr[$value] = 1;
				}
			}

		}
		arsort($treatmentarr);
		$toptreatment = array_slice($treatmentarr, 0, 5, true);

		$toptreatarr = array();
		$j=1;

		foreach ($toptreatment as $key=>$value) {

			$menus = MenuCategory::where('id', '=', $key)->first();
			$toptreatarr[$j]['id'] = $key;
			$toptreatarr[$j]['name'] = $menus->name;
			$j++;
		}

		$localities = Locality::all();
		$categories = MenuCategory::where('parent', '=', 0)->groupBy('name')->get();
		return view('home', compact("categories", "localities", "topvenues", "toptreatarr", "randomvenues"));

	}

}
