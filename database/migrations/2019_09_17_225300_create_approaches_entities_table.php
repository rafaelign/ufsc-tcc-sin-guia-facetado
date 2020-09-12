<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApproachesEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approaches_entities', function (Blueprint $table) {
            $table->unsignedInteger('approach_id');
            $table->unsignedInteger('entity_id');
            $table->timestamps();

            $table->foreign('approach_id')
            ->references('id')
            ->on('approaches');

            $table->foreign('entity_id')
                ->references('id')
                ->on('entities');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approaches_entities');
    }
}
