@extends('...layout')
@section('content')
    <h2>Upload New Avatar</h2>

    {{ HTML::ul($errors->all(), array('class'=>'errors alert alert-danger')) }}

    <img src="{{ $current_user->avatar }}" alt="Avatar" class="avatar"/>

    {{ Form::open(array('url'=>route('save_avatar'), 'enctype'=>'multipart/form-data')) }}

        <div class="form-group">
            {{ Form::label('avatar', 'Avatar') }}
            {{ Form::file('avatar') }}
            <p class="help-block">Please Upload an image, it can be a jpeg, jpg, bmp, gif or png</p>
        </div>

        {{ Form::submit('Upload', array('class'=>'btn btn-success')) }}
    {{ Form::close() }}

@stop