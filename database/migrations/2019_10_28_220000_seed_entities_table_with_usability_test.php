<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithUsabilityTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = DB::table('users')
            ->select(['id'])
            ->where('email', 'admin@mailinator.com')
            ->first();

        $RETechniqueClassification= DB::table('classifications')
            ->select(['id', 'title'])
            ->where('slug', str_slug('Técnicas de Elicitação de Requisitos'))
            ->first();

        $description = 'O teste de usabilidade refere-se à avaliação de um protótipo, produto ou serviço testando-o com usuários representativos. Normalmente, durante um teste, os participantes tentam concluir tarefas típicas enquanto os observadores assistem, ouvem e fazem anotações. O objetivo é identificar quaisquer problemas de usabilidade, coletar dados qualitativos e quantitativos e determinar a satisfação do participante com o produto.

Na etapa de elicitação de requisitos, o teste de usabilidade é utilizado para apresentar ao usuário um protótipo ou uma simulação da solução e observar se existem requisitos que não foram levantados anteriormente, perguntando a opinião do usuário sobre a solução proposta no protótipo apresentado. 

Para executar um teste de usabilidade eficaz, é necessário desenvolver um plano de teste sólido, recrutar participantes, analisar e relatar suas descobertas. Uma das primeiras etapas de cada rodada de testes de usabilidade é desenvolver um plano para o teste. O objetivo do plano é documentar o que você fará, como realizar o teste, quais métricas você quer capturar, número de participantes que você testará e quais cenários serão testados.

O teste de usabilidade permite que as equipes de design e desenvolvimento identifiquem os problemas antes de serem codificados. Quanto mais cedo os problemas são identificados e corrigidos, mais baratas serão as correções em termos de tempo da equipe e possível impacto no cronograma. Desta forma, realizar testes de usabilidade na etapa de elicitação de requisitos permite que requisitos adicionais e de grande importância sejam identificados antes do início do desenvolvimento. 

## Como aplicar?

Primeiro é necessário planejar o teste de usabilidade. Um plano de teste de usabilidade possui usualmente as seguintes informações:

- Escopo do teste, definindo o que será testado;
- Propósito, que representa o principal objetivo do teste;
- Data e local;
- Descrição das sessões, definindo quanto tempo cada uma deve levar;
- Equipamento necessário;
- Participantes e papéis de cada participante;
- Métricas que devem ser geradas a partir dos resultados.

Depois que o plano de teste foi desenvolvido é necessário recrutar os participantes e selecionar uma técnica de moderação do teste. Existem algumas técnicas amplamente utilizadas como Concurrent Think Aloud (CTA), que incentiva o usuário a “pensar alto” enquanto utiliza o sistema e Retrospective Think Aloud (RTA), que é onde o moderador repassa os passos com o participante após a realização do teste. Após essas definições, é interessante realizar um piloto do teste e então realizar o teste propriamente dito.';

        $pros = '- Identificar se os participantes conseguem completar as tarefas com sucesso.
- Identificar quanto tempo os participantes levam para completar as tarefas.
- Descobrir o quanto os participantes estão satisfeitos com o sistema.
- Identificar mudanças necesśarias para melhorar a performance do sistema.';

        $cons = '- É necessário bastante tempo para planejar e aplicar o teste de usabilidade.
- Pode ter um custo elevado se envolver a compensação e o transporte de participantes.
- Requer equipamentos de monitoramento e gravação.';

        DB::table('entities')->insert([
            'title'             => 'Teste de usabilidade',
            'slug'              => str_slug($RETechniqueClassification->title . ' Teste de usabilidade'),
            'short_description' => 'O teste de usabilidade refere-se à avaliação de um protótipo, produto ou serviço testando-o com usuários representativos.',
            'description'       => $description,
            'pros'              => $pros,
            'cons'              => $cons,
            'classification_id' => $RETechniqueClassification->id,
            'user_id'           => 1,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $technique = DB::table('entities')
            ->select(['id'])
            ->where('slug', str_slug($RETechniqueClassification->title . ' Teste de usabilidade'))
            ->first();

        $this->values($technique->id, [
            'Categoria' => 'Contextual',
            'Fonte principal' => 'Analistas e Stakeholders',
            'Tipo de técnica' => 'Direta',
            'Tipo de dado' => 'Qualitativo',
            'Comunicação' => 'Unidirecional',
            'Treinamento na técnica de elicitação' => 'Alto',
            'Experiência do elicitor' => 'Médio',
            'Experiência com técnicas de elicitação' => 'Baixo',
            'Familiaridade com o domínio' => 'Alto',
            'Consenso entre os stakeholders' => 'Alto',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Bem informado',
            'Articulação' => 'Médio',
            'Disponibilidade de tempo' => 'Alto',
            'Tipo de informação a elicitar' => 'Tática',
            'Nível de informação disponível' => 'Superior',
            'Definição do problema' => 'Alto',
            'Tempo de processo' => 'Fim',
        ]);


        $this->references($technique->id, [
            [
                'description' => 'Desconhecido (2017) Usability Testing,  Disponível em: https://www.usability.gov/how-to-and-tools/methods/usability-testing.html# (Acessado: 23 de Outubro de 2019).',
                'code' => 1
            ],
            [
                'description' => 'Elisa Volpato (2014) Teste de usabilidade: o que é e para que serve?, Disponível em: https://brasil.uxdesign.cc/teste-de-usabilidade-o-que-%C3%A9-e-para-que-serve-de3622e4298b (Acessado: 23 de Outubro de 2019).',
                'code' => 2
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Teste de usabilidade')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Teste de usabilidade')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Teste de usabilidade')]);
    }

    private function values(int $id, array $facetsWithValues)
    {
        foreach ($facetsWithValues as $facet => $value) {
            $facetValues = DB::table('values')
                ->select(['id', 'facet_id'])
                ->where('slug', str_slug($facet . ' ' . $value))
                ->first();

            DB::table('entities_values')->insert([
                'entity_id' => $id,
                'value_id' => $facetValues->id,
            ]);
        }
    }

    private function references(int $id, array $referencesWithValues)
    {
        foreach ($referencesWithValues as $reference) {
            $getReference = DB::table('references')
                ->select(['id'])
                ->where('description', 'like', trim($reference['description'] . '%'))
                ->first();

            DB::table('entities_references')->insert([
                'entity_id' => $id,
                'reference_id' => $getReference->id,
                'code' => (int) $reference['code'],
            ]);
        }
    }
}
