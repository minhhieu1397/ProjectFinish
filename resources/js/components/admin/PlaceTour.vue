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
                            <td>{{ space.place }}</td>
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
                                        <input v-model="space.place" type="text" name="place"
                                        class="form-control">
                                        <span v-if="errors.place" class="text-danger"> {{ errors.place[0] }} </span>
                                    </div>
                                    <div class="button-create">
                                        <button class="btn btn-primary" @click="createSpace(space)">Tạo mới</button>
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
                                        <input v-model="space.place" type="text" name="place"
                                        class="form-control">
                                        <span v-if="errors.place" class="text-danger"> {{ errors.place[0] }} </span>
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
                    place: '',
                },
                errors: [],
                listSpace: [],
                successCreateSpace: '',
                successDeleteSpace: '',
            }
        },
        created() {
            this.setJwt();
            this.getAllSpace();
        },
        methods: {
            getAllSpace() {
                axios.get('/api/place/view', {
                        params: {
                          jwt: this.jwt,
                          admin: this.adminCurrent
                        }})
                .then(response => {
                    this.listSpace = response.data;
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name
                })
            },
            createSpace(space) {
                axios.post('/api/place/store', {place: this.space.place, jwt: this.jwt, admin: this.adminCurrent})
                .then(response => {
                    this.space.place = '';
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
                    axios.delete('/api/place/delete/' + space.id, {data:{jwt: this.jwt, admin: this.adminCurrent}})
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
                axios.put('/api/place/update/' + space.id, {place: this.space.place, jwt: this.jwt, admin: this.adminCurrent} )
                .then(response => {
                    this.successUpdateSpace = "Cập nhập địa điểm thành công";
                })
                .catch(error => {
                    if(error.response.status == 422) {
                        this.errors = error.response.data.errors;
                    }
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
