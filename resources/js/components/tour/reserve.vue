<template>
    <div class="row">
        <div v-if="!success" class="col-md-2 offset-md-4">
            <div class="create-form">
                <div class="form-group">
                    <label>Tour: {{tour.tour_name}}</label>
                </div>
                <div class="form-group">
                    <label>Trẻ em dưới 10 tuổi</label>
                    <input v-model="reserve.children" type="number" name="user_name"
                    class="form-control">
                    <!-- <span v-if="errors.departure" class="text-danger"> {{ errors.departure[0] }}</span> -->
                </div>
                <div class="form-group">
                    <label>Người lớn</label>
                    <input v-model="reserve.adults" type="text" name="user_name"
                    class="form-control">
                    
                    <!-- <span v-if="errors.day_night" class="text-danger"> {{ errors.day_night[0] }}</span> -->
                </div>
                <div class="form-group">
                    <label>Số Điện Thoại</label>
                    <input v-model="reserve.phone" type="text" name="user_name"
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
        <div v-else class="col-md-2 offset-md-4">
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
                   children: '',
                   adults: '',
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
            this.id = this.$route.params.id;
            this.showTour();
        },
        methods: {
            CreateReserve(reserve) {
                var today = new Date();
                axios.post('/api/reserve', {tour_id: this.id, booking_date: today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear(), children: this.reserve.children, 
                adults: this.reserve.adults, phone: this.reserve.phone, note: this.reserve.note })
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
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
