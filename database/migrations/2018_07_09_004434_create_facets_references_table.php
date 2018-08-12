<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacetsReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facets_references', function (Blueprint $table) {
            $table->unsignedInteger('facet_id');
            $table->unsignedInteger('reference_id');
            $table->timestamps();

            $table->foreign('facet_id')
                ->references('id')
                ->on('facets');

            $table->foreign('reference_id')
                ->references('id')
                ->on('references');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facets_references');
    }
}
