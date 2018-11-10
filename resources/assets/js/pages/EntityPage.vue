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
                references: [],
                facets: [],
                errors: []
            }
        },
        created() {
            const classificationSlug = this.$route.params.classification
            const entitySlug = this.$route.params.entity
            const url = this.$store.getters.getUrl

            this.loading()

            Promise.all([
                axios.get(url + '/api/classifications/' + classificationSlug),
                axios.get(url + '/api/entities/' + entitySlug),
                axios.get(url + '/api/entities/' + entitySlug + '/values'),
                axios.get(url + '/api/entities/' + entitySlug + '/references'),
                axios.get(url + '/api/facet_groups/' + classificationSlug)
            ]).then(([responseClassification, responseEntities, responseEntityValues, responseEntityReferences, responseFacets]) => {
                this.classification = responseClassification.data
                this.entity = responseEntities.data
                this.values = responseEntityValues.data
                this.references = responseEntityReferences.data
                this.facets = responseFacets.data

                axios.put(url + '/api/entities/page_views/' + this.entity.id)
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
                        { url: '/app', title: 'Guia Facetado de Engenharia de Requisitos' },
                        { url: '/app/classificacoes/' + classification.slug, title: classification.title },
                        { url: '/app/classificacoes/' + classification.slug + '/entidades', title: 'Técnicas Mapeadas' },
                        { url: '#', title: entity.title, active: true }
                    ]"></breadcrumb>

                <div class="row content">
                    <h1 class="title"><b-icon icon="bookmark-outline"></b-icon> {{ entity.title }}</h1>

                    <div class="text-2-columns has-text-justified">
                        <vue-markdown :source="entity.description"></vue-markdown>

                        <template v-if="entity.images_array && entity.images_array.length">
                            <h2>Figuras</h2>
                            <div v-for="image in entity.images_array">
                                <lightbox
                                        style="width: 40em"
                                        :thumbnail="image.src"
                                        :images="[image.src]"
                                >
                                    <lightbox-default-loader slot="loader"/>
                                </lightbox>
                                <small>{{ image.title }}</small>
                                <br><br>
                            </div>
                        </template>
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
                    <references title="Referências" :items="references"></references>
                </div>
            </div>
        </section>
    </section>
</template>