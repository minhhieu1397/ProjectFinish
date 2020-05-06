<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Login</title>
	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="{{ asset('/css/app.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"> 
</head>
<body>
  <!-- Page Content -->	
	<div class="container-fluid" id="app">
		<router-view></router-view>
		<!-- <div class="row">
			<div class="col-md-2 offset-md-5 form-login">
				<form method="POST" action="{{ route('admin.postLogin') }}" role="form">
					{{ csrf_field() }}

					<div class="form-group">
						<label for="usr">User Name:</label>
						<input type="text" class="form-control" id="usr" name="user_name">
					</div>
					<div class="form-group">
						<label for="pwd">Password</label>
						<input type="password" class="form-control" id="pwd" name="password">
					</div>
					<div class="btncre">
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
				</form>
			</div>
		</div> -->
	</div>
	<script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
