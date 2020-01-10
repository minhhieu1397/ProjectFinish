<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Quản trị viên</title>

  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="">
        <img src="/image/logo/paris_logo.jpg" class="logi-admin">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex info">
              <div class="info">
                  <a href="#" class="d-block">Name</a>
              </div>
        </div>

      <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Quản trị viên
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/ListAdmin" class="nav-link">
                                <i class="fas fa-list-alt nav-icon"></i>
                                <p>Danh sách quản lí</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Tour Du Lịch
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <router-link to="/PlaceTour" class="nav-link">
                                <i class="fas fa-map-marker nav-icon"></i>
                                <p>Địa điểm</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/Tour" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                            <p>Tour</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/Comment" class="nav-link">
                                <i class="fas fa-comment-alt nav-icon"></i>
                            <p>Bình luận</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/Reserve" class="nav-link">
                                <i class="fas fa-shopping-cart nav-icon"></i>
                            <p>Phiếu đặt</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/Detail" class="nav-link">
                                <i class="fas fa-marker nav-icon"></i>
                            <p>Chi tiết</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/Program" class="nav-link">
                                <i class="fas fa-clock nav-icon"></i>
                            <p>Chương trình</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
  </aside>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0 text-dark"><i>Travel</i></h1>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                  <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
</div>
    <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <strong>Nguyễn Minh Hiếu</strong> All rights reserved.
    </footer>
</div>

<script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>