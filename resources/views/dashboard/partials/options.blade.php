<div class="btn-group margin-tb-spacing" role="group">
	<a href="{{route('dashboard.users')}}" type="button" class="btn btn-default">
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
		Manage users
	</a>

	<a href="{{route('dashboard.discussions')}}" type="button" class="btn btn-success">
		<span class="glyphicon glyphicon-sunglasses" aria-hidden="true"></span> 
		Manage discussions
	</a>

	<a href="{{route('dashboard.comments')}}" type="button" class="btn btn-danger">
		<span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 
		Manage comments
	</a>

	<div class="btn-group"> 
		<button type="button" class="btn btn-primary">
			<span class="glyphicon glyphicon-th" aria-hidden="true"></span>
			Items
		</button> 
		<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		 <span class="caret"></span> 
		 <span class="sr-only">
		 	Toggle Dropdown
		 </span> 
		</button> 

		 <ul class="dropdown-menu"> 
		 	<li>
		 		<a href="{{route('dashboard.item.add')}}">
		 			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> 
		 			Add new item
		 		</a>
		 	</li>  
		 	<li>
		 		<a href="{{route('dashboard.items')}}">
		 			<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> 
		 			Manage items
		 		</a>
		 	</li> 
		 </ul>
	</div>		
</div>