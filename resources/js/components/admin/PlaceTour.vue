<template>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Địa Điểm</h3>
                    <div class="box-tools text-right">
                        <button class="btn btn-success" data-toggle="modal" data-target="#NewSpace">
                            Thêm mới 
                            <i class="fas fa-plus-circle fa-fw"></i>
                        </button>
                    </div>
                </div>
                <div v-if="successDeleteSpace != ''" class="alert alert-success text-center"> {{successDeleteSpace}} </div>
            <!-- /.box-body -->
            </div>
            <div>
                <table class="table table-condensed" >
                    <thead>
                        <tr class="table__title">
                            <th>Địa Điểm</th>
                            <th>Tour</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody v-for="(space, index) in listSpace" :key="space.id">
                        <tr class="table__content">
                            <td>{{ space.space }}</td>
                            <td>
                                <a class="nav-link" data-toggle="modal" data-target="#ViewTourWithSpace">
                                    Tour
                                </a>
                            </td>
                            <td>
                                <a class="nav-link" @click="sendSpace(space)" data-toggle="modal" data-target="#UpdateSpace">
                                    <i class="fas fa-edit nav-icon text-blue"></i>
                                </a>
                            </td>
                            <td>
                                <a @click="DeleteSpace(space, index)" class="nav-link">
                                    <i class="fas fa-trash-alt nav-icon text-red"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
          <!-- /.box -->
        </div>
        <div class="modal fade" id="NewSpace" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="NewSpaceLable">Create</h5>
                        <button type="button" class="close" @click="successCreateSpace=''" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="api-calling">
                            <div v-if="successCreateSpace!=''" class="alert alert-success"> {{ successCreateSpace }}</div>
                            <div class="create-form">
                                <div class="create-form">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input v-model="space.space" type="text" name="space"
                                        class="form-control">
                                        <span v-if="errors.space" class="text-danger"> {{ errors.space[0] }} </span>
                                    </div>
                                    <div class="button-create">
                                        <button class="btn btn-primary" @click="createSpace(space)">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Space -->
        <div class="modal fade" id="UpdateSpace" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="NewSpaceLable">Create</h5>
                        <button type="button" class="close" @click="successCreateSpace=''" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="api-calling">
                            <div v-if="successCreateSpace!=''" class="alert alert-success"> {{ successCreateSpace }}</div>
                            <div class="create-form">
                                <div class="create-form">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input v-model="space.space" type="text" name="space"
                                        class="form-control">
                                        <span v-if="errors.space" class="text-danger"> {{ errors.space[0] }} </span>
                                    </div>
                                    <div class="button-create">
                                        <button @click="updateSpace(space)" class="btn btn-primary">Update</button>
                                    </div>
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
                space: {
                    space: '',
                },
                errors: [],
                listSpace: [],
                successCreateSpace: '',
                successDeleteSpace: '',
            }
        },
        created() {
            this.getAllSpace();
        },
        methods: {
            getAllSpace() {
                axios.get('/api/space')
                .then(response => {
                    this.listSpace = response.data;
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name
                })
            },
            createSpace(space) {
                axios.post('/api/space', {space: this.space.space})
                .then(response => {
                    this.space.space = '';
                    this.getAllSpace();
                    this.successCreateSpace = 'Tạo thành công'
                })
                .catch(error => {
                    if(error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                })
            },
            DeleteSpace(space, index) {
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa?',
                    text: "Nếu xóa bạn không thể lấy lại!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Xóa!',
                    cancelButtonText: 'Hủy',
                }).then((result) => {
                    axios.delete('/api/space/' + space.id)
                    .then(response => {
                        this.successDeleteSpace = 'Xóa thành công';
                        console.log(response.data.result);
                        this.listSpace.splice(index, 1);
                    })
                    .catch(error => {
                        this.successDeleteSpace = '';
                        this.errors = error.response.data.errors.name;
                    })

                    if (result.value) {
                        
                        Swal.fire(
                        'Xóa Thành Công!',
                        'Bạn đã xóa địa điểm',
                        'Thành công'
                        )
                    }
                })
               
            },
            sendSpace(space) {
                this.space = space;
            },
            updateSpace(space) {
                axios.put('/api/space/' + this.space.id, {space: this.space.space} )
                .then(response => {
                    this.successUpdateSpace = "Cập nhập địa điểm thành công";
                })
                .catch(error => {
                    if(error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
