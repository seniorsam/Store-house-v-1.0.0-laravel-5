<?php namespace storeHouse\Http\Controllers;

use DB;
use Auth;
use storeHouse\Models\User;
use storeHouse\Models\Discussion;
use storeHouse\Models\Comment;
use storeHouse\Models\Log;
use Illuminate\Http\Request;

class CommentsController extends Controller {

	public function postAddComment(Request $request){
		
		$this->validate($request,[
			'comm_body' => 'required'
		]);

		// check if there is a user and discussion with this info
		$user = User::find(Auth::user()->id);
		$discussion = Discussion::find($request->input('discussion_id'));

		$returnMessage = 'Comment added: wait for admin approval';

		if($user && $discussion){ // if founded

			$comment = Comment::create([
				'comm_body' => $request->input('comm_body')
			]);

			$user->comments()->save($comment);
			$discussion->comments()->save($comment);

			
			$logRecord = Auth::user()->username
						.' commented on a discussion titled as '
						.'"'.$discussion->disc_title.'"'
						.' by '
						.'"'.$discussion->users->username.'"';

			Log::create([
				'log' => $logRecord,
			]);

		} else {
			$returnMessage = 'Problem occured please try again';
		}

		return redirect()->back()->withInfo($returnMessage);
	}
}