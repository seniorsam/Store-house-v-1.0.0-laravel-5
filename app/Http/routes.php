<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [
	'uses' => 'HomeController@index',
	'as'   => 'home',
]);

Route::get('home','HomeController@index');

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/

Route::get('signup',[
	'uses' => 'AuthController@getSignup',
	'as'   => 'auth.signup',
	'middleware' => 'guest',
]);

Route::post('signup',[
	'uses' => 'AuthController@postSignup',
	'middleware' => 'guest',
]);

Route::get('signin',[
	'uses' => 'AuthController@getSignin',
	'as'   => 'auth.signin',
	'middleware' => 'guest',
]);

Route::post('signin',[
	'uses' => 'AuthController@postSignin',
	'middleware' => 'guest',
]);

Route::get('signout',[
	'uses' => 'AuthController@getSignout',
	'as' =>   'auth.signout',
	'middleware'   => 'auth',
]);

/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
*/

Route::get('/profile/{username}/show',[
	'uses' => 'UsersController@getUserProfile',
	'as'   => 'user.profile',
	'middleware'   => 'auth',
]);

Route::get('/profile/update',[
	'uses' => 'UsersController@getUpdateUserProfile',
	'as'   => 'user.profile.update',
	'middleware'   => 'auth',
]);

Route::post('/profile/update',[
	'uses' => 'UsersController@postUpdateUserProfile',
	'middleware'   => 'auth',
]);

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::group([

		'middleware' => ['auth', 'auth.admin'],
		'prefix' => 'dashboard'

	],function(){

	/******************
	* Dashboard users *
	*******************/	

	Route::get('/',[
		'uses' => 'DashboardController@index',
		'as' => 'dashboard.index',
	]);

	Route::get('users',[
		'uses' => 'DashboardController@getUsers',
		'as' => 'dashboard.users',
	]);

	Route::get('{username}/update',[
		'uses' => 'DashboardController@getUserUpdate',
		'as' => 'dashboard.user.update',
	]);

	Route::post('{username}/update',[
		'uses' => 'DashboardController@postUserUpdate',
	]);

	Route::get('{username}/{action}/stop',[
		'uses' => 'DashboardController@getUserSuspend',
		'as'   => 'dashboard.user.delete',
	]);

	/************************
	* Dashboard discussions *
	*************************/

	Route::get('discussions',[
		'uses' => 'DashboardController@getDiscussions',
		'as' => 'dashboard.discussions',
	]);

	Route::get('{discussionid}/updateDiscussion',[
		'uses' => 'DashboardController@getDiscussionUpdate',
		'as' => 'dashboard.discussion.update',
	]);

	Route::post('{discussionid}/updateDiscussion',[
		'uses' => 'DashboardController@postDiscussionUpdate',
	]);

	Route::get('{discussionid}/deleteDiscussion',[
		'uses' => 'DashboardController@getDiscussionDelete',
		'as' => 'dashboard.discussion.delete',
	]);

	/******************
	* Dashboard items *
	*******************/

	Route::get('items',[
		'uses' => 'DashboardController@getItems',
		'as'   => 'dashboard.items',
	]);

	Route::get('item/add',[
		'uses' => 'DashboardController@getItemAdd',
		'as'   => 'dashboard.item.add',
	]);

	Route::post('item/add',[
		'uses' => 'DashboardController@postItemAdd',
	]);

	Route::get('{itemid}/updateitem',[
		'uses' => 'DashboardController@getItemUpdate',
		'as'   => 'dashboard.item.update',	
	]);

	Route::post('{itemid}/updateitem',[
		'uses' => 'DashboardController@postItemUpdate',	
	]);

	Route::get('{itemid}/deleteitem',[
		'uses' => 'DashboardController@getItemDelete',	
		'as'   => 'dashboard.item.delete',
	]);

	/******************
	* Dashboard items *
	*******************/

	Route::get('comments',[
		'uses' => 'DashboardController@getComments',
		'as'   => 'dashboard.comments'
	]);

	Route::get('{commentid}/commentUpdate',[
		'uses' => 'DashboardController@getCommentUpdate',
		'as'   => 'dashboard.comment.update'
	]);

	Route::post('{commentid}/commentUpdate',[
		'uses' => 'DashboardController@postCommentUpdate',
	]);

	Route::get('{commentid}/deleteComment',[
		'uses' => 'DashboardController@getCommentDelete',
		'as'   => 'dashboard.comment.delete'
	]);

}); // end of dashboard group route

/*
|--------------------------------------------------------------------------
| Discussions
|--------------------------------------------------------------------------
*/

Route::get('discussion/insert',[
	'uses' => 'DiscussionsController@getInsertDiscussion',
	'as' => 'discussion.insert',
	'middleware' => 'auth',
]);

Route::post('discussion/insert',[
	'uses' => 'DiscussionsController@postInsertDiscussion',
	'middleware' => 'auth',
]);

Route::get('discussion/{discussionid}/single',[
	'uses' => 'DiscussionsController@getSingleDiscussion',
	'as' => 'discussion.single',
]);

/*
|--------------------------------------------------------------------------
| Comments
|--------------------------------------------------------------------------
*/

Route::post('comment/insert',[
	'uses' => 'CommentsController@postAddComment',
	'as' => 'comment.insert',
	'middleware' => 'auth',
]);

/*
|--------------------------------------------------------------------------
| Items
|--------------------------------------------------------------------------
*/

Route::get('item/items',[
	'uses' => 'ItemsController@getItems',
	'as' => 'item.items',
]);

Route::post('item/search',[
	'uses' => 'ItemsController@postSearchedItems',
	'as' => 'item.search',
]);