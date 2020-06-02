<template>
<div>
   <div class="top-header">
        <h5 class="text-right">Liên hệ: Đại học Bách khoa Hà Nội, số 1 Đại Cồ Việt - Hà Nội</h5>
    </div>
    <nav class="navbar navbar-expand-sm header-home">
        <router-link to="/home" class="nav-link">
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
                <a class="nav-link" href="#">Link 2</a>
            </li>
        </ul>
    </nav>
    <hr>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center headeing">Đăng Nhập</h1>
            </div>
            <div class="col-md-2 offset-md-5 mt-5 pt-5">
                <div>
                    <div class="form-group">
                        <label for="phone">Số Điện Thoại: </label>
                        <input v-model="user.phone" type="text" class="form-control" id="phone">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mật khẩu: </label>
                        <input  v-model="user.password" type="password" class="form-control" id="pwd">
                    </div>
                    <div class="btncre">
                        <button @click="login(user)" type="submit" class="btn btn-primary">Đăng nhập</button>
                    </div>
                </div>
                <div class="pt-2 text-center font-site16">
                    <div class="d-inline-block">Bạn chưa có tài khoản: 
                        
                    </div> 
                    <router-link to="/register" class="nav-link d-inline-block">
                        <p>Đăng kí</p>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        data() {
            return {
                user: {
                    phone: '',
                    password: '',
                    email: '',
                },
                loginUser: '',
                name_user: ''
            }
        },
        methods: {
            login(user) {
                axios.post('/api/loginUser', {phone: this.user.phone, password: this.user.password})
                .then(response => {
                    this.loginUser = response.data;
                    this.name_user = response.data.name_user;
                    if (this.loginUser.result) {
                        this.Jwt = response.data.jwt;
                        console.log(this.Jwt);
                        document.cookie = 'jwt=' +  this.Jwt;
                        document.cookie = 'user=' +  this.name_user;
                    } else {
                        console.log('no')
                    }
                    this.$router.push({ path: '/tour/'});
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }
                })
            }
        }
        ,
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
