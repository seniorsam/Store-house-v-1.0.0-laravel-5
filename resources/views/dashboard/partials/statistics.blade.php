<div class="row margin-tb-spacing">
	<div class="col-md-3">
		<div class="mylabel label-primary">
			<h3>Users <br> {{$statistics['usernum']}}</h3>
			<span class="label label-white">Active: {{$statistics['ausernum']}}</span>
			<span class="label label-white">In active: {{ $statistics['usernum'] - $statistics['ausernum']}}</span>
		</div>
	</div>		

	<div class="col-md-3">
		<div class="mylabel label-danger">
			<h3>Items <br> {{$statistics['itemnum']}}</h3>
			<span class="label label-white">Active: {{$statistics['aitemnum']}}</span>
			<span class="label label-white">In active: {{$statistics['itemnum'] - $statistics['aitemnum']}}</span>
		</div>
	</div>

	<div class="col-md-3">
		<div class="mylabel label-info">
			<h3>Discussions <br> {{$statistics['discnum']}}</h3>	
			<span class="label label-white">Active: {{$statistics['adiscnum']}}</span>
			<span class="label label-white">In active: {{$statistics['discnum'] - $statistics['adiscnum']}}</span>
		</div>
	</div>

	<div class="col-md-3">
		<div class="mylabel label-success">
			<h3>Comments <br> {{$statistics['commnum']}}</h3>	
			<span class="label label-white">Active: {{$statistics['acommnum']}}</span>
			<span class="label label-white">In active: {{$statistics['commnum'] - $statistics['acommnum']}}</span>				
		</div>
	</div>
</div>