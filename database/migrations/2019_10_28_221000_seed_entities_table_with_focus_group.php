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

        $description = 'Uma discussão objetiva, conduzida ou moderada que introduz um tópico a um grupo de respondentes e direciona sua discussão sobre o tema, de uma maneira não-estruturada e natural. Um grupo focal é um grupo de discussão informal e de tamanho
reduzido, com o propósito de obter informações de caráter qualitativo em
profundidade. É uma técnica rápida e de baixo custo para avaliação e
obtenção de dados e informações qualitativas, fornecendo aos gerentes de
projetos ou instituições uma grande riqueza de informações qualitativas sobre
o desempenho de atividades desenvolvidas, prestação de serviços, novos
produtos ou outras questões. 

O objetivo principal de um grupo focal é revelar as percepções dos participantes sobre os tópicos em discussão. Normalmente, os participantes possuem alguma característica em comum, compartilhando as mesmas características sociodemográficas, como nível de escolaridade, condição social, por exemplo. Deve ser dirigido por duas pessoas: uma conversando, realizando o papel do moderador, e a outra anotando. Quem está escrevendo não deve interferir para não misturar os papéis.

As salas onde acontecem as discussões em grupo podem ser salas comuns ou salas especialmente preparadas para este tipo de pesquisa. Estas são conhecidas como salas de espelho.

O número de grupos varia em função das reuniões estarem ou não produzindo novas idéias. Se o moderador pode antecipar com clareza o que será dito no próximo grupo, então, a pesquisa está encerrada, o que normalmente ocorre após o terceiro ou quarto grupo ou sessão.

O grupo deve ser idealmente composto por 8 a 12 pessoas. Grupos acima de 12 pessoas inibem e reduzem as possibilidades de todos participarem. Quando possui menos de 8 pessoas, o grupo pode tornar-se menos dinâmico e cresce a chance de alguns participantes dominarem a reunião.';

        $pros = '- Permite fornecer dados ricos de um grupo específico muito mais rapidamente e com menos custos do que entrevistas individuais.
- Pode ser utilizado para a análise de um grande leque de tópicos com uma variedade de indivíduos.';

        $cons = '-  O moderador pode influenciar a geração dos dados e do impacto do próprio grupo
nos dados. 
- Os participantes tendem a racionalizar as suas respostas.
- Alguns tópicos não são aceitáveis para discussão entre algumas categorias de participantes.';

        DB::table('entities')->insert([
            'title'             => 'Grupo Focal',
            'slug'              => str_slug($RETechniqueClassification->title . ' Grupo Focal'),
            'short_description' => 'Uma discussão objetiva, conduzida ou moderada que introduz um tópico a um grupo de respondentes e direciona sua discussão sobre o tema, de uma maneira não-estruturada e natural.',
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
            ->where('slug', str_slug($RETechniqueClassification->title . ' Grupo Focal'))
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
            'Familiaridade com o domínio' => 'Nenhum',
            'Consenso entre os stakeholders' => 'Alto',
            'Interesse do stakeholder' => 'Baixo',
            'Especialidade' => 'Iniciante',
            'Articulação' => 'Médio',
            'Disponibilidade de tempo' => 'Alto',
            'Tipo de informação a elicitar' => 'Estratégica',
            'Nível de informação disponível' => 'Superior',
            'Definição do problema' => 'Baixo',
            'Tempo de processo' => 'Início',
        ]);


        $this->references($technique->id, [
            [
                'description' => 'Elton R. Vieira (2014) Guia de criatividade para projetos de desenvolvimento de software, Disponível em: https://sites.google.com/site/guiadecriatividade/59---focus-group (Acessado: 23 de Outubro de 2019).',
                'code' => 1
            ],
            [
                'description' => 'GOMES, Maria Elasir S.; BARBOSA, Eduardo F. A técnica de grupos focais para obtenção de dados qualitativos. Revista Educativa, p. 1-7, 1999.',
                'code' => 2
            ],
            [
                'description' => 'SILVA, Isabel Soares; VELOSO, Ana Luísa; KEATING, José Bernardo. Focus group: Considerações teóricas e metodológicas. Revista Lusófona de Educação, n. 26, p. 175-190, 2014.',
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
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Grupo Focal')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Grupo Focal')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Grupo Focal')]);
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
