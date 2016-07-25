<?php namespace storeHouse\Http\Controllers;

use Auth;
use storeHouse\Models\User;
use storeHouse\Models\Discussion;
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

		$disc = Discussion::create([
			'disc_title' => $request->input('disc_title'),
			'disc_body' => $request->input('disc_body'),
		]);

		$user->discussions()->save($disc);

		return redirect()->route('home')->withInfo('Discussion started');

	}

	public function getSingleDiscussion($discussionid){
		$discussion = Discussion::find($discussionid);
		$comments   = $discussion->comments;
		return view('discussion.single')
			->withDiscussion($discussion)
			->withComments($comments);

	}

}