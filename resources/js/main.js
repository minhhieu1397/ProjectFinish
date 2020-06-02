/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';
import VueRouter from 'vue-router';
import BootstrapVue from 'bootstrap-vue';
import Swal from 'sweetalert2';

window.Swal = Swal;
Vue.use(VueRouter);
Vue.use(BootstrapVue);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            redirect: '/tour'
        },
        {
            path: '/tour',
            component: require('./components/tour.vue').default,
            children: [
                {
                    path: '/',
                    redirect: '/home'
                },
                {
                    path: '/home',
                    component: require('./components/tour/home.vue').default,
                },
                {
                    path: '/Detail/:id',
                    component: require('./components/tour/detail.vue').default
                },
                {
                    path: '/listTour',
                    component: require('./components/tour/listTour.vue').default
                },
                {
                    path: '/Reserve/:id',
                    component: require('./components/tour/reserve.vue').default
                },
                {
                    path: '/introduce',
                    component: require('./components/tour/introduce.vue').default
                },
                
            ]
        },
        {
            path: '/tourSearch/:search',
            component: require('./components/tourSearch.vue').default,
        },
        {
            path: '/register',
            component: require('./components/user/register.vue').default
        },
        {
            path: '/login',
            component: require('./components/user/login.vue').default
        }
    ],
})
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
