<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use View;

abstract class Controller extends BaseController {

	use DispatchesCommands, ValidatesRequests;

	public function __construct()
  	{
	    // Fetch the User object
	    $locUrl = "";

	    $cdnUrl = "http://d2rmoau0tbh3pz.cloudfront.net";
	 
	    // Sharing is caring
	    View::share('locUrl', $locUrl);
	    View::share('cdnUrl', $cdnUrl);
  	}

	
}
