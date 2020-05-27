<template>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Comment</h3>
                </div>
            </div>
            <div>
                <div v-if="error" class="text-center text-danger">
                        {{error}}
                </div>
                <table class="table table-condensed" >
                    <thead>
                        <tr class="table__title">
                            <th>Tour</th>
                            <th>Ngày đặt</th>
                            <th>Số lượng</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                            <th>Điện thoại</th>
                            <th>Ghi chú</th>
                            <th>Thanh toán</th>
                        </tr>
                    </thead>
                    <tbody v-for="(reserve) in listReserves" :key="reserve.id">
                        <tr class="table__content">
                            <td>{{tour.tour_name}}</td>
                            <td>{{reserve.booking_date}}</td>
                            <td>{{reserve.people}}</td>
                            <td>{{reserve.email}}</td>
                            <td>{{reserve.address}}</td>
                            <td>
                                <div v-if="reserve.status">
                                    <a class="nav-link">
                                        <i class="fas fa-check nav-icon text-success"></i>
                                    </a>
                                </div>
                                <div v-else>
                                    <button type="button" class="btn btn-primary btn-sm mt-0" @click="setStatus(reserve)">Chấp nhận</button>
                                </div>
                            </td>
                            <td>{{reserve.phone}}</td>
                            <td>{{reserve.note}}</td>
                            <td>{{reserve.pay}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                reserve: {
                    tour_id: '',
                    booking_date:'',
                    people: '',
                    status: '',
                    email: '',
                    address: '',
                    phone: '',
                    note: '',
                    pay: '',
                },
                detail: {
                    image: '',
                    day_start: '',
                    day_end: '',
                    amount: '',
                    account: '',
                    description: ''
                },
                listDetail: [],
                tourId: '',
                listReserves: [],
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
                tours: [],
                sold_out: 1,
                error: '',
            }
        },
        created() {
            this.tourId = this.$route.params.tour_id;
            console.log(this.tourId);
            this.getReserve();
            this.getTour();
            this.getDetail();
        },
        methods: {
            getReserve() {
               axios.get('/api/getAllReserve/' + this.tourId)
                .then(response => {
                    this.listReserves = response.data;
                })
                .catch(error => {
                   this.errors = error.response.data.errors.name
                })
            },
            getTour() {
            axios.get('/api/tour/' + this.tourId)
                .then(response => {
                    this.tours = response.data;
                    this.tour = this.tours[0];
                    console.log(this.tours[0]);
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name;
                })
            },
            setStatus(reserve) {
                this.checkSoldOut(reserve);
                console.log(this.sold_out);
                if(!this.sold_out) {
                    reserve.status = true;
                    axios.put('/api/setStatus/' + reserve.id)
                    .then(response => {
                        this.getReserve();
                        this.getTour();
                        this.setAmount(reserve);
                        this.error = '';
                        this.getDetail();
                    })
                    .catch(error => {
                        this.success = ''
                        if (error.response.status == 422) {
                            this.errors = error.response.data.errors
                        }
                    })
                } else {
                    this.error = 'Chuyến đi đã đủ chỗ';
                }
            },
            setAmount(reserve) {
                axios.put('/api/setAmount/' + this.tourId, {people: reserve.people})
                .then(response => {
                    
                })
                .catch(error => {
                    this.success = ''
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }
                })
            },
            getDetail() {
                axios.get('/api/detail/' + this.tourId)
                .then(response => {
                    this.listDetail = response.data;
                    this.detail = this.listDetail[0];
                    console.log(this.detail);
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name
                })
            },
            checkSoldOut(reserve) {
                var add = reserve.people + this.detail.amount;
                console.log(add);
                if(add > this.detail.total) {
                    this.sold_out = 1;
                } else {
                    this.sold_out = 0;
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
