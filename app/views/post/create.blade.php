@extends('...layout')
@section('content')

    {{ Form::open(array('url' => route('save_create'), 'class' => 'form-post')) }}
        <h2 class="form-signin-heading">Create Post</h2>
        {{ HTML::ul($errors->all(), array('class'=>'errors alert alert-danger')) }}
        {{ Form::label('content', 'post', array('class' => 'sr-only')) }}
        {{ Form::textarea('content', '', array('class' => 'form-control', 'placeholder'=>'Create Post')) }}
        {{ Form::hidden('user_id', $user->id) }}
        {{ Form::hidden('creator', $current_user->id) }}
        {{ Form::submit('Create', array('class' => 'btn btn-lg btn-primary btn-block')) }}
    {{ Form::close() }}

@stop