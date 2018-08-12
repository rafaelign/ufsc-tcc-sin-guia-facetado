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
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Contextual',
                    'value' => 'Contextual',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Grupo',
                    'value' => 'Grupo',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Inovadora',
                    'value' => 'Inovadora',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Tradicional',
                    'value' => 'Tradicional',
                    'type' => 'option', // option | interval
                ],
            ],
            'Fonte principal' => [
                [
                    'title' => 'Analista com conhecimento no domínio',
                    'value' => 'Analista com conhecimento no domínio',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Analistas e Stakeholders',
                    'slug' => str_slug('Analistas e Stakeholders'),
                    'value' => 'Analistas e Stakeholders',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Documentação',
                    'value' => 'Documentação',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Especialista',
                    'value' => 'Especialista',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Facilitador externo',
                    'value' => 'Facilitador externo',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Observador',
                    'value' => 'Observador',
                    'type' => 'option', // option | interval
                ],
            ],
            'Tipo de técnica' => [
                [
                    'title' => 'Direta',
                    'value' => 'Direta',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Indireta',
                    'value' => 'Indireta',
                    'type' => 'option', // option | interval
                ],
            ],
            'Tipo de dado' => [
                [
                    'value' => 'Qualitativo',
                    'title' => 'Qualitativo',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Quantitativo',
                    'value' => 'Quantitativo',
                    'type' => 'option', // option | interval
                ],
            ],
            'Comunicação' => [
                [
                    'title' => 'Bidirecional',
                    'value' => 'Bidirecional',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Unidirecional',
                    'value' => 'Unidirecional',
                    'type' => 'option', // option | interval
                ],
            ],
            'Treinamento na técnica de elicitação' => [
                [
                    'title' => 'Nenhum',
                    'value' => '0',
                    'type' => 'interval', // option | interval
                ],
                [
                    'title' => 'Baixo',
                    'value' => '1',
                    'type' => 'interval', // option | interval
                ],
                [
                    'title' => 'Alto',
                    'value' => '2',
                    'type' => 'interval', // option | interval
                ],
            ],
            'Experiência do elicitor' => [
                [
                    'title' => 'Baixo',
                    'value' => '0',
                    'type' => 'interval', // option | interval
                ],
                [
                    'title' => 'Médio',
                    'value' => '1',
                    'type' => 'interval', // option | interval
                ],
                [
                    'title' => 'Alto',
                    'value' => '2',
                    'type' => 'interval', // option | interval
                ],
            ],
            'Experiência com técnicas de elicitação' => [
                [
                    'title' => 'Nenhum',
                    'value' => '0',
                    'type' => 'interval', // option | interval
                ],
                [
                    'title' => 'Baixo',
                    'value' => '1',
                    'type' => 'interval', // option | interval
                ],
                [
                    'title' => 'Alto',
                    'value' => '2',
                    'type' => 'interval', // option | interval
                ],
            ],
            'Familiaridade com o domínio' => [
                [
                    'title' => 'Nenhum',
                    'value' => '0',
                    'type' => 'interval', // option | interval
                ],
                [
                    'title' => 'Baixo',
                    'value' => '1',
                    'type' => 'interval', // option | interval
                ],
                [
                    'title' => 'Alto',
                    'value' => '2',
                    'type' => 'interval', // option | interval
                ],
            ],
            'Pessoas por sessão' => [
                [
                    'title' => 'Em massa',
                    'value' => 'Em massa',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Grupo',
                    'value' => 'Grupo',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Individual',
                    'value' => 'Individual',
                    'type' => 'option', // option | interval
                ],
            ],
            'Consenso entre os stakeholders' => [
                [
                    'title' => 'Baixo',
                    'value' => 'Baixo',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Alto',
                    'value' => 'Alto',
                    'type' => 'option', // option | interval
                ],
            ],
            'Interesse do stakeholder' => [
                [
                    'title' => 'Nenhum',
                    'value' => '0',
                    'type' => 'interval', // option | interval
                ],
                [
                    'title' => 'Baixo',
                    'value' => '1',
                    'type' => 'interval', // option | interval
                ],
                [
                    'title' => 'Alto',
                    'value' => '2',
                    'type' => 'interval', // option | interval
                ],
            ],
            'Especialidade' => [
                [
                    'title' => 'Especialista',
                    'value' => 'Especialista',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Bem informado',
                    'value' => 'Bem informado',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Iniciante',
                    'value' => 'Iniciante',
                    'type' => 'option', // option | interval
                ],
            ],
            'Articulação' => [
                [
                    'title' => 'Baixo',
                    'value' => '0',
                    'type' => 'interval', // option | interval
                ],
                [
                    'title' => 'Médio',
                    'value' => '1',
                    'type' => 'interval', // option | interval
                ],
                [
                    'title' => 'Alto',
                    'value' => '2',
                    'type' => 'interval', // option | interval
                ],
            ],
            'Disponibilidade de tempo' => [
                [
                    'title' => 'Baixo',
                    'value' => '0',
                    'type' => 'interval', // option | interval
                ],
                [
                    'title' => 'Alto',
                    'value' => '1',
                    'type' => 'interval', // option | interval
                ],
            ],
            'Local/Acessibilidade' => [
                [
                    'title' => 'Longe',
                    'value' => 'Longe',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Perto',
                    'value' => 'Perto',
                    'type' => 'option', // option | interval
                ],
            ],
            'Tipo de informação a elicitar' => [
                [
                    'title' => 'Básica',
                    'value' => 'Básica',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Estratégica',
                    'value' => 'Estratégica',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Tática',
                    'value' => 'Tática',
                    'type' => 'option', // option | interval
                ],
            ],
            'Nível de informação disponível' => [
                [
                    'title' => 'Inferior',
                    'value' => 'Inferior',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Nenhum',
                    'value' => 'Nenhum',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Superior',
                    'value' => 'Superior',
                    'type' => 'option', // option | interval
                ],
            ],
            'Definição do problema' => [
                [
                    'title' => 'Baixo',
                    'value' => '0',
                    'type' => 'interval', // option | interval
                ],
                [
                    'title' => 'Alto',
                    'value' => '1',
                    'type' => 'interval', // option | interval
                ],
            ],
            'Restrição de tempo do projeto' => [
                [
                    'title' => 'Baixo',
                    'value' => '0',
                    'type' => 'interval', // option | interval
                ],
                [
                    'title' => 'Médio',
                    'value' => '1',
                    'type' => 'interval', // option | interval
                ],
                [
                    'title' => 'Alto',
                    'value' => '2',
                    'type' => 'interval', // option | interval
                ],
            ],
            'Tempo de processo' => [
                [
                    'title' => 'Fim',
                    'value' => 'Fim',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Início',
                    'value' => 'Início',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Meio',
                    'value' => 'Meio',
                    'type' => 'option', // option | interval
                ],
            ],
            'Frequência de utilização' => [
                [
                    'title' => 'Conforme a natureza do projeto',
                    'value' => 'Conforme a natureza do projeto',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Nunca',
                    'value' => 'Nunca',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Por projeto',
                    'value' => 'Por projeto',
                    'type' => 'option', // option | interval
                ],
                [
                    'title' => 'Projetos terceirizados',
                    'value' => 'Projetos terceirizados',
                    'type' => 'option', // option | interval
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
