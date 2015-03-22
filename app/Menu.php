<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {

	protected $table = 'menu';

	public function allitems() {

		return $this->hasMany('App\MenuCategory', 'menuId', 'id');
	}

}
