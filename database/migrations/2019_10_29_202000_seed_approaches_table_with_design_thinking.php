<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
class SeedApproachesTableWithDesignThinking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $approach_description = 'Esta abordagem alinha os processos de engenharia de software com os processos do Design Thinking. Atividades de Design Thinking foram incluídas no ciclo de vida da engenharia de software, principalmente aplicando técnicas dessa área na fase de elicitação de requisitos ao invés de utilizar técnicas convencionais da engenharia de software. A abordagem foi aplicada em um curso chamado “Running a Software Project” aplicado em 16 semanas, onde 29 alunos participaram. Para verificar a eficácia da abordagem, na fase de testes, os alunos identificaram requisitos funcionais e não funcionais de seus planos iniciais do projeto e um portfólio de design da experiência do usuário (UX),  que é um documento em que profissionais expõem o processo de UX realizado em seus trabalhos de forma mais visualmente elaborada. O uso do design thinking para a elicitação de requisitos foi bem-sucedido, pois essas técnicas melhoraram o entendimento das necessidades do usuário. 

###### *Técnicas desta abordagem não contempladas no guia: Mapa da jornada do usuário.*';
        $context_description = 'Design Thinking (ou “pensamento de design“ em uma tradução livre) é uma abordagem para resolver problemas utilizando métodos criativos. No Design thinking a empatia entre o designer e os usuários é altamente considerada e a exploração dos problemas e soluções é um processo compartilhado entre os dois. Ele mira em ir além de premissas que podem afetar negativamente as soluções e em encontrar a melhor solução possível para um problema complexo. No ramo da educação de engenharia de software mais recente, o Design thinking vem sendo usado para ensinar design de aplicativos mobile, desenvolvimento de jogos, entre outros. No entanto, especialistas sugerem que o Design thinking tem o potencial de ser usado também para aprendizado baseado em projetos, elicitação de requisitos e segurança de software. Além disso, estudos relatam que os métodos ágeis podem ser combinados com o design thinking, a fim de melhorar desenvolvimento de software.

### Etapas do Design thinking

- Empatia: Entender o usuário e suas necessidades.
- Definição: Estruturar e definir o(s) problema(s) de maneira centrada no usuário.
- Idealizar: Pensar em soluções para os problemas encontrados.
- Prototipar: Prototipando as soluções encontradas.
- Testar: Validar com o usuário se a solução realmente resolve o problema encontrado.

![Ilustração das etapas do Design Thinking](/images/design-thinking.jpeg) ';
        DB::table('approaches')->insert([
            'approach_title'    => 'Abordagem de Design Thinking',
            'slug'              => str_slug('Abordagem de Design Thinking'),
            'short_description' => 'Esta abordagem alinha os processos de engenharia de software com os processos do Design Thinking. Atividades de Design Thinking foram incluídas no ciclo de vida da engenharia de software, principalmente na fase de elicitação de requisitos.',
            'approach_description' => $approach_description,
            'context_title' => 'Design Thinking',
            'context_description' => $context_description,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

            $approach = DB::table('approaches')
            ->select(['id'])
            ->where('slug', str_slug('Abordagem de Design Thinking'))
            ->first();

            $this->references($approach->id, [
            [
                'description' => 'PALACIN-SILVA, Maria et al. Infusing design thinking into a software engineering capstone course. In: 2017 IEEE 30th Conference on Software Engineering Education and Training (CSEE&T). IEEE, 2017. p. 212-221.',
                'code' => 1
            ],
            [
                'description' => 'Iain Heath (2018) User Experience is… Design Thinking',
                'code' => 2
            ],
            [
                'description' => 'Comunidade Compartilhar (2017) Convergindo Design Thinking e Canvas',
                'code' => 3
            ],
            ]);

            $this->entities($approach->id, [
            [
                'description' => 'Personas'
            ],
            [
                'description' => 'Storyboards'
            ],
            [
                'description' => 'Prototipação'
            ],
            [
                'description' => 'Teste de usabilidade'
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
        DB::delete('DELETE * FROM approaches where approach_title = "Abordagem de Design Thinking"');
    }


    private function entities(int $id, array $entitiesWithValues)
    {
        foreach ($entitiesWithValues as $entity) {
            $getEntity = DB::table('entities')
                ->select(['id'])
                ->where('title', 'like', trim($entity['description'] . '%'))
                ->first();

            DB::table('approaches_entities')->insert([
                'approach_id' => $id,
                'entity_id' => $getEntity->id,
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

            DB::table('approaches_references')->insert([
                'approach_id' => $id,
                'reference_id' => $getReference->id,
                'code' => (int) $reference['code'],
            ]);
        }
    }

}