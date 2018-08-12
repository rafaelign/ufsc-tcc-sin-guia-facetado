<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('slug', 150);
            $table->string('short_description', 250);
            $table->longText('description');
            $table->longText('pros')->nullable();
            $table->longText('cons')->nullable();
            $table->longText('additional_data')->nullable();
            $table->tinyInteger('published')->default(0);
            $table->unsignedInteger('page_views')->default(0);
            $table->unsignedInteger('rating')->default(0);
            $table->unsignedInteger('collection_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('collection_id')
                ->references('id')
                ->on('collections');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entities');
    }
}
