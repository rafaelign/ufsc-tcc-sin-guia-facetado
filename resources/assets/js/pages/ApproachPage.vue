<script>
    import { mapMutations } from 'vuex'
    import VueMarkdown from 'vue-markdown'
    import References from '../components/References'
    import Classification from '../components/Classification'
    import Breadcrumb from '../components/Breadcrumb'
    import Card from '../components/Card'

    export default {
        components: {
            VueMarkdown,
            Classification,
            References,
            Card,
            Breadcrumb
        },
        data: function () {
            return {
                classification: {},
                approach: {},
                entities: [],
                references: [],
                errors: []
            }
        },
        created() {
            const approachSlug = this.$route.params.approach
            const classificationSlug = this.$route.params.classification
            const url = this.$store.getters.getUrl

            this.loading()

            Promise.all([
                axios.get(url + '/api/classifications/' + classificationSlug),
                axios.get(url + '/api/approaches/' + approachSlug ),
                axios.get(url + '/api/approaches/' + approachSlug + '/entities'),
                axios.get(url + '/api/approaches/' + approachSlug + '/references')
            ]).then(([responseClassification, responseApproach, responseEntities, responseReferences]) => {
                this.classification = responseClassification.data
                this.approach = responseApproach.data
                this.entities = responseEntities.data
                this.references = responseReferences.data
                this.loaded()
                console.log(this.approach)
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
                        { url: '/app/abordagens/', title: 'Abordagens de elicitação de requisitos' },
                        { url: '#', title: approach.approach_title, active: true }
                    ]"></breadcrumb>

                <div class="row content">
                    <h1 class="title"><b-icon icon="bookmark-outline"></b-icon> {{ approach.approach_title }}</h1>

                    <div class="has-text-justified">
                        <vue-markdown :source="approach.approach_description"></vue-markdown>
                    </div>
                </div>

                                <div class="row content">
                    <h3 class="title"><b-icon icon="bookmark-outline"></b-icon> Contexto de aplicação: {{ approach.context_title }}</h3>

                    <div class="has-text-justified">
                        <vue-markdown :source="approach.context_description"></vue-markdown>
                    </div>
                </div>

                <div class="row content">
                    <h2 class="title"><b-icon icon="bookmark-outline"></b-icon> Técnicas utilizadas nesta abordagem</h2>
                    <div class="columns is-multiline">
                        <div class="column is-4 is-6-tablet is-12-mobile" v-for="entity in entities">
                            <card :title="entity.title"
                                  :content="entity.short_description"
                                  :action="'/app/classificacoes/' + entity.classification_slug + '/entidades/' + entity.slug"></card>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row content">
                    <references title="Referências" :items="references"></references>
                </div>
            </div>
        </section>
    </section>
</template>