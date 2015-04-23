@extends('...layout')
@section('content')
    <div class="profile">
        <p>
            <img src="{{ $user->avatar }}" alt="Profile Picture" class="avatar img-rounded box-shadow"/>
            <br/>
            {{ $user->firstname }} {{ $user->lastname }} ({{ $user->username }})
            <br/>
            email : {{ $user->email }}
            <br/>
            with {{ $user->friends()->count() }} friends
            <br/>
        </p>
    </div>
    <a href="{{ route('post_create', $user->id ) }}" class="btn btn-default btn-sm">Comment</a>

    @if ($current_user->id != $user->id)
        @if (isset($friend_list[$user->id]))
            <a href="{{ route('friend_remove', $user->id) }}" class="btn btn-default btn-sm">Unfriend</a>
        @else
            <a href="{{ route('friend_add', $user->id) }}" class="btn btn-default btn-sm">Add Friend</a>
        @endif
    @endif

    <hr/>

    {{ $posts->links() }}

    <div class="posts">
        <h3>Posts</h3>
        @foreach ($posts as $post)
            <div class="post-block">
                <em>
                <a href="{{ route('profile', $post->creator) }}">
                    <img src="{{ $post->user->avatar }}" alt="avatar-mini" class="avatar-mini img-rounded"/>
                    {{ $post->user->username }} said :
                </a>
                </em>
                <p>{{ htmlspecialchars($post->content) }}</p>
                <span class="date">{{ $post->updated_at == $post->created_at ? 'Created :' : 'Updated :'}}
                {{ $post->updated_at }}
                    @if ($post->creator == $current_user->id)
                        <a href="{{ route('post_edit', $post->id) }}" class="post-button btn btn-default btn-xs">
                            <span class="glyphicon glyphicon-pencil"></span> Edit
                        </a>
                        <a href="{{ route('post_delete', $post->id) }}" class="post-button btn btn-default btn-xs">
                            <span class="glyphicon glyphicon-trash"></span> Delete
                        </a>
                    @endif
                </span>
            </div>
        @endforeach
    </div>

@stop