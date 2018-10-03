<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithBrainstorming extends Migration
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

        $description = 'É uma discussão informal onde cada participante pode expressar suas ideias livremente para que um novo sistema seja desenvolvido. Os participantes devem ser de diferentes áreas e cada um possui um tempo para compartilhar suas ideias. Esta técnica tem foco na resolução de um problema particular. Nesta técnica cada membro expressa sua ideia sobre o produto, é comumente utilizada para definir o principal valor a ser entregue. Permite que os stakeholders pensem “fora da caixa” acerca do problema a ser resolvido, aumentando o potencial criativo das ideias. Não são permitidas críticas severas, pois podem causar uma tendência associada às respostas dadas.  As ideias geradas são gravadas, as inapropriadas são descartadas e as apropriadas são priorizadas.

A aplicação da técnica é dividida em duas fases: 

- Fase de geração, onde as ideias são coletadas sem nenhum julgamento ou critério.
- Fase de evolução, onde as ideias coletadas são discutidas.

## Exemplos

Um exemplo de uma sessão de Brainstorming seria a seguinte:

- **Situação**: O número de clientes que frequentam uma dada loja reduziu drasticamente nos meses recentes; o seu dono procura novas formas de atrair novos clientes e de aumentar a frequência de ida à loja dos clientes atuais
- **Problema**: Como atrair mais clientes?

*A sessão de Brainstorming*

- A sessão deve ser planejada. Defina o espaço e o horário.
- Os empregados na loja são convidados a participar. Todavia, o supervisor e o dono não tomarão parte da sessão.
- A sessão terá lugar longe da loja e num ambiente relaxado.
- O moderador deverá ser um bom comunicador e irá tentar quebrar o gelo e preparar o grupo com um jogo de associação de palavras
- O moderador levanta a questão:  Como podemos atrair mais clientes? E escreve a questão num quadro
- O moderador explica as regras da sessão - 20 minutos, todos os participantes devem apresentar ideias e respeitar as dos colegas. **CRITICAR É PROIBIDO!**
- O moderador pede que sejam avançadas ideias
- As ideias são produzidas em um mapa mental
- Cada ideia é pontuada e avaliada pelos integrantes da sessão

<sup>[9] [13] [14] [21] [31] [33]</sup>';

        $pros = '- Os custos são muito baixos e não são necessários muitos recursos.
- Todo participante é ativo no processo e não precisa ser altamente qualificado.
- É facilmente compreendida e de fácil execução.
- Ajuda na geração de novas ideias.
- Ajuda na resolução de conflitos.
- Todos participantes têm permissão de falar e compartilhar suas ideias igualmente.

<sup>[14]</sup>';

        $cons = '- Não é adequado para resolver problemas importantes.
- Se não for devidamente organizada pode consumir muito tempo.
- A quantidade de ideias não é proporcional a sua qualidade.
- Pode levar a repetição de ideias caso os participantes não estiverem prestando a devida atenção.
- Algumas pessoas podem ter medo de compartilhar suas ideias por causa da natureza extrovertida das discussões ou quando são criticadas.

<sup>[14] [28]</sup>';

        DB::table('entities')->insert([
            'title'             => 'Brainstorming',
            'slug'              => str_slug($RETechniqueClassification->title . ' Brainstorming'),
            'short_description' => 'É uma discussão informal onde cada participante pode expressar suas ideias livremente para que um novo sistema seja desenvolvido.',
            'description'       => $description,
            'pros'              => $pros,
            'cons'              => $cons,
            'classification_id' => $RETechniqueClassification->id,
            'user_id'           => $user->id,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $interview = DB::table('entities')
            ->select(['id'])
            ->where('slug', str_slug($RETechniqueClassification->title . ' Brainstorming'))
            ->first();

        $this->values($interview->id, [
            'Categoria' => 'Grupo',
            'Fonte principal' => 'Facilitador externo',
            'Tipo de técnica' => 'Direta',
            'Tipo de dado' => 'Qualitativo',
            'Comunicação' => 'Bidirecional',
            'Treinamento na técnica de elicitação' => 'Baixo',
            'Experiência do elicitor' => 'Alto',
            'Experiência com técnicas de elicitação' => 'Baixo',
            'Familiaridade com o domínio' => 'Nenhum',
            'Pessoas por sessão' => 'Em massa',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Iniciante',
            'Articulação' => 'Médio',
            'Disponibilidade de tempo' => 'Alto',
            'Local/Acessibilidade' => 'Perto',
            'Tipo de informação a elicitar' => 'Tática',
            'Nível de informação disponível' => 'Nenhum',
            'Definição do problema' => 'Alto',
            'Restrição de tempo do projeto' => 'Baixo',
            'Tempo de processo' => 'Início',
        ]);

        $this->values($interview->id, [
            'Treinamento na técnica de elicitação' => 'Alto',
            'Experiência com técnicas de elicitação' => 'Alto',
            'Familiaridade com o domínio' => 'Baixo',
            'Especialidade' => 'Bem informado',
            'Articulação' => 'Alto',
            'Tipo de informação a elicitar' => 'Estratégica',
            'Nível de informação disponível' => 'Inferior',
        ]);

        $this->values($interview->id, [
            'Familiaridade com o domínio' => 'Alto',
            'Especialidade' => 'Especialista',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Brainstorming')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Brainstorming')]);
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
}
