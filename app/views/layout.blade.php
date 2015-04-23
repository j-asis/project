<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <title>My Project</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    </head>
    <body>

    <div class="container">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Project</a>
            </div>
            @if (isset($current_user))
            {{ Form::open(array('url'=>'/user/search', 'method'=>'get', 'class'=>'navbar-form navbar-left', 'role'=>'search')) }}
                <div class="form-group">
                    {{ Form::text('query', '', array('placeholder'=>'Search Users', 'class'=>'form-control')) }}
                </div>
                {{ Form::submit('Search', array('class'=>'btn btn-default')) }}
            {{ Form::close() }}

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <img src="{{ $current_user->avatar }}" class="avatar-mini img-rounded" alt="avatar"/>
                    {{ $current_user->username }} <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ route('edit_profile') }}">Edit Profile</a></li>
                    <li><a href="{{ route('change_password') }}">Change Password</a></li>
                    <li><a href="{{ route('upload_avatar') }}">Upload Avatar</a></li>
                    <li><a href="{{ route('deactivate') }}">Deactivate Account</a></li>
                  </ul>
                </li>
                <li {{ Route::currentRouteName() == 'profile' ? 'class="active"' : '' }}><a href="{{ route('profile', $current_user->id) }}">Home<span class="sr-only">(current)</span></a></li>
                <li {{ Route::currentRouteName() == 'friend_list' ? 'class="active"' : '' }}><a href="{{ route('friend_list') }}">Friends</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
              </ul>
            </div>
            @endif
          </div>
        </nav>
    </div>

        <div class="container-main container">
            @yield('content')
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </body>
</html>