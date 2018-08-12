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
                            <span class="icon is-small"><i class="mdi mdi-view-list"></i></span> Técnicas Mapeadas
                        </router-link>
                    </li>
                    <li>
                        <router-link :to="{ path: '/app/colecoes/' + item.slug + '/facetas' }">
                            <span class="icon is-small"><i class="mdi mdi-information"></i></span> Facetas de Classificação
                        </router-link>
                    </li>
                </ul>
            </li>
        </ul>
        <clip-loader v-if="isLoadingMenu" class="is-centered"></clip-loader>
    </aside>
</template>