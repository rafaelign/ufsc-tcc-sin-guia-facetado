<script>
    export default {
        data () {
            return {}
        },
        props: {
            items: {
                type: Array,
                default: function () {
                    return []
                }
            }
        }
    }
</script>

<template>
    <nav class="breadcrumb has-arrow-separator is-right" aria-label="breadcrumbs">
        <ul>
            <li v-for="item in items" :class="item.active ? 'is-active' : ''">
                <router-link :to="{ path: item.url }" v-if="item.destination === undefined">{{ item.title }}</router-link>
                <router-link :to="item.destination" v-else>{{ item.title }}</router-link>
            </li>
        </ul>
    </nav>
</template>