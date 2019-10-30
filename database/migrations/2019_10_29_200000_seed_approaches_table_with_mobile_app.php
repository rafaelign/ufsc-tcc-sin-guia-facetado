<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
class SeedApproachesTableWithMobileApp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $approach_description = 'A abordagem Wizard of Oz (WOz) é uma abordagem de prototipagem de baixa fidelidade, onde requisitos de software são simulados para dar uma impressão de como esses requisitos funcionarão quando realmente implementados. A simulação geralmente é feita através de esboços em papel da interface que são movidas e alteradas por um facilitador em resposta à entrada do usuário. A técnica WOz é interessante pois pode elicitar requisitos que não são possíveis de serem reunidos por outras técnicas de elicitação de requisitos. Permite que os usuários se envolvam no processo de requisitos de uma maneira que não é possível por outras técnicas de elicitação.

###### *Técnicas desta abordagem não contempladas no guia: Client product descriptions.*';
        $context_description = 'Aplicativos mobile rodam em um pequeno dispositivo móvel de mão que é fácil de usar e acessível em qualquer hora e qualquer lugar. Atualmente uma grande parte da população está utilizando aplicativos diariamente para entrar em contato com amigos, navegar na Internet, gerenciar conteúdos, entretenimento etc. Os aplicativos não só são utilizados para as vidas sociais das pessoas, mas também podem ser utilizados em suas vidas profissionais, auxiliando em seus trabalhos. Além disso, o impacto dos aplicativos não é somente para o usuário, mas também desempenha um papel importante nos negócios. Muitas empresas estão obtendo grandes benefícios lançando aplicativos ou promovendo seus produtos neles. Os aplicativos são executados em um dispositivo cuja usabilidade depende de vários fatores como: resolução da tela, limitações de hardware, uso de dado, problemas de conectividade, possibilidades de interação limitadas. Nos últimos anos, as empresas de dispositivos móveis estão tentando desenvolver um dispositivos com mais resolução de tela, maior armazenamento, melhor conectividade para que ele forneça um ambiente melhor para aplicativos mais modernos.';
        DB::table('approaches')->insert([
            'approach_title'    => 'Abordagem para aplicativos mobile (Wizard-of-Oz)',
            'slug'              => str_slug('Abordagem para aplicativos mobile'),
            'short_description' => 'A abordagem Wizard of Oz (WOz) é uma abordagem de prototipagem de baixa fidelidade, onde requisitos de software são simulados para dar uma impressão de como esses requisitos funcionarão quando realmente implementados.',
            'approach_description' => $approach_description,
            'context_title' => 'Aplicativos mobile',
            'context_description' => $context_description,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

            $approach = DB::table('approaches')
            ->select(['id'])
            ->where('slug', str_slug('Abordagem para aplicativos mobile'))
            ->first();

            $this->references($approach->id, [
            [
                'description' => 'ISLAM, Rashedul; ISLAM, Rofiqul; MAZUMDER, Tahindul. Mobile application',
                'code' => 1
            ],
            [
                'description' => 'ABAD, Zahra Shakeri Hossein et al. Learn more, pay less! lessons learned from applying the wizard-of-oz technique for exploring mobile app requirements. In: 2017 IEEE 25th International Requirements Engineering Conference Workshops (REW). IEEE, 2017. p. 132-138.',
                'code' => 2
            ],
            ]);

            $this->entities($approach->id, [
            [
                'description' => 'Prototipação'
            ],
            [
                'description' => 'Reuniões'
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
        DB::delete('DELETE * FROM approaches where approach_title = "Abordagem para aplicativos mobile (Wizard-of-Oz)"');
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