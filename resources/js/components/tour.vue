<template>
    <div>
        <div class="top-header">
            <h5 class="text-right">Liên hệ: Đại học Bách khoa Hà Nội, số 1 Đại Cồ Việt - Hà Nội</h5>
        </div>
        <nav class="navbar navbar-expand-sm header-home">
            <router-link to="/home" class="nav-link home">
                <p>Tour Du Lịch</p>
            </router-link>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Loại Tour</a>
                </li>
                <li class="nav-item">
                    <router-link to="/listTour" class="nav-link">
                        <p>Danh sách Tour</p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tour Nổi Bật</a>
                </li>
                <li class="nav-item">
                    <router-link to="/introduce" class="nav-link">
                        <p>Giới thiệu</p>
                    </router-link>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="title-home">Du Lịch Tận Hưởng</h2>
                </div>
                <div class="col-md-6 pl-0 pr-0 mt-5">
                    <span>
                        <img class="d-inline-block pl-2" src="/img/logo.jpg" width="200px" height="150px">
                        <div class="d-inline-block pl-5 text-home">
                            <h3 class="text-center the-travel ">Lên kế hoạch ngay!</h3>
                            <h5 class="text-center the-travel ">Du lịch tận hưởng, trải nghiệm du lịch giá rẻ chưa từng thấy</h5>
                        </div>
                    </span>
                </div>
                <div class="col-md-4 offset-md-2 pl-0 pr-0">
                    <h5 class=" the-travel ">Tìm kiếm khu du lịch: </h5>
                    <div class="md-form active-pink active-pink-2 mb-1 mt-0 d-inline-block pl-5">
                        <div class="d-inline-block">
                            <input class="form-control"  v-model="search" type="text" placeholder="Search" aria-label="Search">
                        </div>
                        <div class="d-inline-block">
                            <button @click="searchSpace(search)" type="button" class="btn btn-outline-success ml-2">Success</button>
                        </div>
                    </div>
                    <div class="textError mb-1 mt-0 pl-5">
                        {{ this.errorsSearch }}
                    </div>
                    <div class="icoin-home mt-4">
                        <ul class="list-unstyled">
                            <li class="d-inline-block pl-5">
                                <a href="#!"><i class="fa fa-facebook-official" style="font-size:40px"></i>
                                </a>
                            </li>
                            <li class="d-inline-block pl-3">
                                <a href="#!"><i class="fa fa-instagram " aria-hidden="true" style="font-size:40px"></i>
                                </a>
                            </li>
                            <li class="d-inline-block pl-3">
                                <a href="#!"><i class="fa fa-twitch" aria-hidden="true" style="font-size:40px"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <h5 class=" the-travel ">Theo dõi để nhận ưu đãi !!!</h5>
                    
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <hr class="my-4">
            <router-view></router-view>
        </div>
        <footer class="page-footer font-small blue pt-4 footer-home">
            <div class="container-fluid text-center text-md-left">
                <div class="row">
                    <div class="col-md-6 mt-md-0 mt-3">
                        <h5 class="text-uppercase">Du lịch mọi lúc mọi nơi</h5>
                        <p>Bạn có câu hỏi hay thắc mắc, có thể liên hệ với chúng tôi</p>
                    </div>
                    <hr class="clearfix w-100 d-md-none pb-3">
                    <div class="col-md-3 mb-md-0 mb-3">
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
                    <div class="col-md-3 mb-md-0 mb-3">
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
                </div>
            </div>
            <div class="footer-copyright text-center py-3">© 2020 create by:
                Hieu20151340
            </div>
        </footer>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                search: '',
                data: [],
                errorsSearch: ''
            }
        },
        methods: {
            searchSpace(search) {
                axios.post('/api/searchSpace', {search: this.search})
                .then(response => {
                    this.data = response.data;
                    if (this.data.length) {
                        this.$router.push({ path: '/tourSearch/' + this.search})
                    } else {
                        this.errorsSearch = 'Vui lòng nhập lại địa điểm';
                        console.log(this.errorsSearch);
                    }
                    console.log(this.data.length);
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        
                        this.errors = error.response.data.errors
                    }
                    this.errorsSearch = 'Vui lòng nhập lại địa điểm';
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
