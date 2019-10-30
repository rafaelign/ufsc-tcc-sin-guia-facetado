<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithWorkshops extends Migration
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

        $description = 'O workshop é uma espécie de seminário, grupo de discussão ou colóquio em que um palestrante apresenta um conteúdo específico e incentiva a reflexão no grupo. Ele enfatiza a troca de ideias e a demonstração e aplicação de técnicas e habilidades. A pessoa que vai participar de um workshop pretende adquirir conhecimento sobre o assunto abordado. Um workshop é diferente de uma palestra, pois no workshop a platéia é convidada a participar do evento ativamente e não são meros espectadores, eles interagem com o que está sendo apresentado. Ao colocar os usuários de um sistema como a "platéia" do workshop, é possível coletar requisitos com base no que os usuários comentam, onde pode ser observada uma oportunidade de melhoria ou solução para algum problema existente.

Um workshop de requisitos é uma reunião de grupo facilitada. O processo de grupo de cada oficina deve ser projetado de maneira personalizada para o grupo específico que precisa fornecer requisitos para um determinado projeto. As interações na sessão permitem aos participantes descobrir, elaborar, esclarecer e fechar os requisitos do projeto.

A maioria dos workshops têm entre 7 e 12 participantes. Cada pessoa adicional pode adicionar mais tempo ao workshop ou reduzir o número de entregas.

## Como aplicar?

Para realizar um workshop é interessante a definição de um plano de ensino – ou seja, a estruturação dos temas, subtemas e das atividades que serão abordadas ao longo do evento. Para isso, considere os seguintes pontos:

- Qual é o tema principal do workshop?
- Quais assuntos devem ser abordados dentro desse tema?
- Quem irá participar do workshop?
- Quais atividades devem ser desenvolvidas pelos participantes (provas, exercícios em grupo, atividades práticas…)?
- Quais materiais e recursos serão necessários (internet, softwares, livros…)?
- Os participantes precisam levar algum material para participar das atividades?
- Que aspectos irão demonstrar que os participantes atingiram os objetivos propostos e aprenderam o conteúdo?

Após o plano de ensino, deve-se planejar a estrutura necessária para a realização do workshop e convocar os participantes.';

        $pros = '- Contribuem com a satisfação do cliente e usuário pois eles podem participar diretamente na definição das suas necessidades.
- Com a participação ativa do usuário e cliente o levantamento de requisitos leva menos tempo e tem menos riscos.';

        $cons = '- Não é recomendado para projetos pequenos de baixo risco.
- Podem não funcionar com sistemas de tempo real pois seus requisitos são menos visíveis para os clientes.
- Planejar e executar workshops pode levar tempo e ser caro.';

        DB::table('entities')->insert([
            'title'             => 'Workshops',
            'slug'              => str_slug($RETechniqueClassification->title . ' Workshops'),
            'short_description' => 'O workshop é uma espécie de seminário, grupo de discussão ou colóquio em que um palestrante apresenta um conteúdo específico e incentiva a reflexão no grupo.',
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
            ->where('slug', str_slug($RETechniqueClassification->title . ' Workshops'))
            ->first();

        $this->values($technique->id, [
            'Categoria' => 'Grupo',
            'Fonte principal' => 'Analistas e Stakeholders',
            'Tipo de técnica' => 'Direta',
            'Tipo de dado' => 'Qualitativo',
            'Comunicação' => 'Bidirecional',
            'Treinamento na técnica de elicitação' => 'Baixo',
            'Experiência do elicitor' => 'Médio',
            'Experiência com técnicas de elicitação' => 'Baixo',
            'Familiaridade com o domínio' => 'Baixo',
            'Consenso entre os stakeholders' => 'Alto',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Especialista',
            'Articulação' => 'Alto',
            'Disponibilidade de tempo' => 'Alto',
            'Tipo de informação a elicitar' => 'Básica',
            'Nível de informação disponível' => 'Inferior',
            'Definição do problema' => 'Alto',
            'Tempo de processo' => 'Início',
        ]);

        $this->values($technique->id, [
            'Tempo de processo' => 'Meio',
        ]);


        $this->references($technique->id, [
            [
                'description' => 'GOTTESDIENER, Ellen. Requirements by collaboration: workshops for defining needs. Addison-Wesley Professional, 2002.',
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
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Workshops')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Workshops')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Workshops')]);
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
