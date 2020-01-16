/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import { Form, HasError, AlertError } from 'vform';

window.Form = Form;

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

import Vue from 'vue';
import VueRouter from 'vue-router';
import BootstrapVue from 'bootstrap-vue';


Vue.use(VueRouter)
Vue.use(BootstrapVue);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/ListAdmin',
            component: require('./components/admin/ListAdmin.vue').default
        },
        {
            path: '/Comment',
            component: require('./components/admin/Comment.vue').default
        },
        {
            path: '/Detail',
            component: require('./components/admin/Detail.vue').default
        },
        {
            path: '/PlaceTour',
            component: require('./components/admin/PlaceTour.vue').default
        },
        {
            path: '/Program',
            component: require('./components/admin/Program.vue').default
        },
        {
            path: '/Reserve',
            component: require('./components/admin/Reserve.vue').default
        },
        {
            path: '/Tour',
            component: require('./components/admin/Tour.vue').default
        },
    ],
})
    /**
     * The following block of code may be used to automatically register your
     * Vue components. It will recursively scan this directory for the Vue
     * components and automatically register them with their "basename".
     *
     * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
     */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});