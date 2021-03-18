<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('request_id')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('overview');
            $table->json('ingredients');
            $table->text('paragraph_1');
            $table->text('paragraph_2')->nullable();
            $table->text('paragraph_3')->nullable();
            $table->text('paragraph_4')->nullable();
            $table->text('paragraph_5')->nullable();
            $table->text('paragraph_6')->nullable();
            $table->string('images')->nullable();
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
        Schema::dropIfExists('recipes');
    }
}
