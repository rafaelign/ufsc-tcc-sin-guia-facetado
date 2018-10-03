<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithDocumentAnalysis extends Migration
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

        $description = 'Método comum que consiste em ler e estudar a documentação disponível para o conteúdo que é relevante e útil nas tarefas de levantamento de requisitos. Ela pode ser usada no início do processo de elicitação de requisitos. A informação coletada pode variar conforme a quantidade de documentos disponíveis ou de interações com as pessoas envolvidas. Esta técnica é adequada para sistemas que serão substituídos ou melhorados.

<sup>[3] [14]</sup>';

        $pros = '- Útil quando os stakeholders o usuários não estão disponíveis.
- Ajuda o analista a obter uma compreensão da organização antes de atender os stakeholders.
- Fornece dados históricos úteis.
- Pode ser útil para formular questões para entrevistas.
- Pode ser usada para reutilização de requisitos.
- É uma técnica de baixo custo.

<sup>[14]</sup>';

        $cons = '- Demora para encontrar informações se a quantidade de documentações é alta.
- Às vezes os documentos podem estar desatualizados ou incompletas, muitas vezes invalidando a informação.
- A atualização periódica dos documentos é obrigatória.

<sup>[14]</sup>';

        DB::table('entities')->insert([
            'title'             => 'Análise de documentos',
            'slug'              => str_slug($RETechniqueClassification->title . ' Análise de documentos'),
            'short_description' => 'Método comum que consiste em ler e estudar a documentação disponível para o conteúdo que é relevante e útil nas tarefas de levantamento de requisitos.',
            'description'       => $description,
            'pros'              => $pros,
            'cons'              => $cons,
            'classification_id' => $RETechniqueClassification->id,
            'user_id'           => $user->id,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $interview = DB::table('entities')
            ->select(['id'])
            ->where('slug', str_slug($RETechniqueClassification->title . ' Análise de documentos'))
            ->first();

        $this->values($interview->id, [
            'Categoria' => 'Tradicional',
            'Fonte principal' => 'Documentação',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Análise de documentos')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Análise de documentos')]);
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
}
