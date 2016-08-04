<?php namespace storeHouse\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

	protected $table = 'sthitems';

	protected $fillable = [
		'item_name',  
		'item_picture', 
		'item_quantity', 
		'item_description',
		'item_active',
	];

	public function users(){
		// don't forget to return the data
		return $this->belongsTo('storeHouse\Models\User','sthuser_id');
	}

	public function scopeActive($query){
		return $query->where('item_active', '1');
	}

}
