@extends('...layout')
@section('content')
        {{ Form::open(array('url' => route('auth_login'), 'class' => 'form-signin')) }}
            <h2 class="form-signin-heading">Please sign in</h2>
            @if (isset($message))
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @endif
            {{ HTML::ul($errors->all(), array('class'=>'errors alert alert-danger')) }}
            {{ Form::label('username', 'Username', array('class' => 'sr-only')) }}
            {{ Form::text('username', '', array('class' => 'form-control', 'autofocus', 'placeholder' => 'Username')) }}
            {{ Form::label('password', 'password', array('class' => 'sr-only')) }}
            {{ Form::password('password', array('class' => 'form-control', 'placeholder'=>'Password')) }}
            {{ Form::submit('Sign in', array('class' => 'btn btn-lg btn-primary btn-block')) }}
            <p>Not yet a member? <a href="{{ route('signup') }}">Sign Up</a> Now!</p>
        {{ Form::close() }}
@stop
