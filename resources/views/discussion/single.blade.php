@extends('templates.default')
@section('title')
Store house | Dashboard single discussion
@stop
@section('content')
	<h2>{{$discussion->disc_title}}</h2>
	<hr>
	<p>
		{{$discussion->disc_body}}
	</p>
	 <span class="label label-default">By: {{$discussion->users->username}}</span>
	 <span class="label label-default">{{$discussion->created_at->diffForHumans()}}</span>
	<hr>

	
		<h4>Comment for this discussion:</h4>

		@if($comments->count() == 0)
		    	<div class="alert alert-info bg-primary">
			    	no comments for this discussion
			    </div>
    	@else

	    	@foreach($comments as $comment)
	    	<div class="media">
				<a class="pull-left" href="#">
			        <img class="media-object" alt="empty" src="{{$comment->users->getUserAvatar()}}">
			    </a>
			    <div class="media-body">
			    	<h4 class="media-heading"><a href="{{route('user.profile',['username'=>$comment->users->username])}}">{{$comment->users->username}}</a></h4>
			        <p>{{$comment->comm_body}}.</p>
			

			        <!-- <div class="media">
			            <a class="pull-left" href="#">
			                <img class="media-object" alt="" src="">
			            </a>
			            <div class="media-body">
			                <h5 class="media-heading"><a href="#">Billy</a></h5>
			                <p>Yes, it is lovely!</p>
			                <ul class="list-inline">
			                    <li>8 minutes ago.</li>
			                    <li><a href="#">Like</a></li>
			                    <li>4 likes</li>
			                </ul>
			            </div>
			        </div> -->
			        
			        <hr>
			    </div>
			</div>    
	    	@endforeach

    	@endif

	@if(Auth::check())
	<form role="form" action="{{route('comment.insert')}}" method="post">
    <div class="form-group {{$errors->first('comm_body') ? ' has-error' : ''}}">
        <textarea id="comm_body" name="comm_body" class="form-control" rows="2" placeholder="Reply to this discussion"></textarea>
			@if($errors->first('comm_body'))
            <span class="label label-danger">
            	{{$errors->first('comm_body')}}
        	</span>
        @endif
    </div>
    <input type="submit" value="Reply" class="btn btn-default btn-sm">
    <input type="hidden" name="_token" value="{{Session::token()}}">
    <input type="hidden" name="discussion_id" value="{{$discussion->id}}">
	</form>
	@endif

@stop	