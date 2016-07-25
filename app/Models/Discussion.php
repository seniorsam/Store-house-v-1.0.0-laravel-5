<?php namespace storeHouse\Models;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model {

	protected $table = 'sthdiscussions';

	protected $fillable = [
		'disc_title',  
		'disc_body', 
	];

	public function users(){
		return $this->belongsTo('storeHouse\Models\User','sthuser_id');
	}	

	public function comments(){
		return $this->hasMany('storeHouse\Models\Comment','sthdiscussion_id');
	}

}
