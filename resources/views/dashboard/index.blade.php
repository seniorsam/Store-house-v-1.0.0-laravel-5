@extends('templates.default')
@section('title')
Store house | Dashboard
@stop
@section('content')
	<h2>Dashboard:</h2>

	<hr>
	<h4>
		<span class="glyphicon glyphicon-signal" aria-hidden="true"></span>
		Statistics
	</h4>
	<hr>
	@include('dashboard.partials.statistics')

	<h4>
		<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> 
		Options
	</h4>
	<hr>
	@include('dashboard.partials.options')

	<h4>
		<span class="glyphicon glyphicon-hdd" aria-hidden="true"></span> 
		Store latest activities
	</h4>
	<hr>
	@include('dashboard.partials.activites')

@stop