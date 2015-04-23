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
            'password' => empty(Input::get('password')) ? '' : md5(Input::get('password'))
        );
        $rules = array(
            'username' => ['required', 'exists:user'],
            'password' => ['required', 'exists:user']
        );

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return Redirect::route('login')->withErrors($validator)->withInput();
        }

        $user = User::where('username', '=', $input['username'])->where('password', '=', $input['password'])->get();
        if ($user[0]->status == "deactivated") {
            return Redirect::route('login')
                ->withErrors(
                    ['your account has been deactivated, please contact the administrator to activate your account']
                );
        }
        $id = $user[0]['id'];
        Session::put('user_id', $id);
        return Redirect::route('profile', $id);
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
        $user->password  = md5($input['password']);
        $user->status    = 'active';
        $user->type      = 'user';
        $user->save();

        $params = array(
            'message'    => 'Successfully Registered!',
            'back_title' => 'Log In',
            'back_url'   => route('login')
        );

        return View::make('success', $params);
    }

    public function logout()
    {
        Session::flush();
        $params = array(
            'message'    => 'Successfully Logged out!',
            'back_title' => 'Log In',
            'back_url'   => route('login')
        );
        return View::make('success', $params);
    }
}