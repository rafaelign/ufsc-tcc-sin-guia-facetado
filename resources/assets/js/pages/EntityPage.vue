<script>
    import VueMarkdown from 'vue-markdown'
    import References from '../components/References'
    import Classification from '../components/Classification'

    export default {
        components: {
            VueMarkdown,
            Classification,
            References
        },
        data: function () {
            return {
                collection: {},
                entity: {},
                values: [],
                facets: [],
                errors: []
            }
        },
        created() {
            const collectionSlug = this.$route.params.collection;
            const entitySlug = this.$route.params.entity;

            this.$root.showLoading();

            Promise.all([
                axios.get('/api/collections/' + collectionSlug),
                axios.get('/api/entities/' + entitySlug),
                axios.get('/api/entities/' + entitySlug + '/values'),
                axios.get('/api/facet_groups/' + collectionSlug)
            ]).then(([responseCollections, responseEntities, responseEntityValues, responseFacets]) => {
                this.collection = responseCollections.data;
                this.entity = responseEntities.data;
                this.values = responseEntityValues.data;
                this.facets = responseFacets.data;

                this.$root.hideLoading();
            }).catch((error) => this.errors = error.response.data.errors);
        }
    };
</script>

<template>
    <div class="row" v-if="! this.$root.isLoading">
        <div class="column is-8 content-box">
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
                                <li>
                                    <router-link :to="{ path: '/app/colecoes/' + collection.slug }">
                                        {{ collection.title }}
                                    </router-link>
                                </li>
                                <li>
                                    <router-link to="/app/elicitacao-requisitos/entidades">
                                        Técnicas Mapeadas
                                    </router-link>
                                </li>
                                <li class="is-active"><a href="#" aria-current="page">{{ entity.title }}</a></li>
                            </ul>
                        </nav>

                        <div class="row">
                            <div class="columns">
                                <div class="column is-12">
                                    <div class="container">
                                        <h1 class="title">{{ entity.title }}</h1>

                                        <div class="text-2-columns has-text-justified">
                                            <vue-markdown :source="entity.description"></vue-markdown>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="columns">
                                <div class="column is-6">
                                    <div class="container">
                                        <h2 class="subtitle"><b-icon icon="plus" class="has-text-success"></b-icon> <span>Prós</span></h2>

                                        <vue-markdown :source="entity.pros || 'Informação não encontrada :,('"></vue-markdown>
                                    </div>
                                </div>
                                <div class="column is-6">
                                    <div class="container">
                                        <h2 class="subtitle"><b-icon icon="minus" class="has-text-danger"></b-icon> <span>Contras</span></h2>

                                        <vue-markdown :source="entity.cons || 'Informação não encontrada :,('"></vue-markdown>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="columns">
                                <div class="column is-12">
                                    <div class="container">
                                        <classification :values="values" :items="facets"></classification>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="columns">
                                <div class="column is-12">
                                    <div class="container">
                                        <references title="Referências" :items="entity.references"></references>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>