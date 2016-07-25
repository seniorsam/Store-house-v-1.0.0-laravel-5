@extends('templates.default')
@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading"><h4><span class="glyphicon glyphicon-book" aria-hidden="true"></span> {{$user->username}} profile:</h4></div>
		<div class="panel-body">
			<h3>Information:</h3><hr>
			<h3><span class="label label-default">Username: {{$user->username ? $user->username : 'not included' }}</span></h3>
			<h3><span class="label label-default">Email:    {{$user->email ? $user->email : 'not included'}}</span></h3>
			<h3><span class="label label-default">Address:  {{$user->address ? $user->address : 'not included'}}</span></h3>
			<h3><span class="label label-default">Phone:    {{$user->phone ? $user->phone : 'not included'}}</span></h3><hr>
			@if(Auth::user()->id === $user->id)
				<a href="{{route('user.profile.update')}}">Update my user profile user</a>
			@endif
			
			<br><br><br>

			<h3>Your discussions:</h3><hr>
			@if($discussions->count() == 0)
				<div class="alert alert-info bg-primary">
					there aren't any discussions for you to show.
				</div>
			@else
				@foreach($discussions as $discussion)
					<div class="alert alert-info">
						<a class="alert-link" href="{{route('discussion.single',['discussionid' => $discussion->id])}}">
							<strong>{{$discussion->disc_title}}: </strong>
						</a>
						{{$discussion->disc_body}}
						<br>
						<span class="label label-default">
							{{$discussion->comments->count()}} Comments
						</span>
					</div>
					<hr>					
				@endforeach			
			@endif
		</div>
	</div>	
@stop