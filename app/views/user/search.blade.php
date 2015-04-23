@extends('...layout')
@section('content')
    <h3>Search results for '{{ $query }}'</h3>
    <div class="row">
    {{ $results->links() }}
    @if (count($results) == 0)
    <div class="alert alert-warning">
        <h5>No Results Found!</h5>
    </div>
    @endif
    @foreach ($results as $result)
        <div class="user-block col-md-6">
            <a href="{{ route('profile', $result->id) }}">
                <img src="{{ $result->avatar }}" alt="user-avatar" class="avatar-mini img-rounded"/>
                {{ $result->username }}
                <br/>
            </a>
            <em>First Name : </em> {{ $result->firstname }} <br/>
            <em>Last Name : </em> {{ $result->lastname }} <br/>
            <em>Email : </em> {{ $result->email }} <br/>
        </div>
    @endforeach
    </div>
@stop