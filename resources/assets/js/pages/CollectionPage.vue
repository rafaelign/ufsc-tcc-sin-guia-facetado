<script>
    import VueMarkdown from 'vue-markdown'
    import Card from '../components/Card'

    export default {
        components: {
            VueMarkdown,
            Card
        },
        data: function () {
            return {
                collection: {},
                entities: [],
                errors: []
            };
        },
        created () {
            const slug = this.$route.params.collection;

            this.$root.showLoading();

            Promise.all([
                axios.get('/api/collections/' + slug),
                axios.get('/api/collections/' + slug + '/entities')
            ]).then(([responseCollection, responseEntities]) => {
                this.collection = responseCollection.data;
                this.entities = responseEntities.data;

                this.$root.hideLoading();
            }).catch((error) => this.errors = error.response.data.errors);
        }
    }
</script>

<template>
    <div class="row" v-if="! this.$root.isLoading">
        <div class="column is-8 content-box hero">
            <section class="hero">
                <div class="hero-body">
                    <div class="container">
                        <nav class="breadcrumb has-arrow-separator is-right" aria-label="breadcrumbs">
                            <ul>
                                <li>
                                    <router-link to="/app">
                                        Guia Facetado de Engenharia de Requisitos
                                    </router-link>
                                </li>
                                <li class="is-active"><a href="#" aria-current="page">{{ this.collection.title }}</a></li>
                            </ul>
                        </nav>

                        <div class="row">
                            <div class="columns">
                                <div class="column is-12">
                                    <div class="container">
                                        <h1 class="title">{{ this.collection.title }}</h1>

                                        <vue-markdown :source="collection.description"></vue-markdown>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="columns">
                                <div class="column is-12" v-if="entities.length > 0">
                                    <h2 class="subtitle">Exemplos encontrados nesta seção do guia</h2>
                                </div>
                                <div class="column is-12" v-else>
                                    <h2 class="subtitle">Nenhum exemplo encontrado para esta classificação</h2>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="columns">
                                <div class="column is-4" v-for="entity in entities">
                                    <card :title="entity.title"
                                          :content="entity.short_description"
                                          :action="'/app/colecoes/' + $route.params.collection + '/entidades/' + entity.slug"></card>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="columns">
                                <div class="column is-12 has-text-centered" v-if="entities.length > 3">
                                    <router-link :to="{ path: '/app/colecoes/' + $route.params.collection + '/entidades' }" class="is-medium">
                                        <b-icon icon="link" size="is-small"></b-icon> <span>Ver todos</span>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>