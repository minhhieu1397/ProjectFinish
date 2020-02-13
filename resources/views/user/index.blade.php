<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Timesheet</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <style>
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    </style>
</head>

<body>
    <!-- Navigation -->
<div class="container-fluid navbar navbar-expand-lg navbar-dark static-top bg-dark">
<div class="row">
    <nav class="col-md-10 site-header timesheet-nav menu-timesheet">
        <div class="flex-column flex-md-row justify-content-between timesheet-menu">
            <ul class="nav">
                <li class="dropdown nav-item">
                    <a class="py-2 d-none d-md-inline-block py-2 d-none d-md-inline-block active timesheet-a" href="">Home</a>
                </li>
                <li class="dropdown nav-item">
                    <a href="#" class="nav-link dropdown-toggle py-2 d-none d-md-inline-block timesheet-a" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Timesheets <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="">Create Timesheet</a></li>
                        <li><a href="">View Timesheet</a></li>
                    </ul>
                </li>
                <li class="dropdown nav-item">
                    <a class="py-2 d-none d-md-inline-block py-2 d-none d-md-inline-block timesheet-a" href="">Personal</a>
                </li>
                <li class="dropdown nav-item">
                    <a href="#" class="nav-link dropdown-toggle py-2 d-none d-md-inline-block timesheet-a" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Setting <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="">Update Avatar</a></li>
                            <li><a href="">Update Account</a></li>
                            <li><a href="">Change Password</a></li>
                        </ul>
                </li>
                <li class="dropdown nav-item">
                    <a class="py-2 d-none d-md-inline-block py-2 d-none d-md-inline-block timesheet-a" href="">Approve</a>
                </li>
            </ul>
        </div>
    </nav>
    <span class="col-md-1 text-white user-sigout">
        <a class="text-white" href="">Sign out</a>
    </span>
</div>

</div>
    
<!-- Page Content -->	
  	<div class="container-fluid content-timesheets">
  	</div>
</body>
</html>