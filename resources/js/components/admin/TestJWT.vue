<template>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Test JWT</h3>
                    <div class="box-tools text-right">
                        <button class="btn btn-success" @click="getJWT">
                            Thêm mới tour
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
                            <th>Ngày đi</th>
                            <th>Ngày về</th>
                            <th>HÌnh ảnh</th>
                            <th>Số tiền</th>
                            <th>Tài khoản tạo</th>
                        </tr>
                    </thead>
                    <tbody v-for="(admin) in list_Admins" :key="admin.id">
                        <tr class="table__content">
                            <td>{{admin.user_name}}</td>
                            <td>{{admin.is_super_manager}}</td>
                            <td>
                                
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
                list_Admins: []
            }
        },
        method: {
            getJWT() {
                axios.get('/api/JWT')
                .then(response => {
                   this.list_Admins = response.data
                })
                .catch(error => {
                   this.errors = error.response.data.errors.name
                })
            },
        },
        mounted() {
            console.log('Component mounted.')
        },
    }
</script>
