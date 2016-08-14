@extends('templates.default')
@section('title')
Store house | Dashboard update discussion
@stop
@section('content')
	<h2>Update Discussion:</h2>

	<form method="post" action="{{route('dashboard.discussion.update', ['discussionid' => $discussion->id])}}">

	<div class="form-group {{$errors->first('disc_title') ? ' has-error' : ''}}">
		<label for="disc_title">Title</label>
		<input type="text" class="form-control" id="disc_title" name="disc_title" placeholder="Title" value="{{Request::old('disc_title') ? Request::old('disc_title') : $discussion->disc_title}}">
		@if($errors->first('disc_title'))
			<span class="label label-danger"> 
				{{$errors->first('disc_title')}}
			</span>
		@endif
	</div>  

	<div class="form-group {{$errors->first('disc_body') ? ' has-error' : ''}}">
		<label for="disc_body">Description</label>
		<textarea class="form-control" id="disc_body" name="disc_body" rows="5" placeholder="Description">{{Request::old('disc_body') ? Request::old('disc_body') : $discussion->disc_body}}</textarea>
		@if($errors->first('disc_body'))
			<span class="label label-danger"> 
				{{$errors->first('disc_body')}}
			</span>
		@endif	
	</div>

	<div class="checkbox">
		<label>
			<input type="checkbox" name="active" {{$discussion->active ? 'checked' : ''}}> 
			Publish this discussion (this item is currently {{$discussion->active ? 'Published' : 'Not published'}})
		</label>
	</div>
 
	<button type="submit" class="btn btn-default">Submit</button>
	<input type="hidden" name="_token" value="{{Session::token()}}">
	<input type="hidden" name="id" value="{{$discussion->id}}">
	</form>
@stop