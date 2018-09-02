<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class SeedClassificationsTableWithReTechnique extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('classifications')->insert([
            'title' => 'Técnicas de Elicitação de Requisitos',
            'slug' => str_slug('Técnicas de Elicitação de Requisitos'),
            'description' => 'Conteúdo da página associada a coleção de técnicas de elicitação de requisitos.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $RETechniqueCollection = DB::table('classifications')
            ->select(['id'])
            ->where('slug', str_slug('Técnicas de Elicitação de Requisitos'))
            ->first();

        DB::table('classifications')
            ->delete($RETechniqueCollection->id);
    }
}
