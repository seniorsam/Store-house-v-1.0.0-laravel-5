<?php namespace storeHouse\Http\Controllers;

use storeHouse\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller {

	public function getItems()
	{
		$items = Item::all();
		return view('item.items')->withItems($items);
	}

	public function postSearchedItems(Request $request)
	{
		$this->validate($request,[
			'searchword' => 'required'
		]);

		$items = Item::where('item_name','like','%'.$request->input('searchword').'%')->get();

		return view('item.search')->withItems($items);
	}

}
