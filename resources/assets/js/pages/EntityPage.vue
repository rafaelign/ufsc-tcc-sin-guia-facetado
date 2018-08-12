<script>
    import VueMarkdown from 'vue-markdown'

    export default {
        components: {
            VueMarkdown,
        },
        data: function () {
            return {
                collection: {},
                entity: {},
                errors: []
            }
        },
        created() {
            const collectionSlug = this.$route.params.collection;
            const entitySlug = this.$route.params.entity;

            this.$root.showLoading();

            Promise.all([
                axios.get('/api/collections/' + collectionSlug),
                axios.get('/api/entities/' + entitySlug)
            ]).then(([responseCollections, responseEntities]) => {
                this.collection = responseCollections.data;
                this.entity = responseEntities.data;

                this.$root.hideLoading();
            }).catch((error) => this.errors = error.response.data.errors);
        }
    };
</script>

<template>
    <div class="row" v-if="! this.$root.isLoading">
        <div class="column is-8 content-box">
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
                                    <router-link :to="{ path: '/app/colecoes/' + collection.slug }">
                                        {{ collection.title }}
                                    </router-link>
                                </li>
                                <li>
                                    <router-link to="/app/elicitacao-requisitos/entidades">
                                        Técnicas Mapeadas
                                    </router-link>
                                </li>
                                <li class="is-active"><a href="#" aria-current="page">{{ entity.title }}</a></li>
                            </ul>
                        </nav>

                        <div class="row">
                            <div class="columns">
                                <div class="column is-12">
                                    <div class="container">
                                        <h1 class="title">{{ entity.title }}</h1>

                                        <div class="text-2-columns has-text-justified">
                                            <vue-markdown :source="entity.description"></vue-markdown>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="columns">
                                <div class="column is-6">
                                    <div class="container">
                                        <h2 class="subtitle"><span class="icon has-text-success"><i class="fa fa-plus"></i></span> Prós</h2>

                                        <vue-markdown :source="entity.pros || 'Informação não encontrada :,('"></vue-markdown>
                                    </div>
                                </div>
                                <div class="column is-6">
                                    <div class="container">
                                        <h2 class="subtitle"><span class="icon has-text-danger"><i class="fa fa-minus"></i></span> Contras</h2>

                                        <vue-markdown :source="entity.cons || 'Informação não encontrada :,('"></vue-markdown>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="columns">
                                <div class="column is-12">
                                    <div class="container">
                                        <h2 class="subtitle"><span class="icon has-text-success"><i class="fa fa-table"></i></span> Classificação completa</h2>
                                        <div class="content">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th><abbr title="Position">Pos</abbr></th>
                                                    <th>Team</th>
                                                    <th><abbr title="Played">Pld</abbr></th>
                                                    <th><abbr title="Points">Pts</abbr></th>
                                                    <th>Qualification or relegation</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <th>1</th>
                                                    <td><a href="https://en.wikipedia.org/wiki/Leicester_City_F.C." title="Leicester City F.C.">Leicester City</a> <strong>(C)</strong>
                                                    </td>
                                                    <td>38</td>
                                                    <td>81</td>
                                                    <td>Qualification for the <a href="https://en.wikipedia.org/wiki/2016%E2%80%9317_UEFA_Champions_League#Group_stage" title="2016–17 UEFA Champions League">Champions League group stage</a></td>
                                                </tr>
                                                <tr>
                                                    <th>1</th>
                                                    <td><a href="https://en.wikipedia.org/wiki/Leicester_City_F.C." title="Leicester City F.C.">Leicester City</a> <strong>(C)</strong>
                                                    </td>
                                                    <td>38</td>
                                                    <td>81</td>
                                                    <td>Qualification for the <a href="https://en.wikipedia.org/wiki/2016%E2%80%9317_UEFA_Champions_League#Group_stage" title="2016–17 UEFA Champions League">Champions League group stage</a></td>
                                                </tr>
                                                <tr>
                                                    <th>1</th>
                                                    <td><a href="https://en.wikipedia.org/wiki/Leicester_City_F.C." title="Leicester City F.C.">Leicester City</a> <strong>(C)</strong>
                                                    </td>
                                                    <td>38</td>
                                                    <td>81</td>
                                                    <td>Qualification for the <a href="https://en.wikipedia.org/wiki/2016%E2%80%9317_UEFA_Champions_League#Group_stage" title="2016–17 UEFA Champions League">Champions League group stage</a></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="columns">
                                <div class="column is-12">
                                    <div class="container">
                                        <h2 class="subtitle"><span class="icon has-text-danger"><i class="fa fa-list-ol"></i></span> Referências</h2>
                                        <ul>
                                            <li><b>[1]</b> Lorem ipsum dolor sit amet.</li>
                                            <li><b>[2]</b> Aenean enim ex, vestibulum eu enim.</li>
                                            <li><b>[3]</b> Duis eget lacus quis orci rhoncus aliquet.</li>
                                        </ul>
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