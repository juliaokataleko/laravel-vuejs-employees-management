require('./bootstrap');

import EmployeesIndex from './components/employees/Index'
import EmployeesCreate from './components/employees/Create'
import EmployeesEdit from './components/employees/Edit'

window.Vue = require('vue').default;

import Vue from 'vue';
import VueRouter from 'vue-router';

import VueMask from 'v-mask';

Vue.use(VueMask);


Vue.use(VueRouter);

Vue.component('employees-index', require('./components/employees/Index.vue').default);

const routes = [
    {
        path: "/employees",
        name: "EmployeesIndex",
        component: EmployeesIndex
    },
    {
        path: "/employees/create",
        name: "EmployeesCreate",
        component: EmployeesCreate
    },
    {
        path: "/employees/:id",
        name: "EmployeesEdit",
        component: EmployeesEdit
    }
];

const router = new VueRouter({
    mode: 'history',
    routes: routes
})

window.addEventListener('load', function () {

    const app = new Vue({
        el: '#app',
        router: router
    });

})
