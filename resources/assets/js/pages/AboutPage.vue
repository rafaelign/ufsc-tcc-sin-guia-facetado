<script>
    import Breadcrumb from '../components/Breadcrumb'
    import References from '../components/References'

    export default {
        components: {
            Breadcrumb,
            References
        },
        data () {
            return {}
        }
    }
</script>
<template>
    <section v-if="this.$store.getters.isLoaded">
        <section class="hero">
            <div class="hero-body">
                <breadcrumb :items="[
                    { url: '#', title: 'Guia Facetado de Engenharia de Requisitos', active: true },
                ]"></breadcrumb>

                <section class="content">
                    <h1 class="title"><b-icon icon="information"></b-icon> Sobre este guia</h1>
                    <p class="has-text-justified">Este guia é parte de um trabalho de conclusão de curso intitulado “Guia facetado de técnicas de elicitação de requisitos”. Seu objetivo consiste em coletar técnicas e suas respectivas características, classificar as técnicas coletadas e apresentar neste guia. LALALA, tornando um guia que centraliza essas informações muito útil. Desta forma, a partir de um determinado contexto, os usuários podem filtrar as várias facetas de uma técnica e chegar nos casos que se adequa  sua situação.</p>

                    <h2 class="subtitle"><b-icon icon="target"></b-icon> Público alvo</h2>
                    <div class="columns">
                        <div class="column">
                            Pessoas em geral que procuram informações sobre as técnicas e como elas podem ser aplicadas no contexto de elicitação.
                        </div>
                        <div class="column">
                            Profissionais da área que buscam técnicas para resolver situações enfrentadas durante a elicitação de requisito para um determinado contexto.
                        </div>
                    </div>

                    <hr>

                    <div class="row content">
                        <references title="Referências" :items="['TCC', 'Outras fontes']"></references>
                    </div>
                </section>
            </div>
        </section>
    </section>
</template>