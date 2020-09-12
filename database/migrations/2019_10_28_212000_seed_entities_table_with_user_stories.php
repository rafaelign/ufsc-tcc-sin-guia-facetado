<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithUserStories extends Migration
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

        $description = 'História de usuário é um método que descreve de forma funcional os requisitos para o cliente ou comprador do projeto. Elas capturam o "quem", "o quê" e "por quê" de um requisito em uma forma concisa e simples. Em consulta com o cliente ou com o product owner, a equipe divide o trabalho a ser realizado em incrementos funcionais chamados "histórias de usuários”. Espera-se que cada história de usuário produza, uma vez implementada, uma contribuição para o valor geral do produto, independentemente da ordem de implementação.

As histórias de usuários são geralmente representadas em uma forma física: um cartão de índice ou lembrete, no qual é escrita uma breve frase descritiva. Isso enfatiza a natureza "atômica" das histórias de usuários e incentiva a manipulação física direta: por exemplo, as decisões sobre priorização são tomadas movendo-se fisicamente os "cartões de história".

Apesar do cartão conter as funcionalidades, este não é o mais importante. Por meio das conversas serão tratados todos os detalhes de cada funcionalidade. Uma história, ainda que sintetizada no cartão, que produz histórias ainda menores, é chamada de épico. Assim, um épico contém vários detalhes a serem descritos em cartões distintos.

O uso de histórias de usuário é comum em equipes de desenvolvimento onde os times de projeto são estruturados e gerenciados através da metodologia de desenvolvimento ágil.';

        $pros = '- São compreensíveis por todos.
- São do tamanho certo para planejamentos e priorizações.
- Funcionam em desenvolvimentos iterativos.
- Encorajam a comunicação verbal.';

        $cons = '- Em um projeto grande com muitas histórias é difícil compreender o relacionamento entre elas.
- É necessário aumentá-las com documentação adicional se a rastreabilidade dos requisitos for exigida pelo processo de desenvolvimento.
- Elas podem não ser interessantes para equipes extremamente grandes.';

        DB::table('entities')->insert([
            'title'             => 'Histórias de usuário',
            'slug'              => str_slug($RETechniqueClassification->title . ' Histórias de usuário'),
            'short_description' => 'História de usuário é um método que descreve de forma funcional os requisitos para o cliente ou comprador do projeto. Elas capturam o "quem", "o quê" e "por quê" de um requisito em uma forma concisa e simples.',
            'description'       => $description,
            'pros'              => $pros,
            'cons'              => $cons,
            'images'            => '[{"src": "/guia/images/tecnicas-re/user_story.png", "title": "Figura 1 - Exemplo de aplicação da técnica Histórias de usuário"}]',
            'classification_id' => $RETechniqueClassification->id,
            'user_id'           => 1,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $technique = DB::table('entities')
            ->select(['id'])
            ->where('slug', str_slug($RETechniqueClassification->title . ' Histórias de usuário'))
            ->first();

        $this->values($technique->id, [
            'Categoria' => 'Grupo',
            'Fonte principal' => 'Analista com conhecimento no domínio',
            'Tipo de técnica' => 'Indireta',
            'Tipo de dado' => 'Qualitativo',
            'Treinamento na técnica de elicitação' => 'Baixo',
            'Experiência do elicitor' => 'Baixo',
            'Experiência com técnicas de elicitação' => 'Baixo',
            'Familiaridade com o domínio' => 'Baixo',
            'Consenso entre os stakeholders' => 'Alto',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Bem informado',
            'Articulação' => 'Alto',
            'Disponibilidade de tempo' => 'Baixo',
            'Tipo de informação a elicitar' => 'Básica',
            'Nível de informação disponível' => 'Inferior',
            'Definição do problema' => 'Alto',
            'Tempo de processo' => 'Início',
        ]);

        $this->values($technique->id, [
            'Experiência do elicitor' => 'Médio',
        ]);


        $this->references($technique->id, [
            [
                'description' => 'CARVALHO, Lorena Adrian Cardoso; BARBOSA, Marcelo Werneck; SILVA, Vinícius Bernardo. Proposta',
                'code' => 1
            ],
            [
                'description' => 'Desconhecido (2019) Agile Glossary and Terminology,',
                'code' => 2
            ],
            [
                'description' => 'Francilvio Alff (2018) Como escrever uma User Story fantástica,',
                'code' => 3
            ],
            [
                'description' => 'COHN, Mike. User stories applied:',
                'code' => 4
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
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Histórias de usuário')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Histórias de usuário')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Histórias de usuário')]);
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
