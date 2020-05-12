<template>
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <h1 class="text-center">Chi tiết tour</h1>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 offset-md-2 detail-tour">
                    <div class="inline-block" >
                        <img class="d-inline" height="350px" width="400px" src="/img/dalat.jpg">
                    </div>
                </div>
                <div class="col-md-7 detail-tour">
                        <div>
                            <strong>Tour:</strong> {{ this.tour.tour_name }}
                        </div>
                        <div>
                            <strong>Phương tiện di chuyển:</strong> {{ tour.vehicle }}
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
                            <strong>Số lượng:</strong> {{ detail.amount }}/{{ detail.account }}
                        </div>
                        <div>
                            <strong>Mô tả:</strong> {{ detail.description }}
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-md-8 offset-md-2">
            <div v-for="(program) in list_program" :key="program.id">
                <strong> Ngày thứ {{ program.day }} {{program.title}}: </strong> {{program.detail}}
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
                    amount: '',
                    account: '',
                    description: '',
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
                tours: []
           }
        },
        created() {
            this.id = this.$route.params.id;
            this.getDetail();
            this.getListProgram();
            this.getTour();
        },
        methods: {
           getDetail() {
                axios.get('/api/detail/' + this.id)
                .then(response => {
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
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
