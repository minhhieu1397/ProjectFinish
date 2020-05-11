<template>
    <div class="row">
        <div class="row">
            <div class="col-md-6 pl-0 pr-0">
                <span>
                    <img class="d-inline-block pl-2" src="/img/logo.jpg" width="200px" height="150px">
                    <div class="d-inline-block pl-5 text-home">
                        <h3 class="text-center the-travel ">Lên kế hoạch ngay!</h3>
                        <h5 class="text-center the-travel ">Du lịch tận hưởng, trải nghiệm du lịch giá rẻ chưa từng thấy</h5>
                    </div>
            </span>
            </div>
            <div class="col-md-4 offset-md-2 pl-0 pr-0">
                <h5 class=" the-travel ">Tìm kiếm khu du lịch: </h5>
                <div class="md-form active-pink active-pink-2 mb-3 mt-0 d-inline-block pl-5">
                    <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                </div>
                <button type="button" class="btn btn-outline-success ml-3 mb-1 mt-0 ">Success</button>
                <div class="icoin-home">
                    <ul class="list-unstyled">
                        <li class="d-inline-block pl-5">
                            <a href="#!"><i class="fa fa-facebook-official" style="font-size:40px"></i>
                            </a>
                        </li>
                        <li class="d-inline-block pl-3">
                            <a href="#!"><i class="fa fa-instagram " aria-hidden="true" style="font-size:40px"></i>
                            </a>
                        </li>
                        <li class="d-inline-block pl-3">
                            <a href="#!"><i class="fa fa-twitch" aria-hidden="true" style="font-size:40px"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <h5 class=" the-travel ">Theo dõi để nhận ưu đãi !!!</h5>
            </div>
            <div class="col-md-12 pl-0 pr-0">
                <div id="slides" class="carousel slide" data-ride="carousel">
                    <ul class="carousel-indicators">
                        <li data-target="#slides" data-slide-to="0" class="active">
                        </li>
                        <li data-target="#slides" data-slide-to="1" class="active"> 
                        </li>
                        <li data-target="#slides" data-slide-to="2" class="active"> 
                        </li>
                    </ul>
                    <div class="carousel-inner ">
                        <div class="carousel-item active car-home">
                            <img src="/img/dalat.jpg">
                            <div class="carousel-caption item-inner">
                                <h1 class="display-2">Đà Lạt</h1>
                                <h2 class="display-4">Du lịch Đà Lạt</h2>
                            </div>
                        </div>
                        <div class="carousel-item car-home ml-0 mr-0">
                            <img src="/img/pic2.jpg">
                            <div class="carousel-caption">
                                <h1 class="display-2">Sa</h1>
                                <h2 class="display-4">Du lịch mọi nơi</h2>
                            </div>
                        </div>
                        <div class="carousel-item car-home">
                            <img src="/img/pic3.jpg">
                            <div class="carousel-caption">
                                <h1 class="display-2">Du lịch</h1>
                                <h2 class="display-4">Du lịch mọi nơi</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 pl-0 pr-0">
            <hr class="mt-2">
            <div>
                <h3 class="text-center">Tour Nổi Bật</h3>
            </div>
            <div>
                <div v-for="(tourHighlight) in tourHighlights" :key="tourHighlight.id">
                    <hr class="hrhome">
                    <div>
                        <div class="pl-5 ml-5 d-inline-block">
                            <div class="h3 pl-5 ml-5">
                                Du Lịch {{tourHighlight.tour_name}}
                            </div>
                                <img class="h3 pl-5 ml-5" height="200px" width="250px" src="/img/pic3.jpg">
                        </div>
                        <div class="d-inline-block ml-3 detai-highlight">
                            <div class="">
                                <br>
                                <br>
                                <strong>Phương tiện:</strong> {{tourHighlight.vehicle}}
                            </div>
                            <div>
                                <strong>Ngày khởi hành:</strong> {{tourHighlight.departure}}
                            </div>
                            <div>
                                <strong>Thời gian:</strong> {{tourHighlight.day_night}}
                            </div>
                            <div>
                                <strong>Giá:</strong> {{tourHighlight.price}}
                            </div>
                            <div>
                                {{tourHighlight.note}}
                            </div>
                            <div>
                                 <button @click="viewDetail(tourHighlight)" class="btn btn-success">
                                    Xem chi tiết >>
                                </button>
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
                tourHighlight: {
                    id: '',
                    tour_name: '',
                    vehicle: '',
                    departune: '',
                    day_night: '',
                    price: '',
                    note: '',
                },
                isHighLight: true,
                tourHighlights: []
            }
        },
        created(){
            this.getAllTourHighlights();
        },
        methods: {
            getAllTourHighlights() {
                axios.get('/api/tourhighlight/')
                .then(response => {
                   this.tourHighlights = response.data
                })
                .catch(error => {
                   this.errors = error.response.data.errors.name
                })
            },
            viewDetail(tourHighlight) {
                console.log(tourHighlight.id);
                this.$router.push({ path: '/Detail/' + tourHighlight.id})
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>



