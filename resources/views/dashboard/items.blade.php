@extends('templates.default')
@section('content')
	<h2>Items:</h2>
	<hr>
	@if($items->count() == 0)
		<div class="alert alert-info alert-dismissible fade in" role="alert"> 
			There is no available items
		</div>
	@else	
	<div class="table-responsive">
		<table class="table table-bordered">
			<thead> 
				<tr> 
					<th>#</th> 
					<th>Item name</th> 
					<th>Picture</th> 
					<th>Quantity</th> 
					<th>Description</th> 
					<th>Insertd by</th>  
					<th>Actions</th>  
					<th class="text-danger">Delete</th> 
				</tr> 
			</thead>
			<tbody>	
				@foreach($items as $item)
					<tr> 
						<th scope="row">{{$item->id}}</th> 
						<td>{{$item->item_name}}</th> 
						<td>
							<img width="100px" height="auto" src="/images/itemPictures/{{$item->item_picture ? $item->item_picture : 'thumb.jpg'}}" alt="{{$item->item_picture}}">
						</td> 
						<td>{{$item->item_quantity}}</td> 
						<td>{{$item->item_description}}</td> 
						<td>{{$item->users->username}}</td> 
						<td>
							<!-- <a href="#" title="mail this user"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a> -->
							<a href="{{route('dashboard.item.update',['itemid'=>$item->id])}}" title="update this item"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
							<!-- <a href="#" title="promote this user"><span class="glyphicon glyphicon-flag" aria-hidden="true"></span></a> -->
							<!-- <a href="#" title="deactive this user"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a> -->
						</td>
						<td><a class="deleteUserFromDashboard text-danger" href="{{route('dashboard.item.delete',['itemid'=>$item->id])}}" title="delete this user"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td> 
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>	
	@endif
@stop