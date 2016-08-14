<?php namespace storeHouse\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model {
	protected $table = 'sthlogs';

	protected $fillable = [
		'log',
		'checked'
	];
}