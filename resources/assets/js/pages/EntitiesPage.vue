<script>
    import { mapMutations } from 'vuex'
    import ModalForm from '../components/ModalForm'
    import Card from '../components/Card'
    import Breadcrumb from '../components/Breadcrumb'

    export default {
        components: {
            ModalForm,
            Card,
            Breadcrumb
        },
        data: function () {
            return {
                isComponentModalActive: false,
                formProps: {},
                classification: {},
                entities: [],
                facetGroups: [],
                filteredEntities: [],
                errors: []
            }
        },
        created () {
            const slug = this.$route.params.classification;
            const url = this.$store.getters.getUrl

            this.loading()
            // localforage

            Promise.all([
                axios.get(url + '/api/classifications/' + slug),
                axios.get(url + '/api/classifications/' + slug + '/entities'),
                axios.get(url + '/api/facet_groups/' + slug)
            ]).then(([responseClassification, responseEntities, responseFacetGroups]) => {
                this.classification = responseClassification.data;
                this.entities = responseEntities.data;
                this.facetGroups = responseFacetGroups.data;

                this.filteredEntities = this.entities;
                this.loaded()
            }).catch((error) => this.errors = error.response.data.errors);
        },
        methods: {
            ...mapMutations([
                'resetFilters',
                'loading',
                'loaded'
            ]),
            filter: function () {
                const slug = this.$route.params.classification
                const url = this.$store.getters.getUrl

                this.loading()

                axios.post(url + '/api/classifications/' + slug + '/entities', this.$store.getters.getFilters, {
                    'Content-Type': 'application/json'
                }).then((responseEntities) => {
                    this.filteredEntities = responseEntities.data

                    this.loaded()
                }).catch((error) => this.errors = error.response.data.errors)
            },
            reset: function () {
                this.resetFilters()
                this.filteredEntities = this.entities
                this.filter()
            }
        }
    };
</script>

<template>
    <section v-if="this.$store.getters.isLoaded">
        <section class="hero">
            <div class="hero-body">
                <breadcrumb :items="[
                    { url: '/app', title: 'Guia Facetado de Engenharia de Requisitos' },
                    { url: '/app/classificacoes/' + classification.slug, title: classification.title },
                    { url: '#', title: 'Técnicas Mapeadas', active: true }
                ]"></breadcrumb>

                <div class="row content">
                    <h1 class="title">
                        <div class="field has-addons is-pulled-right">
                            <p class="control">
                                <button class="button is-danger is-medium" @click="reset()">
                                    <b-icon icon="eraser"></b-icon> <span>Limpar filtros</span>
                                </button>
                            </p>
                            <p class="control">
                                <button class="button is-primary is-medium" @click="isComponentModalActive = true">
                                    <b-icon icon="filter"></b-icon> <span>Filtrar</span>
                                </button>
                            </p>
                        </div>

                        <b-icon icon="bookmark"></b-icon> {{ classification.title }}
                    </h1>

                    <p class="has-text-justified">Nesta página são apresentados os elementos que compõe a classificação acessada.</p>
                </div>

                <div class="row content"  v-if="filteredEntities.length">
                    <div class="columns is-multiline">
                        <div class="column is-12">
                            <h2 class="subtitle"><b-icon icon="format-list-bulleted"></b-icon> Registros encontrados</h2>
                        </div>
                        <div class="column is-4 is-6-tablet is-12-mobile" v-for="entity in filteredEntities">
                            <card :title="entity.title"
                                  :content="entity.short_description"
                                  :action="'/app/classificacoes/' + $route.params.classification + '/entidades/' + entity.slug"></card>
                        </div>
                    </div>
                </div>

                <div class="row content" v-else>
                    <p v-if="$store.getters.getFiltersValues.length">Nenhum registro encontrado para o filtro informado.</p>
                    <p v-else>Nenhum registro encontrado para esta classificação.</p>
                </div>
            </div>

            <b-modal :active.sync="isComponentModalActive" class="modal modal-full-screen modal-fx-fadeInScale" width="100%">
                <modal-form v-bind="formProps"
                            title="Selecione os filtros conforme as seguintes facetas"
                            :horizontal-data="facetGroups.filter( ( elem ) => elem.layout === 'horizontal' )"
                            :vertical-data="facetGroups.filter( ( elem ) => elem.layout === 'vertical' )"
                            @filter="filter"
                            @reset="reset"></modal-form>
            </b-modal>
        </section>
    </section>
</template>