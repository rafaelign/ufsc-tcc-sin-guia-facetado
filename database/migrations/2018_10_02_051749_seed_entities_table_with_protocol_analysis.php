<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithProtocolAnalysis extends Migration
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

        $description = 'Esta técnica é executada através de uma análise sobre um sujeito envolvido em alguma tarefa, que durante a execução, explica seus pensamentos acerca de cada passo executado para concluir a atividade. Esta é uma técnica onde o stakeholder executa determinada tarefa na presença do analista e ao concluir, é convidado a conversar sobre os passos realizados explicando cada etapa. Não é uma abordagem orientada para a equipe, mas sim uma abordagem individual para a solução do problema. Ajuda a entender a resolução de problemas em um nível individual, ou seja, como uma pessoa pensa sobre um problema e sua solução.

## Exemplo

Através de uma análise de protocolo, informações sobre o processo são documentadas. Este exemplo retrata como as informações podem ser organizadas após uma sessão previamente agendada e autorizada pelo cliente.

![Exemplo de uma coleta de informações em um processo de análise de protocolo](/images/tecnicas-re/protocol-analysis-01.png)

<sup>[3] [10] [14] [39]</sup>';

        $pros = '- Fácil de implementar.
- Baixo custo, não é necessário ter um equipamento especial.
- Pode ser usado em qualquer estágio do desenvolvimento.
- Útil quando os analistas precisam obter conhecimento sobre o domínio do produto.
- Fornece uma ideia sobre como os usuários percebem a solução e o problema, ou seja, como o sistema deve funcionar na vida real.
- Verbalização direta das atividades inseridas em um determinado contexto de trabalho.

<sup>[14] [15]</sup>';

        $cons = '- Não é adaptado para projetos que possuem cronograma apertado, pois é um processo demorado.
- Tem que acionar o usuário a todo tempo para esclarecer sobre suas ações, decisões e para manter ele falando.
- É adequado para situações em que um indivíduo pode delinear em sua mente todo o cenário do domínio do problema e da solução.
- Não é muito confiável, pois a interpretação depende da introspecção do usuário.
- Incapaz de representar completamente os processos reais.

<sup>[14] [15] [19]</sup>';

        DB::table('entities')->insert([
            'title'             => 'Análise de protocolo',
            'slug'              => str_slug($RETechniqueClassification->title . ' Análise de protocolo'),
            'short_description' => 'É executada através de uma análise sobre um sujeito envolvido em alguma tarefa, que durante a execução, explica seus pensamentos acerca de cada passo executado para concluir a atividade.',
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
            ->where('slug', str_slug($RETechniqueClassification->title . ' Análise de protocolo'))
            ->first();

        $this->values($interview->id, [
            'Categoria' => 'Cognitiva',
            'Fonte principal' => 'Observador',
            'Treinamento na técnica de elicitação' => 'Alto',
            'Experiência do elicitor' => 'Alto',
            'Experiência com técnicas de elicitação' => 'Baixo',
            'Familiaridade com o domínio' => 'Nenhum',
            'Pessoas por sessão' => 'Individual',
            'Consenso entre os stakeholders' => 'Alto',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Especialista',
            'Articulação' => 'Alto',
            'Disponibilidade de tempo' => 'Alto',
            'Local/Acessibilidade' => 'Perto',
            'Tipo de informação a elicitar' => 'Básica',
            'Nível de informação disponível' => 'Nenhum',
            'Definição do problema' => 'Alto',
            'Restrição de tempo do projeto' => 'Baixo',
            'Tempo de processo' => 'Meio',
        ]);

        $this->values($interview->id, [
            'Experiência com técnicas de elicitação' => 'Alto',
            'Familiaridade com o domínio' => 'Baixo',
            'Tipo de informação a elicitar' => 'Tática',
        ]);

        $this->values($interview->id, [
            'Familiaridade com o domínio' => 'Alto',
            'Especialidade' => 'Especialista',
            'Articulação' => 'Alto',
            'Nível de informação disponível' => 'Superior',
            'Restrição de tempo do projeto' => 'Alto',
            'Tipo de informação a elicitar' => 'Estratégica',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Análise de protocolo')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Análise de protocolo')]);
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
