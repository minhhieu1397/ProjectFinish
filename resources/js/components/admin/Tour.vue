<template>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Tour du lịch</h3>
                    <div class="box-tools text-right">
                        <button class="btn btn-success" @click="handleClickNewTour" data-toggle="modal" data-target="#NewUser">
                            Thêm mới tour
                            <i class="fas fa-plus-circle fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div>
                <table class="table table-condensed" >
                    <thead>
                        {{this.admin_current.user_name}}
                        <tr class="table__title">
                            <th>Tour</th>
                            <th>Phương tiện</th>
                            <th>Ngày khởi hành</th>
                            <th>Thời gian</th>
                            <th>Giá/1 người</th>
                            <th>Ghi chú</th>
                            <th>Chi tiết</th>
                            <th>Thao tác</th>
                            <th>Tour Hot</th>
                            <th>Phiếu đặt</th>
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
                                    <b-dropdown-item data-toggle="modal" data-target="#Program" @click="sendTourProgram(tour)">Chương trình</b-dropdown-item>
                                    <b-dropdown-item data-toggle="modal" data-target="#Detail" @click="sendTourDetal(tour)">Chi tiết</b-dropdown-item>
                                </b-dropdown>
                            </td>
                            <td>
                                <ul class="nav nav-treeview">
                                    <a class="nav-link" @click="deleteTour(tour, index)">
                                        <i class="fas fa-trash-alt nav-icon text-red"></i>
                                    </a>
                                    <a class="nav-link" data-toggle="modal" data-target="#UpdateTour" @click="sendTourUpdate(tour)">
                                        <i class="fas fa-edit nav-icon text-blue"></i>
                                    </a>
                                </ul>
                            </td>
                            <td>
                                <ul class="nav nav-treeview">
                                    <div v-if="tour.tour_hot">
                                        <span class="text-danger"> Hot</span>
                                        <a class="nav-link" @click="setTourHot(tour)">
                                            <i class="fas fa-external-link-square-alt nav-icon text-blue"></i>
                                        </a>
                                    </div>
                                    <div v-else>

                                        <a class="nav-link" @click="setTourHot(tour)">
                                            <i class="fas fa-external-link-square-alt nav-icon text-blue"></i>
                                        </a>
                                    </div>
                                </ul>
                            </td>
                             <td>
                                <ul class="nav nav-treeview">
                                    <a class="nav-link text-blue" @click="goReserve(tour)">
                                        <i class="fas fa-book-open nav-icon"></i>
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
                        <h5 class="modal-title" id="NewTourLabel">Thêm mới tour</h5>
                        <button type="button" class="close" @click="successCreateTour=''" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                     
                    <div class="modal-body">
                        <div class="api-calling">
                            <div v-if="successCreateTour != ''">
                                <div class="alert alert-success"> {{ successCreateTour }} </div>
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

                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" v-on:change="onImageChangeTour" class="form-control">
                                    
                                    <div  class="text-danger" v-if="errorFileMessage.length > 0">
                                        <span>{{ errorFileMessage }}</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Địa Điểm:</label>
                                    <select v-model="tour.place_id">
                                        <option v-for="(place) in listPlaces" :key="place.key" :value="place.id">
                                            {{place.place}}
                                        </option>
                                    </select>
                                </div>
                                
                                <div class="button-create">
                                    <button @click="createTour" class="btn btn-primary">Tạo</button>
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
                                <div class="form-group">
                                    <button class="btn btn-primary" @click="isCreateProgram">
                                    Thêm
                                    <i class="fas fa-plus fa-fw"></i>
                                    </button>
                                </div>
                                <table class="table table-condensed" >
                                    <thead>
                                        <tr class="table__title">
                                            <th>Tour</th>
                                            <th>Tiêu đề</th>
                                            <th>Ngày</th>
                                            <th>Chi tiết</th>
                                            <th>Xóa|Sửa</th>
                                        </tr>
                                    </thead>
                                    <tbody v-for="(program, index) in list_Program" :key="program.id">
                                        <tr class="table__content">
                                            <td>{{ tour.tour_name }}</td>
                                            <td>{{ program.title }}</td>
                                            <td>{{ program.day }}</td>
                                            <td>{{ program.detail }}</td>
                                            <td>
                                                <ul class="nav nav-treeview">
                                                    <a class="nav-link" @click="deleteProgram(program, index)">
                                                        <i class="fas fa-trash-alt nav-icon text-red"></i>
                                                    </a>
                                                    <a class="nav-link" data-toggle="modal" data-target="#UpdateProgram" @click="sendProgramUpdate(program)">
                                                        <i class="fas fa-edit nav-icon text-blue"></i>
                                                    </a>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-else>
                                <div class="create-form">
                                    <div v-if="successCreateProgram != ''" class="alert alert-success"> {{successCreateProgram}}</div>
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input v-model="program.title" type="text" name="title"
                                        class="form-control">
                                        <span v-if="errors.title" class="text-danger"> {{ errors.title[0] }} </span>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày thứ</label>
                                        <input v-model="program.day" type="text" name="day"
                                        class="form-control">
                                        <span v-if="errors.day" class="text-danger"> {{ errors.day[0] }} </span>
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết</label>
                                        <input v-model="program.detail" type="text" name="detail"
                                        class="form-control">
                                        <span v-if="errors.detail" class="text-danger"> {{ errors.detail[0] }} </span>
                                    </div>
                                    <div class="button-create">
                                        <button @click="createProgram" class="btn btn-primary">Create</button>
                                        <button class="btn btn-success" @click="listProgram(tour)">
                                            Danh sách
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
                            <div v-if="successUpdateTour !== ''" class="alert alert-success"> {{successUpdateTour}}</div>
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
                                <div class="form-group">
                                    <label>Địa Điểm:</label>
                                    <select v-model="tour.place_id">
                                        <option v-for="(place) in listPlaces" :key="place.key" :value="place.id">
                                            {{place.place}}
                                        </option>
                                    </select>
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
                        <h5 class="modal-title" id="DetailLable">Chi tiết</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="api-calling">
                            <div v-if="!isCreateDetail & !isCreateImage">
                                <div  class="form-group">
                                    <button class="btn btn-primary" @click="isCreateDetail = true">
                                    Thêm
                                    <i class="fas fa-plus fa-fw"></i>
                                    </button>
                                </div>
                                <button class="btn btn-primary" @click="isCreateImage = true ; getImageDetail(tour)">
                                    Thêm ảnh
                                    <i class="fas fa-plus fa-fw"></i>
                                    </button>
                                <div v-if="success !== ''" class="alert alert-success"> {{success}}</div>
                                <table class="table table-condensed" >
                                    <thead>
                                        <tr class="table__title">
                                            <th>Ngày đi</th>
                                            <th>Ngày về</th>
                                            <th>Hình ảnh</th>
                                            <th>Số lượng còn</th>
                                            <th>Xóa|Sửa</th>
                                        </tr>
                                    </thead>
                                    <tbody v-for="(detail, index) in list_Detail" :key="detail.id">
                                        <tr class="table__content">
                                            <td>{{ detail.day_start }}</td>
                                            <td>{{ detail.day_end }}</td>
                                            <td>{{ detail.image }}</td>
                                            <td>{{ detail.amount }}</td>
                                            <td>
                                                <ul class="nav nav-treeview">
                                                    <a class="nav-link" @click="deleteDetail(detail, index)">
                                                        <i class="fas fa-trash-alt nav-icon text-red"></i>
                                                    </a>
                                                    <a class="nav-link" data-toggle="modal" data-target="#UpdateDetail" @click="sendDetailUpdate(detail)">
                                                        <i class="fas fa-edit nav-icon text-blue"></i>
                                                    </a>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-else-if="isCreateImage">
                                <div class="d-inline-block ml-2" v-for="(image) in imageDetails" :key="image.id">
                                    <img width="200" height="150" v-bind:src="'/image/detail/'+image.url" />
                                </div>
                                
                                <form @submit="CreateDetailImage(tour)" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" v-on:change="onImageChange" class="form-control">
                                        
                                        <div  class="text-danger" v-if="errorFileMessage.length > 0">
                                            <span>{{ errorFileMessage }}</span>
                                        </div>
                                    </div>
                                    <div class="button-create">
                                        <button class="btn btn-primary">Thêm ảnh</button>
                                        <button class="btn btn-success" @click="listDetail(tour)">
                                            Danh sách
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div v-else>
                                <div v-if="successCreateDetail !== ''" class="alert alert-success"> {{successCreateDetail}}</div>
                                <div class="create-form">
                                    <form @submit="CreateDetail(tour)" enctype="multipart/form-data">
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
                                            <label>Total</label>
                                            <input v-model="detail.total" type="text" name="amount"
                                            class="form-control">
                                            
                                            <span v-if="errors.total" class="text-danger"> {{ errors.total[0] }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label>description</label>
                                            <input v-model="detail.description" type="text" name="amount"
                                            class="form-control">
                                            
                                            <span v-if="errors.description" class="text-danger"> {{ errors.description[0] }}</span>
                                        </div>
                                        <div class="button-create">
                                            <button class="btn btn-primary">Create</button>
                                            <button class="btn btn-success" @click="listDetail(tour)">
                                                Danh sách
                                            </button>
                                            <button class="btn btn-success" @click="createImage(tour)">
                                                Thêm ảnh
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Program -->
        <div class="modal fade" id="UpdateProgram" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="DetailLable">Thay đổi chương trình</h5>
                        <button type="button" class="close" @click="getAllprogram(tour)" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="api-calling">
                            <div v-if="successUpdateProgram !== ''" class="alert alert-success"> {{successUpdateProgram}}</div>
                            <div class="create-form">
                                <div class="create-form">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input v-model="program.title" type="text" name="title"
                                        class="form-control">
                                        <span v-if="errors.title" class="text-danger"> {{ errors.title[0] }} </span>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày thứ</label>
                                        <input v-model="program.day" type="text" name="day"
                                        class="form-control">
                                        <span v-if="errors.day" class="text-danger"> {{ errors.day[0] }} </span>
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết</label>
                                        <textarea v-model="program.detail" name="detail"
                                        class="form-control"></textarea>
                                        <span v-if="errors.detail" class="text-danger"> {{ errors.detail[0] }} </span>
                                    </div>
                                    <div class="button-create">
                                        <button @click="updateProgram()" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Detail -->
        <div class="modal fade" id="UpdateDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="DetailLable">Sửa</h5>
                        <button type="button" @click="successUpdateDetail=''" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="api-calling">
                            <div v-if="successUpdateDetail !== ''" class="alert alert-success"> {{successUpdateDetail}}</div>
                            <div class="create-form">
                                <form @submit="updateDetail()" enctype="multipart/form-data">
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
                                        
                                        <div  class="text-danger" v-if="errorFileMessage.length > 0">
                                            <span>{{ errorFileMessage }}</span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Total</label>
                                        <input v-model="detail.total" type="text" name="amount"
                                        class="form-control">
                                        
                                        <span v-if="errors.total" class="text-danger"> {{ errors.total[0] }}</span>
                                    </div>
                                    <div class="button-create">
                                        <button class="btn btn-primary">Update</button>
                                    </div>
                                </form>
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
                    id: '',
                    tour_name: '',
                    vehicle: '',
                    departure: '',
                    day_night: '',
                    price: '',
                    note: '',
                    img: '',
                    place_id: '',
                    tour_hot:'',
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
                    image: '',
                    day_start: '',
                    day_end: '',
                    amount: '',
                    total: '',
                    account: '',
                    description: ''
                },
                admin_current: {
                    user_name: '',
                },
                errorFileMessage: '',
                isCreateDetail: false,
                list_Detail: [],
                successUpdateDetail: '',
                successUpdateProgram: '',
                successUpdateTour: '',
                successCreateTour: '',
                successCreateProgram: '',
                successCreateDetail: '',
                adminCurrent: '',
                jwt: '',
                myCookie: '',
                isCreateImage: false,
                imageDetails: [],
                image: {
                    url: '',
                    tour_id: ''
                },
                place: {
                    place: ''
                },
                listPlaces: [],
                selected: ''
            }
        },
        created() {
            this.getAllTours();
            this.getAdminCurrent();
            this.setJwt();
            this.getAllPlace();
        },
        methods: {
            handleClickNewTour() {
                this.successCreateTour = '';
                this.tour = {
                    tour_name: '',
                    vehicle: '',
                    departure: '',
                    day_night: '',
                    price: '',
                    note: '',
                }
            },
            getAllPlace() {
                axios.get('/api/space')
                .then(response => {
                    this.listPlaces = response.data;
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name
                })
            }
            ,
            onImageChangeTour(e){
                console.log(e.target.files[0]);
                this.tour.img = e.target.files[0];
            },
            createTour(tour) {
                console.log(this.jwt);
                console.log(this.adminCurrent);

                event.preventDefault();
                let currentObj = this;
 
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('tour_name', this.tour.tour_name);
                formData.append('vehicle', this.tour.vehicle);
                formData.append('departure', this.tour.departure);
                formData.append('day_night', this.tour.day_night);
                formData.append('price', this.tour.price);
                formData.append('note', this.tour.note);
                formData.append('img', this.tour.img);
                formData.append('place_id', this.tour.place_id);
                formData.append('jwt', this.jwt);
                formData.append('admin', this.admin);

                axios.post('/api/tour', formData, config)
                    .then(response => {
                        this.tour.tour_name = null;
                        this.tour.vehicle = null;
                        this.tour.departune = null;
                        this.tour.day_night = null;
                        this.tour.price = null;
                        this.tour.note = null;
                        this.successCreateTour = 'Tạo Tour thành công';
                        this.getAllTours();
                    })
                    .catch(error => {
                        this.success = ''
                        if (error.response.status == 422) {
                            this.errors = error.response.data.errors
                        }
                    })
            },
            getAllTours() {
                this.successUpdateTour = '';
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
                    this.errors = error.response.data.errors.name
				})
            },
            sendTourUpdate(tour) {
                this.tour = tour
            },
            updateTour() {
                axios.put('/api/tour/' + this.tour.id, {tour_name: this.tour.tour_name, vehicle: this.tour.vehicle, departune: this.tour.departune, day_night: this.tour.day_night,
                    price: this.tour.price, note: this.tour.note, place_id: this.tour.place_id, jwt: this.jwt, admin: this.adminCurrent})
				.then(response => {
                    this.successUpdateTour = 'Cập nhập Tour thành công'
				})
				.catch(error => {
                    this.success = ''
                    this.errors = error.response.data.errors.name
				})
            },
            sendTourProgram(tour) {
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
                    this.successCreateProgram = 'Tạo program thành công'
                })
                .catch(error => {
                    this.successCreateProgram = ''
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }
                })
            },
            deleteProgram(program, index) {
                axios.delete('/api/program/' + program.id)
                .then(response => {
                    console.log(response.data.result)
                    this.list_Program.splice(index, 1)
                })
                .catch(error => {
                    this.success = ''
                    this.errors = error.response.data.errors.name
				})
            },
            getAllprogram(tour) {
                this.successCreateProgram = '';
                this.successUpdateProgram = '';
                this.tour = tour;
                this.program = {
                    tour_id: '',
                    title: '',
                    day: '',
                    detail: '',
                }
                axios.get('/api/program/' + this.tour.id)
                .then(response => {
                   this.list_Program = response.data
                })
                .catch(error => {
                   this.errors = error.response.data.errors.name
                })
            },
            listProgram(tour) {
                this.iscreateProgram = false
                this.getAllprogram(tour)
            },
            sendProgramUpdate(program) {
                this.program = program;
            },
            updateProgram() {
                axios.put('/api/program/' + this.program.id, {title: this.program.title, day: this.program.day, detail: this.program.detail})
				.then(response => {
                    this.successUpdateProgram = 'Cập nhập thành công'
				})
				.catch(error => {
                    this.success = ''
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }
				})
            },
            sendTourDetal(tour) {
                this.tour = tour
                this.getAllDetail(tour)
                this.isCreateDetail = false
            },
            listDetail(tour) {
                this.isCreateImage = false;
                this.isCreateDetail = false;
                this.getAllDetail(tour);
            },
            getAllDetail(tour) {
                this.tour = tour
                this.successCreateDetail = '';
                this.detail= {
                    image: '',
                    day_start: '',
                    day_end: '',
                    amount: '',
                    account: '',
                }
                axios.get('/api/detail/' + this.tour.id)
                .then(response => {
                    this.list_Detail = response.data
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name
                })
            },
            createImage(tour) {
                console.log('aaa');
                this.getImageDetail(tour);
                this.isCreateImage = true;
            },
            getImageDetail(tour) {
                axios.get('/api/image/' + this.tour.id)
                .then(response => {
                    this.imageDetails = response.data
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name
                })
            },
            CreateDetailImage(tour) {
                this.errorFileMessage ='';
                event.preventDefault();
                let currentObj = this;
 
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('image', this.detail.image);
                formData.append('tour_id', this.tour.id);

                axios.post('/api/image', formData, config)
                .then(response => {
                    this.successCreateDetail = 'Tạo Chi Tiết Thành Công'
                })
               .catch(error => {
                    this.success = ''
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }

                    this.errorFileMessage = 'Hình ảnh trống ';
                })
            },
            CreateDetail(tour) {
                this.errorFileMessage ='';
                event.preventDefault();
                let currentObj = this;
 
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }

                let formData = new FormData();
                formData.append('tour_id', this.tour.id);
                formData.append('day_start', this.detail.day_start);
                formData.append('day_end', this.detail.day_end);
                formData.append('total', this.detail.total);
                formData.append('account', this.admin_current.user_name);
                formData.append('description', this.detail.description);

                axios.post('/api/detail', formData, config)
                .then(response => {
                    this.detail.day_start = null;
                    this.detail.day_end = null;
                    this.detail.amount = null;
                    this.successCreateDetail = 'Tạo Chi Tiết Thành Công'
                })
               .catch(error => {
                    this.success = ''
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }

                    this.errorFileMessage = 'Hình ảnh trống ';
                })
            },
            sendDetailUpdate(detailID) {
                console.log(detailID)
                this.detail = detailID
            },
            onImageChange(e){
                console.log(e.target.files[0]);
                this.detail.image = e.target.files[0];
            },
            deleteDetail(detail, index) {
                axios.delete('/api/detail/' + detail.id)
                .then(response => {
                    console.log(response.data.result)
                    this.list_Detail.splice(index, 1)
                })
                .catch(error => {
                    this.success = ''
                    this.errors = error.response.data.errors.name
				})
            },
            updateDetail() {
                event.preventDefault();
                let currentObj = this;
                console.log(this.detail.id)
                let formData = new FormData();
                formData.append('_method', 'PUT');
                formData.append('image', this.detail.image);
                formData.append('tour_id', this.tour.id);
                formData.append('day_start', this.detail.day_start);
                formData.append('day_end', this.detail.day_end);
                formData.append('total', this.detail.total);

                axios.post('/api/detail/' + this.detail.id, formData)
                .then(response => {
                    this.successUpdateDetail = 'Cập nhập thành công '
                })
               .catch(error => {
                    this.success = ''
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }
                })
            },
            setJwt() {
                console.log('test jwt');
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
            setTourHot(tour) {
                if ( tour.tour_hot != null) {
                    tour.tour_hot = !tour.tour_hot;
                } else {
                    tour.tour_hot  = true;
                }
                axios.put('/api/setTourHot/' + tour.id ,{tour_hot: tour.tour_hot})
				.then(response => {
                    console.log(this.tour.tour_hot);
				})
				.catch(error => {
                    this.success = ''
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }
				})
            },
            goReserve(tour) {
                this.$router.push({ path: '/Admin/Reserve/' + tour.id});
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
