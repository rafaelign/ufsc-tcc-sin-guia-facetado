<script>
    import FilterSelect from './FilterSelect'

    export default {
        components: {
            FilterSelect
        },
        props: ['title'],
        data: function () {
            return {
            }
        }
    }
</script>

<template>
    <form action="">
        <div class="modal-card" style="width: auto">
            <header class="modal-card-head">
                <p class="modal-card-title">Filtros</p>
            </header>
            <section class="modal-card-body">
                <filter-select></filter-select>
            </section>
            <footer class="modal-card-foot">
                <button class="button" type="button" @click="$parent.close()">Close</button>
                <button class="button is-primary">Login</button>
            </footer>
        </div>
    </form>
</template>