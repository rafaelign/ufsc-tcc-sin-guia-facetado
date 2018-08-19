<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('values', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('slug', 250)->unique();
            $table->string('value', 200);
            $table->string('description', 250)->nullable();
            $table->unsignedInteger('facet_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('facet_id')
                ->references('id')
                ->on('facets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('values');
    }
}
