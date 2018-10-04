<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithInterview extends Migration
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

        $description = 'É conhecida por ser a mais comum das técnicas de elicitação de requisitos. As entrevistas geralmente envolvem discussões individuais de um representante da equipe com o stakeholder do novo sistema. Devido à capacidade desta técnica para obter conhecimento profundo, é considerada como técnica importante para obter e validar os requisitos de software. É um método verbal, considerado fácil e efetivo para compartilhar ideias e expressar necessidades entre os analistas e os stakeholders. Através de uma conversa, são feitas perguntas e são documentados os fatores que podem estar associados aos requisitos. 

As principais características dos Analistas são:
- Estar abertos a novas ideias, evitam ideias preconcebidas sobre os requisitos e estão dispostos a ouvir os stakeholders, mesmo que o stakeholder apresente requisitos-surpresa, eles estão dispostos a mudar de ideia sobre o sistema.
- Eles estimulam o entrevistado a participar de discussões com uma questão-trampolim, uma proposta de requisitos ou trabalhando em conjunto em um protótipo do sistema. É improvável que dizer às pessoas "diga-me o que quiser" resulte em informações úteis. É muito mais fácil falar em um contexto definido do que em termos gerais.

Geralmente as entrevistas são separadas em:

**Estruturadas**: Entrevistas estruturadas são baseadas em um conjunto fixo de perguntas, juntamente com informações detalhadas. Este tipo permite que os analistas examinem o nível de compreensão que um stakeholder tem sobre determinado tópico. Templates também são parte deste processo que fornece um caminho mais fácil para a elicitação de requisitos.

**Não estruturadas**: Entrevistas não estruturadas são conversacionais por natureza, onde não é necessário preparar perguntas, e as informações dos stakeholders estão em discussões abertas. São mais úteis quando você quer se concentrar na compreensão de um determinado problema dentro do ambiente que o usuário está inserido.

**Semi-estruturada**: É uma combinação de perguntas pré-definidas e não planejadas. Em outras palavras, é uma mistura dos tipos estruturado e não estruturado.

## Como aplicar?

O processo de entrevista pode ser resumido em oito passos:

- Identificar o stakeholder a ser entrevistado.
- Se preparar para a entrevista, mesmo se for não estruturada.
- Agendar a entrevista.
- Chegar antes da hora no local determinado.
- Abrir a entrevista.
- Conduzir a entrevista.
- Finalizar a entrevista.
- Fazer o acompanhamento e manter contato.

## Exemplos

Para a modalidade de entrevista fechada, a preparação contempla a criação de uma série de perguntas a serem respondidas pelo stakeholder, diferente da modalidade de entrevista aberta, onde não existe roteiro.

*Quanto ao perfil do usuário*
- Quais são as suas responsabilidades?
- Quais são os produtos do seu trabalho?
- Para quem você gera esses produtos?

*Quanto ao problema*
- Para quais problemas faltam boas soluções?
- Quais são?
- Por que esse problema existe?
- Como você poderia resolvê-lo?

Ao final é interessante validar as respostas dadas pelo stakeholder.
<sup>[1] [4] [5] [14] [15] [16]</sup>';

        $pros = '- Fácil extrair os detalhes fazendo perguntas de acompanhamento.
- Identifica sentimentos e objetivos de diferentes indivíduos.
- É boa para tratar de tópicos complexos.
- Coleta informações importantes e detalhadas.
- As ambiguidades são esclarecidas.
- Diminui a chance de coletar informações falsas dos stakeholders.
- A falta de respostas é baixa.
- Fornece uma visão geral de todo o sistema.
- Coleta de informações que podem formar uma pesquisa ou outra atividade.
- Mais eficaz do que as outras técnicas na maioria dos casos, mesmo não sendo sempre a mais eficiente.
<sup>[3] [14] [21] [25]</sup>';

        $cons = '- Podem dar a falsa impressão de coleta de informação dos stakeholders dependendo da abordagem feita pelo analista ao fazer os questionamentos. Esta característica está relacionada com as limitações impostas pela linha de questionamento do entrevistador.
- Podem captar somente parte das práticas de trabalho que foram expostas pelos stakeholders.
- As atividades descritas pelos stakeholders podem diferir do que realmente acontece.
- O sucesso depende muito das habilidades do entrevistador.
- Não existe garantia na obtenção de informações significativas.
- A linguagem pode ser uma barreira entre o entrevistador e os stakeholders.
- Poucas pessoas envolvidas.
- É difícil definir o tempo adequado para entrevistas com todas pessoas.
- As informações não podem ser coletadas de muitas pessoas geralmente, pois aumenta o custo do processo.
- São trabalhosas e demoradas.
- Algumas vezes é necessário esclarecer alguma informação e os participantes podem não lembrar das informações coletadas anteriormente.
<sup>[1] [2] [3] [6] [7] [14]</sup>';

        DB::table('entities')->insert([
            'title'             => 'Entrevista',
            'slug'              => str_slug($RETechniqueClassification->title . ' Entrevista'),
            'short_description' => 'É conhecida por ser a mais comum das técnicas de elicitação de requisitos. As entrevistas geralmente envolvem discussões individuais de um representante da equipe com o stakeholder do novo sistema.',
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
            ->where('slug', str_slug($RETechniqueClassification->title . ' Entrevista'))
            ->first();

        $this->values($technique->id, [
            'Categoria' => 'Tradicional',
            'Fonte principal' => 'Analista com conhecimento no domínio',
            'Tipo de técnica' => 'Direta',
            'Tipo de dado' => 'Qualitativo',
            'Comunicação' => 'Bidirecional',
            'Treinamento na técnica de elicitação' => 'Baixo',
            'Experiência do elicitor' => 'Médio',
            'Experiência com técnicas de elicitação' => 'Baixo',
            'Familiaridade com o domínio' => 'Baixo',
            'Pessoas por sessão' => 'Individual',
            'Consenso entre os stakeholders' => 'Alto',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Especialista',
            'Articulação' => 'Médio',
            'Disponibilidade de tempo' => 'Alto',
            'Local/Acessibilidade' => 'Perto',
            'Tipo de informação a elicitar' => 'Básica',
            'Nível de informação disponível' => 'Inferior',
            'Definição do problema' => 'Alto',
            'Restrição de tempo do projeto' => 'Baixo',
            'Tempo de processo' => 'Meio',
        ]);

        $this->values($technique->id, [
            'Tipo de dado' => 'Quantitativo',
            'Especialidade' => 'Bem informado',
            'Tipo de informação a elicitar' => 'Tática',
            'Nível de informação disponível' => 'Superior',
        ]);

        $this->references($technique->id, [
            [
                'description' => 'HANSEN, S.; BERENTE,',
                'code' => 1
            ],
            [
                'description' => 'ISABIRYE, N.; FLOWERDAY, S',
                'code' => 2
            ],
            [
                'description' => 'MRAYAT, O. I. A.; NORWAWI,',
                'code' => 3
            ],
            [
                'description' => 'YOUSEF, R.; ALMARABEH, T',
                'code' => 4
            ],
            [
                'description' => 'ZOWGHI, D.; COULIN, C. Requirements',
                'code' => 5
            ],
            [
                'description' => 'DAVIS, G. "Strategies',
                'code' => 6
            ],
            [
                'description' => 'GOGUEN, J., and LINDE, C.',
                'code' => 7
            ],
            [
                'description' => 'YOUSUF, M.; ASGER, M. C',
                'code' => 8
            ],
            [
                'description' => 'SHARMA, S.; PANDEY, S. R',
                'code' => 9
            ],
            [
                'description' => 'ZHANG, Y. and WILDEMUTH, B. M.',
                'code' => 10
            ],
            [
                'description' => 'ARIF, Q. K. Shams-ul; GAHYYUR',
                'code' => 11
            ],
            [
                'description' => 'DIESTE, O.; JURISTO, N.; SHULL, F',
                'code' => 12
            ],
        ]);
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Entrevista')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Entrevista')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Entrevista')]);
    }
}
