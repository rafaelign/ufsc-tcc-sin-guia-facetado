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
                url: 'https://tcc-ufsc-guia-facetado.herokuapp.com/',
                entities: [],
                errors: [],
                isLoadingMenu: false
            }
        },
        created () {
            this.isLoadingMenu = true;

            axios.get('/api/classifications')
                .then((response) => {
                    this.entities = response.data
                    this.isLoadingMenu = false
                })
                .catch((error) => this.errors = error.response.data.errors)
        }
    }
</script>

<template>
    <aside class="column is-4 is-4-tablet is-3-desktop is-3-widescreen is-2-fullhd is-fullheight is-narrow-mobile">
        <div class="has-text-centered-mobile">
            <figure class="image">
                <img src="/images/logo.png" alt="Logo" style="max-width: 300px;">
            </figure>
        </div>
        <ul class="menu-list">
            <li>
                <router-link to="/app">
                    Sobre este guia
                </router-link>
            </li>
            <li v-for="item,key in entities">
                <router-link :to="{ path: '/app/classificacoes/' + item.slug }">
                    {{ item.title }}
                </router-link>

                <ul>
                    <li>
                        <router-link :to="{ path: '/app/classificacoes/' + item.slug + '/entidades' }">
                            <b-icon icon="view-list" size="is-small"></b-icon> <span>Técnicas Mapeadas</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{ path: '/app/classificacoes/' + item.slug + '/facetas' }">
                            <b-icon icon="information" size="is-small"></b-icon> <span>Facetas de Classificação</span>
                        </router-link>
                    </li>
                </ul>
            </li>
        </ul>
        <clip-loader v-if="isLoadingMenu" class="is-centered"></clip-loader>

        <nav class="navbar is-fixed-bottom socialbar is-hidden-mobile" style="opacity: unset">
            <div class="navbar-item">
                <ul>
                    <p class="menu-label">
                        Compartilhe
                    </p>
                    <li>
                        <vue-goodshare-facebook
                                :page_url="url"
                                title_social="Facebook"
                                has_counter
                                has_icon
                        ></vue-goodshare-facebook>
                    </li>
                    <li>
                        <vue-goodshare-googleplus
                                :page_url="url"
                                title_social="Google"
                                has_counter
                                has_icon
                        ></vue-goodshare-googleplus>
                    </li>
                    <li>
                        <vue-goodshare-twitter
                                :page_url="url"
                                title_social="Twitter"
                                has_counter
                                has_icon
                        ></vue-goodshare-twitter>
                    </li>
                    <li>
                        <vue-goodshare-linkedin
                                :page_url="url"
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