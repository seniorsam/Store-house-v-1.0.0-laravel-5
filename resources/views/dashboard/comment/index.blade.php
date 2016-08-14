@extends('templates.default')
@section('title')
Store house | Dashboard comments
@stop
@section('content')
	<h2>Comments:</h2>
	<hr>
	@if($comments->count() == 0)
		<div class="alert alert-info alert-dismissible fade in" role="alert"> 
			There is no available items
		</div>
	@else		
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead> 
				<tr> 
					<th>#</th> 
					<th>Comment body</th> 
					<th>By</th>  
					<th class="text-success">State</th> 
					<th class="text-info">Actions</th>  
					<th class="text-danger">Delete</th> 
				</tr> 
			</thead>
			<tbody>	
				@foreach($comments as $comment)
					<tr> 
						<th scope="row">{{$comment->id}}</th> 
						<td>{{$comment->comm_body}}</th> 
						<td>{{$comment->users->username}}</td> 
						<td class="text-success"><strong>{{$comment->active ? "Published" : "Not published"}}</strong></td> 
						<td>
							<a href="{{route('dashboard.comment.update',['commentid'=>$comment->id])}}" title="update this item">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</a>
						</td>  
						<td>
							<a class="deleteUserFromDashboard text-danger" href="{{route('dashboard.comment.delete',['commentid'=>$comment->id])}}" title="delete this item">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</a>
						</td> 
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>	
	@endif
@stop