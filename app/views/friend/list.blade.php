@extends('...layout')
@section('content')
    <h3>{{ $current_user->username }}'s Friends</h3>
    <div class="row">

    @foreach ($friends as $friend)
        <div class="user-block col-md-6">

            <a href="{{ route('profile', $friend->user->id) }}">
                <img src="{{ $friend->user->avatar }}" alt="user-avatar" class="avatar-mini img-rounded"/>
                {{ $friend->user->username }}
                <br/>
            </a>

            <em>First Name : </em> {{ $friend->user->firstname }} <br/>
            <em>Last Name : </em> {{ $friend->user->lastname }} <br/>
            <em>Email : </em> {{ $friend->user->email }} <br/>

        </div>
    @endforeach

    </div>
@stop