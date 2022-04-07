<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->integer('unique_id')->nullable();
            $table->string("name")->nullable();
            $table->mediumText("description")->nullable();
            $table->string("modified")->nullable();
            $table->string("resource_uri")->nullable();
            $table->json('thumbnail')->nullable();
            $table->json('comics')->nullable();
            $table->json('series')->nullable();
            $table->json('stories')->nullable();
            $table->json('events')->nullable();
            $table->json('urls')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
