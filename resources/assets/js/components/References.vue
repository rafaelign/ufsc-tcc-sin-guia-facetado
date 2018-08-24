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
        <ul>
            <li v-for="(reference, index) in items" :key="index">
                <sup>[{{ index + 1 }}]</sup> {{ reference.description }}
            </li>
        </ul>
    </section>
</template>