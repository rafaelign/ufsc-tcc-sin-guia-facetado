<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithFocusGroup extends Migration
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

        $description = 'Nesta técnica um grupo de stakeholders é convidado para uma consulta coletiva onde são abordados assuntos do estado atual das práticas executadas e do que se espera ser executado no projeto. Esta técnica é uma simples adaptação da técnica de entrevistas, mas com um direcionamento para um grupo de stakeholders. Assim como ocorre na técnica de entrevista, o uso de perguntas dirigidas e o papel de facilitador dos analistas tendem a limitar a conversa com os temas previamente estabelecida pela equipe de design. Pode ocorrer da forma tradicional, com todos fisicamente em uma sala ou com os membros alocados remotamente enquanto participam. Para conduzir uma entrevista em grupo, é importante que:

- Selecionar os participantes.
- Definir um facilitador responsável por manter a discussão organizada.
- Gravar a reunião para futuras consultas.
- Definir antecipadamente as diretrizes a serem tratadas e repassar aos participantes na reunião.
- Conduzir a reunião a fim de atingir os objetivos documentando as informações coletadas.
- Compartilhar o relatório com os responsáveis.

## Exemplo

A equipe de marketing de uma organização que lida com laptops aspira a entender o feedback dos clientes sobre as dimensões de uma futura variante de laptops. Em tais situações, informações diretas sobre o mercado podem ser recebidas através da técnica de entrevista em grupo da maneira mais eficaz.

A equipe decide nomear um grupo de oito pessoas que representam seu mercado-alvo para se reunir para uma discussão construtiva. Eles também recebem um facilitador experiente a bordo para esse processo, que supervisionará toda a conversa e estabelecerá inferências concretas. São feitas perguntas sobre as preferências dos participantes, vantagens do laptop sobre os concorrentes de mercado, faixa de preço projetada e outros aspectos cruciais.

<sup>[1] [4]</sup>';

        $pros = '- Ao afastar dos foco individuais, as entrevistas em grupo exploram os problemas de maneira mais ampla e promovem o surgimento de novas questões.
- Tende a dar mais suporte ao modo natural de interação entre os participantes.
- Produz requisitos de qualidade em um período curto de tempo.
- Economiza custo em comparação à realização de entrevistas com o mesmo número de pessoas.
- Eficaz para entender o comportamento, experiências e desejos das pessoas.

<sup>[1] [14]</sup>';

        $cons = '- É preciso muito esforço para reunir todos stakeholders ao mesmo tempo, devido à agenda ocupada e aos aspectos políticos.
- Os participantes podem ter problemas relacionados à confiança e hesitar ao discutir assuntos críticos ou sensíveis.
- Os membros podem ser influenciados por pessoas mais dominantes na reunião, levando a resultados tendenciosos.
- Se o grupo selecionado for muito parecido pode não representar completamente os requisitos.

<sup>[4] [14]</sup>';

        DB::table('entities')->insert([
            'title'             => 'Entrevista em grupo',
            'slug'              => str_slug($RETechniqueClassification->title . ' Entrevista em grupo'),
            'short_description' => 'Nesta técnica um grupo de stakeholders é convidado para uma consulta coletiva onde são abordados assuntos do estado atual das práticas executadas e do que se espera ser executado no projeto.',
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
            ->where('slug', str_slug($RETechniqueClassification->title . ' Entrevista em grupo'))
            ->first();

        $this->values($technique->id, [
            'Categoria' => 'Tradicional',
            'Fonte principal' => 'Facilitador externo',
            'Treinamento na técnica de elicitação' => 'Alto',
            'Experiência do elicitor' => 'Médio',
            'Experiência com técnicas de elicitação' => 'Baixo',
            'Familiaridade com o domínio' => 'Baixo',
            'Pessoas por sessão' => 'Grupo',
            'Consenso entre os stakeholders' => 'Baixo',
            'Interesse do stakeholder' => 'Baixo',
            'Especialidade' => 'Iniciante',
            'Articulação' => 'Médio',
            'Disponibilidade de tempo' => 'Alto',
            'Local/Acessibilidade' => 'Perto',
            'Tipo de informação a elicitar' => 'Tática',
            'Nível de informação disponível' => 'Superior',
            'Definição do problema' => 'Baixo',
            'Restrição de tempo do projeto' => 'Baixo',
            'Tempo de processo' => 'Início',
        ]);

        $this->values($technique->id, [
            'Experiência do elicitor' => 'Alto',
            'Experiência com técnicas de elicitação' => 'Alto',
            'Familiaridade com o domínio' => 'Alto',
            'Pessoas por sessão' => 'Em massa',
            'Consenso entre os stakeholders' => 'Alto',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Bem informado',
            'Articulação' => 'Alto',
            'Tipo de informação a elicitar' => 'Estratégica',
            'Definição do problema' => 'Alto',
            'Tempo de processo' => 'Meio',
        ]);

        $this->values($technique->id, [
            'Especialidade' => 'Especialista',
        ]);

        $this->references($technique->id, [
            [
                'description' => 'HANSEN, S.; BERENTE,',
                'code' => 1
            ],
            [
                'description' => 'YOUSEF, R.; ALMARABEH, T',
                'code' => 2
            ],
            [
                'description' => 'YOUSUF, M.; ASGER, M. Comparison',
                'code' => 3
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
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Entrevista em grupo')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Entrevista em grupo')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Entrevista em grupo')]);
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

    private function references(int $interviewId, array $referencesWithValues)
    {
        foreach ($referencesWithValues as $reference) {
            $getReference = DB::table('references')
                ->select(['id'])
                ->where('description', 'like', trim($reference['description'] . '%'))
                ->first();

            DB::table('entities_references')->insert([
                'entity_id' => $interviewId,
                'reference_id' => $getReference->id,
                'code' => (int) $reference['code'],
            ]);
        }
    }
}
