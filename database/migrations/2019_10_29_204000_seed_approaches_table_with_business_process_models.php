<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
class SeedApproachesTableWithBusinessProcessModels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $approach_description = 'A abordagem combina dois métodos de engenharia de requisitos: “Business-Oriented Requirements Engineering (BORE)” e “Business-driven development (BDD)”. Essa abordagem permite a elicitação dos requisitos para modelos de processos de negócio e permite rastreabilidade entre os processos de negócio e os requisitos de sistema correspondentes, de forma a garantir que os requisitos estão de acordo com as necessidades do negócio. Um dos principais objetivos do BORE é realizar o processo de engenharia de requisitos de forma paralela com a modelagem do sistema, o que resulta em um progresso mais rápido. Por outro lado, o método BDD oferece algumas dicas para deixar a informação do sistema mais consistente, pois fornece uma definição mais extensa da engenharia de requisitos considerando a possível mudança futura de requisitos assim como a hierarquia de requisitos e a integridade das informações do sistema. Modificando o método BORE com algumas dicas do BDD resulta numa abordagem de engenharia de requisitos mais exata e flexível. 

###### *Técnicas desta abordagem não contempladas no guia: Apprenticing.*';
        $context_description = 'Modelos de processo tem se tornado uma ferramenta muito popular entre o desenvolvimento de negócios nas últimas décadas. Um modelo de processo de negócio possui muitas semelhanças com programas de software convencionais. Um programa de software é usualmente separado em módulos ou funcionalidades, que recebem uma entrada e fornecem alguma saída. Semelhante a essa estrutura, um modelo de processo de negócio consiste de atividades onde cada uma delas contém algumas operações menores. Além disso, assim como as interações entre módulos e funcionalidades em um programa de software são bem especificadas, a ordem de execução das atividades em um modelo de processo é pré-definida usando operadores lógicos. Modelar os processos de negócio tem sido um processo aprimorado a partir de diferentes perspectivas, como por exemplo otimizando o processo de trabalho, desenvolvendo práticas de organização para seguir os padrões de qualidade, automatizando trabalho e desenvolvendo sistemas de TI.';
        DB::table('approaches')->insert([
            'approach_title'    => 'Abordagem para modelos de processos de negócios',
            'slug'              => str_slug('Abordagem para modelos de processos de negócios'),
            'short_description' => 'Essa abordagem permite a elicitação dos requisitos para modelos de processos de negócio e permite rastreabilidade entre os processos de negócio e os requisitos de sistema.',
            'approach_description' => $approach_description,
            'context_title' => 'Business Process Models',
            'context_description' => $context_description,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

            $approach = DB::table('approaches')
            ->select(['id'])
            ->where('slug', str_slug('Abordagem para modelos de processos de negócios'))
            ->first();

            $this->references($approach->id, [
            [
                'description' => 'NOSRATI, Masoud. Exact requirements engineering for developing business process models. In: 2017 3th International Conference on Web Research (ICWR). IEEE, 2017. p. 140-147.',
                'code' => 1
            ],
            [
                'description' => 'VANDERFEESTEN, Irene et al. Quality metrics for business process models. BPM and Workflow handbook, v. 144, p. 179-190, 2007.',
                'code' => 2
            ],
            ]);

            $this->entities($approach->id, [
            [
                'description' => 'Entrevista'
            ],
            [
                'description' => 'Análise de Documentos'
            ],
            [
                'description' => 'Workshops'
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
        DB::delete('DELETE * FROM approaches where approach_title = "Abordagem para modelos de processos de negócios"');
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