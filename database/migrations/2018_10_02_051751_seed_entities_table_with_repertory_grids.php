<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithRepertoryGrids extends Migration
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

        $description = 'Nesta técnica, os elementos do domínio são representados através de uma matriz, atribuindo as construtos e classificações pelos stakeholders. São realizadas entrevistas semi-estruturadas que envolvem os stakeholders para identificar nomes de elementos e construtos. Esta matriz é utilizada na representação inicial dos requisitos. É mais precisa na captura de detalhes do que a técnica card sorting, mas é menos precisa do que a laddering, portanto, esta técnica não é considerada eficiente para descrever as características dos requisitos complexos.

A técnica consiste em 4 grandes etapas:

- **Pré-entrevista**: Os pesquisadores entendem sobre o conhecimento de domínio para definir os métodos de entrevista e direcionar os participantes a completar o grid. Em um segundo momento eles voltam ao conhecimento de domínio para definir as fontes de elementos e constructos.

- **Entrevista**: Neste estágio, os elementos e construtos são extraídos de um participante e é documentado no grid. O participante também pode participar da identificação dos elementos e construtos em alguns casos. Em seguida são identificadas as semelhanças entre cada tríade de artefatos, representado na imagem pelas colunas laterais e pelos elementos. A atribuição de valores para a associação entre um elemento e os construtos geralmente segue um padrão estabelecido por algum autor que define um escala para estabelecer essa relação. Nesta etapa pode ser utilizado a técnica de Laddering para a extração das informações.

- **Revisão**: Nesta etapa o pesquisador, em conjunto com um participante, faz um revisão do grid criado a fim de refinar os elementos e construtos conforme necessário.

- **Análise**: O grid completo é submetido a uma análise quantitativa e qualitativa. Esta análise ajuda ao pesquisador a entender o conteúdo e organização do sistema de construtos dos participantes. Pode ser analisado o conteúdo do grid ou até as pontuações estabelecidas. Muitas estatísticas podem ser extraídas das pontuações definidas no grid, como por exemplo: clusterização, PCA, MDS, mapeamento conceitual, análise lógica entre outras.

## Exemplo

Este exemplo é um grid para entender as percepções individuais de diferentes softwares de email. Os elementos são os programas de e-mails (apresentados no rodapé do grid) e os construtos são características (apresentadas nas laterais). Cada construto representa uma característica dividida em dois polos.

Exemplos de grids após a execução.

![Exemplo de grid 1](/images/tecnicas-re/repertory-grids-04.png)

![Exemplo de grid 2](/images/tecnicas-re/repertory-grids-01.png)

Exemplo de uma árvore de relação entre elementos e construtos.

![Exemplo de árvore de relação](/images/tecnicas-re/repertory-grids-02.png)

Exemplo da análise estatística PCA.

![Exemplo de análise PCA](/images/tecnicas-re/repertory-grids-03.png)

<sup>[2] [3]</sup>';

        $pros = '- Separa as diferenças e semelhanças entre elementos que não eram conhecidos pelos especialistas.
- Minimiza o viés do especialista enquanto ele desenvolve compreensão do domínio a partir da perspectiva do usuário.
- Facilita a rastreabilidade.
- Representa um nível de abstração desconhecido para a maioria dos usuários.
- Facilita a análise quantitativa e qualitativa.
- Fácil de administrar.

<sup>[1] [2] [3] [4]</sup>';

        $cons = '- É necessário muito esforço por parte dos analistas e especialistas.
- É uma técnica demorada e sua execução pode ser monótona.
- São um pouco limitadas em sua capacidade de expressar características específicas de requisitos complexos.

<sup>[2] [3] [4]</sup>';

        DB::table('entities')->insert([
            'title'             => 'Repertory grids',
            'slug'              => str_slug($RETechniqueClassification->title . ' Repertory grids'),
            'short_description' => 'Nesta técnica, os elementos do domínio são coletados através de entrevistas e representados através de uma matriz, atribuindo as construtos e classificações pelos stakeholders.',
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
            ->where('slug', str_slug($RETechniqueClassification->title . ' Repertory grids'))
            ->first();

        $this->values($technique->id, [
            'Categoria' => 'Cognitiva',
            'Tipo de técnica' => 'Indireta',
            'Tipo de dado' => 'Quantitativo',
            'Comunicação' => 'Bidirecional',
            'Treinamento na técnica de elicitação' => 'Alto',
            'Experiência do elicitor' => 'Médio',
            'Experiência com técnicas de elicitação' => 'Baixo',
            'Familiaridade com o domínio' => 'Baixo',
            'Pessoas por sessão' => 'Individual',
            'Consenso entre os stakeholders' => 'Baixo',
            'Interesse do stakeholder' => 'Nenhum',
            'Especialidade' => 'Iniciante',
            'Articulação' => 'Baixo',
            'Disponibilidade de tempo' => 'Baixo',
            'Local/Acessibilidade' => 'Perto',
            'Tipo de informação a elicitar' => 'Básica',
            'Nível de informação disponível' => 'Inferior',
            'Definição do problema' => 'Alto',
            'Restrição de tempo do projeto' => 'Baixo',
            'Tempo de processo' => 'Meio',
        ]);

        $this->values($technique->id, [
            'Tipo de dado' => 'Qualitativo',
            'Comunicação' => 'Unidirecional',
            'Experiência do elicitor' => 'Alto',
            'Experiência com técnicas de elicitação' => 'Alto',
            'Familiaridade com o domínio' => 'Alto',
            'Pessoas por sessão' => 'Grupo',
            'Consenso entre os stakeholders' => 'Alto',
            'Interesse do stakeholder' => 'Baixo',
            'Especialidade' => 'Bem informado',
            'Articulação' => 'Médio',
            'Disponibilidade de tempo' => 'Alto',
            'Local/Acessibilidade' => 'Longe',
            'Restrição de tempo do projeto' => 'Médio',
        ]);

        $this->values($technique->id, [
            'Pessoas por sessão' => 'Em massa',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Especialista',
            'Articulação' => 'Alto',
            'Restrição de tempo do projeto' => 'Alto',
        ]);

        $this->references($technique->id, [
            [
                'description' => 'REHMAN, T. ur; KHAN, M. N. A.; RIAZ',
                'code' => 1
            ],
            [
                'description' => 'YOUSUF, M.; ASGER, M. Comparison',
                'code' => 2
            ],
            [
                'description' => 'ARIF, Q. K. Shams-ul; GAHYYUR, S. Requirements',
                'code' => 3
            ],
            [
                'description' => 'CURTIS, Aaron Mosiah et al. An overview and',
                'code' => 4
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
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Repertory grids')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Repertory grids')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Repertory grids')]);
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
