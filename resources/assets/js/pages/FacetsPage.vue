<script>
    import { mapMutations } from 'vuex'
    import References from '../components/References'

    export default {
        components: {
            References
        },
        data: function () {
            return {
                collection: {},
                facets: [],
                errors: []
            }
        },
        created() {
            const slug = this.$route.params.collection

            this.loading()

            Promise.all([
                axios.get('/api/collections/' + slug),
                axios.get('/api/collections/' + slug + '/facets')
            ]).then(([responseCollection, responseFacets]) => {
                this.collection = responseCollection.data
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
    <div class="row" v-if="this.$store.getters.isLoaded">
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
                                <li class="is-active"><a href="#" aria-current="page">Facetas de Classificação</a></li>
                            </ul>
                        </nav>

                        <div class="row">
                            <div class="columns">
                                <div class="column is-12">
                                    <div class="container">
                                        <h1 class="title">Facetas de classificação</h1>

                                        <p>Nesta página são apresentadas as facetas que determinam a classificação desta seção.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="columns">
                                <div class="column is-12">
                                    <b-table
                                            :data="this.facets"
                                            paginated
                                            per-page="10"
                                            detailed
                                            detail-key="id"
                                    >

                                        <template slot-scope="props">
                                            <b-table-column field="id" label="#" width="40" numeric>
                                                {{ props.row.id }}
                                            </b-table-column>

                                            <b-table-column field="user.title" label="Título" sortable>
                                                {{ props.row.title }}
                                            </b-table-column>
                                        </template>

                                        <template slot="detail" slot-scope="props">
                                            <article class="media">
                                                <div class="media-content">
                                                    <div class="content">
                                                        <p>
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
                                                        </p>
                                                    </div>
                                                </div>
                                            </article>
                                        </template>
                                    </b-table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="columns">
                                <div class="column is-12">
                                    <div class="container">
                                        <references title="Referências" :items="[]"></references>
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

<style scoped>
    ul { list-style: none; }
    .inner-list { margin-left: 12px;padding-left: 13px;border-left: 5px #CCC solid; }
</style>