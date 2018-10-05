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
            $table->longText('images')->nullable();
            $table->tinyInteger('published')->default(0);
            $table->unsignedInteger('page_views')->default(0);
            $table->unsignedInteger('classification_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('classification_id')
                ->references('id')
                ->on('classifications');

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
