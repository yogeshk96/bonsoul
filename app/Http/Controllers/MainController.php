<?php namespace App\Http\Controllers;

use View;
use App\Venue;
use App\MenuCategory;
use App\Appointments;
use App\Locality;
use App\SelfReview;
use App\Menu;
use App\MenuItem;
use App\User;
use Request;
use SetCookie;

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
		$userid = 0;
		if(isset($_COOKIE['userid'])) {
			$userid = $_COOKIE['userid'];
		}

		//return $venueprice;
		
		$localities = Locality::all();
		$categories = MenuCategory::where('parent', '=', 0)->groupBy('name')->get();

		return view("venue", compact("venuedetail", "localities", "categories", "venuepicArr", "mainpic", "selfreviews", "venueitems", "itemsub", "venueprice", "userid"));
	}

	public function team() {

		return view('team');
	}

	public function book_appointment() {

		$userid = Request::input('userid');
		$venueid = Request::input('venueid');
		$appointdate = Request::input('appointdate');
		$appointtime = Request::input('appointtime');
		$appointtime = Request::input('appointtime');
		$appointtime = date("H:i A", strtotime($appointtime));
		$contact = Request::input('contact');
		$allservices = json_encode(Request::input('allservices'));
		$created_at = date("Y-m-d H:i:s");

		$user = User::where('id', '=', $userid)->first();
		if($user) {

			$singleappoint=array(
				'venueId'=>$venueid,
				'name'=>$user->name,
				'contact'=>$contact,
				'treatments'=>$allservices,
				'date'=>$appointdate,
				'time'=>$appointtime,
				'email'=>$user->email,
				'userId'=>$userid,
				'created'=>$created_at
				);
			$createappoint=Appointments::create($singleappoint);
			$out =1;

		} else {

			$out = 0;
		}
		return $out;
	}

	public function logout(SetCookie $setcookie) {

		$userid = $_COOKIE['userid'];

		if($userid) {

			//removing cookie for userid
			$setcookie->set_cookie('userid', $userid, '-');
			$out = 1;

		} else {

			$out = 0;
		}

		return $out;
	}

	public function login(SetCookie $setcookie) {

		$email = Request::input('email');
		$pass = Request::input('pass');
		$pass = md5($pass);

		$user = User::where('email', '=', $email)->where('password', '=', $pass)->first();
		if($user) {

			$userid = $user->id;
			//setting cookie for userid
			$setcookie->set_cookie('userid', $userid, '+');
			$out = $user->name;

		} else {

			$out = 0;
		}

		return $out;
	}

	public function siteregister(SetCookie $setcookie) {

		$email = Request::input('email');
		$pass = Request::input('pass');
		$pass = md5($pass);
		$name = Request::input('name');

		$user = User::where('email', '=', $email)->get();
		if($user->count() == 0) {

			$singleuser=array(
				'email'=>$email,
				'name'=>$name,
				'password'=>$pass
				);
			$createuser=User::create($singleuser);
			$userid = $createuser->id;

			//setting cookie for userid
			$setcookie->set_cookie('userid', $userid, '+');
			$out = $name;

		} else {

			$out = 0;
		}

		return $out;
	}

}
