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
                'references'        => [],
            ],
            [
                'title'             => 'Fonte principal',
                'slug'              => str_slug('Fonte principal'),
                'description'       => 'Fonte principal responsável por fornecer insumos ou conduzir a técnica. [3]',
                'facet_group_id'    => $this->getFacetGroupId('Geral'),
                'type'              => 'select',
                'references'        => [['description' => 'MRAYAT, O. I. A.; NORWAWI, N.; BASIR', 'code' => 3]]
            ],
            [
                'title'             => 'Tipo de técnica',
                'slug'              => str_slug('Tipo de técnica'),
                'description'       => 'Identifica qual a forma de extração de requisitos. [1]',
                'facet_group_id'    => $this->getFacetGroupId('Características gerais da técnica'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'ABBASI, M. A. et al. Assessment of requirement', 'code' => 1]],
            ],
            [
                'title'             => 'Tipo de dado',
                'slug'              => str_slug('Tipo de dado'),
                'description'       => 'Identifica o tipo do dado extraído [1]',
                'facet_group_id'    => $this->getFacetGroupId('Domínio do problema'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'ABBASI, M. A. et al. Assessment of requirement', 'code' => 1]],
            ],
            [
                'title'             => 'Comunicação',
                'slug'              => str_slug('Comunicação'),
                'description'       => 'Identifica a direção da comunicação entre os envolvidos. [1]',
                'facet_group_id'    => $this->getFacetGroupId('Domínio do problema'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'ABBASI, M. A. et al. Assessment of requirement', 'code' => 1]],
            ],
            [
                'title'             => 'Treinamento na técnica de elicitação',
                'slug'              => str_slug('Treinamento na técnica de elicitação'),
                'description'       => 'Treinamento prévio e prática do elicitor com a técnica de elicitação [2]',
                'facet_group_id'    => $this->getFacetGroupId('Elicitor'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'CARRIZO, D.; DIESTE, O.; JURISTO, N', 'code' => 2]],
            ],
            [
                'title'             => 'Experiência do elicitor',
                'slug'              => str_slug('Experiência do elicitor'),
                'description'       => 'Número de projetos que o elicitor realizou atividades de elicitação [2]',
                'facet_group_id'    => $this->getFacetGroupId('Elicitor'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'CARRIZO, D.; DIESTE, O.; JURISTO, N', 'code' => 2]],
            ],
            [
                'title'             => 'Experiência com técnicas de elicitação',
                'slug'              => str_slug('Experiência com técnicas de elicitação'),
                'description'       => 'Número de projetos que o elicitor realizou atividades com determinada técnica. [2]',
                'facet_group_id'    => $this->getFacetGroupId('Elicitor'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'CARRIZO, D.; DIESTE, O.; JURISTO, N', 'code' => 2]],
            ],
            [
                'title'             => 'Familiaridade com o domínio',
                'slug'              => str_slug('Familiaridade com o domínio'),
                'description'       => 'Número de projetos no mesmo domínio ou no domínio de conhecimento do elicitor. [2]',
                'facet_group_id'    => $this->getFacetGroupId('Elicitor'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'CARRIZO, D.; DIESTE, O.; JURISTO, N', 'code' => 2]],
            ],
            [
                'title'             => 'Pessoas por sessão',
                'slug'              => str_slug('Pessoas por sessão'),
                'description'       => 'Número de indivíduos que podem participar da sessão de elicitação. [2]',
                'facet_group_id'    => $this->getFacetGroupId('Stakeholder'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'CARRIZO, D.; DIESTE, O.; JURISTO, N', 'code' => 2]],
            ],
            [
                'title'             => 'Consenso entre os stakeholders',
                'slug'              => str_slug('Consenso entre os stakeholders'),
                'description'       => 'Acordo inicial entre os informantes. [2]',
                'facet_group_id'    => $this->getFacetGroupId('Stakeholder'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'CARRIZO, D.; DIESTE, O.; JURISTO, N', 'code' => 2]],
            ],
            [
                'title'             => 'Interesse do stakeholder',
                'slug'              => str_slug('Interesse do stakeholder'),
                'description'       => 'Interesse do informante em participar das sessões de elicitação. [2]',
                'facet_group_id'    => $this->getFacetGroupId('Stakeholder'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'CARRIZO, D.; DIESTE, O.; JURISTO, N', 'code' => 2]],
            ],
            [
                'title'         => 'Especialidade',
                'slug'          => str_slug('Especialidade'),
                'description'   => 'Experiência do informante no problema ou no domínio. [2]',
                'facet_group_id'    => $this->getFacetGroupId('Stakeholder'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'CARRIZO, D.; DIESTE, O.; JURISTO, N', 'code' => 2]],
            ],
            [
                'title'             => 'Articulação',
                'slug'              => str_slug('Articulação'),
                'description'       => 'Habilidade do informante em passar seu conhecimento. [2]',
                'facet_group_id'    => $this->getFacetGroupId('Stakeholder'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'CARRIZO, D.; DIESTE, O.; JURISTO, N', 'code' => 2]],
            ],
            [
                'title'             => 'Disponibilidade de tempo',
                'slug'              => str_slug('Disponibilidade de tempo'),
                'description'       => 'Tempo disponível do informante. [2]',
                'facet_group_id'    => $this->getFacetGroupId('Stakeholder'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'CARRIZO, D.; DIESTE, O.; JURISTO, N', 'code' => 2]],
            ],
            [
                'title'             => 'Local/Acessibilidade',
                'slug'              => str_slug('Local/Acessibilidade'),
                'description'       => 'Distância do informante em relação ao elicitor no processo de coleta de informações. [2]',
                'facet_group_id'    => $this->getFacetGroupId('Stakeholder'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'CARRIZO, D.; DIESTE, O.; JURISTO, N', 'code' => 2]],
            ],
            [
                'title'             => 'Tipo de informação a elicitar',
                'slug'              => str_slug('Tipo de informação a elicitar'),
                'description'       => 'Tipo de informação que a técnica pode levantar. [2]',
                'facet_group_id'    => $this->getFacetGroupId('Domínio do problema'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'CARRIZO, D.; DIESTE, O.; JURISTO, N', 'code' => 2]],
            ],
            [
                'title'             => 'Nível de informação disponível',
                'slug'              => str_slug('Nível de informação disponível'),
                'description'       => 'Tipo de categorização de informação disponível antes da execução da técnica. [2]',
                'facet_group_id'    => $this->getFacetGroupId('Domínio do problema'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'CARRIZO, D.; DIESTE, O.; JURISTO, N', 'code' => 2]],
            ],
            [
                'title'             => 'Definição do problema',
                'slug'              => str_slug('Definição do problema'),
                'description'       => 'Clareza dos objetivos e escopo do projeto. [2]',
                'facet_group_id'    => $this->getFacetGroupId('Domínio do problema'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'CARRIZO, D.; DIESTE, O.; JURISTO, N', 'code' => 2]],
            ],
            [
                'title'             => 'Restrição de tempo do projeto',
                'slug'              => str_slug('Restrição de tempo do projeto'),
                'description'       => 'Tempo disponível para aplicação da técnica no projeto. [2]',
                'facet_group_id'    => $this->getFacetGroupId('Características gerais da técnica'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'CARRIZO, D.; DIESTE, O.; JURISTO, N', 'code' => 2]],
            ],
            [
                'title'         => 'Tempo de processo',
                'slug'          => str_slug('Tempo de processo'),
                'description'   => 'Etapa de pré-sessão do processo de elicitação. [2]',
                'facet_group_id'    => $this->getFacetGroupId('Características gerais da técnica'),
                'type'              => 'checkbutton',
                'references'        => [['description' => 'CARRIZO, D.; DIESTE, O.; JURISTO, N', 'code' => 2]],
            ],
        ]);
    }

    private function create($userId, $classificationId, array $facets)
    {
        foreach ($facets as $facet) {
            $references = isset($facet['references']) ? $facet['references'] : [];
            if (isset($facet['references'])) {
                unset($facet['references']);
            }

            DB::table('facets')->insert(array_merge($facet, [
                'classification_id' => $classificationId,
                'user_id'       => $userId,
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now(),
            ]));

            $this->references($facet['slug'], $references);
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
        DB::table('facets_references')->delete();

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

    private function references(string $facet, array $references)
    {
        $getFacet = DB::table('facets')
            ->select(['id'])
            ->where('slug', 'like', str_slug(trim($facet)))
            ->first();

        foreach ($references as $reference) {
            $getReference = DB::table('references')
                ->select(['id'])
                ->where('description', 'like', trim($reference['description'] . '%'))
                ->first();

            DB::table('facets_references')->insert([
                'facet_id' => $getFacet->id,
                'reference_id' => $getReference->id,
                'code' => (int) $reference['code'],
            ]);
        }
    }
}
