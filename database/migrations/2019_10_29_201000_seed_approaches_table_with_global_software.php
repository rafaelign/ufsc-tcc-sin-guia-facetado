<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
class SeedApproachesTableWithGlobalSoftware extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $approach_description = 'A abordagem GSD-RE é uma abordagem de elicitação e análise de requisitos para o desenvolvimento de software global (GSD), especialmente para os grupos de stakeholders que participam do GSD pela primeira vez ou não estão cientes dos aspectos e questões fundamentais do processo de elicitação de requisitos nos GSD. Essa abordagem auxilia os stakeholders a se conscientizarem sobre os aspectos sociais, temporais, geográficos e de idiomas diferentes do GSD em um estágio inicial, considerarem requisitos não funcionais com relação a diferentes fusos horários e o aumento da distância, pensarem nos requisitos subjacentes em um domínio mais amplo e elaborarem um conjunto de requisitos de qualidade.';
        $context_description = 'O Desenvolvimento de software global (GSD) é um desenvolvimento de software com equipes de desenvolvimento espalhadas por diferentes lugares do mundo. Existem muitos benefícios no desenvolvimento de software global, como por exemplo a diminuição dos custos devido aos salários serem mais baratos em outros lugares. Além disso, o GSD pode levar a diminuição do tempo de desenvolvimento devido a diferença de fusos horários das equipes, sendo possível ter sempre alguma equipe desenvolvendo e pode facilitar a proximidade com os clientes e com o mercado de várias localidades diferentes.';
        DB::table('approaches')->insert([
            'approach_title'    => 'Abordagem para o desenvolvimento de software global (GSD‐RE)',
            'slug'              => str_slug('Abordagem para o desenvolvimento de software global'),
            'short_description' => 'A abordagem GSD-RE é uma abordagem que auxilia os stakeholders a se conscientizarem sobre os aspectos sociais, temporais, geográficos e de idiomas diferentes do GSD em um estágio inicial.',
            'approach_description' => $approach_description,
            'context_title' => 'Desenvolvimento de software global',
            'context_description' => $context_description,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

            $approach = DB::table('approaches')
            ->select(['id'])
            ->where('slug', str_slug('Abordagem para o desenvolvimento de software global'))
            ->first();

            $this->references($approach->id, [
            [
                'description' => 'ALI, Naveed; LAI, Richard. A method of requirements elicitation and analysis for Global Software Development. Journal of Software: Evolution and Process, v. 29, n. 4, p. e1830, 2017.',
                'code' => 1
            ],
            [
                'description' => 'CONCHÚIR, Eoin Ó. et al. Global software development: where are the benefits?. Communications of the ACM, v. 52, n. 8, p. 127-131, 2009.',
                'code' => 2
            ],
            ]);

            $this->entities($approach->id, [
            [
                'description' => 'Cenários'
            ],
            [
                'description' => 'Histórias de usuário'
            ],
                        [
                'description' => 'Casos de uso'
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
        DB::delete('DELETE * FROM approaches where approach_title = "Abordagem para o desenvolvimento de software global (GSD‐RE)"');
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