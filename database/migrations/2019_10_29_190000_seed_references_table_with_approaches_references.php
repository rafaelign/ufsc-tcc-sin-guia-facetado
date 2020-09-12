<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedReferencesTableWithApproachesReferences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('references')->insert([
            ['description' => 'ISLAM, Rashedul; ISLAM, Rofiqul; MAZUMDER, Tahindul. Mobile application and its global impact. International Journal of Engineering & Technology (IJEST), v. 10, n. 6, p. 72-78, 2010.'],
            ['description' => 'ABAD, Zahra Shakeri Hossein et al. Learn more, pay less! lessons learned from applying the wizard-of-oz technique for exploring mobile app requirements. In: 2017 IEEE 25th International Requirements Engineering Conference Workshops (REW). IEEE, 2017. p. 132-138.'],
            ['description' => 'ALI, Naveed; LAI, Richard. A method of requirements elicitation and analysis for Global Software Development. Journal of Software: Evolution and Process, v. 29, n. 4, p. e1830, 2017.'],
            ['description' => 'CONCHÚIR, Eoin Ó. et al. Global software development: where are the benefits?. Communications of the ACM, v. 52, n. 8, p. 127-131, 2009.'],
            ['description' => 'PALACIN-SILVA, Maria et al. Infusing design thinking into a software engineering capstone course. In: 2017 IEEE 30th Conference on Software Engineering Education and Training (CSEE&T). IEEE, 2017. p. 212-221.'],
            ['description' => 'Iain Heath (2018) User Experience is… Design Thinking, Disponível em: https://uxdesign.cc/user-experience-is-design-thinking-2428a0a360c2 (Acessado: 24 de Outubro de 2019).'],
            ['description' => 'Comunidade Compartilhar (2017) Convergindo Design Thinking e Canvas, Disponível em: https://medium.com/@compartilhar.co/convergindo-design-thinking-e-canvas-cf5e95183cbb (Acessado: 24 de Outubro de 2019.).'],
            ['description' => 'RUDOLPH, Manuel et al. Requirements elicitation and derivation of security policy templates—an industrial case study. In: 2016 IEEE 24th International Requirements Engineering Conference (RE). IEEE, 2016. p. 283-292.'],
            ['description' => 'RUDOLPH, Manuel; SCHWARZ, Reinhard; JUNG, Christian. Security policy specification templates for critical infrastructure services in the cloud. In: The 9th International Conference for Internet Technology and Secured Transactions (ICITST-2014). IEEE, 2014. p. 61-66.'],
            ['description' => 'NOSRATI, Masoud. Exact requirements engineering for developing business process models. In: 2017 3th International Conference on Web Research (ICWR). IEEE, 2017. p. 140-147.'],
            ['description' => 'VANDERFEESTEN, Irene et al. Quality metrics for business process models. BPM and Workflow handbook, v. 144, p. 179-190, 2007.'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('references')->delete();
    }
}
