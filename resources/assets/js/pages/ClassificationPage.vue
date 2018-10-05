<script>
    import { mapMutations } from 'vuex'
    import VueMarkdown from 'vue-markdown'
    import Card from '../components/Card'
    import Breadcrumb from '../components/Breadcrumb'

    export default {
        components: {
            VueMarkdown,
            Card,
            Breadcrumb
        },
        data: function () {
            return {
                classification: {},
                entities: [],
                errors: [],
                breadcrumb: [

                ]
            };
        },
        created () {
            const slug = this.$route.params.classification

            this.loading()

            Promise.all([
                axios.get('/api/classifications/' + slug),
                axios.get('/api/classifications/' + slug + '/entities')
            ]).then(([responseClassification, responseEntities]) => {
                this.classification = responseClassification.data
                this.entities = responseEntities.data

                this.loaded()
            }).catch((error) => this.errors = error.response.data.errors)
        },
        methods: {
            ...mapMutations([
                'loading',
                'loaded'
            ])
        }
    }
</script>

<template>
    <section v-if="this.$store.getters.isLoaded">
        <section class="hero">
            <div class="hero-body">
                <breadcrumb :items="[
                    { url: '/app', title: 'Guia Facetado de Engenharia de Requisitos' },
                    { url: '#', title: classification.title, active: true }
                ]"></breadcrumb>

                <div class="row content">
                    <h1 class="title"><b-icon icon="bookmark"></b-icon> {{ this.classification.title }}</h1>
                    <vue-markdown :source="classification.description"></vue-markdown>
                </div>

                <div class="row content">
                    <h2 class="subtitle" v-if="entities.length > 0"><b-icon icon="adjust"></b-icon> Exemplos encontrados nesta seção do guia</h2>
                    <h2 class="subtitle" v-else><b-icon icon="close"></b-icon> Nenhum exemplo encontrado para esta classificação</h2>
                </div>

                <div class="row content">
                    <div class="columns is-multiline">
                        <div class="column is-4 is-6-tablet is-12-mobile" v-for="entity in entities.slice(0, 4)">
                            <card :title="entity.title"
                                  :content="entity.short_description"
                                  :action="'/app/classificacoes/' + $route.params.classification + '/entidades/' + entity.slug"></card>
                        </div>
                    </div>
                </div>

                <div class="row content has-text-centered" v-if="entities.length > 3">
                    <router-link :to="{ path: '/app/classificacoes/' + $route.params.classification + '/entidades' }" class="is-medium">
                        <b-icon icon="plus" size="is-small"></b-icon> <span>Visualizar {{ this.classification.classification_type }}</span>
                    </router-link>
                </div>
            </div>
        </section>
    </section>
</template>