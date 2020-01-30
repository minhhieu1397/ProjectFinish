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
                            <th>Tour</th>
                            <th>Phương tiện</th>
                            <th>Ngày khởi hành</th>
                            <th>Thời gian</th>
                            <th>Giá/1 người</th>
                            <th>Ghi chú</th>
                            <th>Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody v-for="tour in list_Tours" :key="tour.id">
                        <tr class="table__content">
                            <td>{{ tour.tour_name }}</td>
                            <td>{{ tour.vehicle }}</td>
                            <td>{{ tour.departure }}</td>
                            <td>{{ tour.day_night }}</td>
                            <td>{{ tour.price }} VNĐ</td>
                            <td>{{ tour.note }}</td>
                            <td> 
                                <b-dropdown variant="light" text="Chi tiết">
                                    <b-dropdown-item data-toggle="modal" data-target="#Program">Chương trình</b-dropdown-item>
                                    <b-dropdown-item href="#">Chi tiết</b-dropdown-item>
                                </b-dropdown>
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
                            <div v-if="success != ''">
                                <div class="alert alert-success"> </div>
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

         <div class="modal fade" id="Program" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ProgramLable">Update user</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="api-calling">
                            aaaaaa
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
            }
        },
        created() {
            this.getAllTours()
        },
        methods: {
            createTour() {
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
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
