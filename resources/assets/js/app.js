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

const store = new Vuex.Store({
    state: {
        filters: [],
        defaultValues: []
    },
    mutations: {
        addFilter (state, filter) {
            state.filters.forEach((item, index) => {
                if (item.name === filter.name) {
                    state.filters.splice(index, 1)
                }
            })

            state.filters.push(filter)
        },
        addDefaultValue (state, filter) {
            state.defaultValues.forEach((item, index) => {
                if (item.name === filter.name) {
                    state.defaultValues.splice(index, 1)
                }
            })

            state.defaultValues.push(filter)
        }
    },
    getters: {
        getFilterValueByName: (state) => (name) => {
            let filter = state.filters.filter((item) => {
                return item.name === name
            })

            if (filter.length) {
                return filter.shift().value
            }

            filter = state.defaultValues.filter((item) => {
                return item.name === name
            })

            return filter.length ? filter.shift().value : null
        },
        getFilters: (state) => {
            return state.filters || []
        }
    }
});

const app = new Vue({
    el: '#app',
    router,
    store,
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
