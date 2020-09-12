<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApproachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approaches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('approach_title', 100);
            $table->string('slug', 150);
            $table->string('short_description', 250);
            $table->longText('approach_description');
            $table->string('context_title', 100);
            $table->longText('context_description');
            $table->tinyInteger('published')->default(0);
            $table->unsignedInteger('page_views')->default(0);
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approaches');
    }
}
