<?php namespace storeHouse\Http\Controllers;
use storeHouse\Models\Discussion;
class HomeController extends Controller {

	public function index()
	{
		$discussions = Discussion::all()->sortByDesc('created_at');
		return view('home')->withDiscussions($discussions);
	}

}
