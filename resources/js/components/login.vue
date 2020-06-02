<template>
    
    <div class="row">
        <div class="col-md-2 offset-md-5 form-login">
            <div class="form-group">
                <label for="usr">User Name:</label>
                <input v-model="admin.user_name" type="text" class="form-control" id="usr" name="user_name">
            </div>
            <div class="form-group">
                <label for="pwd">Password</label>
                <input  v-model="admin.password" type="password" class="form-control" id="pwd" name="password">
            </div>
            <div class="btncre">
                <button @click="Login(admin)" type="submit" class="btn btn-primary">Login</button>
            </div>
            {{this.login.message}}
        </div>
	</div>
</template>

<script>
    export default {
        data() {
            return {
                admin: {
                    user_name: '',
                    password:''
                },
                login: '',
                jwt: ''
            }
        },
        methods: {
            Login(admin) {
                axios.post('/api/login', {user_name: this.admin.user_name, password: this.admin.password})
                .then(response => {
                    this.login = response.data;
                    console.log(this.login)
                    if (this.login.result) {
                        this.Jwt = response.data.jwt;
                        console.log(this.Jwt)
                        document.cookie = 'jwt=' +  this.Jwt;
                        document.cookie = 'admin=' +  this.admin.user_name;
                        this.$router.push({ path: '/Admin/ListAdmin',  params: { admin: this.admin } })
                    } else {
                        console.log('no')
                    }
                })
                .catch(error => {
                   this.login = response.result;
                   console.log(this.login)
                })
                console.log(this.admin.user_name)
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
