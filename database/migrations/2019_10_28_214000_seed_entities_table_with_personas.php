<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithPersonas extends Migration
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

        $description = 'Personas são arquétipos, personagens ficcionais, concebidos a partir da síntese de comportamentos observados entre consumidores com perfis extremos. Elas representam as motivações, desejos, expectativas e necessidades, reunindo características significativas de um grupo mais abrangente, possibilitando que sejam traçados perfis de usuário. Esta técnica fornece uma compreensão dos usuários do sistema em termos de suas características, necessidades e objetivos, para permitir que os engenheiros de software e desenvolvedores de software possam projetar e implementar um sistema que atenda bem às necessidades dos usuários.

Personas são usadas em sua maioria para ajudar todas as partes envolvidas no projeto a entender, ilustrar e esclarecer os objetivos dos usuários, assim como seu comportamento, atitudes e motivação. 

Criar Personas consiste principalmente de coleta de dados sobre os usuários para ganhar uma compreensão de suas características, sendo através de entrevistas, observação, análise de documentos, etc. Com os dados coletados é possível definir as descrições específicas de grupos de usuários.

Para que a técnica seja realmente eficaz, deve ser mantido o foco sobre estas personas ao longo do processo de desenvolvimento de software, para que suas necessidades e frustrações sejam sempre lembradas. Para facilitar essa lembrança, a persona geralmente recebe um nome e características físicas e sociais.';

        $pros = '- Descrição vívida e altamente memorável do usuário sendo considerada no processo de desenvolvimento.
- São fáceis de entender e simplificam a comunicação entre a equipe de desenvolvimento e a tomada de decisão em relação ao design do produto.
- Podem ser apresentadas em diversas maneiras, não necessitam de ferramentas complexas.
- Leva a noção de quem é o usuário para membros da equipe que não tem contato com ele.';

        $cons = '- Deve ser realizada uma pesquisa prévia para entender os perfis de usuário.
- Não será útil se for construída com base em achismos.
- Um projeto pode ter vários usuários muito diferentes e isso pode aumentar a complexidade da definição das personas.';

        DB::table('entities')->insert([
            'title'             => 'Personas',
            'slug'              => str_slug($RETechniqueClassification->title . ' Personas'),
            'short_description' => 'Personas são arquétipos, personagens ficcionais, concebidos a partir da síntese de comportamentos observados entre consumidores com perfis extremos.',
            'description'       => $description,
            'pros'              => $pros,
            'cons'              => $cons,
            'images'            => '[{"src": "/guia/images/tecnicas-re/personas.png", "title": "Figura 1 - Exemplo de uma Persona"}]',
            'classification_id' => $RETechniqueClassification->id,
            'user_id'           => $user->id,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $technique = DB::table('entities')
            ->select(['id'])
            ->where('slug', str_slug($RETechniqueClassification->title . ' Personas'))
            ->first();

        $this->values($technique->id, [
            'Categoria' => 'Cognitiva',
            'Fonte principal' => 'Observador',
            'Tipo de técnica' => 'Indireta',
            'Tipo de dado' => 'Quantitativo',
            'Treinamento na técnica de elicitação' => 'Alto',
            'Experiência do elicitor' => 'Médio',
            'Experiência com técnicas de elicitação' => 'Alto',
            'Familiaridade com o domínio' => 'Alto',
            'Consenso entre os stakeholders' => 'Baixo',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Bem informado',
            'Articulação' => 'Médio',
            'Disponibilidade de tempo' => 'Baixo',
            'Tipo de informação a elicitar' => 'Estratégica',
            'Nível de informação disponível' => 'Inferior',
            'Definição do problema' => 'Baixo',
            'Tempo de processo' => 'Início',
        ]);

        $this->values($technique->id, [
            'Tipo de informação a elicitar' => 'Tática',
        ]);


        $this->references($technique->id, [
            [
                'description' => 'Anderson Felipe (2018) Design Thinking Assistant for Requirements Elicitation, Disponível em: https://sites.google.com/site/dta4re/tecnicas-de-design-thinking/personas (Acessado: 23 de Outubro de 2019).',
                'code' => 1
            ],
            [
                'description' => 'SCHNEIDEWIND, Lydia et al. How personas support requirements engineering.',
                'code' => 2
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
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Personas')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Personas')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Personas')]);
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
