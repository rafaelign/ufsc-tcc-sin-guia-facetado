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
                'title' => 'Geral'
            ],
            [
                'title' => 'Elicitor'
            ],
            [
                'title' => 'Domínio do problema'
            ],
            [
                'title' => 'Stakeholder'
            ],
            [
                'title' => 'Características gerais da técnica'
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
