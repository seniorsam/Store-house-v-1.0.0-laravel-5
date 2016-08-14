@extends('templates.default')
@section('title')
Store house | sign up
@stop
@section('content')
<!-- <span class="label label-default">Default</span> -->
	<div class="panel panel-primary">
		<div class="panel-heading"><h4><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Sign up</h4></div>
		<div class="panel-body">
			<form method="post" action="{{route('auth.signup')}}">
			  <div class="form-group {{$errors->first('username') ? ' has-error' : ''}}">
			    <label for="username">User name *</label>
			    <input type="text" class="form-control" id="username" name="username" placeholder="User name" value="{{Request::old('username') ? Request::old('username') : '' }}">
			    @if ($errors->first('username'))
				    <span class="label label-danger">
				    	{{$errors->first('username')}}
				    </span>
			    @endif
			  </div>

			  <div class="form-group {{$errors->first('email') ? ' has-error' : ''}}">
			    <label for="email">Email *</label>
			    <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{Request::old('email') ? Request::old('email') : '' }}">
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
			  <button type="submit" class="btn btn-default">Submit</button>
			  <input type="hidden" name="_token" value="{{Session::token()}}">
			</form>
		</div>
	</div>
@stop