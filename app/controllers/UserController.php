<?php
// app/controllers/UserController.php

class UserController extends BaseController
{
    const MAX_FILE_SIZE = 2000000; //2 MB

    public function profile(User $user)
    {
        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(5);
        $friends = User::find(Auth::id())->friends()->get();
        $friend_list = array();
        foreach ($friends as $friend) {
            $friend_list[$friend->friend_id] = true;
        }
        $params = array(
            'user'        => $user,
            'posts'       => $posts,
            'friend_list' => $friend_list
        );
        return View::make('user.profile', $params);
    }

    public function search()
    {
        $query = '%'.htmlspecialchars(Input::get('query')).'%';
        $results = User::where  ('username',  'like', $query)
                       ->orWhere('firstname', 'like', $query)
                       ->orWhere('lastname',  'like', $query)
                       ->orWhere('email',     'like', $query)
                       ->where  ('status',    '=',    'active')
                       ->paginate(6);
        $params = array(
            'query' => Input::get('query') == '' ? 'all users' : Input::get('query'),
        );
        $params = array_merge($params, compact('results'));
        return View::make('user.search', $params);
    }

    public function edit()
    {
        return View::make('user.update');
    }
    public function update()
    {
        $current_user = User::find(Auth::id());
        $inputs = Input::all();

        $rules = array(
            'username'  => 'required|unique:user|alpha_dash',
            'firstname' => 'required|alpha',
            'lastname'  => 'required|alpha',
            'email'     => 'required|email|unique:user',
        );

        //Unset if the inputs are unchanged.
        foreach ($inputs as $key => $value ) {
            if ($value == $current_user->$key) {
                unset($rules[$key]);
            }
        }
        //Return If nothing has been changed
        if (count($rules) == 0) {
            return Redirect::route('edit_profile');
        }

        $validator = Validator::make($inputs, $rules);
        
        if ($validator->fails()) {
            return Redirect::route('edit_profile')->withErrors($validator)->withInput();
        }
        $user = User::findOrFail($current_user->id);
        foreach ($rules as $key => $value) {
            $user->$key = $inputs[$key];
        }
        $user->save();

        return Redirect::route('success')
            ->with('message', 'Successfully Updated Profile')
            ->with('back_title', 'Own profile')
            ->with('back_url', route('profile', $current_user->id));
    }

    public function changePassword()
    {
        return View::make('user.changePassword');
    }

    public function savePassword()
    {
        $current_user = User::find(Auth::id());
        $inputs = Input::all();
        if (!Hash::check($inputs['password'], $current_user->password)) {
            return Redirect::route('change_password')->withErrors('Wrong Password')->withInput();
        }
        $rules = array(
            'password'          => array('required'),
            'new_password'      => array('required'),
            'confirm_password'  => array('required', 'same:new_password'),
        );
        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            return Redirect::route('change_password')->withErrors($validator)->withInput();
        }
        $user = User::findOrFail($current_user->id);
        $user->password = Hash::make($inputs['new_password']);
        $user->save();

        return Redirect::route('success')
            ->with('message', 'Successfully Changed Password')
            ->with('back_title', 'Own profile')
            ->with('back_url', route('profile', $current_user->id));
    }


    public function uploadAvatar()
    {
        return View::make('user.uploadAvatar');
    }

    public function saveAvatar()
    {
        $current_user = User::find(Auth::id());

        if (!Input::hasFile('avatar')) {
            return Redirect::route('upload_avatar')
                ->withErrors(['Either you uploaded nothing or Uploaded File size too big!']);
        }
        $inputs = Input::all();
        $rules = array(
            'avatar' => array('image', 'max:'.self::MAX_FILE_SIZE)
        );

        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            return Redirect::route('upload_avatar')->withErrors($validator)->withInput();
        }

        if (Input::file('avatar')->isValid()) {
            $avatar    = Input::file('avatar');
            $path      = public_path() . '/img';
            $extension = $avatar->getClientOriginalExtension();
            $filename  = $current_user->username.'.'.$extension;
            if (!preg_match('/default/', $current_user->avatar)) {
                unlink(public_path() . $current_user->avatar);
            }
            $avatar->move($path, $filename);
            $user = User::findOrFail($current_user->id);
            $user->avatar = '/img/'.$filename;
            $user->save();

            return Redirect::route('success')
                ->with('message', 'Successfully Uploaded Avatar!')
                ->with('back_title', 'Own profile')
                ->with('back_url', route('profile', $current_user->id));
        }
        return Redirect::route('upload_avatar');
    }

    public function deactivate()
    {
        return View::make('user.deactivate');
    }
    public function saveDeactivate()
    {
        $current_user = User::find(Auth::id());
        $is_confirmed = Input::get('value');
        if ($is_confirmed == 'false') {
            return Redirect::route('profile', $current_user->id);
        }
        $user = User::findOrFail($current_user->id);
        $user->status = 'deactivated';
        $user->save();
        return Redirect::route('logout');
    }
}