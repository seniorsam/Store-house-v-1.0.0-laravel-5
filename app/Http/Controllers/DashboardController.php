<?php namespace storeHouse\Http\Controllers;

use DB;
use Auth;
use storeHouse\Models\User;
use storeHouse\Models\Item;
use Illuminate\Http\Request;

class DashboardController extends Controller {

	public function index()
	{
		return view('dashboard.index');
	}

	/*
	|--------------------------------------------------------------------------
	| Users center
	|--------------------------------------------------------------------------
	*/
	public function getUsers()
	{
		$users = User::all();
		return view('dashboard.users')->withUsers($users);
	}

	public function getUserUpdate($username)
	{
		$user = User::where('username',$username)->first();
		return view('dashboard.updateUser')->withUser($user);
	}	

	public function postUserUpdate(Request $request)
	{
		$this->validate($request,[
			'address' => 'max:255|alpha_dash',
			'phone'   => 'max:255|digits:11',
		]);

		DB::table('sthusers')
		    ->where('id', $request->input('id'))
		    ->update([
				'address' => $request->input('address'),
				'phone'   => $request->input('phone'),
		]);


		return redirect()->route('dashboard.users')->withInfo('information updated successfully');

	}

	public function getUserDelete($username)
	{
		DB::table('sthusers')->where('username', '=', $username)->delete();
		return redirect()->route('dashboard.users')->withInfo('User deleted');
	}

	/*
	|--------------------------------------------------------------------------
	| Items center
	|--------------------------------------------------------------------------
	*/	

	public function getItems(){
		$items = Item::all();
		return view('dashboard.items')->withItems($items);
	}

	public function getItemAdd(){
		return view('dashboard.addItem');	
	}	

	public function postItemAdd(Request $request){
		
		$this->validate($request,[
			'item_name' => 'required|max:50|alpha-dash|unique:sthitems',
			'item_picture' => 'image',
			'item_quantity' => 'required|integer',
			'item_description' => 'required|min:10|max:250',
		]);

		/*
		* Handle picture processing
		*/

		$imageName = rand('0',1000000000).'-'.$request->file('item_picture')->getClientOriginalName();
		$request->file('item_picture')->move(public_path('images/itemPictures/'), $imageName);

		/*
		* Handle user insertion process
		*/
		$user = User::find(Auth::user()->id);

		$item = Item::create([
			'item_name' => $request->input('item_name'),
			'item_picture' => $imageName,
			'item_quantity' => $request->input('item_quantity'),
			'item_description' => $request->input('item_description'),
		]);

		$user->items()->save($item);

		return redirect()->route('dashboard.items')->withInfo('Item created successfully');
	}

	public function getItemUpdate($itemid){
		$item = Item::find($itemid);
		return view('dashboard.updateItem')->withItem($item);
	}

	public function postItemUpdate(Request $request){

		$this->validate($request,[
			'item_name' => 'required|max:50|alpha-dash',
			'item_picture' => 'image',
			'item_quantity' => 'required|integer',
			'item_description' => 'required|min:10|max:250',
		]);

		/*
		* Handle picture if exist
		*/

		if($request->file('item_picture')){

			$imageName = rand('0',1000000000).'-'.$request->file('item_picture')->getClientOriginalName();
			$request->file('item_picture')->move(public_path('images/itemPictures/'), $imageName);

		}

		DB::table('sthitems')
			->where('id',$request->input('_id'))
			->update([
				'item_name' => $request->input('item_name'),
				'item_picture' => $request->file('item_picture') ? $imageName : $request->input('item_picture_old'),
				'item_quantity' => $request->input('item_quantity'),
				'item_description' => $request->input('item_description'),
			]);

		return redirect()->route('dashboard.items')->withInfo('Item updated successfully');	

	}

	public function getItemDelete($itemid){
		DB::table('sthitems')->where('id','=',$itemid)->delete();
		return redirect()->route('dashboard.items')->withInfo('Item deleted successfully');
	}



}
