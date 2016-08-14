<?php namespace storeHouse\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use storeHouse\Models\User;

class AuthController extends controller {

	/*
	* Sign up user view
	*/
	public function getSignup(){
		return view('auth.signup');
	}

	/*
	* Sign up post data
	*/
	public function postSignup(Request $request){
		
		/*
		*validate users data
		*/
		$this->validate($request,[
			'username' => 'required|max:25|alpha-dash|unique:sthusers',
			'email'    => 'required|max:255|unique:sthusers',
			'password' => 'required|max:255',
		]);
		
		/*
		*add user data to database
		*/
		$insert = User::create([
			'username' => $request->input('username'),
			'email'    => $request->input('email'),
			'password' => bcrypt($request->input('password')),
		]);

		$message = ($operation) ? 'You signed up successfully': 'Problem occured';

		return redirect()->route('auth.signin')->withInfo($message);
	}

	/*
	* Sign in view
	*/
	public function getSignin(){
		return view('auth.signin');
	}

	/*
	* Sign in view
	*/
	public function postSignin(Request $request){

		/*
		* validate the user data
		*/
		$this->validate($request, [
			'email' =>    'required',
			'password' => 'required'
		]);

		/*
		*Attempt the user
		*/
		if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')], $request->has('remember'))){
			return redirect()->route('home')->withInfo('You signed in successfully');
		} else {
			return redirect()->route('auth.signin')->withInfo('Could not find user with this information');
		}
	}

	/*
	* Sign out user
	*/

	public function getSignout(){
		$logout = Auth::logout();		
		return redirect()->route('home');
	}


} 