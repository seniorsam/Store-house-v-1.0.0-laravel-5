@extends('templates.default')
@section('title')
Welcome to store house | Home page
@stop
@section('content')
	<div class="panel panel-primary">
		<div class="panel-heading"><h4><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Store timeline</h4></div>
		<div class="panel-body">
			@if($discussions->count() == 0)
				<div class="alert alert-info bg-primary">
					There aren't new discussions
				</div>
			@else
			@foreach($discussions as $discussion)
			
				<div class="alert alert-info bg-primary">
					<a class="alert-link" href="{{route('discussion.single',['discussionid'=>$discussion->id])}}">
						<strong>{{$discussion->disc_title}}: </strong>
					</a>
					{{$discussion->disc_body}}.
				</div>
				<span>
					<img src="{{$discussion->users->getUserAvatar()}}" alt="{{$discussion->users->username}}">
				</span>
				<span class="label label-default">By: {{$discussion->users->username}}</span>
				<span class="label label-default">{{$discussion->created_at->diffForHumans()}}</span>
				<span class="label label-default">{{$discussion->comments()->active()->count()}} comment</span>
			<hr>
			@endforeach
			<?php echo $discussions->render(); ?>
			@endif
		</div>
	</div>
@endsection
