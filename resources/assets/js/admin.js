require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'
import { APP_URL } from './utils/config'

Vue.use(VueRouter);

const app = new Vue({
    el: '#app',
    components: {},
    data() {
        return {
            loading: false,
            tecnicastab: 'default',
            facetastab: 'default'
        }
    },
    methods: {
        isLoading: function () {
            return this.loading
        },
        publishClassification: function (classificationId) {
            if (this.isLoading()) {
                return
            }

            this.loading = true

            axios.put(APP_URL + '/admin/classifications/' + classificationId + '/update_publish', {published: 1}, {
                'Content-Type': 'application/json'
            }).then((response) => {
                this.loading = false

                if (! response.data.error) {
                    window.location.reload(true)
                }
            })
        },
        unpublishClassification: function (classificationId) {
            if (this.isLoading()) {
                return
            }

            this.loading = true

            axios.put(APP_URL + '/admin/classifications/' + classificationId + '/update_publish', {published: 0}, {
                'Content-Type': 'application/json'
            }).then((response) => {
                this.loading = false

                if (! response.data.error) {
                    window.location.reload(true)
                }
            })
        },
        publishEntity: function (classificationId, entityId) {
            if (this.isLoading()) {
                return
            }

            this.loading = true

            axios.put(APP_URL + '/admin/classifications/' + classificationId + '/entities/' + entityId + '/update_publish', {published: 1}, {
                'Content-Type': 'application/json'
            }).then((response) => {
                this.loading = false

                if (! response.data.error) {
                    window.location.reload(true)
                }
            })
        },
        unpublishEntity: function (classificationId, entityId) {
            if (this.isLoading()) {
                return
            }

            this.loading = true

            axios.put(APP_URL + '/admin/classifications/' + classificationId + '/entities/' + entityId + '/update_publish', {published: 0}, {
                'Content-Type': 'application/json'
            }).then((response) => {
                this.loading = false

                if (! response.data.error) {
                    window.location.reload(true)
                }
            })
        },
        attemptDeleteUser: function () {
            let id = document.querySelector('.modal-confirm').dataset.id;

            axios.delete(APP_URL + '/admin/users/' + id)
                .then(() => {
                    window.location.reload(true)
                })
        },
        attemptDeleteFacet: function () {
            let id = document.querySelector('.modal-confirm').dataset.id;
            let classification = document.querySelector('.modal-confirm').dataset.classification;

            axios.delete(APP_URL + '/admin/classifications/' + classification + '/facets/' + id)
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
    let deleteButton = document.getElementsByClassName("delete-button");
    let modal = deleteButton !== null ? document.querySelector('#'+deleteButton[0].dataset.target) : null;
    let modalConfirm = document.querySelector('.modal-confirm');
    let modalCancel = document.querySelector('.modal-cancel');
    let modalClose = document.querySelector('.modal-cancel-x');

    if (deleteButton && modal) {
        console.log(deleteButton);
        for (var i = 0; i < deleteButton.length; i++) {
            console.log(deleteButton[i]);
            deleteButton[i].addEventListener('click', function () {
                modalConfirm.dataset.id = this.dataset.id;
                modalConfirm.dataset.classification = this.dataset.classification;
                modal.classList.toggle('is-active');
            });
        }
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