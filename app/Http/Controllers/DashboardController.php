<?php namespace storeHouse\Http\Controllers;

use DB;
use Auth;
use storeHouse\Models\User;
use storeHouse\Models\Item;
use storeHouse\Models\Discussion;
use storeHouse\Models\Comment;
use storeHouse\Models\Log;
use Illuminate\Http\Request;

class DashboardController extends Controller {

	public function index()
	{
		$statistics = [ // na = not active , a = active
			'commnum'  => $this->counts( Comment::class, 'na' ),
			'discnum'  => $this->counts( Discussion::class, 'na' ),
			'itemnum'  => $this->counts( Item::class, 'na' ),
			'usernum'  => $this->counts( User::class, 'na' ),
			'acommnum' => $this->counts( Comment::class, 'a' ),
			'adiscnum' => $this->counts( Discussion::class, 'a' ),
			'aitemnum' => $this->counts( Item::class, 'a' ),
			'ausernum' => $this->counts( User::class, 'a' ),
		];

		$logs = Log::orderBy('created_at', 'desc')->get();

		return view('dashboard.index')
				->withStatistics($statistics)
				->withLogs($logs);
	}

	protected function counts($target, $type){

		return ($type == 'a') ? $target::active()->get()->count() : $target::get()->count();

	}

	protected function message($operation, $clue){
		$message = ($operation) ? 'The ' . $clue . ' opearation done successfully': 'Problem occured: please try again';
		return $message;
	}

	/*
	|--------------------------------------------------------------------------
	| Users center
	|--------------------------------------------------------------------------
	*/

	public function getUsers()
	{
		$users = User::all();
		return view('dashboard.user.index')->withUsers($users);
	}

	public function getUserUpdate($username)
	{
		$user = User::where('username',$username)->first();

		if(!$user){
			abort('404');
		}

		return view('dashboard.user.update')->withUser($user);
	}	

	public function postUserUpdate(Request $request)
	{
		$this->validate($request,[
			'address' => 'max:255|alpha_dash',
			'phone'   => 'max:255|digits:11',
		]);

		$update = DB::table('sthusers')
		    ->where('id', $request->input('id'))
		    ->update([
				'address' => $request->input('address'),
				'phone'   => $request->input('phone'),
				'active'  => $request->has('active'),
		]);

        $message = $this->message($update, 'update');

		return redirect()->route('dashboard.users')->withInfo($message);

	}

	public function getUserSuspend($username, $action)
	{
		$update = DB::table('sthusers')
		    ->where('username', $username)
		    ->update([
				'suspend' => ($action == 'suspend') ? '1' : 0,
		]);

		$message = $this->message($update, '');

		return redirect()->route('dashboard.users')->withInfo($message);
	}

	/*
	|--------------------------------------------------------------------------
	| Items center
	|--------------------------------------------------------------------------
	*/	

	public function getItems(){
		$items = Item::get();
		return view('dashboard.item.index')->withItems($items);
	}

	public function getItemAdd(){
		return view('dashboard.item.add');	
	}	

	public function postItemAdd(Request $request){
		
		$this->validate($request,[
			'item_name' => 'required|max:50|unique:sthitems',
			'item_picture' => 'image',
			'item_quantity' => 'required|integer',
			'item_description' => 'required|min:10|max:250',
		]);

		/*
		* Handle picture process
		*/

		$imageName = '';

		if($request->hasFile('item_picture')){
	        $imageName = rand('0',1000000000).'-'.$request->file('item_picture')->getClientOriginalName();
			$request->file('item_picture')->move(public_path('images/items-pictures/'), $imageName);
		}

		/*
		* Handle user insertion process
		*/
		
		$user = User::find(Auth::user()->id);

		if(!$user){
			abort('404');
		}

		$item = Item::create([
			'item_name' => $request->input('item_name'),
			'item_picture' => $imageName,
			'item_quantity' => $request->input('item_quantity'),
			'item_description' => $request->input('item_description'),
			'item_active' => $request->has('item_active'),
		]);

		$save = $user->items()->save($item);

		$message = $this->message($save, 'insert');

		return redirect()->route('dashboard.items')->withInfo($message);
	}

	public function getItemUpdate($itemid){
		$item = Item::find($itemid);

		if(!$item)
		{
			abort('404');
		}

		return view('dashboard.item.update')->withItem($item);
	}

	public function postItemUpdate(Request $request){

		$this->validate($request,[
			'item_name' => 'required|max:50',
			'item_picture' => 'image',
			'item_quantity' => 'required|integer',
			'item_description' => 'required|min:10|max:250',
		]);

		/*
		* Handle picture if exist
		*/

		$flag = 0;

		if($request->hasFile('item_picture')){

			$imageName = rand('0',1000000000).'-'.$request->file('item_picture')->getClientOriginalName();
			$request->file('item_picture')->move(public_path('images/items-pictures/'), $imageName);
			$flag = 1;

		}

		$update = DB::table('sthitems')
			->where('id',$request->input('_id'))
			->update([
				'item_name' => $request->input('item_name'),
				'item_picture' => $flag ? $imageName : $request->input('item_picture_old'),
				'item_quantity' => $request->input('item_quantity'),
				'item_description' => $request->input('item_description'),
				'item_active' => $request->has('item_active'),
			]);

		$message = $this->message($update, 'update');

		return redirect()->route('dashboard.items')->withInfo($message);	

	}

	public function getItemDelete($itemid){
		$delete = DB::table('sthitems')->where('id','=',$itemid)->delete();

		$message = $this->message($delete, 'delete');

		return redirect()->route('dashboard.items')->withInfo('Item deleted successfully');
	}

	/*
	|--------------------------------------------------------------------------
	| Discussions center
	|--------------------------------------------------------------------------
	*/	

	public function getDiscussions(){
		$discussions = Discussion::get();
		return view('dashboard.discussion.index')->withDiscussions($discussions);
	}

	public function getDiscussionUpdate($id){
		$discussion = Discussion::where('id', $id)->first();

		if(!$discussion){
			abort('404');
		}

		return view('dashboard.discussion.update')->withDiscussion($discussion);
	}

	public function postDiscussionUpdate(Request $request){
		
		$this->validate($request,[
			'disc_title' => 'required',
			'disc_body' => 'required'
		]);

		$update = DB::table('sthdiscussions')
			->where('id', $request->input('id'))
			->update([
				'disc_title' => $request->input('disc_title'),
				'disc_body' => $request->input('disc_body'),
				'active' => $request->has('active'),
			]);

		$message = $this->message($update, 'update');

		return redirect()->route('dashboard.discussions')->withInfo($message);

	}

	public function getDiscussionDelete($id){
		$delete = DB::table('sthdiscussions')
			->where('id', $id)
			->delete();

		$message = $this->message($delete, 'delete');

		return redirect()->back()->withInfo('Discussion deleted successfully');
	}	

	/*
	|--------------------------------------------------------------------------
	| Users center
	|--------------------------------------------------------------------------
	*/

	public function getComments(){
		$comments = Comment::get();
		return view('dashboard.comment.index')->withComments($comments);
	}

	public function getCommentUpdate($id){
		$comment = Comment::where('id', $id)->first();

		if(!comment){
			abort('404');
		}

		return view('dashboard.comment.update')->withComment($comment);
	}


	public function postCommentUpdate(Request $request){
		
		$this->validate($request,[
			'comm_body' => 'required',
		]);

		$update = DB::table('sthcomments')
			->where('id', $request->input('id'))
			->update([
				'comm_body' => $request->input('comm_body'),
				'active' => $request->has('active')
			]);

		$message = $this->message($update, 'update');

		return redirect()->route('dashboard.comments')->withInfo($message);


	}

	public function getCommentDelete($id){
		$delete = DB::table('sthcomments')
			->where('id', $id)
			->delete();

		$message = $this->message($delete, 'delete');

		return redirect()->back()->withInfo($message);
	}

}
