<template>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Users</h3>
                    <div class="box-tools text-right">
                        <button class="btn btn-success" @click="handleClickNewUser" data-toggle="modal" data-target="#NewUser">
                            New Admin
                            <i class="fas fa-user-plus fa-fw"></i>
                        </button>
                    </div>
                </div>
            
            <!-- /.box-body -->
            </div>
            <div>
                <table class="table table-condensed" >
                    <thead>
                        <tr class="table__title">
                            <th>Admin Name</th>
                            <th>Super Admin</th>
                            <th>Delete|Update</th>
                        </tr>
                    </thead>
                    <tbody v-for="(admin, index) in list_Admins" :key="admin.id">
                        <tr class="table__content">
                            <td>{{admin.user_name}}</td>
                            <td>{{admin.is_super_manager}}</td>
                            <td>
                                <ul class="nav nav-treeview">
                                    <a class="nav-link" @click="deleteAdmin(admin, index)">
                                        <i class="fas fa-trash-alt nav-icon text-red"></i>
                                    </a>
                                    <a class="nav-link" data-toggle="modal" data-target="#UpdateAdmin" @click="sendAdmin(admin)">
                                        <i class="fas fa-edit nav-icon text-blue"></i>
                                    </a>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
                     
                    <div class="modal-body">
                        <div class="api-calling">
                            <div v-if="success !== null" class="alert alert-success"> {{success}}</div>
                            <div class="create-form">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input v-model="admin.user_name" type="text" name="user_name"
                                    class="form-control">
                                    
                                    <span v-if="errors.user_name" class="text-danger"> {{ errors.user_name[0] }} </span>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input v-model="admin.password" type="password" name="password"
                                        class="form-control">
                                    <span v-if="errors.password" class="text-danger"> {{ errors.password[0] }} </span>

                                </div>
                                <div class="form-group">
                                <div class="block">
                                        <div class="title">Super Admin</div>
                                        <div class="input">
                                            <b-form-checkbox v-model="admin.is_super_manager">
                                                Admin
                                            </b-form-checkbox>
                                        </div>
                                    </div> 
                                </div>
                                <div class="button-create">
                                    <button @click="createAdmin" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
      <!-- Modal -->
        <div class="modal fade" id="UpdateAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="UpdateAdminLable">Update user</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="api-calling">
                            <div v-if="success !== null" class="alert alert-success"> {{success}}</div>
                            <div class="create-form">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input v-model="admin.user_name" type="text" name="user_name"
                                    class="form-control">
                                </div>
                                <div class="form-group">
                                <div class="block">
                                    <div class="title">Super Admin</div>
                                        <div class="input">
                                            <b-form-checkbox value="1" v-model="admin.is_super_manager">
                                                Admin
                                            </b-form-checkbox>
                                        </div>
                                    </div> 
                                </div>
                                <div class="button-create">
                                    <button @click="updateAdmin(admin)" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
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
                admin: {
                    user_name :'',
                    password :'',
                    is_super_manager : false,
                },
                errors: [],   
                success: null,
                list_Admins: [],
            }
        },
        created() {
           this.getListAdmins()
        },
        methods: {
            createAdmin() {
                this.errors = []
                axios.post('api/admin/', {user_name: this.admin.user_name, password: this.admin.password, is_super_manager: this.admin.is_super_manager})
                .then(response => {
                    this.admin.user_name = null
                    this.admin.password = null
                    this.admin.is_super_manager = false
                    this.success = 'Tạo admin thành công'
                    this.getListAdmins()
                })
                .catch(error => {
                    this.success = ''
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }
                })
            },
            getListAdmins() {
                axios.get('/api/admin/')
                .then(response => {
                   this.list_Admins = response.data
                })
                .catch(error => {
                   this.errors = error.response.data.errors.name
                })
           },
           sendAdmin(admin) {
               this.success = '';
               this.admin = admin;
           },
           handleClickNewUser() {
                this.success = '';
                this.admin = {
                    user_name :'',
                    password :'',
                    is_super_manager : false,
                }
           },
           updateAdmin(admin) {
                axios.put('/api/admin/' + this.admin.id, {user_name: this.admin.user_name, is_super_manager: this.admin.is_super_manager})
				.then(response => {
                    this.success = 'Cập nhập thành công'
				})
				.catch(error => {
                    this.success = ''
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }
				})
            },
            deleteAdmin(admin, index) {
                axios.delete('/api/admin/' + admin.id)
                .then(response => {
                    console.log(response.data.result)
                    this.list_Admins.splice(index, 1)
                })
                .catch(error => {
                    this.success = ''
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }
				})
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>