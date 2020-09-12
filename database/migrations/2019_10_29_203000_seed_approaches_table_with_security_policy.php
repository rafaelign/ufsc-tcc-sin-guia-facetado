<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;
class SeedApproachesTableWithSecurityPolicy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $approach_description = 'A abordagem coloca parte das decisões da engenharia de requisitos para o usuário final, que especifica suas demandas de segurança em tempo de execução, e não apenas durante o desenvolvimento, para alterar o comportamento de segurança do sistema. O processo possui três fases principais, como é possível observar na figura abaixo: “Inicialização do Projeto”, que estabelece uma base, "Elicitação e documentação", que elicita demandas e políticas de segurança e “Derivação e Validação”, que valida os resultados e deriva modelos de política de segurança. Conceitualmente, a fase de "Elicitação e documentação" pode ser vista como uma sub atividade de elicitação e especificação de requisitos gerais, com foco especial nas políticas de segurança. A fase de  “Derivação e Validação” é conceitualmente uma subatividade da validação e verificação de requisitos gerais, pois o conjunto completo de modelos especificados tem sua qualidade verificada. 

![Ilustração das fases da abordagem](/images/abordagem-security-policy.png) 

###### *Técnicas desta abordagem não contempladas no guia: Goal trees.*';
        $context_description = 'Uma política de segurança descreve uma ameaça e uma contramedida para mitigar ou impedir a ameaça. Uma ferramenta de aplicação de políticas pode ser integrada a um sistema para executar a mitigação ou prevenção de ameaças de acordo com as políticas de segurança especificadas. Um modelo de política de segurança descreve genericamente ameaças e possíveis contramedidas como padrão de política linguagem natural que pode ser instanciada em uma política de segurança. Um catálogo desses modelos de política de segurança deve ser fornecido aos autores das políticas para que eles possam refinar esses modelos para expressar melhor suas demandas individuais de segurança.';
        DB::table('approaches')->insert([
            'approach_title'    => 'Abordagem para modelos de políticas de segurança',
            'slug'              => str_slug('Abordagem para modelos de políticas de segurança'),
            'short_description' => 'A abordagem coloca parte das decisões da engenharia de requisitos para o usuário final, que especifica suas demandas de segurança em tempo de execução, e não apenas durante o desenvolvimento, para alterar o comportamento de segurança do sistema.',
            'approach_description' => $approach_description,
            'context_title' => 'Security Policy Templates',
            'context_description' => $context_description,
            'published'         => 1,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

            $approach = DB::table('approaches')
            ->select(['id'])
            ->where('slug', str_slug('Abordagem para modelos de políticas de segurança'))
            ->first();

            $this->references($approach->id, [
            [
                'description' => 'RUDOLPH, Manuel et al. Requirements elicitation and derivation of security policy templates—an industrial case study. In: 2016 IEEE 24th International Requirements Engineering Conference (RE). IEEE, 2016. p. 283-292.',
                'code' => 1
            ],
            [
                'description' => 'RUDOLPH, Manuel; SCHWARZ, Reinhard; JUNG, Christian. Security policy specification templates for critical infrastructure services in the cloud. In: The 9th International Conference for Internet Technology and Secured Transactions (ICITST-2014). IEEE, 2014. p. 61-66.',
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
                'description' => 'Grupo Focal'
            ],
            [
                'description' => 'Workshops'
            ],
            [
                'description' => 'Questionários'
            ],
            [
                'description' => 'Brainstorming'
            ],
            [
                'description' => 'Mapas mentais'
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
        DB::delete('DELETE * FROM approaches where approach_title = "Abordagem para modelos de políticas de segurança"');
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
