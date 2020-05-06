<template>
  <div class="wrapper" id="app">
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href class>
        <img src="/image/logo/paris_logo.jpg" class="logi-admin" />
      </a>
      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex info">
          <div class="info">
            <a href="#" class="d-block">Name</a>
          </div>
        </div>
        <nav class="mt-2">
          <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
          >
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users blue"></i>
                <p>
                  Quản trị viên
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview tree-left">
                <li class="nav-item">
                  <router-link to="/Admin/ListAdmin" class="nav-link">
                    <i class="fas fa-list-alt nav-icon yellow"></i>
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
                  <router-link to="/Admin/TestJWT" class="nav-link">
                    <i class="fas fa-map-marker nav-icon red"></i>
                    <p>Test JWT</p>
                  </router-link>
                </li>
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
              <h1 class="m-0 text-dark">
                <i>Travel</i>
              </h1>
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
      <div class="float-right d-none d-sm-inline">Anything you want</div>
      <strong>Nguyễn Minh Hiếu</strong> All rights reserved.
    </footer>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  methods: {},
  mounted() {
    console.log("Component mounted.");
  }
};
</script>
