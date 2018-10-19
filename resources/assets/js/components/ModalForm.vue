<script>
    import DynamicField from './DynamicField'
    import Popover from './Popover'

    export default {
        components: {
            DynamicField,
            Popover
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
            <div class="has-text-right">
                <span class="has-background-warning"><b-icon icon="asterisk"></b-icon> Para que uma técnica seja filtrada ela precisa ter <b>TODOS</b> os filtros selecionados</span>
            </div>
            <form action="">
                <div class="tile is-ancestor">
                    <div class="tile is-vertical is-12">
                        <div class="tile is-parent" v-for="group in horizontalData">
                            <article class="tile is-child is-white">
                                <p class="subtitle has-text-weight-bold">{{ group.title }}</p>
                                <div class="content">
                                    <div class="columns">
                                        <div class="column is-3" v-for="facet in group.facets">
                                            <div class="field">
                                                <label :for="facet.slug" class="">
                                                    <span class="columns">
                                                        <span class="column is-three-fifths">
                                                            {{ facet.title }}
                                                            <popover class="is-pulled-right" direction="is-popover-bottom">
                                                                <span class="icon is-popover-trigger" slot="button" slot-scope="{ toggle }" @click="toggle()"><span class="mdi mdi-information mdi-circle"></span></span>
                                                                <div slot="content">
                                                                    <p>{{ facet.description }}</p>
                                                                    <p>Opções:</p>
                                                                    <ul>
                                                                        <li v-for="value in facet.values">{{ value.title }}: {{ value.description }}</li>
                                                                    </ul>
                                                                </div>
                                                            </popover>
                                                        </span>
                                                    </span>
                                                </label>
                                                <dynamic-field
                                                        :type="facet.type"
                                                        :name="facet.slug"
                                                        :options="facet.values"></dynamic-field>
                                            </div>
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
                                            <small>
                                                {{ facet.title }}

                                                <popover direction="is-popover-top">
                                                    <span class="icon is-popover-trigger" slot="button" slot-scope="{ toggle }" @click="toggle()"><span class="mdi mdi-information mdi-circle"></span></span>
                                                    <div slot="content">
                                                        <p>{{ facet.description }}</p>
                                                        <p>Opções:</p>
                                                        <ul>
                                                            <li v-for="value in facet.values">{{ value.title }}: {{ value.description }}</li>
                                                        </ul>
                                                    </div>
                                                </popover>
                                            </small>
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