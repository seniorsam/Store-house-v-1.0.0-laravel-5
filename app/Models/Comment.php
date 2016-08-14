<?php namespace storeHouse\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	protected $table = 'sthcomments';

	protected $fillable = [
		'comm_body',  
		'active'  
	];

	public function users(){
		// don't forget to return the data
		return $this->belongsTo('storeHouse\Models\User','sthuser_id');
	}

	public function scopeActive($query){
		return $query->where('active',1);
	}

}
