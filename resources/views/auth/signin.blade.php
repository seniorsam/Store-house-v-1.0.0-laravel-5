@extends('templates.default')
@section('title')
Store house | sign in
@stop
@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading"><h4><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Sign in</h4></div>
		<div class="panel-body">
			<form method="post" action="{{route('auth.signin')}}">

			  <div class="form-group {{$errors->first('email') ? ' has-error' : ''}}">
			    <label for="email">Email *</label>
			    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
			    @if ($errors->first('email'))
				    <span class="label label-danger">
				    	{{$errors->first('email')}}
				    </span>
			    @endif
			  </div> 

			  <div class="form-group {{$errors->first('password') ? ' has-error' : ''}}">
			    <label for="password">Password *</label>
			    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
			    @if ($errors->first('password'))
				    <span class="label label-danger">
				    	{{$errors->first('password')}}
				    </span>
			    @endif		
			  </div>

			  <div class="checkbox">
			    <label>
			      <input name="remember" id="remember" type="checkbox"> Remember me
			    </label>
			  </div>

			  <button type="submit" class="btn btn-default">Submit</button>
			  <input type="hidden" name="_token" value="{{Session::token()}}">
			</form>			
		</div>
	</div>
@stop