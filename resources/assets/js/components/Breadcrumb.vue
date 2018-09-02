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
                <router-link :to="{ path: item.url }">{{ item.title }}</router-link>
            </li>
        </ul>
    </nav>
</template>