<script>
    import ModalForm from '../components/ModalForm'
    import Card from '../components/Card'

    export default {
        components: {
            ModalForm,
            Card
        },
        data: function () {
            return {
                isComponentModalActive: false,
                formProps: {},
                collection: {},
                entities: [],
                facetGroups: [],
                errors: []
            }
        },
        created () {
            const slug = this.$route.params.collection;

            this.$root.showLoading();

            // VUEX - storage - state - getters - mutatios
            // localforage

            Promise.all([
                axios.get('/api/collections/' + slug),
                axios.get('/api/collections/' + slug + '/entities'),
                axios.get('/api/facet_groups/' + slug)
            ]).then(([responseCollection, responseEntities, responseFacetGroups]) => {
                this.collection = responseCollection.data;
                this.entities = responseEntities.data;
                this.facetGroups = responseFacetGroups.data;

                this.$root.hideLoading();
            }).catch((error) => this.errors = error.response.data.errors);
        },
        methods: {
            filter: function (data) {
                console.log('EntitiesPage', data)
            }
        }
    };
</script>

<template>
    <div>
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
                                    <li>
                                        <router-link :to="{ path: '/app/colecoes/' + this.collection.slug }">
                                            {{ this.collection.title }}
                                        </router-link>
                                    </li>
                                    <li class="is-active"><a href="#" aria-current="page">Técnicas Mapeadas</a></li>
                                </ul>
                            </nav>

                            <div class="row">
                                <div class="columns">
                                    <div class="column is-12">
                                        <div class="container">
                                            <h1 class="title">
                                                {{ collection.title }}
                                                <button class="button is-primary is-medium is-pulled-right"
                                                        @click="isComponentModalActive = true">
                                                    <b-icon icon="filter"></b-icon> <span>Filtrar</span>
                                                </button>
                                            </h1>

                                            <p>Nesta página estão listadas todas técnicas mapeadas através da pesquisa. Conforme falado anteriormente, foi utilizado um método de classificação facetada, agrupando as características presentes sob diversos aspectos.</p>
                                        </div>
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
                        </div>
                    </div>
                    <!-- .sync="isComponentModalActive" -->
                    <b-modal :active="true" class="modal modal-full-screen modal-fx-fadeInScale" width="100%">
                        <modal-form v-bind="formProps"
                                    title="Selecione os filtros conforme as seguintes facetas"
                                    :horizontal-data="facetGroups.filter( ( elem ) => elem.layout === 'horizontal' )"
                                    :vertical-data="facetGroups.filter( ( elem ) => elem.layout === 'vertical' )"
                                    @filter="filter"></modal-form>
                    </b-modal>
                </section>
            </div>
        </div>
    </div>
</template>