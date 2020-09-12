<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedEntitiesTableWithStoryboards extends Migration
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

        $description = 'Um Storyboard é um formato de escrita. Geralmente é um conjunto de caixas colocados em ordem logicamente sequenciada. Cada caixa ou quadro é um lugar para o escritor colocar informações, imagens, símbolos ou textos. Storyboard é a origem de todas as linguagens escritas, usadas pelas culturas ancestrais antes do texto evoluir e como uma ponte natural para o texto que conhecemos e escrevemos hoje. É uma representação visual de uma história através de quadros estáticos, compostos por desenhos, colagens, fotografias ou qualquer outra técnica disponível. 

É recomendável usar Storyboard quando se quer comunicar uma ideia a terceiros ou para visualizar o encadeamento de uma solução, com o objetivo de se detectar aspectos em aberto no produto ou refinar um serviço final. Eles são usados ​​no processo de elicitação de requisitos para ilustrar como os usuários podem interagir com um sistema.

Storyboards são utilizados por pessoas envolvidas na criação de filmes, desenhos e comerciais e são uma ferramenta poderosa em destacar os aspectos mais importantes de uma narrativa, sendo possível apresentá-lo a um cliente de forma que ele rapidamente entenda do que se trata e diga se é o que ele esperava ou não.';

        $pros = '- Eles engajam o time de desenvolvimento fazendo eles pensarem sobre a imagem da qualidade geral do serviço.
- Representam de forma fácil os requisitos para o usuário, facilitando a identificação da prioridade de um requisito.
- Pode simultaneamente apresentar modelos mentais bem diferentes.';

        $cons = '- Precisam de uma ideia ou solução definida.
- Podem ser difíceis de ilustrar.';

        DB::table('entities')->insert([
            'title'             => 'Storyboards',
            'slug'              => str_slug($RETechniqueClassification->title . ' Storyboards'),
            'short_description' => 'Um Storyboard é um formato de escrita. Geralmente é um conjunto de caixas colocados em ordem logicamente sequenciada. Cada caixa ou quadro é um lugar para o escritor colocar informações, imagens, símbolos ou textos.',
            'description'       => $description,
            'pros'              => $pros,
            'cons'              => $cons,
            'images'            => '[{"src": "/guia/images/tecnicas-re/storyboard.png", "title": "Figura 1 - Exemplo de um Storyboard"}]',
            'classification_id' => $RETechniqueClassification->id,
            'user_id'           => 1,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $technique = DB::table('entities')
            ->select(['id'])
            ->where('slug', str_slug($RETechniqueClassification->title . ' Storyboards'))
            ->first();

        $this->values($technique->id, [
            'Categoria' => 'Inovadora',
            'Fonte principal' => 'Analista com conhecimento no domínio',
            'Tipo de dado' => 'Qualitativo',
            'Comunicação' => 'Bidirecional',
            'Treinamento na técnica de elicitação' => 'Baixo',
            'Experiência do elicitor' => 'Médio',
            'Experiência com técnicas de elicitação' => 'Baixo',
            'Familiaridade com o domínio' => 'Alto',
            'Consenso entre os stakeholders' => 'Alto',
            'Interesse do stakeholder' => 'Alto',
            'Especialidade' => 'Bem informado',
            'Articulação' => 'Médio',
            'Disponibilidade de tempo' => 'Baixo',
            'Tipo de informação a elicitar' => 'Básica',
            'Nível de informação disponível' => 'Inferior',
            'Definição do problema' => 'Alto',
            'Tempo de processo' => 'Início',
        ]);

        $this->values($technique->id, [
            'Tempo de processo' => 'Fim',
        ]);


        $this->references($technique->id, [
            [
                'description' => 'Anderson Felipe (2018) Design Thinking Assistant for Requirements Elicitation, Disponível em: https://sites.google.com/site/dta4re/tecnicas-de-design-thinking/storyboard (Acessado: 23 de Outubro de 2019).',
                'code' => 1
            ],
            [
                'description' => 'WAHID, Shahtab et al. Picking up artifacts: Storyboarding as a gateway to reuse. In: IFIP Conference on Human-Computer Interaction. Springer, Berlin, Heidelberg, 2009. p. 528-541.',
                'code' => 2
            ],
            [
                'description' => 'SUTHERLAND, Malcolm; MAIDEN, Neil. Storyboarding requirements. IEEE software, v. 27, n. 6, p. 9-11, 2010.',
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
        DB::delete('DELETE FROM entities_references WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Storyboards')]);
        DB::delete('DELETE FROM entities_values WHERE entity_id IN (SELECT id FROM entities WHERE slug LIKE ?)', [str_slug('Técnicas de Elicitação de Requisitos Storyboards')]);
        DB::delete('DELETE FROM entities WHERE slug LIKE ?', [str_slug('Técnicas de Elicitação de Requisitos Storyboards')]);
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
