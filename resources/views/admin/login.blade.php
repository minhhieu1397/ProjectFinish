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
	<link rel="stylesheet" href="/css/app.css'">
	<link rel="stylesheet" type="text/css" href="css/style.css"> 
</head>
<body>
  <!-- Page Content -->	
	<div class="container-fluid" id="app">	
		<router-view></router-view>
	</div>
	<script src="/js/app.js"></script>
</body>
</html>
