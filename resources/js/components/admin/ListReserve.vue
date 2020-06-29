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
                            <th>Tour</th>
                            <th>Ngày đặt</th>
                            <th>Số lượng</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                            <th>Điện thoại</th>
                            <th>Ghi chú</th>
                            <th>Thanh toán</th>
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
    </div>
</template>

<script>

    export default {
        data() {
            return {
                reserver: {
                    tour_id :'',
                    booking_date :'',
                    children :'',
                    people :'',
                    status :'',
                    email :'',
                    phone :'',
                    note :'',
                    address:'',
                },
                errors: [],
                success: null,
                list_Admins: [],
                adminCurrent: '',
                jwt: '',
            }
        },
        created() {
           this.setJwt();
           this.getListAdmins();
        },
        methods: {
            createAdmin() {
                this.errors = []
                axios.post('/api/admin/store', {user_name: this.admin.user_name, password: this.admin.password, is_super_manager: this.admin.is_super_manager, jwt: this.jwt, admin: this.adminCurrent})
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
                axios.get('/api/admin/view', {
                        params: {
                          jwt: this.jwt,
                          admin: this.adminCurrent
                        }
                    })
                    .then(response => {
                       this.list_Admins = response.data
                    })
                    .catch(error => {
                       this.errors = error.response.data.errors.name
                    })
            },
            setJwt() {
                this.myCookie = document.cookie;
                var name = 'Jwt' + "=";
                var ad = 'admin' + "=";
                var ca = this.myCookie.split(';');
                for(var i = 0; i <ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0)==' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf('jwt') == 0) {
                        this.jwt=  c.substring(name.length,c.length);
                        console.log(this.jwt);
                    } else if (c.indexOf('admin') == 0) {
                        this.adminCurrent = c.substring(ad.length,c.length);
                        console.log(this.adminCurrent);
                    }
                }
            },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>