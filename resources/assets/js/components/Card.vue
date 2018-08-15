<script>
    export default {
        name: 'card',
        props: {
            title: {
                type: String,
                default: null,
                required: true
            },
            content: {
                type: String,
                default: null,
                required: true
            },
            action: {
                type: String,
                default: null
            }
        },
        data: function () {
            return {}
        }
    }
</script>

<template>
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">
                {{ title }}
            </p>
        </header>
        <div class="card-content">
            <div class="content">
                {{ content }}
            </div>
        </div>
        <div class="card-footer" v-if="action">
            <router-link class="card-footer-item" :to="{ path: action }">
                <b-icon icon="link"></b-icon> <span>Acessar</span>
            </router-link>
        </div>
    </div>
</template>
