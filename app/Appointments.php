<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model {

	protected $table = 'appointment';

	public function venuename()
	{	
		return $this->hasOne('venue','id','venueId');
	}

}
