<template>
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center headeing">Đăng kí</h1>
        </div>
        
        <div v-if="!RegisterSuccess" class="col-md-2 offset-md-5 mt-2 pt-2">
            <div>
                <div class="form-group">
                    <label for="a">Họ tên: </label>
                    <input v-model="user.name" type="text" class="form-control" id="a">
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input v-model="user.email" type="text" class="form-control" id="email">
                </div>
                <div class="form-group">
                    <label for="phone">Số Điện Thoại: </label>
                    <input v-model="user.phone" type="text" class="form-control" id="phone">
                </div>
                <div class="form-group">
                    <label for="pwd">Mật khẩu: </label>
                    <input  v-model="user.password" type="password" class="form-control" id="pwd">
                </div>
                <div class="form-group">
                    <label for="cfpwd">Xác nhận mật khẩu: </label>
                    <input  v-model="user.confilmPassword" type="password" class="form-control" id="cfpwd">
                </div>
                <div class="btncre">
                    <button @click="Register(user)" type="submit" class="btn btn-primary">Đăng kí</button>
                </div>
            </div>
            <div class="pt-2 text-center font-site16 mb-5 pt-5">
                <div class="d-inline-block">Bạn đã có tài khoản: 
                    
                </div> 
                <router-link to="/login" class="nav-link d-inline-block">
                    <p>Đăng nhập</p>
                </router-link>
            </div>
        </div>
        <div v-else class="col-md-2 offset-md-5 pt-5 font-site-18 mb-5 pt-5">
            <div>
                <div class="h4 text-danger">Đăng kí thành công</div>
            </div>
            <div >
                <div class="d-inline-block">Đăng nhập ngay: 
                </div> 
                <router-link to="/login" class="nav-link d-inline-block">
                    <p>Đăng nhập</p>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user: {
                    name: '',
                    email: '',
                    phone: '',
                    password: '',
                    confilmPassword: ''
                },
                RegisterSuccess: ''
            }
        },
        created() {
            this.RegisterSuccess = '';
        },
        methods: {
            Register(user) {
                this.RegisterSuccess = '';
                axios.post('/api/createUser', {name: this.user.name, email: this.user.email, phone: this.user.phone, 
                password: this.user.password, confilmPassword: this.user.confilmPassword })
                .then(response => {
                    this.RegisterSuccess = 'Đăng kí thành công';
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
