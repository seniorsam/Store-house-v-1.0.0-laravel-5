@extends('templates.default')
@section('title')
Store house | Dashboard users
@stop
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
						<th>State</th> 
						<th>Suspend</th> 
						<th>Action</th> 
						<th class="text-danger">Suspend</th> 
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
							<td class="text-success">
								<strong>
									{{$user->active ? 'Activated' : 'Not activated' }}			
								</strong>
							</td>							
							<td class="text-danger">
								<strong>
									<?php echo ($user->suspend) ? '<span class="label label-danger" aria-hidden="true">Suspended</span>' : '<span class="label label-success" aria-hidden="true">Available</span>' ?>		
								</strong>
							</td> 
							<td>
								<a href="{{route('dashboard.user.update', ['username' => $user->username ])}}" title="update this user">
									<span class="glyphicon glyphicon-pencil" aria-hidden="true">	
									</span>
								</a>
							</td>
							<td>
								@if($user->suspend)
									<a class="deleteUserFromDashboard" href="{{route('dashboard.user.delete', ['username' => $user->username , 'action' => 'unsuspend'])}}" title="un suspend this user">
										<span class="glyphicon glyphicon-refresh text-success" aria-hidden="true"></span>
									</a>								
								@else
									<a class="deleteUserFromDashboard text-danger" href="{{route('dashboard.user.delete', ['username' => $user->username , 'action' => 'suspend'])}}" title="suspend this user">
										<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
									</a>
								@endif
						</td> 
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@endif
@stop