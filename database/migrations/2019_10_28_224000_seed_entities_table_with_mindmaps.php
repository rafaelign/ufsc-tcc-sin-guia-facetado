<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithMindmaps extends Migration
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

        $description = 'Mapa Mental é uma técnica de pensamento visual que pode ajudar a gerar ideias e desenvolver conceitos quando as relações entre as muitas partes da informação relacionada não estão claras. Ele compreende uma rede de conceitos relacionados e conectados. O pensamento espontâneo é necessário ao criar um Mapa Mental e o objetivo deste mapeamento é encontrar associações criativas entre ideias.

O Mapa Mental fornece um meio não-linear de externalizar as informações em nossas cabeças para que possamos consolidar, interpretar, comunicar, armazenar e recuperar informações, sendo um poderoso instrumento mnemônico e pode ser usado para promover a compreensão e recordação de uma questão. Ele é iniciado com um pensamento central e são conectados outros pensamentos gerando uma rede ou mapa de pensamentos conectados.

De maneira geral, o Mapa Mental é uma representação de como pensamos, ou seja, não-linear. Assim, à medida que o mapa toma forma ele nos permite resumir e testar suposições, fazer e quebrar conexões e considerar alternativas enquanto formamos os dados em temas e padrões significativos.

## Como aplicar?

- Pense no seu tema principal geral e escreva-o no centro da página;
- Descubra sub-temas do seu conceito principal e desenhe ramos para eles a partir do centro, começando a parecer uma teia de aranha;
- Certifique-se de usar frases muito curtas ou mesmo palavras únicas;
- Adicione imagens para chamar a atenção ou transmitir melhor a mensagem;
- Tente pensar em pelo menos dois pontos principais para cada subtema que você criou e crie ramificações para aqueles.';

        $pros = '- Apresenta uma estrutura de pensamento livre e sem restrições.
- Promove o pensamento criativo.
- Faz com que a linha de pensamento do usuário fique mais clara.';

        $cons = '- Os tipos de associações são limitadas a associações simples.
- Ausência de vínculos claros entre ideias.
- Seu entendimento por outras pessoas pode ser difícil.';

        DB::table('entities')->insert([
            'title'             => 'Mapas mentais',
            'slug'              => str_slug($RETechniqueClassification->title . ' Mapas mentais'),
            'short_description' => 'Mapa Mental é uma técnica de pensamento visual que pode ajudar a gerar ideias e desenvolver conceitos quando as relações entre as muitas partes da informação relacionada não estão claras.',
            'description'       => $description,
            'pros'              => $pros,
            'cons'              => $cons,
            'images'            => '[{"src": "/guia/images/tecnicas-re/mind_mapping.png", "title": "Figura 1 - Exemplo de um mapa mental"}]',
            'classification_id' => $RETechniqueClassification->id,
            'user_id'           => $user->id,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $technique = DB::table('entities')
            ->select(['id'])
            ->where('slug', str_slug($RETechniqueClassification->title . ' Mapas mentais'))
            ->first();

        $this->values($technique->id, [
            'Categoria' => 'Inovadora',
            'Fonte principal' => 'Analista com conhecimento no domínio',
            'Tipo de técnica' => 'Indireta',
            'Tipo de dado' => 'Qualitativo',
            'Treinamento na técnica de elicitação' => 'Baixo',
            'Experiência do elicitor' => 'Alto',
            'Experiência com técnicas de elicitação' => 'Baixo',
            'Familiaridade com o domínio' => 'Alto',
            'Consenso entre os stakeholders' => 'Baixo',
            'Interesse do stakeholder' => 'Baixo',
            'Especialidade' => 'Especialista',
            'Articulação' => 'Alto',
            'Disponibilidade de tempo' => 'Baixo',
            'Tipo de informação a elicitar' => 'Básica',
            'Nível de informação disponível' => 'Inferior',
            'Definição do problema' => 'Alto',
            'Tempo de processo' => 'Início',
        ]);

        $this->references($technique->id, [
            [
                'description' => 'Anderson Felipe (2018) Design Thinking Assistant for Requirements Elicitation, Disponível em: https://sites.google.com/site/dta4re/tecnicas-de-design-thinking/mapa-mental (Acessado: 23 de Outubro de 2019).',
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
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Mapas mentais')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Mapas mentais')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Mapas mentais')]);
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
