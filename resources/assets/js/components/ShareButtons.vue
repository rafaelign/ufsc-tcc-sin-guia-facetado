<script>
    import VueGoodshareFacebook from 'vue-goodshare/src/providers/Facebook'
    import VueGoodshareGoogleplus from 'vue-goodshare/src/providers/GooglePlus'
    import VueGoodshareTwitter from 'vue-goodshare/src/providers/Twitter'
    import VueGoodshareLinkedin from 'vue-goodshare/src/providers/LinkedIn'

    export default {
        components: {
            VueGoodshareFacebook,
            VueGoodshareGoogleplus,
            VueGoodshareTwitter,
            VueGoodshareLinkedin
        },
        data () {
            return {
                url: 'https://tcc-ufsc-guia-facetado.herokuapp.com/',
            }
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
            <vue-goodshare-facebook :page_url="url" has_icon></vue-goodshare-facebook>
            <vue-goodshare-googleplus :page_url="url" has_icon></vue-goodshare-googleplus>
            <vue-goodshare-twitter :page_url="url" has_icon></vue-goodshare-twitter>
            <vue-goodshare-linkedin :page_url="url" has_icon></vue-goodshare-linkedin>
        </li>
    </ul>
</template>