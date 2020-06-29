<template>
    <div class="row mb-5">
        <div v-if="!success" class="col-md-3 offset-md-5">
            <div class="create-form">
                <div class="form-group">
                    <label>Tour: {{tour.tour_name}}</label>
                </div>
                <div class="form-group">
                    <label>Số lượng người</label>
                    <input v-model="reserve.people" type="number" name="user_name"
                    class="form-control">
                    <span v-if="errors.people" class="text-danger"> {{ errors.people[0] }}</span>
                </div>
                <div class="form-group">
                    <label>Số Điện Thoại</label>
                    <input v-model="reserve.phone" type="text" name="user_name"
                    class="form-control">
                    <span v-if="errors.phone" class="text-danger"> {{ errors.phone[0] }}</span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input v-model="reserve.email" type="text" name="user_name"
                    class="form-control">
                    <span v-if="errors.email" class="text-danger"> {{ errors.email[0] }}</span>
                </div>
                <div class="form-group">
                    <label>Địa Chỉ</label>
                    <input v-model="reserve.address" type="text" name="user_name"
                    class="form-control">
                    <span v-if="errors.address" class="text-danger"> {{ errors.address[0] }}</span>
                </div>
                <div class="form-group">
                    <label>Ghi chú</label>
                    <input v-model="reserve.note" type="text" name="user_name"
                    class="form-control">
                    <span v-if="errors.note" class="text-danger"> {{ errors.note[0] }}</span>
                </div>
                <div class="button-create">
                    <button @click="CreateReserve(reserve)" class="btn btn-primary">Gửi</button>
                </div>
            </div>
        </div>
        <div v-else class="col-md-4 offset-md-4 text-success h5">
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
                   tour_name: '',
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
                jwt: '',
                name_user: '',
                errors: [],
           }
        },
        created() {
            this.id = this.$route.params.id;
            this.getJwt();
            this.checkLogin();
            this.showTour();
        },
        methods: {
            CreateReserve(reserve) {
                this.errors = []
                var today = new Date();
                axios.post('/api/reserve/store', {tour_id: this.id, booking_date: today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear(), people: this.reserve.people, 
                    email: this.reserve.email, phone: this.reserve.phone, note: this.reserve.note, address: this.reserve.address, jwt: this.jwt, user: this.name_user })
                .then(response => {
                    this.successCreateProgram = 'Tạo program thành công';
                    this.success = true;
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
                var name = 'jwt' + "=";
                var ad = 'user' + "=";
                var ca = this.myCookie.split(';');
                for(var i = 0; i <ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0)==' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf('jwt') == 0) {
                        this.jwt=  c.substring(name.length,c.length);
                    } else if (c.indexOf('user') == 0) {
                        this.name_user = c.substring(ad.length,c.length);
                    }
                }
                if (this.jwt == '') {
                    document.cookie = 'tour=' +  this.id;
                    this.$router.push({ path: '/login/'});
                }
            },
            checkLogin() {

            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
