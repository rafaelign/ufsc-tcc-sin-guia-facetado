<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedValuesTableWithReTechnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
            'Categoria' => [
                [
                    'title' => 'Cognitiva',
                    'value' => 'Cognitiva',
                ],
                [
                    'title' => 'Contextual',
                    'value' => 'Contextual',
                ],
                [
                    'title' => 'Grupo',
                    'value' => 'Grupo',
                ],
                [
                    'title' => 'Inovadora',
                    'value' => 'Inovadora',
                ],
                [
                    'title' => 'Tradicional',
                    'value' => 'Tradicional',
                ],
            ],
            'Fonte principal' => [
                [
                    'title' => 'Analista com conhecimento no domínio',
                    'value' => 'Analista com conhecimento no domínio',
                ],
                [
                    'title' => 'Analistas e Stakeholders',
                    'value' => 'Analistas e Stakeholders',
                ],
                [
                    'title' => 'Documentação',
                    'value' => 'Documentação',
                ],
                [
                    'title' => 'Especialista',
                    'value' => 'Especialista',
                ],
                [
                    'title' => 'Facilitador externo',
                    'value' => 'Facilitador externo',
                ],
                [
                    'title' => 'Observador',
                    'value' => 'Observador',
                ],
            ],
            'Tipo de técnica' => [
                [
                    'title' => 'Direta',
                    'value' => 'Direta',
                ],
                [
                    'title' => 'Indireta',
                    'value' => 'Indireta',
                ],
            ],
            'Tipo de dado' => [
                [
                    'value' => 'Qualitativo',
                    'title' => 'Qualitativo',
                ],
                [
                    'title' => 'Quantitativo',
                    'value' => 'Quantitativo',
                ],
            ],
            'Comunicação' => [
                [
                    'title' => 'Bidirecional',
                    'value' => 'Bidirecional',
                ],
                [
                    'title' => 'Unidirecional',
                    'value' => 'Unidirecional',
                ],
            ],
            'Treinamento na técnica de elicitação' => [
                [
                    'title' => 'Nenhum',
                    'value' => '0',
                ],
                [
                    'title' => 'Baixo',
                    'value' => '1',
                ],
                [
                    'title' => 'Alto',
                    'value' => '2',
                ],
            ],
            'Experiência do elicitor' => [
                [
                    'title' => 'Baixo',
                    'value' => '0',
                ],
                [
                    'title' => 'Médio',
                    'value' => '1',
                ],
                [
                    'title' => 'Alto',
                    'value' => '2',
                ],
            ],
            'Experiência com técnicas de elicitação' => [
                [
                    'title' => 'Nenhum',
                    'value' => '0',
                ],
                [
                    'title' => 'Baixo',
                    'value' => '1',
                ],
                [
                    'title' => 'Alto',
                    'value' => '2',
                ],
            ],
            'Familiaridade com o domínio' => [
                [
                    'title' => 'Nenhum',
                    'value' => '0',
                ],
                [
                    'title' => 'Baixo',
                    'value' => '1',
                ],
                [
                    'title' => 'Alto',
                    'value' => '2',
                ],
            ],
            'Pessoas por sessão' => [
                [
                    'title' => 'Em massa',
                    'value' => 'Em massa',
                ],
                [
                    'title' => 'Grupo',
                    'value' => 'Grupo',
                ],
                [
                    'title' => 'Individual',
                    'value' => 'Individual',
                ],
            ],
            'Consenso entre os stakeholders' => [
                [
                    'title' => 'Baixo',
                    'value' => 'Baixo',
                ],
                [
                    'title' => 'Alto',
                    'value' => 'Alto',

                ],
            ],
            'Interesse do stakeholder' => [
                [
                    'title' => 'Nenhum',
                    'value' => '0',
                ],
                [
                    'title' => 'Baixo',
                    'value' => '1',
                ],
                [
                    'title' => 'Alto',
                    'value' => '2',
                ],
            ],
            'Especialidade' => [
                [
                    'title' => 'Especialista',
                    'value' => 'Especialista',
                ],
                [
                    'title' => 'Bem informado',
                    'value' => 'Bem informado',
                ],
                [
                    'title' => 'Iniciante',
                    'value' => 'Iniciante',
                ],
            ],
            'Articulação' => [
                [
                    'title' => 'Baixo',
                    'value' => '0',
                ],
                [
                    'title' => 'Médio',
                    'value' => '1',
                ],
                [
                    'title' => 'Alto',
                    'value' => '2',
                ],
            ],
            'Disponibilidade de tempo' => [
                [
                    'title' => 'Baixo',
                    'value' => '0',
                ],
                [
                    'title' => 'Alto',
                    'value' => '1',
                ],
            ],
            'Local/Acessibilidade' => [
                [
                    'title' => 'Longe',
                    'value' => 'Longe',
                ],
                [
                    'title' => 'Perto',
                    'value' => 'Perto',
                ],
            ],
            'Tipo de informação a elicitar' => [
                [
                    'title' => 'Básica',
                    'value' => 'Básica',
                ],
                [
                    'title' => 'Estratégica',
                    'value' => 'Estratégica',
                ],
                [
                    'title' => 'Tática',
                    'value' => 'Tática',
                ],
            ],
            'Nível de informação disponível' => [
                [
                    'title' => 'Inferior',
                    'value' => 'Inferior',
                ],
                [
                    'title' => 'Nenhum',
                    'value' => 'Nenhum',
                ],
                [
                    'title' => 'Superior',
                    'value' => 'Superior',
                ],
            ],
            'Definição do problema' => [
                [
                    'title' => 'Baixo',
                    'value' => '0',
                ],
                [
                    'title' => 'Alto',
                    'value' => '1',
                ],
            ],
            'Restrição de tempo do projeto' => [
                [
                    'title' => 'Baixo',
                    'value' => '0',
                ],
                [
                    'title' => 'Médio',
                    'value' => '1',
                ],
                [
                    'title' => 'Alto',
                    'value' => '2',
                ],
            ],
            'Tempo de processo' => [
                [
                    'title' => 'Início',
                    'value' => '0',
                ],
                [
                    'title' => 'Meio',
                    'value' => '1',
                ],
                [
                    'title' => 'Fim',
                    'value' => '2',
                ],
            ],
            'Frequência de utilização' => [
                [
                    'title' => 'Conforme a natureza do projeto',
                    'value' => 'Conforme a natureza do projeto',
                ],
                [
                    'title' => 'Nunca',
                    'value' => 'Nunca',
                ],
                [
                    'title' => 'Por projeto',
                    'value' => 'Por projeto',
                ],
                [
                    'title' => 'Projetos terceirizados',
                    'value' => 'Projetos terceirizados',
                ],
            ],
        ];

        foreach ($data as $facet => $values) {
            $this->create($facet, $values);
        }
    }

    private function getFacetIdByTitle(string $title)
    {
        $facet = DB::table('facets')
            ->select(['id'])
            ->where('slug', 'LIKE', str_slug($title))
            ->first();

        return $facet->id;
    }

    private function create($facetTitle, $values)
    {
        $facetId = $this->getFacetIdByTitle($facetTitle);

        foreach ($values as $value) {
            DB::table('values')->insert(array_merge($value, [
                'facet_id'      => $facetId,
                'slug'          => str_slug($facetTitle . ' ' . $value['title']),
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]));
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $RETechniqueCollection = DB::table('collections')
            ->select(['id'])
            ->where('slug', str_slug('Técnicas de Elicitação de Requisitos'))
            ->first();

        $REFacets = DB::table('facets')
            ->select(['id'])
            ->where('collection_id', $RETechniqueCollection->id)
            ->get();

        foreach ($REFacets as $facet) {
            DB::delete('DELETE FROM `values` WHERE facet_id = ?', [$facet->id]);
        }
    }
}
