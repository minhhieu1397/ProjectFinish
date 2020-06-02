<template>
    <div class="row">
        <div v-if="!success" class="col-md-2 offset-md-4">
            <div class="create-form">
                <div class="form-group">
                    <label>Tour: {{tour.tour_name}}</label>
                </div>
                <div class="form-group">
                    <label>Số lượng người</label>
                    <input v-model="reserve.people" type="number" name="user_name"
                    class="form-control">
                    <!-- <span v-if="errors.departure" class="text-danger"> {{ errors.departure[0] }}</span> -->
                </div>
                <div class="form-group">
                    <label>Số Điện Thoại</label>
                    <input v-model="reserve.phone" type="text" name="user_name"
                    class="form-control">
                    <!-- <span v-if="errors.price" class="text-danger"> {{ errors.price[0] }}</span> -->
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input v-model="reserve.email" type="text" name="user_name"
                    class="form-control">
                    <!-- <span v-if="errors.price" class="text-danger"> {{ errors.price[0] }}</span> -->
                </div>
                <div class="form-group">
                    <label>Địa Chỉ</label>
                    <input v-model="reserve.address" type="text" name="user_name"
                    class="form-control">
                    <!-- <span v-if="errors.price" class="text-danger"> {{ errors.price[0] }}</span> -->
                </div>
                <div class="form-group">
                    <label>Ghi chú</label>
                    <input v-model="reserve.note" type="text" name="user_name"
                    class="form-control">
                    <!-- <span v-if="errors.note" class="text-danger"> {{ errors.note[0] }}</span> -->
                </div>
                <div class="button-create">
                    <button @click="CreateReserve(reserve)" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
        <div v-else class="col-md-2 offset-md-4 text-success">
            Bạn đã đặt tour thành công, vui lòng đợi phản hồi
            <br>
            <br>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
           return {
               id: '',
               reserve: {
                   tour_id: '',
                   booking_date: '',
                   people: '',
                   email: '',
                   address: '',
                   phone: '',
                   note: ''
                },
               tour: {
                    id: '',
                    tour_name: '',
                    vehicle: '',
                    departune: '',
                    day_night: '',
                    price: '',
                    note: '',
                },
                tours: [],
                number_children: 0,
                success: false,
           }
        },
        created() {
            this.getJwt();
            this.id = this.$route.params.id;
            this.showTour();
        },
        methods: {
            CreateReserve(reserve) {
                var today = new Date();
                axios.post('/api/reserve', {tour_id: this.id, booking_date: today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear(), people: this.reserve.people, 
                email: this.reserve.email, phone: this.reserve.phone, note: this.reserve.note, address: this.reserve.address })
                .then(response => {
                    this.successCreateProgram = 'Tạo program thành công';
                    this.success = true;
                    console.log(this.success);
                })
                .catch(error => {
                    this.successCreateProgram = ''
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }
                })
            },
            showTour() {
                axios.get('/api/tour/' + this.id)
                .then(response => {
                    this.tours = response.data;
                    this.tour = this.tours[0];
                    console.log(this.tours[0].tour_name);
                })
                .catch(error => {
                   this.errors = error.response.data.errors.name
                })
            },
            getJwt() {
                this.myCookie = document.cookie;
                var name = 'Jwt' + "=";
                var ad = 'name_user' + "=";
                var ca = this.myCookie.split(';');
                for(var i = 0; i <ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0)==' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf('jwt') == 0) {
                        this.jwt=  c.substring(name.length,c.length);
                        console.log(this.jwt);
                    } else if (c.indexOf('user') == 0) {
                        this.name_user = c.substring(ad.length,c.length);
                        console.log(this.name_user);
                        console.log('aa');
                    }
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
