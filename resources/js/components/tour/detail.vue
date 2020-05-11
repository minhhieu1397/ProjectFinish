<template>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h1 class="text-center">Chi tiết tour</h1>
            {{$route.params.id}}

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
                program: {
                    id :'',
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
                   this.detail = response.data;
                    console.log(this.detail)
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
                })
                .catch(error => {
                   this.errors = error.response.data.errors.name
                })
            },
            getTour() {
                axios.get('/api/tour/' + this.id)
                .then(response => {
                    this.list_program = response.data;
                    console.log(this.list_program);
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
