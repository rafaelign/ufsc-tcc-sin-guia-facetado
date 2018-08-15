<script>
    export default {
        props: {
            data: {
                type: Array,
                default: () => {
                    return [];
                }
            }
        },
        data () {
            return {};
        },
        created () {
            console.log(this.data)
        }
    }
</script>

<template>
    <div class="row">
        <div class="columns">
            <div v-for="group in data" :class="['column', group.type]">
                group
            </div>
        </div>
    </div>
</template>