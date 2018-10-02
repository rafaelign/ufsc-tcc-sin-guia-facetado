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
        attemptDeleteUser: function () {
            let id = document.querySelector('.modal-confirm').dataset.id;

            axios.delete('/admin/users/' + id)
                .then(() => {
                    window.location.reload(true)
                })
        },
        attemptDeleteEntity: function () {
            let id = document.querySelector('.modal-confirm').dataset.id;

            axios.delete('/admin/entities/' + id)
                .then(() => {
                    window.location.reload(true)
                })
        }
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

(function () {
    let deleteButton = document.querySelector('.delete-button');
    let modal = deleteButton !== null ? document.querySelector('#'+deleteButton.dataset.target) : null;
    let modalConfirm = document.querySelector('.modal-confirm');
    let modalCancel = document.querySelector('.modal-cancel');
    let modalClose = document.querySelector('.modal-cancel-x');

    if (deleteButton && modal) {
        deleteButton.addEventListener('click', function () {
            modalConfirm.dataset.id = deleteButton.dataset.id;
            modal.classList.toggle('is-active');
        });
    }

    if (modalCancel && modalClose) {
        modalCancel.addEventListener('click', function () {
            modal.classList.toggle('is-active');
            modalConfirm.dataset.id = '';
        });

        modalClose.addEventListener('click', function () {
            modal.classList.toggle('is-active');
            modalConfirm.dataset.id = '';
        });
    }
})();