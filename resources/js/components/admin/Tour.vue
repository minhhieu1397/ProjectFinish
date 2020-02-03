<template>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tour du lịch</h3>
                    <div class="box-tools text-right">
                        <button class="btn btn-success" data-toggle="modal" data-target="#NewUser">
                            Thêm mới tour
                            <i class="fas fa-plus-circle fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div>
                <table class="table table-condensed" >
                    <thead>
                        <tr class="table__title">
                            <th>Tour</th>
                            <th>Phương tiện</th>
                            <th>Ngày khởi hành</th>
                            <th>Thời gian</th>
                            <th>Giá/1 người</th>
                            <th>Ghi chú</th>
                            <th>Chi tiết</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody v-for="(tour, index) in list_Tours" :key="tour.id">
                        <tr class="table__content">
                            <td>{{ tour.tour_name }}</td>
                            <td>{{ tour.vehicle }}</td>
                            <td>{{ tour.departure }}</td>
                            <td>{{ tour.day_night }}</td>
                            <td>{{ tour.price }} VNĐ</td>
                            <td>{{ tour.note }}</td>
                            <td> 
                                <b-dropdown variant="light" text="Chi tiết">
                                    <b-dropdown-item data-toggle="modal" data-target="#Program" @click="sendTour(tour)">Chương trình</b-dropdown-item>
                                    <b-dropdown-item data-toggle="modal" data-target="#Detail" @click="sendTour(tour)">Chi tiết</b-dropdown-item>
                                </b-dropdown>
                            </td>
                            <td>
                                <ul class="nav nav-treeview">
                                    <a class="nav-link" @click="deleteTour(tour, index)">
                                        <i class="fas fa-trash-alt nav-icon text-red"></i>
                                    </a>
                                    <a class="nav-link" data-toggle="modal" data-target="#UpdateTour" @click="sendTour(tour)">
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
       
        <!-- Modal add new tour -->
        <div class="modal fade" id="NewUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="NewTourLabel">Add New</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                     
                    <div class="modal-body">
                        <div class="api-calling">
                            <div v-if="success != ''">
                                <div class="alert alert-success"> {{ success }} </div>
                            </div>
                            <div class="create-form">
                                <div class="form-group">
                                    <label>Tour</label>
                                    <input v-model="tour.tour_name" type="text" name="user_name"
                                    class="form-control">
                                    
                                    <span v-if="errors.tour_name" class="text-danger"> {{ errors.tour_name[0] }} </span>
                                </div>
                                <div class="form-group">
                                    <label>Phương tiện</label>
                                    <input v-model="tour.vehicle" type="text" name="user_name"
                                    class="form-control">
                                    
                                    <span v-if="errors.vehicle" class="text-danger"> {{ errors.vehicle[0] }}</span>
                                </div>
                                <div class="form-group">
                                    <label>Ngày khởi hành</label>
                                    <input v-model="tour.departure" type="date" name="user_name"
                                    class="form-control">
                                    
                                    <span v-if="errors.departure" class="text-danger"> {{ errors.departure[0] }}</span>
                                </div>
                                <div class="form-group">
                                    <label>Thời gian</label>
                                    <input v-model="tour.day_night" type="text" name="user_name"
                                    class="form-control">
                                    
                                    <span v-if="errors.day_night" class="text-danger"> {{ errors.day_night[0] }}</span>
                                </div>
                                <div class="form-group">
                                    <label>Giá</label>
                                    <input v-model="tour.price" type="text" name="user_name"
                                    class="form-control">
                                    
                                    <span v-if="errors.price" class="text-danger"> {{ errors.price[0] }}</span>
                                </div>
                                <div class="form-group">
                                    <label>Ghi chú</label>
                                    <input v-model="tour.note" type="text" name="user_name"
                                    class="form-control">
                                    
                                    <span v-if="errors.note" class="text-danger"> {{ errors.note[0] }}</span>
                                </div>
                                <div class="button-create">
                                    <button @click="createTour" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Model Program -->
        <div class="modal fade" id="Program" size="xl"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered  modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ProgramLable">Chương trình</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="api-calling">
                            <div v-if="!iscreateProgram" >
                                <button class="btn btn-primary" @click="isCreateProgram">
                                Thêm chương trình
                                <i class="fas fa-plus fa-fw"></i>
                                </button>
                                <div v-if="success !== ''" class="alert alert-success"> {{success}}</div>
                                <table class="table table-condensed" >
                                        <thead>
                                            <tr class="table__title">
                                                <th>Tour</th>
                                                <th>Tiêu đề</th>
                                                <th>Ngày</th>
                                                <th>Chi tiết</th>
                                            </tr>
                                        </thead>
                                        <tbody v-for="program in list_Program" :key="program.id">
                                            <tr class="table__content">
                                                <td>{{ tour.tour_name }}</td>
                                                <td>{{ program.title }}</td>
                                                <td>{{ program.day }}</td>
                                                <td>{{ program.detail }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                            <div v-else>
                                <div class="create-form">
                                    
                                    <div v-if="success !== ''" class="alert alert-success"> {{success}}</div>
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input v-model="program.title" type="text" name="title"
                                        class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày thứ</label>
                                        <input v-model="program.day" type="text" name="day"
                                        class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết</label>
                                        <input v-model="program.detail" type="text" name="detail"
                                        class="form-control">
                                    </div>
                                    <div class="button-create">
                                        <button @click="createProgram" class="btn btn-primary">Create</button>
                                        <button class="btn btn-primary" @click="listProgram(tour)">
                                            Danh sách chương trình
                                        </button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Tour -->
        <div class="modal fade" id="UpdateTour" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="UpdateTourLable">Update Tour</h5>
                        <button type="button" class="close" data-dismiss="modal" @click="getAllTours" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="api-calling">
                            <div v-if="success !== ''" class="alert alert-success"> {{success}}</div>
                            <div class="create-form">
                                <div class="form-group">
                                    <label>Tour</label>
                                    <input v-model="tour.tour_name" type="text" name="user_name"
                                    class="form-control">
                                    
                                    <span v-if="errors.tour_name" class="text-danger"> {{ errors.tour_name[0] }} </span>
                                </div>
                                <div class="form-group">
                                    <label>Phương tiện</label>
                                    <input v-model="tour.vehicle" type="text" name="user_name"
                                    class="form-control">
                                    
                                    <span v-if="errors.vehicle" class="text-danger"> {{ errors.vehicle[0] }}</span>
                                </div>
                                <div class="form-group">
                                    <label>Ngày khởi hành</label>
                                    <input v-model="tour.departure" type="date" name="user_name"
                                    class="form-control">
                                    
                                    <span v-if="errors.departure" class="text-danger"> {{ errors.departure[0] }}</span>
                                </div>
                                <div class="form-group">
                                    <label>Thời gian</label>
                                    <input v-model="tour.day_night" type="text" name="user_name"
                                    class="form-control">
                                    
                                    <span v-if="errors.day_night" class="text-danger"> {{ errors.day_night[0] }}</span>
                                </div>
                                <div class="form-group">
                                    <label>Giá</label>
                                    <input v-model="tour.price" type="text" name="user_name"
                                    class="form-control">
                                    
                                    <span v-if="errors.price" class="text-danger"> {{ errors.price[0] }}</span>
                                </div>
                                <div class="form-group">
                                    <label>Ghi chú</label>
                                    <input v-model="tour.note" type="text" name="user_name"
                                    class="form-control">
                                    
                                    <span v-if="errors.note" class="text-danger"> {{ errors.note[0] }}</span>
                                </div>
                                <div class="button-create">
                                    <button @click="updateTour(tour)" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Detail -->
        <div class="modal fade" id="Detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="DetailLable">Create Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="api-calling">
                            <div v-if="success !== ''" class="alert alert-success"> {{success}}</div>
                            <div class="create-form">
                                <div class="form-group">
                                    <label>Day Start</label>
                                    <input v-model="detail.day_start" type="date" name="day_start"
                                    class="form-control">
                                    
                                    <span v-if="errors.day_start" class="text-danger"> {{ errors.day_start[0] }} </span>
                                </div>
                                <div class="form-group">
                                    <label>Day End</label>
                                    <input v-model="detail.day_end" type="date" name="day_end"
                                    class="form-control">
                                    
                                    <span v-if="errors.day_end" class="text-danger"> {{ errors.day_end[0] }}</span>
                                </div>

                                <div class="form-group">
                                    <label>Image</label>
                                     <input type="file" v-on:change="onImageChange" class="form-control">
                                    class="form-control">
                                    
                                    <span v-if="errors.day_end" class="text-danger"> {{ errors.day_end[0] }}</span>
                                </div>

                                <div class="form-group">
                                    <label>Amount</label>
                                    <input v-model="detail.amount" type="text" name="amount"
                                    class="form-control">
                                    
                                    <span v-if="errors.amount" class="text-danger"> {{ errors.amount[0] }}</span>
                                </div>
                                <div class="button-create">
                                    <button @click="CreateDetail(tour)" class="btn btn-primary">Create</button>
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
                tour: {
                    tour_name: '',
                    vehicle: '',
                    departure: '',
                    day_night: '',
                    price: '',
                    note: '',
                },
                errors: [],
                success: '',
                list_Tours: [],
                iscreateProgram: false,
                program: {
                    tour_id: '',
                    title: '',
                    day: '',
                    detail: '',
                },
                list_Program: [],
                detail: {
                    day_start: '',
                    day_end: '',
                    amount: '',
                    account: '',
                },
                admin_current: {
                    user_name: '',
                }
            }
        },
        created() {
            this.getAllTours()
            this.getAdminCurrent()
        },
        methods: {
            createTour(tour) {
                axios.post('/api/tour', {tour_name: this.tour.tour_name, vehicle: this.tour.vehicle, departure: this.tour.departure, 
                    day_night: this.tour.day_night, price: this.tour.price, note: this.tour.note })
                    .then(response => {
                        this.tour.tour_name = null
                        this.tour.vehicle = null
                        this.tour.departune = null
                        this.tour.day_night = null
                        this.tour.price = null
                        this.tour.note = null
                        this.success = 'Tạo Tour thành công'
                        this. getAllTours()
                    })
                    .catch(error => {
                        this.success = ''
                        if (error.response.status == 422) {
                            this.errors = error.response.data.errors
                        }
                    })
            },
            getAllTours() {
                axios.get('/api/tour')
                .then(response => {
                   this.list_Tours = response.data
                })
                .catch(error => {
                   this.errors = error.response.data.errors.name
                })
            },
            getAdminCurrent() {
                axios.get('/Admin/admin')
                .then(response => {
                    this.admin_current = response.data
                    console.log(this.admin_current.user_name)
                })
                .catch(error => {
                   this.errors = error.response.data.errors.name
                   console.log('errors get admin current')
                })
            },
            deleteTour(tour, index) {
                axios.delete('/api/tour/' + tour.id)
                .then(response => {
                    console.log(response.data.result)
                    this.list_Tours.splice(index, 1)
                })
                .catch(error => {
                    this.success = ''
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }
				})
            },
            updateTour() {
                axios.put('/api/tour/' + this.tour.id, {tour_name: this.tour.tour_name, vehicle: this.tour.vehicle, departune: this.tour.departune, day_night: this.tour.day_night,
                    price: this.tour.price, note: this.tour.note})
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
            sendTour(tour) {
                this.getAllprogram(tour)
                this.tour = tour
                this.iscreateProgram = false
            },
            isCreateProgram() {
                this.iscreateProgram = true;
            },
            createProgram() {
                axios.post('/api/program', {tour_id: this.tour.id, title: this.program.title, day: this.program.day, 
                detail: this.program.detail })
                .then(response => {
                    this.program.title = null
                    this.success = 'Tạo program thành công'
                })
                .catch(error => {
                    this.success = ''
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }
                })
            },
            getAllprogram(tour) {
                this.tour = tour
                axios.get('/api/program/' + this.tour.id)
                .then(response => {
                   this.list_Program = response.data
                })
                .catch(error => {
                   this.errors = error.response.data.errors.name
                })
            },
            listProgram(tour) {
                this.success = ''
                this.iscreateProgram = false
                this.getAllprogram(tour)
            },
            CreateDetail(tour) {
                console.log(this.detail.image)
                axios.post('/api/detail', {image: this.detail.image})
                .then(response => {
                    this.detail.day_start = null
                    this.detail.day_end = null
                    this.detail.amount
                })
                .catch(error => {
                    if(error.response.status ==422) {
                        this.errprs = error.response.data.errors
                    }
                })
            },
            onImageChange(e){
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.detail.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
