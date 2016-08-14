@extends('templates.default')
@section('title')
Store house | Dashboard discussions
@stop
@section('content')
	<h2>Discussions:</h2>
	<hr>
		@if($discussions->count() == 0)
			<div class="alert alert-info alert-dismissible fade in" role="alert"> 
				There is no available discussions
			</div>
		@else
		<div class="table-responsive">
		<table class="table table-bordered">
			<thead> 
				<tr> 
					<th>#</th> 
					<th>Title</th> 
					<th>Body</th> 
					<th>By</th>  
					<th>State</th>  
					<th>Actions</th>  
					<th>Delete</th>  
				</tr> 
			</thead>
			<tbody>	
				@foreach ( $discussions as $discussion )
					<tr> 
						
						<th scope="row">{{$discussion->id}}</th> 
						<td>{{$discussion->disc_title}}</th> 
						<td>{{$discussion->disc_body}}</th> 
						<td><strong>{{$discussion->users->username}}</strong></th> 
						<td class="text-success">
							<strong>
								{{$discussion->active ? 'Published' : 'Not published'}}
							</strong>
						</td>							
						<td>
							<a href="{{route('dashboard.discussion.update',['dicussion' => $discussion->id])}}" title="update this discussion">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</a>
						</td>							
						<td>
							<a class="deleteUserFromDashboard text-danger" href="{{route('dashboard.discussion.delete',['discussionid' => $discussion->id])}}" title="delete this discussion">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</a>
						</td>
				@endforeach
			</tbody>
		</table>
	</div>	
	@endif
@stop