<nav class="navbar navbar-classic">
  <div class="container-fluid">

    <!-- Mobile menu trigger -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <strong>
        <a class="navbar-brand" href="{{route('home')}}">
          <span class="glyphicon glyphicon-home"></span>
          Store house
        </a>
      </strong>  
    </div>

    <!-- Menu content container -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <!-- Left section -->
      <ul class="nav navbar-nav">
        <!-- class="active" -->
        <li><a href="{{route('home')}}">Home</a></li>
        <li><a href="{{route('item.items')}}">Available items</a></li>
      </ul>

      <form method="post" action="{{route('item.search')}}" class="navbar-form navbar-left" role="search">
        <div class="form-group {{$errors->first('searchword') ? ' has-error' : ''}}">
          <input id="searchword" name="searchword" type="text" class="form-control" placeholder="Search items">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
        <input type="hidden" name="_token" value="{{Session::token()}}">
      </form>

      <!-- Right section -->
      <ul class="nav navbar-nav navbar-right">
        @if (Auth::check())
          @if(Auth::user()->sthrule_id == 1)
            <li><a href="{{route('dashboard.index')}}">Dashboard</a></li>
          @endif
          <li><a href="{{route('discussion.insert')}}">Start a discussion</a></li>
          <li><a href="{{route('user.profile', ['username' => Auth::user()->username ])}}">Hi {{Auth::user()->username}}</a></li>
          <li><a href="{{route('auth.signout')}}">Signout</a></li>
          
        @else
          <li><a href="{{route('auth.signup')}}">signup</a></li>
          <li><a href="{{route('auth.signin')}}">signin</a></li>                    
        @endif
      </ul>

    </div>

  </div>
</nav>