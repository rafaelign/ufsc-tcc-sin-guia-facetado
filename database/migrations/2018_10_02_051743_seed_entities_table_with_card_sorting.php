<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithCardSorting extends Migration
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

        $description = 'O especialista classifica um conjunto de cartões em grupos, cada um com o nome de alguma entidade de domínio escrita ou representada nele. Esta técnica mostra quanto conhecimento o cliente tem sobre o domínio, explicando o modo como os usuários costumam usar para agrupar, classificar e rotular atribuições e conteúdo em sua própria mente. Ajuda no agrupamento, associação e priorização dos requisitos. Para tornar esta técnica mais eficaz, é importante que todas as entidades essenciais sejam incluídas no processo e é necessário que o analista e os participantes tenham conhecimento suficiente sobre o domínio, caso contrário serão produzidos resultados errados.

Esta técnica possui duas formas de aplicação:

- **Aberto**: Os participantes recebem cartas com os itens de conteúdo da aplicação sem agrupamento estabelecido. Eles são convidados a classificar os cartões, formando grupos conforme julgam ser o mais apropriado e por fim definem os rótulos de cada grupo definido.
- **Fechado**: Neste modelo, os participantes recebem as cartas com os itens de conteúdo e um conjunto pré-estabelecido de grupos. Eles são convidados a organizar as cartas nos grupos recebidos. Dependendo da flexibilidade da pesquisa, os grupos podem sofrer alteração ou até mesmo podem ser criados novos grupos.

O processo passa por 3 fases: preparação, aplicação e análise de resultados.

## Exemplo

Na **preparação** são:
- Seleção dos conteúdos que farão parte da execução. O conteúdo determina a lista de tópicos que será utilizada. 
- Seleção dos participantes, geralmente o total fica em torno de 15 a 20 participantes. Não existe um número mágico, mas pesquisas apontam que a precisão para esta quantidade é satisfatória.
- Preparação das cartas. Nesta etapa as cartas dos itens de conteúdo da aplicação são criadas. Elas devem conter uma descrição breve, de forma que os participantes compreendam. Não é necessário dar nomes, essa tarefa fica a cargo dos participantes. Também não existe um número exato de cartas, mas aconselha-se usar de 30 a 100 cartas no processo.

A etapa de **execução** é uma reunião que começa com o facilitador embaralhando e distribuindo as cartas aos participantes. Estes são convidados a separar as cartas recebidas em grupos, utilizando o critério de semelhança entre elas. O analista não deve interferir no processo, somente quando solicitado pelos participantes. As questões levantadas pelos participantes devem ser anotadas, pois podem ser itens não previstos. Por fim, os participantes devem atribuir nomes aos agrupamentos (se necessário), resultando em sugestões de termos utilizados nos rótulos de navegação.

Na **análise dos resultados** as definições dos participantes são combinadas e tratadas estatisticamente. O objetivo do analista é identificar padrões de comportamento para elaborar um modelo mental eficiente para os perfis. É interessante que outros membros da equipe de desenvolvimento opinem para aperfeiçoar a interpretação.

![Exemplo de card sorting](/guia/images/tecnicas-re/card-sorting-01.jpg)

Exemplo de um exercício de card sorting.

<sup>[1] [2] [4] [3] [6]</sup>';

        $pros = '- É uma técnica rápida e barata.
- É acessível para participantes que estão distante através da internet.
- É uma técnica confiável, fácil e bem estabelecida no mercado.
- Ajuda a fornecer uma boa estruturação.
- Útil para coletar dados qualitativos.
- Envolve dados reais inseridos pelos usuários.
- Cria informações estruturadas para alimentar o processo.

<sup>[4]</sup>';

        $cons = '- Não é adaptada para arquiteturas complexas, grandes e heterogêneas.
- Envolve resultados variados.
- Útil somente quando o número de cartões é limitado.
- Inclui somente características superficiais.
- Não é muito eficaz, pois fornece muitas informações sobre o conteúdo envolvido.
- Interações limitadas e explicações detalhadas reduzem o valor da técnica.
- A técnica entrevista em grupo é mais eficaz do que a técnica card sorting, pois não precisa de um conhecimento tão profundo sobre o domínio.
- Cartões complexos podem confundir um stakeholder iniciante.

<sup>[4] [5]</sup>';

        DB::table('entities')->insert([
            'title'             => 'Card sorting',
            'slug'              => str_slug($RETechniqueClassification->title . ' Card sorting'),
            'short_description' => 'O especialista classifica um conjunto de cartões em grupos, cada um com o nome de alguma entidade de domínio escrita ou representada nele e efetua as associações com a participalção dos usuários.',
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
            ->where('slug', str_slug($RETechniqueClassification->title . ' Card sorting'))
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
            'Pessoas por sessão' => 'Em massa',
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
                'description' => 'MRAYAT, O. I. A.; NORWAWI, N',
                'code' => 1
            ],
            [
                'description' => 'ABBASI, M. A. et al. Assessment',
                'code' => 2
            ],
            [
                'description' => 'REHMAN, T. ur; KHAN, M. N. A.; RIAZ',
                'code' => 3
            ],
            [
                'description' => 'YOUSUF, M.; ASGER, M. Comparison',
                'code' => 4
            ],
            [
                'description' => 'ARIF, Q. K. Shams-ul; GAHYYUR, S. Requirements',
                'code' => 5
            ],
            [
                'description' => 'SPENCER, Donna; WARFEL, Todd. Card',
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
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Card sorting')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Card sorting')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Card sorting')]);
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
