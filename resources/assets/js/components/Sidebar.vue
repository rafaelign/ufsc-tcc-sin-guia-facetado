<script>
    import ClipLoader from 'vue-spinner/src/ClipLoader'
    import ShareButtons from './ShareButtons'

    export default {
        components: {
            ClipLoader,
            ShareButtons
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

            axios.get(this.$store.getters.getUrl + '/api/classifications')
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
                <img :src="$root.url + '/images/logo.png'" alt="Logo" style="max-width: 300px;">
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
                            <b-icon icon="view-list" size="is-small"></b-icon> <span>{{ item.main_menu }}</span>
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{ path: '/app/classificacoes/' + item.slug + '/facetas' }">
                            <b-icon icon="information" size="is-small"></b-icon> <span>Facetas de Classificação</span>
                        </router-link>
                    </li>
                </ul>
            </li>
            <li class="is-hidden-tablet">
                <router-link to="#">Compartilhe</router-link>

                <share-buttons></share-buttons>
            </li>
        </ul>
        <clip-loader v-if="isLoadingMenu" class="is-centered"></clip-loader>

        <nav class="navbar is-fixed-bottom socialbar is-hidden-mobile" style="opacity: unset">
            <div class="navbar-item">
                <share-buttons label="Compartilhe"></share-buttons>
            </div>
        </nav>
    </aside>
</template>