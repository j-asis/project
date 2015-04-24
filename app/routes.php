<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//filters
Route::filter('authenticate', function()
{
    if (!Auth::check()) {
        return Redirect::route('login');
    }
});

Route::filter('is_logged', function()
{
    if (Auth::check() && Route::currentRouteName() != 'logout') {
        return Redirect::route('profile', Auth::id());
    }
});

Route::filter('current_user', function()
{
    $current_user = User::find(Auth::id());
    View::share('current_user', $current_user);
});

//redirect immediately to login page
Route::get('/', function()
{
    return Redirect::route('login');
});


//signup / login
Route::group(['before'=>'is_logged'], function()
{
    Route::get ('user/signup',            ['as'=>'signup',     'uses'=>'RegisterController@signup']);
    Route::post('user/register',          ['as'=>'register',   'uses'=>'RegisterController@register']);
    Route::get ('user/login',             ['as'=>'login',      'uses'=>'RegisterController@login']);
    Route::post('user/auth_login',        ['as'=>'auth_login', 'uses'=>'RegisterController@authLogin']);
    Route::get ('user/logout',            ['as'=>'logout',     'uses'=>'RegisterController@logout']);
});


Route::group(['before'=>'authenticate|current_user'], function()
{

    //User Route
    Route::get ('user/profile/{user_id}',  ['as'=>'profile',            'uses'=>'UserController@profile']);
    Route::get ('user/search',             ['as'=>'search',             'uses'=>'UserController@search']);
    Route::get ('user/edit_profile',       ['as'=>'edit_profile',       'uses'=>'UserController@edit']);
    Route::post('user/update',             ['as'=>'update',             'uses'=>'UserController@update']);
    Route::get ('user/change_password',    ['as'=>'change_password',    'uses'=>'UserController@changePassword']);
    Route::post('user/save_password',      ['as'=>'save_password',      'uses'=>'UserController@savePassword']);
    Route::get ('user/upload_avatar',      ['as'=>'upload_avatar',      'uses'=>'UserController@uploadAvatar']);
    Route::post('user/save_avatar',        ['as'=>'save_avatar',        'uses'=>'UserController@saveAvatar']);
    Route::get ('user/deactivate',         ['as'=>'deactivate',         'uses'=>'UserController@deactivate']);
    Route::post('user/confirm_deactivate', ['as'=>'confirm_deactivate', 'uses'=>'UserController@saveDeactivate']);

    //Friend Route
    Route::get('friend/add/{user_id}',    ['as'=>'friend_add',    'uses'=>'FriendController@addFriend']);
    Route::get('friend/remove/{user_id}', ['as'=>'friend_remove', 'uses'=>'FriendController@unfriend']);
    Route::get('friend/list',             ['as'=>'friend_list',   'uses'=>'FriendController@friends']);

    //Post Route
    Route::get ('post/create/{user_id}', ['as'=>'post_create', 'uses'=>'PostController@post']);
    Route::post('post/save_create',      ['as'=>'save_create', 'uses'=>'PostController@savePost']);
    Route::get ('post/edit/{post_id}',   ['as'=>'post_edit',   'uses'=>'PostController@edit']);
    Route::post('post/save_edit',        ['as'=>'save_edit',   'uses'=>'PostController@saveEdit']);
    Route::get ('post/delete/{post_id}', ['as'=>'post_delete', 'uses'=>'PostController@delete']);

});


    Route::get ('page/success', ['as'=>'success', function()
    {
        return View::make('success');
    }]);
//model Route
Route::model('user_id', 'User');
Route::model('post_id', 'Post');

