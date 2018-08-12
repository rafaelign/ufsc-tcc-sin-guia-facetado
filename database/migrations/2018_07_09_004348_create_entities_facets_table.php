<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntitiesFacetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entities_facets', function (Blueprint $table) {
            $table->unsignedInteger('entity_id');
            $table->unsignedInteger('facet_id');
            $table->unsignedInteger('value_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('entity_id')
                ->references('id')
                ->on('entities');

            $table->foreign('facet_id')
                ->references('id')
                ->on('facets');

            $table->foreign('value_id')
                ->references('id')
                ->on('values');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entities_facets');
    }
}
