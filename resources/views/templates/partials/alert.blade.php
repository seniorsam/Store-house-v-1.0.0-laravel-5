@if(Session::has('info'))
<div class="alert alert-info alert-dismissible fade in" role="alert"> 
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
	</button> 
	<strong>
		{{Session::get('info')}}
	</strong>
</div>
@endif 