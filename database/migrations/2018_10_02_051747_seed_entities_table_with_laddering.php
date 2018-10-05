<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithLaddering extends Migration
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

        $description = 'Trata-se de uma técnica de questionamento estruturada, derivada da técnica repertory grid, permitindo estabelecer uma hierarquia de conceitos. Esta técnica envolve a criação, revisão e modificação de um conteúdo hierárquico acerca do conhecimento de um especialista, simbolicamente formando uma escada. É uma técnica de entrevista para obter atributos, consequências e valores das partes interessadas. Estes termos variam conforme o autor, mas o objetivo geral da técnica se mantém. Inicialmente, os principais atributos do produto são extraídos dos usuários. Com a ajuda dos principais atributos, o entrevistador aprofunda suas habilidades para extrair mais informações dos usuários sobre os critérios de suas preferências. As perguntas e respostas são organizadas de maneira hierárquica de acordo com as prioridades. Os usuários avançam na hierarquia de perguntas ao mesmo tempo. O conhecimento do stakeholder acerca do domínio da aplicação é muito importante para o sucesso da técnica. Utilizado para obter uma justificativa e explicação de terminologias tecnológicas ou termos subjetivos, e extrair como compor o conhecimento acerca de determinado tema.

Com relação aos termos:

- **Atributos**: São valores extraídos de perguntas onde o entrevistado descreve as características desejadas, por exemplo: qualidade, preço, marca, etc.

- **Consequências**: São derivadas da identificação dos atributos. Revela aspectos individuais da relação do usuário com a aplicação para determinada característica. As respostas para esse nível de pergunta são mais profundas, se aproximam mais das reais razões do usuário.

- **Valores**: A razão de uma escolha do usuário nem sempre é clara. As perguntas deste nível tem o objetivo de coletar essa informação, ou seja, os motivos pelos quais o usuário tomou determinada decisão. 

## Exemplo

Esta técnica é basicamente um modelo de aplicar entrevistas e documentar os resultados. Desta forma, as mesmas práticas de organização são mantidas. A primeira mudança se encontra no planejamento das questões, pois cada “ladder" tem o objetivo de descrever uma funcionalidade.
	
No início de um “ladder”, o participante é questionado sobre as características que tornam aquele produto útil e o diferencia dos demais.
- *Pergunta*: Por que você selecionou estes convites de casamento?
- *Resposta*: Eu gostei do design tradicional e do papel-cartão espesso.
	
O próximo passo é identificar os atributos na resposta do participante e questioná-lo sobre as consequências associadas.
- *Pergunta*: Por que a espessura do papel-cartão é importante para você?
    - Por que esta característica é importante para você?
    - O que isso significa pra você?
    - Qual o significado deste produto ter este atributo?
- *Resposta*: Pois faz o evento parecer mais formal e importante.
	
Por fim, é necessário coletar os motivos individuais que fazem o participante tomar uma decisão relacionada ao assunto tratado. Esta fase tende a esclarecer o domínio da aplicação.
- *Pergunta*: Por que é importante que o casamento seja mais formal?
- *Resposta*: Meus amigos tiveram casamentos fabulosos e eu quero fazer algo do mesmo nível.
	
Estes passos formam níveis de pergunta e respostas, criando uma hierarquia entre as informações coletadas.

![Formação da escada de requisitos](/images/tecnicas-re/laddering-01.png)

<sup>[1] [2] [3] [4] [6]</sup>';

        $pros = '- Fácil de entender os requisitos devido a natureza hierárquica.
- O reuso de requisitos diminui o tempo e o custo.
- Não é muito adequada para o desenvolvimento de novos sistemas.
- Esta técnica fornece o contato próximo com os stakeholders, possibilitando a identificação das prioridades.

<sup>[3] [5]</sup>';

        $cons = '- A estrutura hierárquica torna difícil a tarefa de inclusão ou exclusão de requisitos de usuários.
- A técnica se torna complexa a medida que o número de requisitos aumenta.
- Requer uma opinião de especialista ou dados iniciais para elicitar os requisitos.
- É uma técnica muito longa e cansativa.

<sup>[3]</sup>';

        DB::table('entities')->insert([
            'title'             => 'Laddering',
            'slug'              => str_slug($RETechniqueClassification->title . ' Laddering'),
            'short_description' => 'Trata-se de uma técnica de questionamento estruturada, derivada da técnica repertory grid, permitindo estabelecer uma hierarquia de conceitos.',
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
            ->where('slug', str_slug($RETechniqueClassification->title . ' Laddering'))
            ->first();

        $this->values($technique->id, [
            'Categoria' => 'Cognitiva',
            'Fonte principal' => 'Especialista',
            'Tipo de técnica' => 'Indireta',
            'Tipo de dado' => 'Quantitativo',
            'Comunicação' => 'Bidirecional',
            'Treinamento na técnica de elicitação' => 'Alto',
            'Experiência do elicitor' => 'Médio',
            'Experiência com técnicas de elicitação' => 'Baixo',
            'Familiaridade com o domínio' => 'Baixo',
            'Pessoas por sessão' => 'Individual',
            'Consenso entre os stakeholders' => 'Alto',
            'Interesse do stakeholder' => 'Baixo',
            'Especialidade' => 'Iniciante',
            'Articulação' => 'Baixo',
            'Disponibilidade de tempo' => 'Alto',
            'Local/Acessibilidade' => 'Perto',
            'Tipo de informação a elicitar' => 'Básica',
            'Nível de informação disponível' => 'Nenhum',
            'Definição do problema' => 'Alto',
            'Restrição de tempo do projeto' => 'Baixo',
            'Tempo de processo' => 'Início',
        ]);

        $this->values($technique->id, [
            'Tipo de dado' => 'Qualitativo',
            'Comunicação' => 'Unidirecional',
            'Experiência do elicitor' => 'Alto',
            'Experiência com técnicas de elicitação' => 'Alto',
            'Familiaridade com o domínio' => 'Alto',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Bem informado',
            'Articulação' => 'Médio',
            'Nível de informação disponível' => 'Inferior',
            'Restrição de tempo do projeto' => 'Médio',
            'Tempo de processo' => 'Meio',
        ]);

        $this->values($technique->id, [
            'Especialidade' => 'Especialista',
            'Articulação' => 'Alto',
            'Nível de informação disponível' => 'Superior',
            'Restrição de tempo do projeto' => 'Alto',
        ]);

        $this->references($technique->id, [
            [
                'description' => 'MRAYAT, O. I. A.; NORWAWI,',
                'code' => 1
            ],
            [
                'description' => 'REHMAN, T. ur; KHAN, M. N. A.; RIAZ',
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
                'description' => 'ARIF, Q. K. Shams-ul; GAHYYUR, S. Requirements',
                'code' => 5
            ],
            [
                'description' => 'HAWLEY, Michael. Laddering: A Research',
                'code' => 6
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
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Laddering')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Laddering')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Laddering')]);
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
