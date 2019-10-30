<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithUseCases extends Migration
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

        $description = 'O Caso de uso representa uma possível utilização do sistema por um ator utilizando algum de seus serviços. Ele narra a interação entre o sistema e os atores envolvidos, para atingir um ou mais objetivos. Um caso de uso cria um contrato entre os stakeholders de um sistema sobre seu comportamento. Ele descreve o comportamento do sistema sob diversas condições enquanto o sistema responde a uma requisição de um ator primário, que pode ser uma pessoa, dispositivo físico, mecanismo ou subsistema. São definidas as pré-condições e fluxo de eventos primário, onde o ator primário inicia uma interação com o sistema para alcançar determinado objetivo e o sistema responde de acordo com os requisitos dos stakeholders, gerando as pós-condições. 

Um caso de uso não é um cenário único, mas uma "classe" que especifica um conjunto de cenários de uso relacionados, cada um dos quais captura um curso específico de interações que ocorrem entre um ou mais atores e o sistema. Portanto, a descrição de um caso de uso individual geralmente pode ser dividida em um fluxo primário e fluxos alternativos.

Casos de uso são utilizados usualmente em forma de texto, mas podem ser escritos utilizando um diagrama. O Diagrama de Caso de Uso serve para representar como os casos de uso e atores interagem entre si no sistema e como as funcionalidades se relacionam umas com as outras, sendo possível identificar como serão utilizadas pelo usuário durante o uso real do sistema.

## Exemplo

Este exemplo é um caso de uso da compra de um produto em um sistema de vendas online.

![Exemplo de Caso de Uso](/guia/images/tecnicas-re/caso_de_uso.png)

Diagrama do exemplo de caso de uso descrito acima.

![Exemplo de Diagrama de caso de uso](/guia/images/tecnicas-re/diagrama_caso_de_uso.png)';

        $pros = '- Ajudam a garantir que o sistema correto será desenvolvido capturando os requisitos através do ponto de vista do usuário.
- São fáceis de entender e fornecem um bom meio de comunicação com clientes e usuários.
-  Não precisam de muitas ferramentas para serem utilizados.
- Podem ajudar a gerenciar a complexidade de projetos maiores ao decompor o problema em funções principais.
- Fornecem um meio objetivo de rastreamento do projeto, no qual o valor agregado pode ser definido em termos de casos de uso implementados, testados e entregues.';

        $cons = '- Não são orientados a objetos.';

        DB::table('entities')->insert([
            'title'             => 'Casos de uso',
            'slug'              => str_slug($RETechniqueClassification->title . ' Casos de uso'),
            'short_description' => 'O Caso de uso representa uma possível utilização do sistema por um ator utilizando algum de seus serviços. Ele narra a interação entre o sistema e os atores envolvidos, para atingir um ou mais objetivos.',
            'description'       => $description,
            'pros'              => $pros,
            'cons'              => $cons,
            'classification_id' => $RETechniqueClassification->id,
            'user_id'           => 1,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $technique = DB::table('entities')
            ->select(['id'])
            ->where('slug', str_slug($RETechniqueClassification->title . ' Casos de uso'))
            ->first();

        $this->values($technique->id, [
            'Categoria' => 'Tradicional',
            'Fonte principal' => 'Analista com conhecimento no domínio',
            'Tipo de técnica' => 'Indireta',
            'Tipo de dado' => 'Quantitativo',
            'Treinamento na técnica de elicitação' => 'Alto',
            'Experiência do elicitor' => 'Médio',
            'Experiência com técnicas de elicitação' => 'Baixo',
            'Familiaridade com o domínio' => 'Alto',
            'Consenso entre os stakeholders' => 'Alto',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Bem informado',
            'Articulação' => 'Alto',
            'Disponibilidade de tempo' => 'Baixo',
            'Tipo de informação a elicitar' => 'Tática',
            'Nível de informação disponível' => 'Inferior',
            'Definição do problema' => 'Alto',
            'Tempo de processo' => 'Meio',
        ]);


        $this->references($technique->id, [
            [
                'description' => 'COCKBURN, Alistair. Writing effective use cases.',
                'code' => 1
            ],
            [
                'description' => 'FIRESMITH, Donald G. Use cases: the pros and cons. Wisdom of the Gurus:',
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
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Casos de uso')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Casos de uso')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Casos de uso')]);
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
