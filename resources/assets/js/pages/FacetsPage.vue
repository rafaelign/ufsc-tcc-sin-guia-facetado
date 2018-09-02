<script>
    import { mapMutations } from 'vuex'
    import References from '../components/References'
    import Breadcrumb from '../components/Breadcrumb'

    export default {
        components: {
            References,
            Breadcrumb
        },
        data: function () {
            return {
                classification: {},
                facets: [],
                errors: []
            }
        },
        created() {
            const slug = this.$route.params.classification

            this.loading()

            Promise.all([
                axios.get('/api/classifications/' + slug),
                axios.get('/api/classifications/' + slug + '/facets')
            ]).then(([responseClassification, responseFacets]) => {
                this.classification = responseClassification.data
                this.facets = responseFacets.data

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
                            { url: '#', title: 'Facetas de Classificação', active: true }
                        ]"></breadcrumb>

                    <section class="row content">
                        <h1 class="title">Facetas de classificação</h1>
                        <p class="has-text-justified">Nesta página são apresentadas as facetas que determinam a classificação desta seção.</p>
                    </section>

                    <section class="row">
                        <b-table
                                :data="this.facets"
                                paginated
                                per-page="10"
                                detailed
                                detail-key="id">

                            <template slot-scope="props">
                                <b-table-column field="id" label="#" width="40" numeric>
                                    {{ props.row.id }}
                                </b-table-column>

                                <b-table-column field="user.title" label="Título">
                                    {{ props.row.title }}
                                </b-table-column>
                            </template>

                            <template slot="detail" slot-scope="props">
                                <article class="media">
                                    <div class="media-content">
                                        <div class="content">
                                            <span>
                                                <small>Descrição</small>
                                                <br>
                                                <span>{{ props.row.description }}</span>
                                                <br><br>
                                                <small>Opções:</small>
                                                <ul v-if="props.row.values.length">
                                                    <li v-for="value in props.row.values">
                                                        <div><b-icon icon="chevron-right" size="is-small"></b-icon> <span>{{ value.title }}</span></div>
                                                        <div v-if="value.description" class="inner-list">
                                                            <small>{{ value.description }}</small>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </span>
                                        </div>
                                    </div>
                                </article>
                            </template>
                        </b-table>
                    </section>

                    <section class="row content">
                        <references title="Referências" :items="[]"></references>
                    </section>
                </div>
            </section>
    </section>
</template>

<style scoped>
    ul { list-style: none; }
    .inner-list { margin-left: 12px;padding-left: 13px;border-left: 5px #CCC solid; }
</style>