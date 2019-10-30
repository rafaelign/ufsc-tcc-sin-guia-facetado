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
                    <p class="has-text-justified">
                        Este guia procura apresentar técnicas de elicitação de requisitos e suas respectivas informações de uma maneira didática e simples.
                        A execução da pesquisa demonstrou que existem diversos métodos que podem ser utilizados para elicitar requisitos de software.
                        Outra constatação é que o processo de elicitação de requisitos de um projeto não se restringe a utilização de apenas uma técnica, mas sim de uma combinação entre elas.
                        Por esse motivo o guia também apresenta abordagens de elicitação de requisitos, que nada mais são que técnicas utilizadas em conjunto em um processo de elicitação de requisitos.
                        As abordagens usualmente foram desenvolvidas para um contexto específico de aplicação, porém nada impede que elas sejam testadas e possuam um bom desempenho em contextos diferentes.
                        A classificação facetada nos permite realizar determinados filtros conforme as características mapeadas.
                        Desta forma, a partir de um determinado cenário, os usuários podem definir as características associadas ao seu contexto e obter as técnicas mais adequadas para sua configuração, podendo observar quais técnicas são utilizadas em conjunto com as técnicas encontradas.
                    </p>

                    <h2 class="subtitle"><b-icon icon="target"></b-icon> Público alvo</h2>
                    <div class="columns">
                        <div class="column">
                            <p>Pessoas em geral que procuram informações sobre as técnicas e como elas podem ser aplicadas no contexto de elicitação.</p>

                            <figure class="image">
                                <img :src=" $root.url + '/images/anybody.png'" alt="Fluxo de consulta geral">
                            </figure>

                            <p>O guia também é útil para as pessoas que tem o objetivo de se informas sobre o assunto. Neste grupo estão inclusos estudantes, profissionais da área, entre outras pessoas.</p>
                        </div>
                        <div class="column">
                            <p>Profissionais da área que buscam técnicas para resolver situações enfrentadas durante a elicitação de requisito para um determinado contexto.</p>

                            <figure class="image">
                                <img :src=" $root.url + '/images/professional.png'" alt="Fluxo de consulta para profissionais">
                            </figure>

                            <p>Com informações sobre o contexto em mãos, é possível utilizar a classificação para encontrar as técnicas mais adequadas e obter informações detalhadas sobre as mesmas.</p>
                        </div>
                    </div>

                    <h2 class="subtitle"><b-icon icon="target"></b-icon> Sobre a pesquisa</h2>
                    <p>A pesquisa se divide em duas etapas: A primeira foi a execução de um mapeamento sistemática para coleta de informações sobre as técnicas e posterior classificação das mesmas através da técnica de facetas. Foram encontradas mais de 90 técnicas referenciadas pelos autores como parte da etapa de elicitação de requisitos.</p>
                    <div class="columns">

                        <div class="column">
                            <figure class="image">
                                <img :src="$root.url + '/images/g-tecnicas-frequencia.png'" alt="Gráfico de técnicas de elicitação de requisitos por frequência.">
                            </figure>

                            Estas são as técnicas mais encontradas nos trabalhos coletados. <sup>[1]</sup>
                        </div>
                        <div class="column">
                            <figure class="image">
                                <img :src="$root.url + '/images/np-tecnicas-frequentes.png'" alt="Nuvem de palavras de técnicas de elicitação de requisitos.">
                            </figure>

                            Esta núvem de palavras contém todas técnicas encontradas e seu tamanho é proporcional ao número de artigos que às citam. <sup>[1]</sup>
                        </div>
                    </div>
                    <p>Na segunda etapa foi realizado um segundo mapeamento sistemático, desta vez para encontrar abordagens de elicitação de requisitos que utilizam uma combinação de técnicas. Foram encontradas 35 abordagens, muitas delas com contextos de aplicação específicos. Cerca de 40% destas abordagens foram aplicadas na prática e avaliadas, como é possível observar na figura abaixo. </p>

                    <div class="columns">

                        <div class="column">

                            <figure class="image">
                                <img :src="$root.url + '/images/abordagens-tecnicas.png'" alt="Gráfico de técnicas de elicitação de requisitos por frequência.">
                            </figure>
                            Esta imagem apresenta a relação de abordagens e técnicas de elicitação de requisitos. <sup>[2]</sup>
                        </div>
                        <div class="column">
                            <figure class="image">
                                <img :src="$root.url + '/images/abordagens-avaliadas-aplicadas.png'" alt="Gráfico de técnicas de elicitação de requisitos por frequência.">
                            </figure>
                            Este diagrama de <i>Venn</i> apresenta a relação de abordagens avaliadas e aplicadas na prática dentre as abordagens encontradas. <sup>[2]</sup>
                        </div>
                    </div>
                    
                    <hr>

                    <div class="row content">
                        <references title="Referências" :items="[{code: 1, description: 'IGNACIO, Rafael C. Guia Facetado de Técnicas de Elicitação de Requisitos. Universidade Federal de Santa Catarina. 2018'}, {code: 2, description: 'Brito, Nathália L. Recomendações de técnicas complementares de elicitação de requisitos em um guia facetado. Universidade Federal de Santa Catarina. 2019'}]"></references>

                        <br>

                    </div>
                </section>
            </div>
        </section>
    </section>
</template>