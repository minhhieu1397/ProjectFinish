<template>
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
        <div class="col-md-6 pl-0 pr-0">
            <h5 class=" the-travel ">Tìm kiếm khu du lịch: </h5>
            <div class="md-form active-pink active-pink-2 mb-3 mt-0 d-inline-block pl-5">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
            </div>
            <button type="button" class="btn btn-outline-success ml-3 mb-1 mt-0 ">Success</button>
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
                    <div class="carousel-item">
                        <img src="/img/pic2.jpg">
                        <div class="carousel-caption">
                            <h1 class="display-2">Sa</h1>
                            <h2 class="display-4">Du lịch mọi nơi</h2>
                        </div>
                    </div>
                    <div class="carousel-item">
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
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>



