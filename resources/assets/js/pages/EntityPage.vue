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
                approaches: [],
                facets: [],
                errors: [],
                approachesList: [],
                entitiesApproachMap: {},
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
                axios.get(url + '/api/entities/' + entitySlug + '/approaches'),
                axios.get(url + '/api/facet_groups/' + classificationSlug)
            ]).then(([responseClassification, responseEntities, responseEntityValues, responseEntityReferences, responseApproaches, responseFacets]) => {
                this.classification = responseClassification.data
                this.entity = responseEntities.data
                this.values = responseEntityValues.data
                this.references = responseEntityReferences.data
                this.approaches = responseApproaches.data
                this.facets = responseFacets.data

                this.entitiesApproachMap = _.groupBy(this.approaches, (value) => value.approach_slug)
                this.approachesList = _.uniqBy(this.approaches.map((v) => _.pick(v, ['approach_slug', 'approach_title'])), 'approach_slug')
                
                axios.get(url + '/api/entities/page_views/' + this.entity.id)
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
                                        :thumbnail="$root.url + image.src"
                                        :images="[$root.url + image.src]"
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
                <div> <hr v-if="approachesList.length > 0"> </div>
                <div class="row content">
                    <h4 class="title" v-if="approachesList.length > 0" ><b-icon icon="apps" class="has-text-warning"></b-icon> Técnicas utilizadas em conjunto em abordagens de elicitação de requisitos</h4>
                    <div class="columns is-multiline">
                        <div class="column is-4 is-6-tablet is-12-mobile" v-for="approach in approachesList">
                                <button class="button is-info is-small" @click="$router.push('/app/abordagens/' + approach.approach_slug)">
                                    <span>{{ approach.approach_title }}</span>
                                </button>
                                <div class="margin-top-5">
                                    <span class="margin-top-10" v-for="relatedEntity in entitiesApproachMap[approach.approach_slug]">
                                        <button class="button margin-top-10 margin-right-5 is-small is-outlined" v-if="relatedEntity.entity_slug!==entity.slug" @click="$router.push('/app/classificacoes/' + $route.params.classification + '/entidades/' + relatedEntity.entity_slug, () => $router.go())">
                                            <span class="has-text-info">{{ relatedEntity.title }}</span>
                                        </button>
                                    </span>
                                </div>
                        </div>
                    </div>
                    
                </div>
                <div> <hr> </div>

                <div class="row">
                    <classification :values="values" :items="facets"></classification>
                </div>

                <hr>

                <div class="row content">
                    <references title="Referências" :items="references"></references>
                    <br>
                </div>
            </div>
        </section>
    </section>
</template>