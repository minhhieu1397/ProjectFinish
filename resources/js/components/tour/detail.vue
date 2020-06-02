<template>
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center headeing">Chi tiết tour</h1>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4 offset-md-3 detail-tour">
                    <div>
                        <strong>Tour:</strong> {{ this.tour.tour_name }}
                    </div>
                    <div>
                        <strong> Phương tiện di chuyển:</strong> {{ tour.vehicle }}
                    </div>
                    <div>
                        <strong>Tour sẽ kéo dài trong:</strong> {{ tour.day_night }}
                    </div>
                    <div>
                        <strong>Phí trên người lớn:</strong> {{ tour.price }}
                    </div>
                    <div>
                        <strong> Ghi chú thêm:</strong> {{ tour.note }}
                    </div>
                    <div>
                        <strong>Ngày khởi hành:</strong> {{ detail.day_start }}
                    </div>
                    <div>
                        <strong>Ngày về:</strong> {{ detail.day_end }}
                    </div>
                    <div>
                        <strong>Số lượng:</strong> {{ detail.amount }}/{{ detail.total }}
                    </div>
                    <div>
                        <strong>Mô tả:</strong> {{ detail.description }}
                    </div>
                    <div>
                        <strong>Chi phí:</strong> {{ tour.price }} vnđ
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <button type="button" @click="reserve(tour)" class="btn btn-outline-success">Đặt Tour Ngay >></button>
                </div>
            </div>
            <hr>
        </div>
        <div class="col-md-12 center">
            <div class="center-img">
                <H3 class="headeing">Hình ảnh về {{tour.tour_name}}</H3>
                <div class="d-inline-block" v-for="(image) in images" :key="image.id">
                    <img class="pl-3" height="350px" width="400px" v-bind:src="'/image/detail/'+image.url">
                </div>
            </div>
        </div>
        <div class="col-md-8 offset-md-2 list-program">
            <hr>
            <h3 class="text-center headeing">Lịch trình</h3>
            <div class="TNR" v-for="(program) in list_program" :key="program.id">
                <strong> &emsp; &emsp; Ngày thứ {{ program.day }} {{program.title}}: </strong> {{program.detail}}
                <br><br>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
           return {
               id: '',
                detail: {
                    id :'',
                    tour_id: '',
                    day_start: '',
                    day_end: '',
                    amount: '',
                    account: '',
                    description: '',
                    total: ''
                },
                details: [],
                program: {
                    id :'',
                    title:'',
                    tour_id :'',
                    day : '',
                    detail :'',
                },
                list_program: [],
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
                image: {
                    id: '',
                    tour_id: '',
                    url: ''
                },
                images: [],
           }
        },
        created() {
            this.getJwt();
            this.id = this.$route.params.id;
            console.log(this.id)
            this.getDetail();
            this.getListProgram();
            this.getTour();
            this.getImageDetail();
            console.log(this.details);
            console.log(this.list_program);
            console.log(this.tours);
        },
        methods: {
            getDetail() {
                    axios.get('/api/detail/' + this.id)
                    .then(response => {
                        console.log('detail');
                    this.details = response.data;
                    this.detail  = this.details[0];
                    })
                    .catch(error => {
                    this.errors = error.response.data.errors.name
                    })
            },
            getListProgram() {
                axios.get('/api/program/' + this.id)
                .then(response => {
                    this.list_program = response.data;
                    console.log(this.list_program);
                    console.log('program');

                })
                .catch(error => {
                   this.errors = error.response.data.errors.name
                })
            },
            getTour() {
                axios.get('/api/tour/' + this.id)
                .then(response => {
                    this.tours = response.data;
                    this.tour = this.tours[0];
                    console.log(this.tours[0]);
                })
                .catch(error => {
                   this.errors = error.response.data.errors.name
                })
            },
            getImageDetail() {
                axios.get('/api/image/' + this.id)
                .then(response => {
                    this.images = response.data
                })
                .catch(error => {
                    this.errors = error.response.data.errors.name
                })
            },
            reserve(tour) {
                this.$router.push({ path: '/Reserve/' + tour.id});
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
