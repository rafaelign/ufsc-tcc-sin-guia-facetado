require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    components: {},
    data() {
        return {}
    },
    methods: {}
});

(function() {
    let burger = document.querySelector('.burger');
    let menu = burger !== null ? document.querySelector('#'+burger.dataset.target) : null;

    if (burger && menu) {
        burger.addEventListener('click', function() {
            burger.classList.toggle('is-active');
            menu.classList.toggle('is-active');
        });
    }
})();