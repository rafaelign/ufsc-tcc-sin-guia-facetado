<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedFacetsTableWithReTechnique extends Migration
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

        $classification = DB::table('classifications')
            ->select(['id'])
            ->where('slug', str_slug('Técnicas de Elicitação de Requisitos'))
            ->first();

        $this->create($user->id, $classification->id, [
            [
                'title'             => 'Categoria',
                'slug'              => str_slug('Categoria'),
                'description'       => 'Categorias utilizadas nas publicações selecionadas na revisão sistemática.',
                'facet_group_id'    => $this->getFacetGroupId('Geral'),
                'type'              => 'select',
            ],
            [
                'title'             => 'Fonte principal',
                'slug'              => str_slug('Fonte principal'),
                'description'       => 'Fonte principal responsável por fornecer insumos ou conduzir a técnica',
                'facet_group_id'    => $this->getFacetGroupId('Geral'),
                'type'              => 'select',
            ],
            [
                'title'             => 'Tipo de técnica',
                'slug'              => str_slug('Tipo de técnica'),
                'description'       => 'Identifica qual a forma de extração de requisitos',
                'facet_group_id'    => $this->getFacetGroupId('Características gerais da técnica'),
                'type'              => 'checkbutton',
            ],
            [
                'title'             => 'Tipo de dado',
                'slug'              => str_slug('Tipo de dado'),
                'description'       => 'Identifica o tipo do dado extraído',
                'facet_group_id'    => $this->getFacetGroupId('Domínio do problema'),
                'type'              => 'checkbutton',
            ],
            [
                'title'             => 'Comunicação',
                'slug'              => str_slug('Comunicação'),
                'description'       => 'Identifica a direção da comunicação entre os envolvidos',
                'facet_group_id'    => $this->getFacetGroupId('Domínio do problema'),
                'type'              => 'checkbutton',
            ],
            [
                'title'             => 'Treinamento na técnica de elicitação',
                'slug'              => str_slug('Treinamento na técnica de elicitação'),
                'description'       => 'Treinamento prévio e prática do elicitor com a técnica de elicitação',
                'facet_group_id'    => $this->getFacetGroupId('Elicitor'),
                'type'              => 'slider',
            ],
            [
                'title'             => 'Experiência do elicitor',
                'slug'              => str_slug('Experiência do elicitor'),
                'description'       => 'Número de projetos que o elicitor realizou atividades de elicitação',
                'facet_group_id'    => $this->getFacetGroupId('Elicitor'),
                'type'              => 'slider',
            ],
            [
                'title'             => 'Experiência com técnicas de elicitação',
                'slug'              => str_slug('Experiência com técnicas de elicitação'),
                'description'       => 'Número de projetos que o elicitor realizou atividades com determinada técnica',
                'facet_group_id'    => $this->getFacetGroupId('Elicitor'),
                'type'              => 'slider',
            ],
            [
                'title'             => 'Familiaridade com o domínio',
                'slug'              => str_slug('Familiaridade com o domínio'),
                'description'       => 'Número de projetos no mesmo domínio ou no domínio de conhecimento do elicitor',
                'facet_group_id'    => $this->getFacetGroupId('Elicitor'),
                'type'              => 'slider',
            ],
            [
                'title'             => 'Pessoas por sessão',
                'slug'              => str_slug('Pessoas por sessão'),
                'description'       => 'Número de indivíduos que podem participar da sessão de elicitação',
                'facet_group_id'    => $this->getFacetGroupId('Stakeholder'),
                'type'              => 'checkbutton',
            ],
            [
                'title'             => 'Consenso entre os stakeholders',
                'slug'              => str_slug('Consenso entre os stakeholders'),
                'description'       => 'Acordo inicial entre os informantes',
                'facet_group_id'    => $this->getFacetGroupId('Stakeholder'),
                'type'              => 'switch',
            ],
            [
                'title'             => 'Interesse do stakeholder',
                'slug'              => str_slug('Interesse do stakeholder'),
                'description'       => 'Interesse do informante em participar das sessões de elicitação',
                'facet_group_id'    => $this->getFacetGroupId('Stakeholder'),
                'type'              => 'slider',
            ],
            [
                'title'         => 'Especialidade',
                'slug'          => str_slug('Especialidade'),
                'description'   => 'Experiência do informante no problema ou no domínio',
                'facet_group_id'    => $this->getFacetGroupId('Stakeholder'),
                'type'              => 'checkbutton',
            ],
            [
                'title'             => 'Articulação',
                'slug'              => str_slug('Articulação'),
                'description'       => 'Habilidade do informante em passar seu conhecimento',
                'facet_group_id'    => $this->getFacetGroupId('Stakeholder'),
                'type'              => 'slider',
            ],
            [
                'title'             => 'Disponibilidade de tempo',
                'slug'              => str_slug('Disponibilidade de tempo'),
                'description'       => 'Tempo disponível do informante',
                'facet_group_id'    => $this->getFacetGroupId('Stakeholder'),
                'type'              => 'switch',
            ],
            [
                'title'             => 'Local/Acessibilidade',
                'slug'              => str_slug('Local/Acessibilidade'),
                'description'       => 'Distância do informante em relação ao elicitor no processo de coleta de informações',
                'facet_group_id'    => $this->getFacetGroupId('Stakeholder'),
                'type'              => 'checkbutton',
            ],
            [
                'title'             => 'Tipo de informação a elicitar',
                'slug'              => str_slug('Tipo de informação a elicitar'),
                'description'       => 'Tipo de informação que a técnica pode levantar',
                'facet_group_id'    => $this->getFacetGroupId('Domínio do problema'),
                'type'              => 'checkbutton',
            ],
            [
                'title'             => 'Nível de informação disponível',
                'slug'              => str_slug('Nível de informação disponível'),
                'description'       => 'Tipo de categorização de informação disponível antes da execução da técnica',
                'facet_group_id'    => $this->getFacetGroupId('Domínio do problema'),
                'type'              => 'checkbutton',
            ],
            [
                'title'             => 'Definição do problema',
                'slug'              => str_slug('Definição do problema'),
                'description'       => 'Clareza dos objetivos e escopo do projeto',
                'facet_group_id'    => $this->getFacetGroupId('Domínio do problema'),
                'type'              => 'switch',
            ],
            [
                'title'             => 'Restrição de tempo do projeto',
                'slug'              => str_slug('Restrição de tempo do projeto'),
                'description'       => 'Tempo disponível para aplicação da técnica no projeto',
                'facet_group_id'    => $this->getFacetGroupId('Características gerais da técnica'),
                'type'              => 'slider',
            ],
            [
                'title'         => 'Tempo de processo',
                'slug'          => str_slug('Tempo de processo'),
                'description'   => 'Etapa de pré-sessão do processo de elicitação',
                'facet_group_id'    => $this->getFacetGroupId('Características gerais da técnica'),
                'type'              => 'slider',
            ],
            [
                'title'         => 'Frequência de utilização',
                'slug'          => str_slug('Frequência de utilização'),
                'description'   => 'Frequência de utilização da técnica na indústria',
                'facet_group_id'    => $this->getFacetGroupId('Características gerais da técnica'),
                'type'              => 'checkbox',
            ],
        ]);
    }

    private function create($userId, $classificationId, array $facets)
    {
        foreach ($facets as $facet) {
            DB::table('facets')->insert(array_merge($facet, [
                'classification_id' => $classificationId,
                'user_id'       => $userId,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]));
        }
    }

    private function getFacetGroupId(string $title)
    {
        $facetGroup = DB::table('facet_groups')
            ->select(['id'])
            ->where('title', 'LIKE', $title)
            ->first();

        return $facetGroup->id;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $RETechniqueClassification = DB::table('classifications')
            ->select(['id'])
            ->where('slug', str_slug('Técnicas de Elicitação de Requisitos'))
            ->first();

        $REFacets = DB::table('facets')
            ->select(['id'])
            ->where('classification_id', $RETechniqueClassification->id)
            ->get();

        foreach ($REFacets as $facet) {
            DB::table('facets')->delete($facet->id);
        }
    }
}
