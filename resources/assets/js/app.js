require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import VueMarkdown from 'vue-markdown'
import VueLoading from 'vue-loading-overlay'
import Sidebar from './components/Sidebar'
import Buefy from 'buefy'

import { routes } from './utils/routes';

Vue.use(Vuex);
Vue.use(VueRouter);
Vue.use(Buefy);
Vue.use(VueMarkdown);
Vue.use(VueLoading);

const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    el: '#app',
    router,
    components: {
        Sidebar,
        Loading: VueLoading
    },
    data() {
        return {
            isLoading: false
        }
    },
    methods: {
        showLoading () {
            this.isLoading = true
        },
        hideLoading () {
            this.isLoading = false
        }
    }
});
