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

Como exemplo de um cenário de texto simples apresentado na **figura 1**, ele retrata a situação em que um sistema pode ser usado para introduzir dados de um novo paciente.

<sup>[1] [2] [4]</sup>';

        $pros = '- Um cenário bem desenvolvido ajuda a organização a serem pró-ativas e trabalharem especificamente para o produto desejado.
- Fornece um bom entendimento sobre a atividade ou evento no fluxo normal, exceções ou caminhos alternativos.
- Pessoas sem conhecimento técnico conseguem compreender.
- Fácil de entender, pois nenhuma linguagem especial é usada para escrever.
- Garante que o sistema seja desenvolvido corretamente, pois a perspectiva do usuário é considerada desde a elicitação de requisitos.


<sup>[2]</sup>';

        $cons = '- É difícil desenhar cenários úteis.
- Não é adequado para todos tipos de projetos.
- Não cobre todos os processos, ou seja, não fornece uma visão completa do futuro do sistema.
- Se desatualizam rápido. As interfaces dos usuários normalmente sofrem alterações com o tempo, tornando necessária a manutenção dos cenários criados.

<sup>[2] [3]</sup>';

        DB::table('entities')->insert([
            'title'             => 'Cenários',
            'slug'              => str_slug($RETechniqueClassification->title . ' Cenários'),
            'short_description' => 'Cenários são representações das interações dos usuários com o sistema usados para procurar e preparar a narrativa e descrições detalhadas do atual e futuro processo necessário para desenvolvimento do projeto de software.',
            'description'       => $description,
            'pros'              => $pros,
            'cons'              => $cons,
            'images'            => '[{"src": "/images/tecnicas-re/scenarios-01.png", "title": "Figura 1 - Exemplo de aplicação da técnica Cenários"}]',
            'classification_id' => $RETechniqueClassification->id,
            'user_id'           => $user->id,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $technique = DB::table('entities')
            ->select(['id'])
            ->where('slug', str_slug($RETechniqueClassification->title . ' Cenários'))
            ->first();

        $this->values($technique->id, [
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

        $this->values($technique->id, [
            'Experiência do elicitor' => 'Alto',
            'Experiência com técnicas de elicitação' => 'Alto',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Bem informado',
            'Articulação' => 'Alto',
            'Nível de informação disponível' => 'Inferior',
            'Restrição de tempo do projeto' => 'Médio',
        ]);

        $this->values($technique->id, [
            'Especialidade' => 'Especialista',
            'Nível de informação disponível' => 'Superior',
            'Restrição de tempo do projeto' => 'Alto',
        ]);

        $this->references($technique->id, [
            [
                'description' => 'REHMAN, T. ur; KHAN, M. N. A.; RIAZ, N',
                'code' => 1
            ],
            [
                'description' => 'YOUSUF, M.; ASGER, M. Comparison',
                'code' => 2
            ],
            [
                'description' => 'ARIF, Q. K. Shams-ul; GAHYYUR, S. Requirements',
                'code' => 3
            ],
            [
                'description' => 'SOMMERVILLE, I.Engenharia de software',
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
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Cenários')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Cenários')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Cenários')]);
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
