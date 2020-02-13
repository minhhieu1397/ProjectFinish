<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Quản trị viên</title>

  c
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
                        <i class="nav-icon fas fa-users blue"></i>
                        <p>
                            Quản trị viên
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview tree-left">
                        <li class="nav-item ">
                            <router-link to="/Admin/ListAdmin" class="nav-link">
                                <i class="fas fa-list-alt nav-icon yellow "></i>
                                <p>Danh sách quản lí</p>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book blue"></i>
                        <p>
                            Tour Du Lịch
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview tree-left">
                        <li class="nav-item">
                            <router-link to="/Admin/PlaceTour" class="nav-link">
                                <i class="fas fa-map-marker nav-icon red"></i>
                                <p>Địa điểm</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/Admin/Tour" class="nav-link">
                                <i class="fas fa-list nav-icon purple"></i>
                            <p>Tour</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/Admin/Comment" class="nav-link">
                                <i class="fas fa-comment-alt nav-icon while"></i>
                            <p>Bình luận</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/Admin/Reserve" class="nav-link">
                                <i class="fas fa-shopping-cart nav-icon orange"></i>
                            <p>Phiếu đặt</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/Admin/Detail" class="nav-link">
                                <i class="fas fa-marker nav-icon green"></i>
                            <p>Chi tiết</p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/Admin/Program" class="nav-link">
                                <i class="fas fa-clock nav-icon teal"></i>
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