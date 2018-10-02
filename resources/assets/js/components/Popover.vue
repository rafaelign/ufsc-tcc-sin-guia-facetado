<script>
    export default {
        props: {
            direction: {
                type: String,
                default: 'is-popover-bottom'
            }
        },
        data() {
            return {
                active: ''
            }
        },
        methods: {
            toggle: function () {
                this.active = this.active === 'is-popover-active' ? '' : 'is-popover-active'
            }
        }
    }
</script>

<template>
    <div :class="['popover', direction, active]">
        <slot name="button" :toggle="toggle"></slot>
        <div class="popover-content">
            <slot name="content"></slot>
        </div>
    </div>
</template>