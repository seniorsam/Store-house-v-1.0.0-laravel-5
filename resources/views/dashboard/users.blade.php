@extends('templates.default')
@section('content')
	<h2>Users:</h2>
	<hr>
	@if($users->count() == 0)
		<div class="alert alert-info alert-dismissible fade in" role="alert"> 
			There is no available users
		</div>
	@else
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead> 
					<tr> 
						<th>#</th> 
						<th>username</th> 
						<th>email</th> 
						<th>Address</th> 
						<th>Phone</th> 
						<th>Action</th> 
						<th class="text-danger">Delete</th> 
					</tr> 
				</thead>
				<tbody>	
					@foreach($users as $user)
						<tr> 
							<th scope="row">{{$user->id}}</th> 
							<td>{{$user->username ? $user->username : 'Not included'}}</td> 
							<td>{{$user->email    ? $user->email : 'Not included' }}</td> 
							<td>{{$user->address  ? $user->address : 'Not included' }}</td> 
							<td>{{$user->phone    ? $user->phone : 'Not included' }}</td> 
							<td>
								<!-- <a href="#" title="mail this user"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a> -->
								<a href="{{route('dashboard.user.update', ['username' => $user->username ])}}" title="update this user"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
								<!-- <a href="#" title="promote this user"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span></a> -->
								<!-- <a href="#" title="deactive this user"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a> -->
							</td>
							<td><a class="deleteUserFromDashboard text-danger" href="{{route('dashboard.user.delete', ['username' => $user->username ])}}" title="delete this user"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td> 
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@endif
@stop