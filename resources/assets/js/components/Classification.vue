<script>
    export default {
        data () {
            return {
                presented: []
            }
        },
        props: {
            items: {
                type: Array,
                default: function () {
                    return []
                }
            },
            values: {
                type: Array,
                default: function () {
                    return []
                }
            }
        },
        methods: {
            getValue: function (id) {
                let value = this.values.filter((item) => {
                    return item.facet_id === id
                }).pop();

                return value ? value.title : null
            }
        }
    }
</script>

<template>
    <section>
        <h2 class="subtitle"><b-icon icon="table" class="has-text-success"></b-icon> <span>Classificação completa</span></h2>
        <section  v-for="item in items">
            <div class="row">
                <div class="columns is-multiline">
                    <div class="column is-12 has-background-grey-lighter has-text-black margin-top-15 padding-5">
                        <small>{{ item.title }}</small>
                    </div>
                    <div class="column is-3" v-for="facet in item.facets">
                        <small><b>{{ facet.title }}</b></small>
                        <div>
                            <span class="tag is-primary margin-top-10">
                                <span v-if="getValue(facet.id) !== null">{{ getValue(facet.id) }}</span>
                                <i v-else>null</i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</template>