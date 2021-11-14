<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card', function (Blueprint $table) {
            $table->id();
			$table->string('id_data');
			$table->string('oracle_id');
			$table->string('name');
			$table->date('released_at');
			$table->string('image_uris', 200);
			$table->string('mana');
			$table->string('type_line');
			$table->string('oracle_text');
			$table->string('colors');
			$table->string('rarity');
			$table->integer('quantidade')->nullable()->default(NULL);
			$table->boolean('disponivel')->nullable()->default(NULL);	
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
        Schema::dropIfExists('card');
    }
}
