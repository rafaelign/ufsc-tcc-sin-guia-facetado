<script>
    import VueGoodshareFacebook from 'vue-goodshare/src/providers/Facebook'
    import VueGoodshareTwitter from 'vue-goodshare/src/providers/Twitter'
    import VueGoodshareLinkedin from 'vue-goodshare/src/providers/LinkedIn'

    export default {
        components: {
            VueGoodshareFacebook,
            VueGoodshareTwitter,
            VueGoodshareLinkedin
        },
        data () {
            return {}
        },
        props: {
            label: {
                type: String,
                default: null
            }
        }
    }
</script>

<template>
    <ul class="socialbar">
        <li v-if="label" class="menu-label">
            {{ label }}
        </li>
        <li>
            <vue-goodshare-facebook :page_url="$root.url" has_icon></vue-goodshare-facebook>
            <vue-goodshare-twitter :page_url="$root.url" has_icon></vue-goodshare-twitter>
            <vue-goodshare-linkedin :page_url="$root.url" has_icon></vue-goodshare-linkedin>
        </li>
    </ul>
</template>