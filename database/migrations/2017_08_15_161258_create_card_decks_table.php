<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardDecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_decks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('deck_id')->unsigned();
            $table->foreign('deck_id')->references('id')->on('decks');
            $table->integer('card_id');
            $table->foreign('card_id')->references('id')->on('cards');
            $table->integer('quantity');
            $table->softDeletes();
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
        Schema::dropIfExists('card_decks');
    }
}
