<?php namespace storeHouse\Http\Controllers;

use Auth;
use storeHouse\Models\User;
use storeHouse\Models\Discussion;
use storeHouse\Models\Log;
use Illuminate\Http\Request;

class DiscussionsController extends controller {

	public function getInsertDiscussion(){

		return view('Discussion.insert');

	}

	public function postInsertDiscussion(Request $request){

		$this->validate($request,[
			'disc_title' => 'required|max:60|unique:sthdiscussions',
			'disc_body' => 'required|min:50',
		]);

		$user = User::find(Auth::user()->id);

		if(!$user){
			abort('404');
		}

		$disc = Discussion::create([
			'disc_title' => $request->input('disc_title'),
			'disc_body' => $request->input('disc_body'),
		]);

		$save = $user->discussions()->save($disc);


		// create log
		$logRecord = Auth::user()->username
					.' started a new discussion titled as '
					.'"'.$request->input('disc_title').'"';

		$saveLog = Log::create([
			'log' => $logRecord,
		]);

        $message = ($save) ? 'Discussion started: wait for admin approval' : 'Problem occured: please try again';

		return redirect()->route('home')->withInfo($message);

	}

	public function getSingleDiscussion($discussionid){

		$discussion = Discussion::find($discussionid);

		if(!$discussion){
			abort('404');
		}

		$comments   = $discussion->comments()->active()->get();

		return view('discussion.single')
			->withDiscussion($discussion)
			->withComments($comments);

	}

}