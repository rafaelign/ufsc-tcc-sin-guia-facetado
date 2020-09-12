require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue'
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import VueMarkdown from 'vue-markdown'
import VueLoading from 'vue-loading-overlay'
import Sidebar from './components/Sidebar'
import Buefy from 'buefy'
import Lightbox from 'vue-pure-lightbox'
import {APP_URL} from './utils/config'

import { routes } from './utils/routes';
import 'buefy/dist/buefy.css'

Vue.use(Vuex);
Vue.use(VueRouter);
Vue.use(Buefy);
Vue.use(VueMarkdown);
Vue.use(VueLoading);
Vue.use(Lightbox);

const router = new VueRouter({
    mode: 'history',
    routes
});

const store = new Vuex.Store({
    state: {
        filters: {
            mode: 'restrict',
            values: []
        },
        defaultValues: [],
        isLoading: false
    },
    mutations: {
        updateMode (state, mode) {
            state.filters.mode = mode
        },
        addFilter (state, filter) {
            state.filters.values.forEach((item, index) => {
                if (item.name === filter.name) {
                    state.filters.values.splice(index, 1)
                }
            })

            state.filters.values.push(filter)
        },
        addDefaultValue (state, filter) {
            state.defaultValues.forEach((item, index) => {
                if (item.name === filter.name) {
                    state.defaultValues.splice(index, 1)
                }
            })

            state.defaultValues.push(filter)
        },
        resetFilters (state) {
            state.filters = {
                mode: 'restrict',
                values: []
            }
        },
        loading (state) {
            state.isLoading = true
        },
        loaded (state) {
            state.isLoading = false
        }
    },
    getters: {
        getFilterValueByName: (state) => (name) => {
            let filter = state.filters.values.filter((item) => {
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
        },
        getFiltersValues: (state) => {
            return state.filters.values || []
        },
        getMode: (state) => {
            return state.filters.mode
        },
        isLoading: (state) => {
            return state.isLoading
        },
        isLoaded: (state) => {
            return ! state.isLoading
        },
        getUrl: () => {
            return APP_URL
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
    computed: {
        url () {
            return this.$store.getters.getUrl
        }
    },
    data() {
        return {}
    }
});
