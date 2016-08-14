<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title')</title>
	<link rel="icon" type="image/png" href="/images/fav.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="/css/stylesheet.css">
	<script src=https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
	<style>
		body{
			font-family: 'Ubuntu', sans-serif;
		}
	</style>
</head>
<body>
	<!-- nav -->
		@include ('templates.partials.nav')
	<!-- body -->
	<section class="container">
		@include ('templates.partials.alert')
		@yield('content')
		<br><hr>
		@include ('templates.partials.footer')
		<hr>
	</section>
	<!-- footer -->
	<script>
	    $(".deleteUserFromDashboard").on("click", function(){
	        return confirm("Do you want to delete this item?");
	    });
	</script>
</body>
</html>