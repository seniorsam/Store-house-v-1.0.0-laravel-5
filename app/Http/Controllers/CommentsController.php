<?php namespace storeHouse\Http\Controllers;

use DB;
use Auth;
use storeHouse\Models\User;
use storeHouse\Models\Discussion;
use storeHouse\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller {

	public function postAddComment(Request $request){
		
		$this->validate($request,[
			'comm_body' => 'required'
		]);

		$user = User::find(Auth::user()->id);
		$discussion = Discussion::find($request->input('discussion_id'));

		$comment = Comment::create([
			'comm_body' => $request->input('comm_body')
		]);

		// ->$user->comments->associate(Auth::user()->id);
		$user->comments()->save($comment);
		$discussion->comments()->save($comment);

		return redirect()->back()->withInfo('Comment added');
	}
}