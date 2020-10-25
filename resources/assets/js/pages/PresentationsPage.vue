<script>
    import Breadcrumb from '../components/Breadcrumb'
    import References from '../components/References'
    import pdf from 'vue-pdf'

    export default {
        components: {
            Breadcrumb,
            References,
            pdf
        },
        data () {
            return {
                videoId: '4-z2jbOZUY4',
                playerVars: {
                    autoplay: 0
                }
            }
        },
        methods: {
            playing() {
                console.log('\o/ we are watching!!!')
            }
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
                    <h1 class="title"><b-icon icon="presentation"></b-icon> Apresentações</h1>
                    <p class="has-text-justified">
                        <p>Em agosto de 2020 apresentamos o artigo intitulado Guia Facetado de Técnicas de Elicitação de Requisitos.<sup>[1]</sup> no 23rd Workshop em Engenharia de Requisitos (WER) que ocorreu no período de 24 à 28 de agosto de 2020. Para mais detalhes, basta seguir os respectivos links do evento.</p>

                        <p>
                            <ul>
                                <li><a href="http://wer20.sites.unifesp.br/" target="_blank">WER2020</a></li>
                                <li><a href="http://wer.inf.puc-rio.br/WERpapers/papers_by_conference.lp?conference=WER20" target="_blank">Artigos apresentados no evento</a></li>
                                <li><a href="https://www.youtube.com/channel/UC2VT4McnmSGRXh9jRygGz6w" target="_blank">Canal do evento no Youtube</a></li>
                            </ul>
                        </p>

                        <p>O artigo foi muito recebido pela comunidade do evento e recembemos algumas premiações destacadas logo abaixo.</p>
                    </p>
                    <div class="columns">
                        <div class="column">
                            <p><b-icon icon="presentation-play"></b-icon> Vídeo</p>
                            <youtube :video-id="videoId" :player-vars="playerVars" @playing="playing" :height="330" style="height: 85%;"></youtube>
                        </div>
                        <div class="column">
                            <p><b-icon icon="trophy-award"></b-icon> Prêmio de melhor artigo</p>
                            <pdf :src="$root.url + '/files/Best_Paper_Award_WER2020.pdf'"></pdf>
                        </div>
                        <div class="column">
                            <p><b-icon icon="trophy-award"></b-icon> Prêmio de melhor apresentação</p>
                            <pdf :src="$root.url + '/files/Best_Video_Award_WER2020.pdf'"></pdf>
                        </div>
                    </div>

                    <p class="has-text-justified">
                        <p>Em novembro deste mesmo ano (2020) teremos a apresentação do artigo Recomendações de técnicas complementares de elicitação de requisitos em um guia facetado.<sup>[2]</sup> no Congresso Ibero-Americano em Engenharia de Software (CIbSE) na trilha de Engenharia de Requisitos (RET).</p>
                    </p>

                    <hr>

                    <div class="row content">
                        <references title="Referências" :items="[
                            {code: 1, description: 'IGNACIO, Rafael C. Guia Facetado de Técnicas de Elicitação de Requisitos. Universidade Federal de Santa Catarina. 2018'}, 
                            {code: 2, description: 'BRITO, Nathália L. Recomendações de técnicas complementares de elicitação de requisitos em um guia facetado. Universidade Federal de Santa Catarina. 2019'}
                        ]"></references>
                        <br>
                    </div>
                </section>
            </div>
        </section>
    </section>
</template>