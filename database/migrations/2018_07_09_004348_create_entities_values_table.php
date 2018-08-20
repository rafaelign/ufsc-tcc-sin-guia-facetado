<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntitiesValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entities_values', function (Blueprint $table) {
            $table->unsignedInteger('entity_id');
            $table->unsignedInteger('value_id');
            $table->timestamps();

            $table->foreign('entity_id')
                ->references('id')
                ->on('entities');

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
        Schema::dropIfExists('entities_values');
    }
}
