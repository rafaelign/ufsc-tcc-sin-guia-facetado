<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntitiesReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entities_references', function (Blueprint $table) {
            $table->unsignedInteger('entity_id');
            $table->unsignedInteger('reference_id');
            $table->timestamps();

            $table->foreign('entity_id')
                ->references('id')
                ->on('entities');

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
        Schema::dropIfExists('entities_references');
    }
}
