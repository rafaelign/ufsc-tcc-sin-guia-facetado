<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithMeetings extends Migration
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

        $description = 'Uma reunião se caracteriza pelo encontro entre duas ou mais pessoas com a finalidade de apresentar, debater e discutir tópicos relativos ao tema central escolhido. Nas reuniões de elicitação de requisitos, os elicitores têm a oportunidade de questionar os stakeholders e esclarecer as suas dúvidas sobre os requisitos do projeto, para que o seu entendimento sobre os requisitos fique mais claro e para que possam ser tomadas decisões acerca do que será desenvolvido, definindo e priorizando requisitos.

A reunião é uma importante ferramenta de comunicação e, durante a comunicação, as pessoas visam formar um entendimento comum ao compartilhar ideias, discutir, negociar e tomar decisões. A comunicação facilita a tomada de decisão, resultado fundamental de uma reunião, em que estimula, desenvolve e valoriza os profissionais. 

Além da tomada de decisões, algum dos objetivos de uma reunião podem ser: comunicação de decisões, discussões ou capturar a opinião ou versão de outros sobre um determinado tema. Uma parte importante de realizar reuniões é estruturar o tempo da reunião, identificando e gerenciando o conhecimento levantado e recuperando as decisões da reunião em reuniões futuras.

Reuniões são destinadas a serem um mecanismo de produtividade no local de trabalho, porém um estudo afirma que os executivos consideram cerca de 67% das reuniões improdutivas. Essa improdutividade pode acontecer por diversas razões, como participantes realizando outras tarefas junto com a reunião, participantes remotos não estando muito concentrados na reunião ou a falta de planejamento e estruturação da reunião. Algumas boas práticas para reuniões mais produtivas são:

- Agende reuniões curtas, de 30 minutos no máximo;
- Deixe as expectativas da reunião claras;
- Envie materiais previamente, utilizando a reunião apenas para discussão;
- Comece e termine no tempo certo;
- Evite monólogos;
- Se mantenha focado;
- Identifique os pontos chave e itens de ação e comunique os participantes.';

        $pros = '- Integração da equipe.
- Resolução de pendências.
- Comunicados oficiais.
- Surgimento de ideias inovadoras.
- Proximidade do cliente.
- Interatividade.';

        $cons = '- A reunião deve ser bem planejada para não ser improdutiva.
- Os diferentes stakeholders envolvidos em reuniões geralmente não compartilham uma linguagem em comum ou conhecimento sobre o projeto quando essa reuniões ocorrem em fases iniciais do projeto, ou seja, mal entendidos são comuns.
- As anotações produzidas na reuniões podem ficar incompletas, inconsistente ou incorretas, levando a más interpretações.';

        DB::table('entities')->insert([
            'title'             => 'Reuniões',
            'slug'              => str_slug($RETechniqueClassification->title . ' Reuniões'),
            'short_description' => 'Uma reunião se caracteriza pelo encontro entre duas ou mais pessoas com a finalidade de apresentar, debater e discutir tópicos relativos ao tema central escolhido.',
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
            ->where('slug', str_slug($RETechniqueClassification->title . ' Reuniões'))
            ->first();

        $this->values($technique->id, [
            'Categoria' => 'Grupo',
            'Fonte principal' => 'Analistas e Stakeholders',
            'Tipo de técnica' => 'Direta',
            'Tipo de dado' => 'Qualitativo',
            'Comunicação' => 'Bidirecional',
            'Treinamento na técnica de elicitação' => 'Baixo',
            'Experiência do elicitor' => 'Alto',
            'Experiência com técnicas de elicitação' => 'Alto',
            'Familiaridade com o domínio' => 'Baixo',
            'Pessoas por sessão' => 'Grupo',
            'Consenso entre os stakeholders' => 'Alto',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Iniciante',
            'Articulação' => 'Médio',
            'Disponibilidade de tempo' => 'Alto',
            'Local/Acessibilidade' => 'Perto',
            'Tipo de informação a elicitar' => 'Estratégica',
            'Nível de informação disponível' => 'Nenhum',
            'Definição do problema' => 'Baixo',
            'Restrição de tempo do projeto' => 'Baixo',
            'Tempo de processo' => 'Início',
        ]);

        $this->values($technique->id, [
            'Especialidade' => 'Bem informado',
            'Tipo de informação a elicitar' => 'Tática',
            'Local/Acessibilidade' => 'Longe',
        ]);


        $this->references($technique->id, [
            [
                'description' => 'MIURA, N.; KAIYA, H.; SAEKI, M. Building',
                'code' => 1
            ],
            [
                'description' => 'Marcelo Ribeiro de Almeida (2011)',
                'code' => 2
            ],
            [
                'description' => 'YUSOP, N.; MEHBOOB, Z.; ZOWGHI, D. The role of',
                'code' => 3
            ],
            [
                'description' => 'CIBOTTO, R. A. G. (2010). A importância',
                'code' => 4
            ],
            [
                'description' => 'GALL, M.; BERENBACH, B. Towards a framework',
                'code' => 5
            ],
            [
                'description' => 'Maria Perpétua (2018) 10 Excelentes motivos pra você fazer reuniões',
                'code' => 6
            ],
            [
                'description' => 'Laura Montini (2014) What Unproductive Meetings Are Costing You',
                'code' => 7
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
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Reuniões')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Reuniões')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Reuniões')]);
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
