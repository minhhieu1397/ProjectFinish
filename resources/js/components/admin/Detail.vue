<template>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tour du lịch</h3>
                    <div class="box-tools text-right">
                        <button class="btn btn-success" data-toggle="modal" data-target="#NewUser">
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
                    <tbody>
                        <tr class="table__content">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
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
                            <div>
                                <div class="alert alert-success"> </div>
                            </div>
                            <div class="create-form">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input  type="text" name="user_name"
                                    class="form-control">
                                    
                                    <span class="text-danger">  </span>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input  type="password" name="password"
                                        class="form-control">
                                    <span class="text-danger">  </span>

                                </div>
                                <div class="form-group">
                                <div class="block">
                                        <div class="title">Super Admin</div>
                                        <div class="input">
                                            <b-form-checkbox>
                                                Admin
                                            </b-form-checkbox>
                                        </div>
                                    </div> 
                                </div>
                                <div class="button-create">
                                    <button  class="btn btn-primary">Create</button>
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
                            <div class="alert alert-success"> </div>
                            <div class="create-form">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input  type="text" name="user_name"
                                    class="form-control">
                                </div>
                                <div class="form-group">
                                <div class="block">
                                    <div class="title">Super Admin</div>
                                        <div class="input">
                                            <b-form-checkbox value="1" >
                                                Admin
                                            </b-form-checkbox>
                                        </div>
                                    </div> 
                                </div>
                                <div class="button-create">
                                    <button class="btn btn-primary">Update</button>
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
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
