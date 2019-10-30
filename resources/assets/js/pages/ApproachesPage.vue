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
                approaches: {},
                errors: [],
                breadcrumb: []
            };
        },
        created () {
            const url = this.$store.getters.getUrl
            this.loading()

            Promise.all([
                axios.get(url + '/api/approaches/')
            ]).then(([responseApproaches]) => {
                this.approaches = responseApproaches.data

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
                    { url: '#', title: 'Abordagens de elicitação de requisitos', active: true }
                ]"></breadcrumb>

                <div class="row content">
                    <h1 class="title"><b-icon icon="bookmark"></b-icon> {{ 'Abordagens de elicitação de requisitos' }}</h1>
                 <p class="has-text-justified">Abordagens de elicitação de requisitos são formadas por conjuntos de técnicas que são utilizadas em conjunto em um processo de elicitação de requisitos de forma a aprimorá-lo. As abordagens usualmente foram desenvolvidas para um contexto específico de aplicação, porém nada impede que elas sejam testadas e possuam um bom desempenho em contextos diferentes. </p>
                </div>

                <div class="row content">
                    <h2 class="subtitle" v-if="approaches.length > 0"><b-icon icon="adjust"></b-icon> Abordagens encontradas no guia</h2>
                    <h2 class="subtitle" v-else><b-icon icon="close"></b-icon> Nenhuma abordagem encontrada</h2>
                </div>

                <div class="row content">
                    <div class="columns is-multiline">
                        <div class="column is-4 is-6-tablet is-12-mobile" v-for="approach in approaches">
                            <card :title="approach.approach_title"
                                  :content="approach.short_description"
                                  :action="'/app/abordagens/' + approach.slug"></card>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>