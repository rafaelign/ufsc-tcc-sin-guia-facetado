<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedFacetGroupsTableWithReGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('facet_groups')->insert([
            [
                'title'     => 'Geral',
                'layout'    => 'horizontal',
            ],
            [
                'title' => 'Elicitor',
                'layout'    => 'vertical',
            ],
            [
                'title' => 'Domínio do problema',
                'layout'    => 'vertical',
            ],
            [
                'title' => 'Stakeholder',
                'layout'    => 'vertical',
            ],
            [
                'title' => 'Características gerais da técnica',
                'layout'    => 'vertical',
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
        DB::table('facet_groups')->delete();
    }
}
