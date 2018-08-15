<script>
    import ClipLoader from 'vue-spinner/src/ClipLoader'

    export default {
        components: {
            ClipLoader
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
    </aside>
</template>