<?php
// app/controllers/FriendController.php

class FriendController extends BaseController
{
    public function addFriend(User $user)
    {
        $current_user = User::find(Session::get('user_id'));
        $friend = new Friend;
        $friend->user_id = $current_user->id;
        $friend->friend_id = $user->id;
        $friend->save();
        return Redirect::route('profile', $user->id);
    }

    public function unfriend(User $user)
    {
        $current_user = User::find(Session::get('user_id'));
        Friend::where('friend_id', '=', $user->id)->where('user_id', '=', $current_user->id)->delete();
        return Redirect::route('profile', $user->id);
    }

    public function friends()
    {
        $current_user = User::find(Session::get('user_id'));
        $friends = $current_user->friends()->get();
        return View::make('friend.list', compact('friends'));
    }
}