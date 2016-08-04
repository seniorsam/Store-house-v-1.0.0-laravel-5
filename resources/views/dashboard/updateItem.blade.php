@extends('templates.default')
@section('content')
	<h2>Update item:</h2>
	<hr>
	<form method="post" action="{{route('dashboard.item.update')}}" enctype="multipart/form-data">

	<div class="form-group {{$errors->first('item_name') ? ' has-error' : ''}}">
		<label for="item_name">Name</label>
		<input type="text" class="form-control" id="item_name" name="item_name" placeholder="Name" value="{{Request::old('item_name') ? Request::old('item_name') : $item->item_name}}">
		@if($errors->first('item_name'))
			<span class="label label-danger"> 
				{{$errors->first('item_name')}}
			</span>
		@endif
	</div>  

	<div class="form-group {{$errors->first('item_picture') ? ' has-error' : ''}}">
		<label for="item_picture">Picture</label>
		<input type="hidden" id="item_picture_old" name="item_picture_old" value="{{Request::old('item_picture') ? Request::old('item_picture') : $item->item_picture}}">
		<input type="file" class="form-control btn btn-default" id="item_picture" name="item_picture" placeholder="Picture">
		@if($errors->first('item_picture'))
			<span class="label label-danger"> 
				{{$errors->first('item_picture')}}
			</span>
		@endif
	</div>

	<div class="form-group {{$errors->first('item_quantity') ? ' has-error' : ''}}">
		<label for="item_quantity">Quantity</label>
		<input type="text" class="form-control" id="item_quantity" name="item_quantity" placeholder="Quantity" value="{{Request::old('item_quantity') ? Request::old('item_quantity') : $item->item_quantity}}">
		@if($errors->first('item_quantity'))
			<span class="label label-danger"> 
				{{$errors->first('item_quantity')}}
			</span>
		@endif
	</div>

	<div class="form-group {{$errors->first('item_description') ? ' has-error' : ''}}">
		<label for="item_description">Description</label>
		<textarea class="form-control" id="item_description" name="item_description" rows="5" placeholder="Description">{{Request::old('item_description') ? Request::old('item_description') : $item->item_description}}</textarea>
		@if($errors->first('item_description'))
			<span class="label label-danger"> 
				{{$errors->first('item_description')}}
			</span>
		@endif	
	</div>

	<div class="checkbox">
		<label>
			<input type="checkbox" name="item_active" {{ $item->item_active ? "checked" : ""}}> 
			Publish this item (this item is currently {{ $item->item_active ? "Published" : "Not published"}} )
		</label>
	</div>
 
	<button type="submit" class="btn btn-default">Submit</button>
	<input type="hidden" name="_token" value="{{Session::token()}}">
	<input type="hidden" name="_id" value="{{$item->id}}">
	</form>
@stop