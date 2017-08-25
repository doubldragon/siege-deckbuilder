<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('isMonarch');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('card_types');
            $table->string('type_icon')->nullable();
            $table->string('name')->unique();
            $table->integer('deck_points')->nullable();
            $table->integer('cost')->nullable();
            $table->string('action');
            $table->string('effect');
            $table->string('flavor_text');
            $table->boolean('isActive')->default(true);
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
        Schema::dropIfExists('cards');
    }
}
