@extends('templates.default')
@section('title')
Store house | Start a new discussion
@stop
@section('content')
	<h2>Start a discussion:</h2>
	<hr>
	<form method="post" action="{{route('discussion.insert')}}">

	<div class="form-group {{$errors->first('disc_title') ? ' has-error' : ''}}">
		<label for="disc_title">Title</label>
		<input type="text" class="form-control" id="disc_title" name="disc_title" placeholder="Title" value="{{Request::old('disc_title') ? Request::old('disc_title') : ''}}">
		@if($errors->first('disc_title'))
			<span class="label label-danger"> 
				{{$errors->first('disc_title')}}
			</span>
		@endif
	</div>  

	<div class="form-group {{$errors->first('disc_body') ? ' has-error' : ''}}">
		<label for="disc_body">Description</label>
		<textarea class="form-control" id="disc_body" name="disc_body" rows="5" placeholder="Description">{{Request::old('disc_body') ? Request::old('disc_body') : ''}}</textarea>
		@if($errors->first('disc_body'))
			<span class="label label-danger"> 
				{{$errors->first('disc_body')}}
			</span>
		@endif	
	</div>
 
	<button type="submit" class="btn btn-default">Submit</button>
	<input type="hidden" name="_token" value="{{Session::token()}}">
	</form>
@stop