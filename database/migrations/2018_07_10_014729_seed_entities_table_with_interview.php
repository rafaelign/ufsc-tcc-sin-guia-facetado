<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithInterview extends Migration
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

        DB::table('entities')->insert([
            'title'             => 'Entrevista',
            'slug'              => str_slug($RETechniqueClassification->title . ' Entrevista'),
            'short_description' => 'As entrevistas geralmente envolvem discussões individuais de um representante da equipe com a parte interessada em um novo sistema (HANSEN; BERENTE; AVITAL, 2014).',
            'description'       => 'Esta técnica foi a mais encontrada através da revisão sistemática. Zowghi e Coulin (2005) destaca que este é, "talvez o método mais comum e estabelecido de elicitação de requisitos", indo de encontro com o que foi identificado na revisão. As entrevistas geralmente envolvem discussões individuais de um representante da equipe com a parte interessada em um novo sistema (HANSEN; BERENTE; AVITAL, 2014). Devido à capacidade desta técnica para obter conhecimento profundo, é considerada como técnica importante para obter e validar os requisitos de software (YOUSUF; ASGER, 2015).',
            'classification_id' => $RETechniqueClassification->id,
            'user_id'           => $user->id,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $interview = DB::table('entities')
            ->select(['id'])
            ->where('slug', str_slug($RETechniqueClassification->title . ' Entrevista'))
            ->first();

        $this->values($interview->id, [
            'Categoria' => 'Tradicional',
            'Fonte principal' => 'Analista com conhecimento no domínio',
            'Tipo de técnica' => 'Direta',
            'Tipo de dado' => 'Qualitativo',
            'Comunicação' => 'Bidirecional',
            'Treinamento na técnica de elicitação' => 'Baixo',
            'Experiência do elicitor' => 'Médio',
            'Experiência com técnicas de elicitação' => 'Baixo',
            'Familiaridade com o domínio' => 'Baixo',
            'Pessoas por sessão' => 'Individual',
            'Consenso entre os stakeholders' => 'Alto',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Especialista',
            'Articulação' => 'Médio',
            'Disponibilidade de tempo' => 'Alto',
            'Local/Acessibilidade' => 'Perto',
            'Tipo de informação a elicitar' => 'Básica',
            'Nível de informação disponível' => 'Inferior',
            'Definição do problema' => 'Alto',
            'Restrição de tempo do projeto' => 'Baixo',
            'Tempo de processo' => 'Meio',
        ]);

        $this->values($interview->id, [
            'Tipo de dado' => 'Quantitativo',
            'Especialidade' => 'Bem informado',
            'Tipo de informação a elicitar' => 'Tática',
            'Nível de informação disponível' => 'Superior',
        ]);
    }

    private function values(int $interviewId, array $facetsWithValues)
    {
        foreach ($facetsWithValues as $facet => $value) {
            $facetValues = DB::table('values')
                ->select(['id', 'facet_id'])
                ->where('slug', str_slug($facet . ' ' . $value))
                ->first();

            DB::table('entities_values')->insert([
                'entity_id' => $interviewId,
                'value_id' => $facetValues->id,
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Entrevista')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Entrevista')]);
    }
}
