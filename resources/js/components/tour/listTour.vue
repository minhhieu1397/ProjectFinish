<template>
    <div class="row">
        <div class="col-md-12">
            <h2 class="headeing text-center">Tour Du Lịch</h2>
        </div>
        <div class="col-md-12 mt-5">
            <div v-for="(tour) in list_Tours" :key="tour.id">
                <hr class="hrhome">
                    <div>
                        <div class="pl-5 ml-5 d-inline-block">
                            <div class="h3 pl-5 ml-5">
                                Du Lịch {{tour.tour_name}}
                            </div>
                                <img class="h3 pl-5 ml-5" height="200px" width="250px"  v-bind:src="'/image/tour/'+tour.img">
                        </div>
                        <div class="d-inline-block ml-3 detai-highlight">
                            <div class="">
                                <br>
                                <br>
                                <strong>Phương tiện:</strong> {{tour.vehicle}}
                            </div>
                            <div>
                                <strong>Ngày khởi hành:</strong> {{tour.departure}}
                            </div>
                            <div>
                                <strong>Thời gian:</strong> {{tour.day_night}}
                            </div>
                            <div>
                                <strong>Giá:</strong> {{tour.price}}
                            </div>
                            <div>
                                {{tour.note}}
                            </div>
                            <div>
                                 <button @click="viewDetail(tour)" class="btn btn-success">
                                    Xem chi tiết >>
                                </button>
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
               list_Tours: [],
               tour: {
                    id: '',
                    tour_name: '',
                    vehicle: '',
                    departure: '',
                    day_night: '',
                    price: '',
                    note: '',
               },
           }
        },
        created() {
            this.getJwt();
            this.getAllTours();
        },
        methods: {
            getAllTours() {
                axios.get('/api/tour')
                .then(response => {
                   this.list_Tours = response.data
                })
                .catch(error => {
                   this.errors = error.response.data.errors.name
                })
            },
            viewDetail(tour) {
                console.log(tour.id);
                this.$router.push({ path: '/Detail/' + tour.id})
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
