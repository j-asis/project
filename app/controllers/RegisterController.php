<?php
// app/controllers/RegisterController.php

class RegisterController extends BaseController
{
    public function login()
    {
        return View::make('register.login');
    }
    public function authLogin()
    {
        $input = array(
            'username' => Input::get('username'),
            'password' => Input::get('password')
        );

        $rules = array(
            'username' => ['required'],
            'password' => ['required']
        );

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Redirect::route('login')->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['username'=>$input['username'], 'password'=>$input['password'], 'status'=>'active'])) {
            return Redirect::route('profile', Auth::id());
        }
        return Redirect::route('login')->withErrors('Wrong Username or Password')->withInput();
    }

    public function signup()
    {
        return View::make('register.signup');
    }
    public function register()
    {
        $input = Input::all();
        $rules = array(
            'username'         => array('required', 'unique:user', 'alpha_dash'),
            'firstname'        => array('required', 'alpha'),
            'lastname'         => array('required', 'alpha'),
            'email'            => array('required', 'email', 'unique:user'),
            'password'         => array('required'),
            'confirm_password' => array('required', 'same:password')
        );

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Redirect::route('signup')->withErrors($validator)->withInput();
        }

        $user = new User;
        $user->username  = htmlspecialchars($input['username']);
        $user->firstname = htmlspecialchars($input['firstname']);
        $user->lastname  = htmlspecialchars($input['lastname']);
        $user->email     = htmlspecialchars($input['email']);
        $user->avatar    = '/img/default.jpg';
        $user->password  = Hash::make($input['password']);
        $user->status    = 'active';
        $user->type      = 'user';
        $user->save();

        return Redirect::route('success')
            ->with('message', 'Successfully Registered!')
            ->with('back_title', 'Log In')
            ->with('back_url', route('login'));
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return Redirect::route('login');
        /*
        return Redirect::route('success')
            ->with('message', 'Successfully Logged Out')
            ->with('back_title', 'Log In')
            ->with('back_url', route('login'));
        */
    }
}