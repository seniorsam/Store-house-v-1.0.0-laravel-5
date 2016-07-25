<?php namespace storeHouse\Http\Controllers;
use DB;
use Auth;
use Illuminate\Http\Request;
use storeHouse\Models\User;
use storeHouse\Models\Discussion;

class UsersController extends Controller {

	public function getUserProfile($username)
	{
		$user = User::where('username',$username)->first();

		$discussions = $user->discussions;

		if(!$user) {
			abort('404');
		}

		return view('user.profile')
			->withUser($user)
			->withDiscussions($discussions);
	}

	public function getUpdateUserProfile(){
		return view('user.updateProfile');
	}

	public function postUpdateUserProfile(Request $request){

		$this->validate($request,[
			'address' => 'max:255|alpha_dash',
			'phone'   => 'max:255|digits:11',
		]);

		DB::table('sthusers')
		    ->where('id', Auth::user()->id)
		    ->update([
				'address' => $request->input('address'),
				'phone'   => $request->input('phone'),
		]);


		return redirect()->route('user.profile',['username' => Auth::user()->username])->withInfo('Your information updated');

	}

}