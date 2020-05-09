<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="top-header">
        <h5 class="text-right">Liên hệ: Đại học Bách khoa Hà Nội, số 1 Đại Cồ Việt - Hà Nội</h5>
    </div>
    <nav class="navbar navbar-expand-sm header-home">
        <!-- Brand -->
        <a class="navbar-brand" href="#">Tour Du Lịch</a>

        <!-- Links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Loại Tour</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Danh Sách Tour</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Tour Nổi Bật</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link 2</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item ">
                <a class="nav-link" href="#">Đăng kí</a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="#">Đăng nhập</a>
            </li>
        </ul>
    </nav>
    <hr>
    <br>
    <div class="container-fluid" id="app">
        <router-view></router-view>
    </div>
    <footer class="page-footer font-small blue pt-4 footer-home">

        <!-- Footer Links -->
        <div class="container-fluid text-center text-md-left">

            <!-- Grid row -->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-6 mt-md-0 mt-3">

                    <!-- Content -->
                    <h5 class="text-uppercase">Du lịch mọi lúc mọi nơi</h5>
                    <p>Bạn có câu hỏi hay thắc mắc, có thể liên hệ với chúng tôi</p>

                </div>
                <!-- Grid column -->

                <hr class="clearfix w-100 d-md-none pb-3">

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <h5 class="text-uppercase">Liên hệ</h5>

                    <ul class="list-unstyled">
                        <li>
                            Số điện thoại: 0123456789
                        </li>
                        <li>
                            Email: Minhhieu97.hust@gmail.com
                        </li>
                        <li>
                            Địa chỉ: Số 1, Đại Cồ Việt
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <h5 class="text-uppercase">Mạng xã hội</h5>

                    <ul class="list-unstyled">
                        <li>
                        <i class="fa fa-facebook-official" style="font-size:24px"></i> :
                            <a href="#!">Facebook</a>
                        </li>
                        <li>
                            <i class="fa fa-instagram" aria-hidden="true" style="font-size:24px"></i> :
                            <a href="#!">Instagram</a>
                        </li>
                    </ul>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2020 create by:
           Hieu20151340
        </div>
        <!-- Copyright -->

    </footer>
    <script src="{{ asset('/main/main.js') }}"></script>
</body>

</html>