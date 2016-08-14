@extends('templates.default')
@section('title')
Store house | Available items
@stop
@section('content')
<h2>Available items in the store house:</h2>
<hr>
<div class="row">
	@if($items->count() == 0)
		<div class="alert alert-info">
			There aren't available items in the database
		</div>
	@else
	    <div class="row">
			@foreach($items as $item)
				<div class="col-md-12 marg-bottom-spacing">
					<div class="col-md-2">
							@if(!$item->item_picture)
								<img class="img-responsive" src="/images/itemPictures/thumb.jpg" alt="empty">
							@else
								<img class="img-responsive" src="/images/itemPictures/{{$item->item_picture}}" alt="empty">
							@endif	
					</div>
					<div class="col-md-10">
						<h3>{{$item->item_name}}</h3>
					    <p>{{$item->item_description}}</p>
					    <span class="label label-default">{{$item->item_quantity}} peice</span>
					    <span class="label label-default">Added {{$item->created_at->diffForHumans()}}</span>
					</div>
				</div>
			@endforeach
		</div>
	@endif

</div>
@stop