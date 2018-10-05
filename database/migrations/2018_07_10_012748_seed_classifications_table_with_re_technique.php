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
            'description' => 'São técnicas utilizadas para elicitar requisitos de um produto ou serviço de software. Em outras palavras, são maneiras de extrair as necessidades do cliente para resolução de determinado problema por meio do software. Alguns exemplos são:',
            'classification_type' => 'Técnicas',
            'main_menu' => 'Técnicas',
            'published' => 1,
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
