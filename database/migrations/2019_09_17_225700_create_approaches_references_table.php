<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApproachesReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approaches_references', function (Blueprint $table) {
            $table->unsignedInteger('approach_id');
            $table->unsignedInteger('reference_id');
            $table->unsignedInteger('code');
            $table->timestamps();

            $table->foreign('approach_id')
            ->references('id')
            ->on('approaches');

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
        Schema::dropIfExists('approaches_references');
    }
}
