<template>
    <div class="row">
        <div class="col-md-10 offset-md-1 border">
          <div class="box">
            <div class="box-header">
                <h3 class="box-title">Users</h3>

                <div class="box-tools text-right">
                    <button class="btn btn-success" data-toggle="modal" data-target="#NewUser">
                        New User
                        <i class="fas fa-user-plus fa-fw"></i>
                    </button>
                </div>
            </div>
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
            <!-- Modal -->
            <div class="modal fade" id="NewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="NewUserLabel">Add New</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                   <form @submit.prevent="createAdmin" @keydown="form.onKeydown($event)">
                        <div class="form-group">
                        <label>Username</label>
                        <input v-model="form.user_name" type="text" name="user_name"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('user_name') }">
                        <has-error :form="form" field="user_name"></has-error>
                        </div>

                        <div class="form-group">
                        <label>Password</label>
                        <input v-model="form.password" type="password" name="password"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                        <has-error :form="form" field="password"></has-error>
                        </div>

                        <div class="form-group">
                        <label>is_super_manager</label>
                        <input v-model="form.password" type="is_super_manager" name="is_super_manager"
                            class="form-control" :class="{ 'is-invalid': form.errors.has('is_super_manager') }">
                        <has-error :form="form" field="is_super_manager"></has-error>
                        </div>

                        <button  type="submit" class="btn btn-primary">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form: new Form({
                    user_name :'',
                    password :'',
                    is_super_manager :'',
                })
            }
        },
        methods: {
            createAdmin() {
                console.log('aaaaaaaaaaa.')
                this.form.post('api/admin');
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>