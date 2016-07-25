@extends('templates.default')
@section('content')
	<h2>Update:</h2>
	<form method="post" action="{{route('user.profile.update')}}">

	  <div class="form-group {{$errors->first('address' ? ' has-error' : '')}}">
	    <label for="address">Address</label>
	    <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{Request::old('address') ? Request::old('address') : Auth::user()->address }}">
	    @if ($errors->first('address'))
		    <span class="label label-danger">
		    	{{$errors->first('address')}}
		    </span>
	    @endif
	  </div>

	  <div class="form-group {{$errors->first('address' ? ' has-error' : '')}}">
	    <label for="email">phone</label>
	    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{Request::old('phone') ? Request::old('phone') : Auth::user()->phone }}">
	    @if ($errors->first('phone'))
		    <span class="label label-danger">
		    	{{$errors->first('phone')}}
		    </span>
	    @endif
	  </div> 

	  <button type="submit" class="btn btn-default">Submit</button>
	  <input type="hidden" name="_token" value="{{Session::token()}}">
	</form>
@stop