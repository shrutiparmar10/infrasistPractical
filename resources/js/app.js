/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//require('./bootstrap');

import Vue from 'vue';
import {Form} from 'vform';
import Multiselect from 'vue-multiselect';
import VueRouter from 'vue-router';

window.Vue = require('vue').default;
window.axios = require('axios');
window.Form = Form;
window.Multiselect = Multiselect;
Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
let routes =[{
    path:"/dashboard",
    name:"dashboard",
    component:require('./components/ExampleComponent.vue').default
},
{
    path:"/employee",
    name:"employee",
    component:require('./components/Employee.vue').default
},
{
    path:"/add-employee",
    name:"add-employee",
    component:require('./components/AddEmployee.vue').default
}
];

const router = new VueRouter({
    mode:"history",
    routes,
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    el: '#app',
});
