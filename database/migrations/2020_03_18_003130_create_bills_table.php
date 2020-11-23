<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('room_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('user_paid')->unsigned()->nullable();
            $table->float('water_unit')->default(0);
            $table->float('electric_unit')->default(0);
            $table->float('room_price');
            $table->float('total_price');
            $table->date('activated_at')->nullable();
            $table->enum('status',['รอชำระ','ชำระแล้ว','บิลใหม่'])->default('รอชำระ');
            $table->timestamps();

            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_paid')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('bills');
    }
}
