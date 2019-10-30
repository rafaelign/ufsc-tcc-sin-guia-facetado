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

        $description = 'A análise dos documentos para a coleta de requisitos é uma técnica na qual analisa-se a documentação existente para identificar os requisitos do projeto. Se trata de um procedimento sistemático para revisar ou avaliar documentos, que podem estar em material impresso ou digital. Como outros métodos analíticos na pesquisa qualitativa, a análise de documentos exige que os dados sejam examinados e interpretado para obter significado, obter entendimento e desenvolver conhecimento empírico.

É necessário fazer uma análise preliminar para selecionar os documentos mais relevantes para a coleta dos requisitos. Alguns dos documentos comumente analisados são:

- Documentação já existente do sistema;
- Documentos de outro projeto relacionado;
- Legislação relacionada;
- Editais;
- Planos de negócios;
- Contratos.';

        $pros = '- Não consome muito tempo e não envolve muitas pessoas.
- O material é na maioria das vezes de fácil acesso.
- Tem custo muito baixo, sendo na maioria das vezes apenas o tempo do elicitor.
- Documentos são estáveis e exatos.';

        $cons = '- Eles podem não fornecer detalhes suficientes para responder às dúvidas do elicitor.
- Seletividade tendenciosa: elicitores podem escolher selecionar os documentos que mais lhes convém.';

        DB::table('entities')->insert([
            'title'             => 'Análise de Documentos',
            'slug'              => str_slug($RETechniqueClassification->title . ' Análise de Documentos'),
            'short_description' => 'A análise dos documentos para a coleta de requisitos é uma técnica na qual analisa-se a documentação existente para identificar os requisitos do projeto.',
            'description'       => $description,
            'pros'              => $pros,
            'cons'              => $cons,
            'classification_id' => $RETechniqueClassification->id,
            'user_id'           => $user->id,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $technique = DB::table('entities')
            ->select(['id'])
            ->where('slug', str_slug($RETechniqueClassification->title . ' Análise de Documentos'))
            ->first();

        $this->values($technique->id, [
            'Categoria' => 'Tradicional',
            'Fonte principal' => 'Documentação',
            'Tipo de técnica' => 'Indireta',
            'Tipo de dado' => 'Quantitativo',
            'Treinamento na técnica de elicitação' => 'Baixo',
            'Experiência do elicitor' => 'Baixo',
            'Experiência com técnicas de elicitação' => 'Nenhum',
            'Familiaridade com o domínio' => 'Alto',
            'Consenso entre os stakeholders' => 'Baixo',
            'Interesse do stakeholder' => 'Baixo',
            'Especialidade' => 'Iniciante',
            'Articulação' => 'Baixo',
            'Tipo de informação a elicitar' => 'Básica',
            'Nível de informação disponível' => 'Nenhum',
            'Definição do problema' => 'Alto',
            'Tempo de processo' => 'Início',
        ]);

        $this->values($technique->id, [
            'Tempo de processo' => 'Meio',
        ]);


        $this->references($technique->id, [
            [
                'description' => 'BOWEN, Glenn A. Document analysis as a qualitative research method. Qualitative research journal, v. 9, n. 2, p. 27-40, 2009.',
                'code' => 1
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
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Análise de Documentos')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Análise de Documentos')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Análise de Documentos')]);
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
