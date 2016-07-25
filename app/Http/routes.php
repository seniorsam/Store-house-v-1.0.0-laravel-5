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

Route::get('dashboard',[
	'uses' => 'DashboardController@index',
	'as' => 'dashboard.index',
	'middleware' => ['auth', 'auth.admin'],
]);

Route::get('dashboard/users',[
	'uses' => 'DashboardController@getUsers',
	'as' => 'dashboard.users',
	'middleware' => ['auth', 'auth.admin'],
]);

Route::get('dashboard/{username}/update',[
	'uses' => 'DashboardController@getUserUpdate',
	'as' => 'dashboard.user.update',
	'middleware' => ['auth', 'auth.admin'],
]);

Route::post('dashboard/{username}/update',[
	'uses' => 'DashboardController@postUserUpdate',
	'middleware' => ['auth', 'auth.admin'],
]);

Route::get('dashboard/{username}/delete',[
	'uses' => 'DashboardController@getUserDelete',
	'as'   => 'dashboard.user.delete',
	'middleware' => ['auth', 'auth.admin'],
]);

/******************
* Dashboard items *
*******************/

Route::get('dashboard/items',[
	'uses' => 'DashboardController@getItems',
	'as'   => 'dashboard.items',
	'middleware' => ['auth', 'auth.admin'],
]);

Route::get('dashboard/item/add',[
	'uses' => 'DashboardController@getItemAdd',
	'as'   => 'dashboard.item.add',
	'middleware' => ['auth', 'auth.admin'],
]);

Route::post('dashboard/item/add',[
	'uses' => 'DashboardController@postItemAdd',
	'middleware' => ['auth', 'auth.admin'],
]);

Route::get('dashboard/{itemid}/updateitem',[
	'uses' => 'DashboardController@getItemUpdate',
	'as'   => 'dashboard.item.update',	
	'middleware' => ['auth', 'auth.admin'],
]);

Route::post('dashboard/{itemid}/updateitem',[
	'uses' => 'DashboardController@postItemUpdate',	
	'middleware' => ['auth', 'auth.admin'],
]);

Route::get('dashboard/{itemid}/deleteitem',[
	'uses' => 'DashboardController@getItemDelete',	
	'as'   => 'dashboard.item.delete',	
	'middleware' => ['auth', 'auth.admin'],
]);

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
