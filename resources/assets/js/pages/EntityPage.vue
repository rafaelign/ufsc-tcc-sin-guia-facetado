<script>
    import { mapMutations } from 'vuex'
    import VueMarkdown from 'vue-markdown'
    import References from '../components/References'
    import Classification from '../components/Classification'
    import Breadcrumb from '../components/Breadcrumb'

    export default {
        components: {
            VueMarkdown,
            Classification,
            References,
            Breadcrumb
        },
        data: function () {
            return {
                classification: {},
                entity: {},
                values: [],
                facets: [],
                errors: []
            }
        },
        created() {
            const classificationSlug = this.$route.params.classification
            const entitySlug = this.$route.params.entity

            this.loading()

            Promise.all([
                axios.get('/api/classifications/' + classificationSlug),
                axios.get('/api/entities/' + entitySlug),
                axios.get('/api/entities/' + entitySlug + '/values'),
                axios.get('/api/facet_groups/' + classificationSlug)
            ]).then(([responseClassification, responseEntities, responseEntityValues, responseFacets]) => {
                this.classification = responseClassification.data
                this.entity = responseEntities.data
                this.values = responseEntityValues.data
                this.facets = responseFacets.data

                axios.put('/api/entities/page_views/' + this.entity.id)
                    .catch((error) => this.errors = error.response.data.errors)

                this.loaded()
            }).catch((error) => this.errors = error.response.data.errors)
        },
        methods: {
            ...mapMutations([
                'loading',
                'loaded'
            ])
        }
    };
</script>

<template>
    <section v-if="this.$store.getters.isLoaded">
        <section class="hero">
            <div class="hero-body">
                <breadcrumb :items="[
                        { url: '#', title: 'Guia Facetado de Engenharia de Requisitos' },
                        { url: '/app/colecoes/' + classification.slug, title: classification.title },
                        { url: '/app/elicitacao-requisitos/entidades', title: 'Técnicas Mapeadas' },
                        { url: '#', title: entity.title, active: true }
                    ]"></breadcrumb>

                <div class="row content">
                    <h1 class="title">{{ entity.title }}</h1>

                    <div class="text-2-columns has-text-justified">
                        <vue-markdown :source="entity.description"></vue-markdown>
                    </div>
                </div>

                <hr>

                <div class="row content">
                    <div class="columns is-multiline">
                        <div class="column is-12 is-6-desktop">
                            <h2 class="subtitle"><b-icon icon="plus" class="has-text-success"></b-icon> <span>Prós</span></h2>

                            <vue-markdown :source="entity.pros || 'Informação não encontrada :,('"></vue-markdown>
                        </div>
                        <div class="column is-12 is-6-desktop">
                            <h2 class="subtitle"><b-icon icon="minus" class="has-text-danger"></b-icon> <span>Contras</span></h2>

                            <vue-markdown :source="entity.cons || 'Informação não encontrada :,('"></vue-markdown>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <classification :values="values" :items="facets"></classification>
                </div>

                <hr>

                <div class="row content">
                    <references title="Referências" :items="entity.references"></references>
                </div>
            </div>
        </section>
    </section>
</template>