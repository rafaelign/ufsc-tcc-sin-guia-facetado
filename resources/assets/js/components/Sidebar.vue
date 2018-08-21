<script>
    import ClipLoader from 'vue-spinner/src/ClipLoader'
    import VueGoodshareFacebook from 'vue-goodshare/src/providers/Facebook'
    import VueGoodshareGoogleplus from 'vue-goodshare/src/providers/GooglePlus'
    import VueGoodshareTwitter from 'vue-goodshare/src/providers/Twitter'
    import VueGoodshareLinkedin from 'vue-goodshare/src/providers/LinkedIn'

    export default {
        components: {
            ClipLoader,
            VueGoodshareFacebook,
            VueGoodshareGoogleplus,
            VueGoodshareTwitter,
            VueGoodshareLinkedin
        },
        data: function () {
            return {
                entities: [],
                errors: [],
                isLoadingMenu: false
            }
        },
        created () {
            this.isLoadingMenu = true;

            axios.get('/api/collections')
                .then((response) => {
                    this.entities = response.data
                    this.isLoadingMenu = false
                })
                .catch((error) => this.errors = error.response.data.errors);
        }
    }
</script>

<template>
    <aside class="column is-2 is-narrow-mobile is-fullheight section is-hidden-mobile">
        <figure class="image has-text-centered">
            <img src="/images/logo.png" alt="Logo">
        </figure>
        <p class="menu-label is-hidden-touch">
            Menu
        </p>
        <ul class="menu-list">
            <li>
                <router-link to="/app">
                    Sobre este guia
                </router-link>
            </li>
            <li v-for="item,key in entities">
                <router-link :to="{ path: '/app/colecoes/' + item.slug }">
                    {{ item.title }}
                </router-link>

                <ul>
                    <li>
                        <router-link :to="{ path: '/app/colecoes/' + item.slug + '/entidades' }">
                            <b-icon icon="view-list" size="is-small"></b-icon> <span>Técnicas Mapeadas</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{ path: '/app/colecoes/' + item.slug + '/facetas' }">
                            <b-icon icon="information" size="is-small"></b-icon> <span>Facetas de Classificação</span>
                        </router-link>
                    </li>
                </ul>
            </li>
        </ul>
        <clip-loader v-if="isLoadingMenu" class="is-centered"></clip-loader>

        <nav class="navbar is-fixed-bottom">
            <div class="navbar-item">
                <ul>
                    <p class="menu-label has-text-centered">
                        Compartilhe
                    </p>
                    <li>
                        <vue-goodshare-facebook
                                page_url="https://github.com"
                                title_social="Facebook"
                                has_counter
                                has_icon
                        ></vue-goodshare-facebook>
                    </li>
                    <li>
                        <vue-goodshare-googleplus
                                page_url="https://github.com"
                                title_social="Google"
                                has_counter
                                has_icon
                        ></vue-goodshare-googleplus>
                    </li>
                    <li>
                        <vue-goodshare-twitter
                                page_url="https://github.com"
                                title_social="Twitter"
                                has_counter
                                has_icon
                        ></vue-goodshare-twitter>
                    </li>
                    <li>
                        <vue-goodshare-linkedin
                                page_url="https://github.com"
                                title_social="Linkedin"
                                has_counter
                                has_icon
                        ></vue-goodshare-linkedin>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>
</template>