<script>
    export default {
        props: {
            title: {
                type: String
            },
            items: {
                type: Array,
                default: function () {
                    return [];
                }
            }
        }
    }
</script>

<template>
    <section v-if="items.length">
        <h2 class="subtitle"><b-icon icon="view-list" class="has-text-danger"></b-icon> <span>{{ title }}</span></h2>
        <ul class="references-list">
            <li v-for="(reference, index) in items" :key="index">
                <sup>[{{ reference.code }}]</sup> {{ reference.description }}
            </li>
        </ul>
    </section>
</template>

<style type="text/css">
    ul.references-list {
        padding: 0;
        margin: 0;
    }

    ul.references-list li {
        list-style: none;
        margin-top: 20px;
    }
</style>