<?php namespace storeHouse\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable  as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract{

	use Authenticatable, CanResetPassword;

	protected $table = 'sthusers';

	protected $fillable = [
	'username', 
	'email', 
	'address',
	'phone',
	'password',
	'active',
	'suspend'
	];

	protected $hidden   = [
	'password', 
	'remember_token'
	];

	public function getUserAvatar(){
		$email = md5( strtolower( trim( $this->email ) ) );
		return "https://www.gravatar.com/avatar/$email?s=40&d=mm";
	}

	public function items(){
		// don't forget to return the data
		return $this->hasMany('storeHouse\Models\Item','sthuser_id');
	}

	public function discussions(){
		// don't forget to return the data
		return $this->hasMany('storeHouse\Models\Discussion','sthuser_id');
	}

	public function comments(){
		return $this->hasMany('storeHouse\Models\Comment','sthuser_id');		
	}

	public function cars(){
		return $this->hasMany('storeHouse\Models\Car','sthusers_id');				
	}

	public function scopeActive($query){
		return $query->where('active', '1');
	}
}
