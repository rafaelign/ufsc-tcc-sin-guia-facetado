<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithPrototyping extends Migration
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

        $description = 'Prototipação pode ser considerada como a confecção de uma versão inicial do produto, preparada para coletar o feedback das partes interessadas e levantar alterações que devem ser incorporadas na próxima edição. O uso de protótipos é muito útil quando os stakeholders não tem muita familiaridade com as opções tecnológicas disponíveis para atender sua necessidade. Uma visão antecipada do software torna fácil a determinação de ambiguidades ou conflitos nos requisitos. É importante ressaltar que apesar de causar uma sobrecarga, o protótipo diminui as chances de falha da concepção, uma garantia de 80% de seleção dos requisitos apropriados. Desta forma, esta técnica visa descobrir e visualizar os requisitos da interface antes de projetar ou desenvolver o aplicativo. É útil para o desenvolvimento de novos sistemas, principalmente quando a plataforma tem mais interações de usuário do que funcionalidades internas ou quando os stakeholders não estão familiarizados com as soluções disponíveis. Vem sendo bastante utilizada para elicitação onde há muita incerteza nos requisitos ou quando o stakeholder precisa do feedback.

Podem fornecer dois tipos de requisitos:

- **A nível de produto**: Define uma funcionalidade requerida, é realista e útil.
- **A nível de design**: Define como a interface do sistema será apresentada.

Quanto aos tipos de protótipos, para elicitação de requisitos podemos citar:

- **Protótipo em papel**: são representações de interfaces gráficas com diferentes níveis de fidelidade, desde um wireframe desenhado à mão em pequenos pedaços de papel até uma embalagem de sabonete.

- **Protótipo de experiência**: é a simulação da experiência do serviço que prevê alguns de seus desempenhos através do uso de interações específicas envolvidas

## Exemplo

- Exemplo de protótipo em papel.

<iframe width="560" height="315" src="https://www.youtube.com/embed/hB9bt_dmlBQ" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

- Exemplo de protótipo de produto.

<iframe src="https://giphy.com/embed/6gtH7ijWMdqak" width="480" height="352" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>

- Exemplo de protótipo desenvlvido no Balsamiq.

<iframe width="560" height="315" src="https://www.youtube.com/embed/wEw7zaLCi8s" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

<sup>[2] [3] [4] [5] [6] [7] [10] [11] [14] [15]</sup>';

        $pros = '- Envolvimento do usuário durante o processo de desenvolvimento.
- Permite o feedback antecipado do usuário para o refinamento de requisitos.
- Economiza tempo e custo de desenvolvimento.
- Usuário e analistas entendem melhor o sistema.
- Com a prototipagem, não há requisitos errados, mas somente aqueles que esperam para ser descobertos.
- Podem demonstrar o progresso desde o estágio inicial de desenvolvimento.
- Acrescenta qualidade e comunicação entre os analistas e usuários.
- Resulta em um alto nível de satisfação de usuário.

<sup>[6] [9] [12] [13]</sup>';

        $cons = '- Pode elevar a expectativa dos usuários, influenciando negativamente na recepção do produto final, criando uma resistência às mudanças efetuadas até a versão final.
- Quando um protótipo não é descartado, ou seja, é usado para dar segmento ao desenvolvimento do produto, ele pode acabar gerando um software que dificulta a manutenção.
- A estimativa de esforço e custo pode ser alta se for feita muito cedo.
- Pode ser demorado para sistemas complexos.
- O desenvolvimento de múltiplos protótipos de alta fidelidade pode se tornar caro.
- Às vezes leva a documentação incompleta.

<sup>[1] [6] [8] [12]</sup>';

        DB::table('entities')->insert([
            'title'             => 'Prototipação',
            'slug'              => str_slug($RETechniqueClassification->title . ' Prototipação'),
            'short_description' => 'Prototipação pode ser considerada como a confecção de uma versão inicial do produto, preparada para coletar o feedback das partes interessadas e levantar alterações que devem ser incorporadas na próxima edição.',
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
            ->where('slug', str_slug($RETechniqueClassification->title . ' Prototipação'))
            ->first();

        $this->values($technique->id, [
            'Categoria' => 'Grupo',
            'Fonte principal' => 'Analistas e Stakeholders',
            'Tipo de técnica' => 'Direta',
            'Tipo de dado' => 'Qualitativo',
            'Comunicação' => 'Bidirecional',
            'Treinamento na técnica de elicitação' => 'Alto',
            'Experiência do elicitor' => 'Médio',
            'Experiência com técnicas de elicitação' => 'Baixo',
            'Familiaridade com o domínio' => 'Alto',
            'Pessoas por sessão' => 'Individual',
            'Consenso entre os stakeholders' => 'Baixo',
            'Interesse do stakeholder' => 'Nenhum',
            'Especialidade' => 'Iniciante',
            'Articulação' => 'Baixo',
            'Disponibilidade de tempo' => 'Alto',
            'Local/Acessibilidade' => 'Perto',
            'Tipo de informação a elicitar' => 'Básica',
            'Nível de informação disponível' => 'Inferior',
            'Definição do problema' => 'Baixo',
            'Restrição de tempo do projeto' => 'Baixo',
            'Tempo de processo' => 'Meio',
        ]);

        $this->values($technique->id, [
            'Tipo de informação a elicitar' => 'Tática',
            'Nível de informação disponível' => 'Superior',
        ]);

        $this->references($technique->id, [
            [
                'description' => 'HANSEN, S.; BERENTE,',
                'code' => 1
            ],
            [
                'description' => 'YOUSEF, R.; ALMARABEH, T.',
                'code' => 2
            ],
            [
                'description' => 'ZOWGHI, D.; COULIN,',
                'code' => 3
            ],
            [
                'description' => 'KHAN, K. et al. Requirement',
                'code' => 4
            ],
            [
                'description' => 'ABBASI, M. A. et al. Assessment',
                'code' => 5
            ],
            [
                'description' => 'YOUSUF, M.; ASGER, M. Comparison',
                'code' => 6
            ],
            [
                'description' => 'SHARMA, S.; PANDEY, S. Revisiting',
                'code' => 7
            ],
            [
                'description' => 'INAYAT, I. et al. A systematic literature',
                'code' => 8
            ],
            [
                'description' => 'TOMAYKO, J. E. (2002). Engineering',
                'code' => 9
            ],
            [
                'description' => 'DAVIS, A. Article in an edited book',
                'code' => 10
            ],
            [
                'description' => 'LAUESEN, S. , Article in an',
                'code' => 11
            ],
            [
                'description' => 'KHAN, S.; DULLOO, A. B.; VERMA',
                'code' => 12
            ],
            [
                'description' => 'GUNDA, Sai Ganesh. "Requirements',
                'code' => 13
            ],
            [
                'description' => 'VIANNA, Mauricio; VIANNA, Ysmar',
                'code' => 14
            ],
            [
                'description' => 'SOUZA, A. F. et al.Design Thinking',
                'code' => 15
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
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Prototipação')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Prototipação')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Prototipação')]);
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
