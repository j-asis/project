@extends('...layout')
@section('content')

    {{ Form::open(array('url' => route('save_edit'), 'class' => 'form-post')) }}
    {{ HTML::ul($errors->all(), array('class'=>'errors alert alert-danger')) }}
    <div class="form-group">
        {{ Form::label('content', 'New Content') }}
        {{ Form::textarea('content', $post->content, array('class' => 'form-control', 'placeholder'=>'Create Post')) }}
        {{ Form::hidden('post_id', $post->id) }}
        {{ Form::hidden('user_id', $post->user_id) }}
    </div>
    {{ Form::submit('Update', array('class' => 'btn btn-lg btn-primary btn-block')) }}
    {{ Form::close() }}

@stop