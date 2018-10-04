<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithQuestionnaires extends Migration
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

        $description = 'Os questionários são usados principalmente como uma ferramenta simples, que contém perguntas abertas e/ou fechadas durante a fase inicial da elicitação de requisitos. Servem para coletar o máximo de requisitos de diferentes pessoas que podem estar em lugares distintos. São baratas e tem o objetivo de coletar informações de uma grande população. Em situações onde entrevistas não são possíveis, seja presencialmente ou online, o questionário é utilizado. É necessário planejar com a devida atenção aos detalhes para garantir o sucesso da execução. É muito importante mencionar o prazo em que o questionário deve ser devolvido. Para manter a neutralidade das questões e ao mesmo que se obtém uma indicação da força das respostas às questões da escala de Likert são recomendadas.

Os passos para o planejamento de um questionário são os seguintes:

- A proposta do questionário deve ser definida.
- Deve ser definido um grupo de amostragem.
- Preparação e desenvolvimento do questionário.
- Coletar e analisar os resultados.

Para a execução, geralmente são encontrados:

- As questões deve ser bem organizadas.
- As questões devem ser ordenadas do domínio conhecido para o desconhecido.
- Tenta usar as questões fechadas no início.
- As questões relevantes devem ser priorizadas e devem estar no início do questionário.
- Evitar que perguntas pessoais ou íntimas ocorram no início.

## Exemplo

Exemplos de tipos de perguntas que podem ser incluídas nos questionários que utilizam a escala Likert:

![Exemplo 1](/images/tecnicas-re/questionnaires-01.png)

![Exemplo 2](/images/tecnicas-re/questionnaires-02.png)

Também é possível explorar outras formas de questões, tudo vai depender do projeto em questão:

![Exemplo 3](/images/tecnicas-re/questionnaires-03.png)

<sup>[1] [2] [3] [4] [5] [6] [7] [8]</sup>';

        $pros = '- Grande número de pessoas alcançadas em pouco tempo.
- Útil quando as mesmas perguntas devem ser feitas para todas pessoas.
- É uma técnica barata.
- Fácil de aplicar devido ao modelo das questões envolvidas, exemplo, múltipla escolha, verdadeiro ou falso, texto aberto, etc.

<sup>[3]</sup>';

        $cons = '- Não é possível adquirir mais informações sobre o problema além do que está exposto no questionário.
- Podem ser mal interpretados.
- Às vezes os comentários recebidos não são úteis.
- É necessário usar outras técnicas para obter mais informações, como por exemplo a técnica entrevista.
- Perguntas ambíguas podem ser formuladas.
- É utilizada para software de uso geral.

<sup>[3]</sup>';

        DB::table('entities')->insert([
            'title'             => 'Questionários',
            'slug'              => str_slug($RETechniqueClassification->title . ' Questionários'),
            'short_description' => 'São usados principalmente como uma ferramenta simples, com perguntas abertas ou fechadas durante a fase inicial da elicitação de requisitos para coletar o máximo de requisitos de diferentes pessoas que podem estar em lugares distintos.',
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
            ->where('slug', str_slug($RETechniqueClassification->title . ' Questionários'))
            ->first();

        $this->values($technique->id, [
            'Categoria' => 'Tradicional',
            'Tipo de técnica' => 'Indireta',
            'Tipo de dado' => 'Quantitativo',
            'Comunicação' => 'Unidirecional',
            'Treinamento na técnica de elicitação' => 'Baixo',
            'Experiência do elicitor' => 'Médio',
            'Experiência com técnicas de elicitação' => 'Nenhum',
            'Familiaridade com o domínio' => 'Baixo',
            'Pessoas por sessão' => 'Individual',
            'Consenso entre os stakeholders' => 'Baixo',
            'Interesse do stakeholder' => 'Nenhum',
            'Especialidade' => 'Iniciante',
            'Articulação' => 'Baixo',
            'Disponibilidade de tempo' => 'Baixo',
            'Local/Acessibilidade' => 'Perto',
            'Tipo de informação a elicitar' => 'Básica',
            'Nível de informação disponível' => 'Nenhum',
            'Definição do problema' => 'Baixo',
            'Restrição de tempo do projeto' => 'Baixo',
            'Tempo de processo' => 'Meio',
        ]);

        $this->values($technique->id, [
            'Treinamento na técnica de elicitação' => 'Alto',
            'Experiência do elicitor' => 'Alto',
            'Experiência com técnicas de elicitação' => 'Baixo',
            'Familiaridade com o domínio' => 'Alto',
            'Pessoas por sessão' => 'Grupo',
            'Consenso entre os stakeholders' => 'Alto',
            'Interesse do stakeholder' => 'Baixo',
            'Especialidade' => 'Bem informado',
            'Articulação' => 'Médio',
            'Disponibilidade de tempo' => 'Alto',
            'Local/Acessibilidade' => 'Longe',
            'Tipo de informação a elicitar' => 'Tática',
            'Nível de informação disponível' => 'Inferior',
            'Definição do problema' => 'Alto',
            'Restrição de tempo do projeto' => 'Médio',
            'Tempo de processo' => 'Fim',
        ]);

        $this->values($technique->id, [
            'Experiência com técnicas de elicitação' => 'Alto',
            'Pessoas por sessão' => 'Em massa',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Especialista',
            'Articulação' => 'Alto',
            'Tipo de informação a elicitar' => 'Estratégica',
            'Nível de informação disponível' => 'Superior',
            'Restrição de tempo do projeto' => 'Alto',
        ]);

        $this->references($technique->id, [
            [
                'description' => 'REHMAN, T. ur; KHAN, M. N. A.; RIAZ',
                'code' => 1
            ],
            [
                'description' => 'DRISCOLL, L. “Introduction to Primary Research',
                'code' => 2
            ],
            [
                'description' => 'YOUSUF, M.; ASGER, M. Comparison',
                'code' => 3
            ],
            [
                'description' => 'SHARMA, S.; PANDEY, S. Revisiting',
                'code' => 4
            ],
            [
                'description' => 'GUNDA, Sai Ganesh. "Requirements',
                'code' => 5
            ],
            [
                'description' => 'SOUZA, A. F. et al.Design Thinking',
                'code' => 6
            ],
            [
                'description' => 'HANINGTON, B., & MARTIN, B. (2012). Universal',
                'code' => 7
            ],
            [
                'description' => 'BARBOSA, S., & SILVA, B. (2010). Interação humano',
                'code' => 8
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
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Questionários')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Questionários')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Questionários')]);
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
