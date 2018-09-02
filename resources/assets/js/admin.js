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
    let menu = document.querySelector('#'+burger.dataset.target);
    burger.addEventListener('click', function() {
        burger.classList.toggle('is-active');
        menu.classList.toggle('is-active');
    });
})();