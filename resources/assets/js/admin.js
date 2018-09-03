require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    components: {},
    data() {
        return {
            loading: false
        }
    },
    methods: {
        isLoading: function () {
            return this.loading
        },
        updatePublish: function (classificationId) {
            console.log(classificationId)

            if (this.isLoading()) {
                return
            }

            this.loading = true

            axios.put('/admin/classifications/' + classificationId + '/update_publish')
                .then((response) => {
                    console.log(response.data);
                    this.loading = false

                    if (! response.data.error) {
                        window.location.reload(true)
                    }
                })
        },
    }
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