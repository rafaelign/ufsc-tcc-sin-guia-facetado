<script>
import Breadcrumb from "../components/Breadcrumb";
import References from "../components/References";
import pdf from "vue-pdf";

export default {
  components: {
    Breadcrumb,
    References,
    pdf,
  },
  data() {
    return {
      wer2020id: "4-z2jbOZUY4",
      cibseid: "0dwzR4IVTTI?t=100",
      playerVars: {
        autoplay: 0,
      },
    };
  },
  methods: {
    playing() {
      console.log("o/ we are watching!!!");
    },
  },
};
</script>
<template>
    <section v-if="this.$store.getters.isLoaded">
        <section class="hero">
            <div class="hero-body">
                <breadcrumb :items="[
                    { url: '#', title: 'Guia Facetado de Engenharia de Requisitos', active: true },
                ]"></breadcrumb>

                <section class="content">
                    <h1 class="title"><b-icon icon="presentation"></b-icon> Publicações</h1>
                    <p class="has-text-justified">
                        <p>Em agosto de 2020 apresentamos o artigo intitulado Guia Facetado de Técnicas de Elicitação de Requisitos.<sup>[1]</sup> no 23rd Workshop em Engenharia de Requisitos (WER) que ocorreu no período de 24 à 28 de agosto de 2020. O artigo foi muito bem recebido pela comunidade do evento. Por fim, tivemos a grata surpresa de sermos premiados duas vezes com os títulos de melhor artigo e melhor apresentação em vídeo.</p>
                    </p>
                    <div class="columns">
                        <div class="column" style="min-height: 430px;">
                            <p><b-icon icon="presentation-play"></b-icon> Vídeo</p>
                            <youtube :video-id="wer2020id" :player-vars="playerVars" @playing="playing" :height="330" style="height: 85% !important;"></youtube>
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
                        <p>Em novembro deste mesmo ano (2020) tivemos a apresentação do artigo Recomendações de técnicas complementares de elicitação de requisitos em um guia facetado.<sup>[2]</sup> no Congresso Ibero-Americano em Engenharia de Software (CIbSE) na trilha de Engenharia de Requisitos (RET).</p>
                    </p>
                    <div class="columns">
                        <div class="column" style="min-height: 430px;">
                            <p><b-icon icon="presentation-play"></b-icon> Vídeo</p>
                            <youtube :video-id="cibseid" :player-vars="playerVars" @playing="playing" :height="330" style="height: 85% !important;"></youtube>
                        </div>
                        <div class="column"></div>
                        <div class="column"></div>
                    </div>

                    <hr>

                    <div class="row content">
                        <references title="Referências" :items="[
                            {code: 1, description: 'IGNÁCIO, R.C.; BENITTI, F.B.V. Improving the selection of requirements elicitation techniques: a faceted guide. Anais do WER20 - Workshop em Engenharia de Requisitos, São José dos Campos, SP, Brasil, Agosto 24-28, 2020. http://wer.inf.puc-rio.br/WERpapers/artigos/artigos_WER20/01_WER_2020_paper_1.pdf'}, 
                            {code: 2, description: 'BRITO, N.L.; BENITTI, F.B.V. In Proceedings XXIII Ibero-American Conference on Software Engineering (CIbSE 2020). Curitiba, Nov. 2020. http://cibse2020.ppgia.pucpr.br/images/artigos/7/S07_P1.pdf'}
                        ]"></references>
                        <br>
                    </div>
                </section>
            </div>
        </section>
    </section>
</template>