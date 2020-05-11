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
                }
           }
        },
        created() {
            this.id = this.$route.params.id;
            console.log(this.id);
            console.log('aaa');
            console.log(this.$route);  
      console.log(this.$route.params);
      console.log(this.$route.params.id);
        },
        methods: {
           
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
