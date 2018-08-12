<script>
    export default {
        data: function () {
            return {
                collection: {},
                facets: [],
                errors: []
            }
        },
        created() {
            const slug = this.$route.params.collection;

            this.$root.showLoading();

            Promise.all([
                axios.get('/api/collections/' + slug),
                axios.get('/api/collections/' + slug + '/facets')
            ]).then(([responseCollection, responseFacets]) => {
                this.collection = responseCollection.data;
                this.facets = responseFacets.data;

                this.$root.hideLoading();
            }).catch((error) => this.errors = error.response.data.errors);
        }
    };
</script>

<template>
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

                                            <b-table-column field="created_at" label="Cadastrado em" width="200" sortable>
                                                <span class="tag is-primary">
                                                    {{ new Date(props.row.created_at).toLocaleDateString() }}
                                                </span>
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
                                                                <li v-for="value in props.row.values">{{ value.title }}</li>
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
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>