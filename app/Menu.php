<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MenuCategory;

class Menu extends Model {

	protected $table = 'menu';

	public function allitems() {

		$this->hasOne('MenuCategory', 'id', 'venueId');
	}

}
