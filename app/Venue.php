<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model {

	protected $table = 'venue';
	public $timestamps = false;
	protected $guarded=['id'];

}
