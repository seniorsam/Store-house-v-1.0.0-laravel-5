<?php namespace storeHouse\Http\Controllers;

use storeHouse\Models\Discussion;

class HomeController extends Controller {

	public function index()
	{
		// paginate = get
		$discussions = Discussion::active()
			->orderBy('created_at', 'desc')
			->paginate(5);
		return view('home')->withDiscussions($discussions);
	}

}
