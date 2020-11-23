<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->bigInteger("building_id")->unsigned();
            $table->bigInteger("type_id")->unsigned();
            $table->string("number");
            $table->integer("floor");
            $table->enum('available',['yes','no'])->default('yes');
            $table->timestamps();

            $table->foreign('building_id')->references('id')->on('buildings')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::dropIfExists('rooms');
    }
}
