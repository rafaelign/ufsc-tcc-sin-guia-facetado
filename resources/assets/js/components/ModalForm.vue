<script>
    import DynamicField from './DynamicField'

    export default {
        components: {
            DynamicField
        },
        props: {
            title: {
                type: String,
                default: null
            },
            horizontalData: {
                type: Array,
                default: function  () {
                    return [];
                }
            },
            verticalData: {
                type: Array,
                default: function  () {
                    return [];
                }
            }
        },
        data: function () {
            return {
                selectedFilters: []
            }
        },
        methods: {
            filter: function () {
                this.$emit('filter')
                this.$parent.close()
            },
            reset: function () {
                this.$emit('reset')
                this.$parent.close()
            },
        }
    }
</script>

<template>
    <div class="modal-content modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">{{ title }}</p>
        </header>
        <section class="modal-card-body">
            <form action="">
                <div class="tile is-ancestor">
                    <div class="tile is-vertical is-12">
                        <div class="tile is-parent" v-for="group in horizontalData">
                            <article class="tile is-child is-white">
                                <p class="subtitle has-text-weight-bold">{{ group.title }}</p>
                                <div class="content">
                                    <div class="columns">
                                        <div class="column is-3" v-for="facet in group.facets">
                                            <b-field :label="facet.title">
                                                <dynamic-field
                                                        :type="facet.type"
                                                        :name="facet.slug"
                                                        :options="facet.values"></dynamic-field>
                                            </b-field>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <div class="tile">
                            <div class="tile is-parent" v-for="group in verticalData">
                                <article class="tile is-child is-white">
                                    <p class="subtitle has-text-weight-bold">{{ group.title }}</p>
                                    <div class="content">
                                        <div class="field" v-for="facet in group.facets">
                                            <small>{{ facet.title }}</small>
                                            <br>
                                            <dynamic-field
                                                    :type="facet.type"
                                                    :name="facet.slug"
                                                    :options="facet.values"></dynamic-field>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
        <footer class="modal-card-foot buttons is-centered">
            <button class="button is-medium" type="button" @click="reset">
                <b-icon icon="eraser"></b-icon> <span>Limpar</span>
            </button>
            <button class="button is-medium is-primary" @click="filter">
                <b-icon icon="filter"></b-icon> <span>Filtrar</span>
            </button>
        </footer>
    </div>
</template>