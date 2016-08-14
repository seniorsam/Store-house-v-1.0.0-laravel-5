@if($logs->count() == 0)
	<div class='label label-danger'>
		There are no new logs to show
	</div>
@endif

@foreach($logs as $log)

<div class="well">
	{{$log->log}}
	<span class="badge">{{ $log->created_at->diffForHumans() }}</span>
</div>

@endforeach