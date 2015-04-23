@extends('...layout')
@section('content')

<h3>Are you sure you want to deactivate your account?</h3>
<p class="help-block">To Reactivate your account you will need to contact the administrator.</p>
{{ Form::open(['url'=>route('confirm_deactivate'), 'style'=>'float:left']) }}
{{ Form::hidden('value', 'true') }}
{{ Form::submit('Yes', array('class'=>'btn btn-danger')) }}
{{ Form::close() }}

{{ Form::open(['url'=>route('confirm_deactivate'), 'style'=>'float:left']) }}
{{ Form::hidden('value', 'false') }}
{{ Form::submit('No', array('class'=>'btn btn-success')) }}
{{ Form::close() }}
@stop