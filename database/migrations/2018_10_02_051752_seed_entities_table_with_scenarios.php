<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithScenarios extends Migration
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

        $description = 'Cenários são representações das interações dos usuários com o sistema. Usados para procurar e preparar a narrativa e descrições detalhadas do atual e futuro processo necessário para desenvolvimento do projeto de software. É comumente utilizado após a coleta inicial dos requisitos. São exemplos reais de como o sistema será utilizado. Inclui a descrição completa de todos os processos, ou seja, estado inicial e final, fluxo de eventos, atividades simultâneas, etc. É útil quando o sistema precisa ser descrito a partir da visão do usuário. Para escrever um cenário, é necessário ter um conhecimento básico sobre a tarefa executada pelo sistema e os usuários envolvidos. Deve ser escrito em linguagem natural simples. São muito úteis para validar os requisitos e criar casos de teste. Um cenário começa com um esboço da interação. Durante o processo de elicitação, são adicionados detalhes ao esboço, para criar uma descrição completa dessa interação. 

Em sua forma mais geral, um cenário pode incluir:

1. Uma descrição do que o sistema e os usuários esperam quando o cenário se iniciar.
1. Uma descrição do fluxo normal de eventos no cenário.
1. Uma descrição do que pode dar errado e como isso é tratado.
1. Informações sobre outras atividades que podem acontecer ao mesmo tempo.
1. Uma descrição do estado do sistema quando o cenário acaba.

## Exemplo

Como exemplo de um cenário de texto simples, considere como o cenário a seguir onde retrata a situação em que um sistema pode ser usado para introduzir dados de um novo paciente.

![Exemplo da aplicação da técnica cenário](/images/tecnicas-re/scenarios-01.png)

<sup>[14] [19] [29]</sup>';

        $pros = '- Fácil de entender os requisitos devido a natureza hierárquica.
- O reuso de requisitos diminui o tempo e o custo.
- Não é muito adequada para o desenvolvimento de novos sistemas.
- Esta técnica fornece o contato próximo com os stakeholders, possibilitando a identificação das prioridades.

<sup>[14] [21]</sup>';

        $cons = '- A estrutura hierárquica torna difícil a tarefa de inclusão ou exclusão de requisitos de usuários.
- A técnica se torna complexa a medida que o número de requisitos aumenta.
- Requer uma opinião de especialista ou dados iniciais para elicitar os requisitos.
- É uma técnica muito longa e cansativa.

<sup>[14]</sup>';

        DB::table('entities')->insert([
            'title'             => 'Cenários',
            'slug'              => str_slug($RETechniqueClassification->title . ' Cenários'),
            'short_description' => 'Cenários são representações das interações dos usuários com o sistema usados para procurar e preparar a narrativa e descrições detalhadas do atual e futuro processo necessário para desenvolvimento do projeto de software.',
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
            ->where('slug', str_slug($RETechniqueClassification->title . ' Cenários'))
            ->first();

        $this->values($interview->id, [
            'Categoria' => 'Grupo',
            'Fonte principal' => 'Analistas e Stakeholders',
            'Treinamento na técnica de elicitação' => 'Alto',
            'Experiência do elicitor' => 'Médio',
            'Experiência com técnicas de elicitação' => 'Baixo',
            'Pessoas por sessão' => 'Individual',
            'Consenso entre os stakeholders' => 'Alto',
            'Interesse do stakeholder' => 'Baixo',
            'Especialidade' => 'Iniciante',
            'Articulação' => 'Médio',
            'Disponibilidade de tempo' => 'Alto',
            'Local/Acessibilidade' => 'Perto',
            'Tipo de informação a elicitar' => 'Tática',
            'Nível de informação disponível' => 'Nenhum',
            'Definição do problema' => 'Alto',
            'Restrição de tempo do projeto' => 'Baixo',
            'Tempo de processo' => 'Meio',
        ]);

        $this->values($interview->id, [
            'Experiência do elicitor' => 'Alto',
            'Experiência com técnicas de elicitação' => 'Alto',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Bem informado',
            'Articulação' => 'Alto',
            'Nível de informação disponível' => 'Inferior',
            'Restrição de tempo do projeto' => 'Médio',
        ]);

        $this->values($interview->id, [
            'Especialidade' => 'Especialista',
            'Nível de informação disponível' => 'Superior',
            'Restrição de tempo do projeto' => 'Alto',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Cenários')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Cenários')]);
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
